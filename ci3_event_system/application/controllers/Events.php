<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['events'] = $this->Event_model->get_all_events();
        $this->load->view('events/index', $data);
    }

    public function detail($event_id) {
        $data['event'] = $this->Event_model->get_event($event_id);
        $user_id = $this->session->userdata('user_id');
        $data['registration'] = $this->Registration_model->get_user_registration($event_id, $user_id);
        $data['quotas'] = $this->Quota_model->get_quotas_by_event($event_id);
        
        $this->load->view('events/detail', $data);
    }

    public function register($event_id) {
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('role');

        // Check if user already registered
        $existing = $this->Registration_model->get_user_registration($event_id, $user_id);
        if ($existing) {
            $this->session->set_flashdata('error', 'You are already registered for this event.');
            redirect('events/detail/' . $event_id);
        }

        $event = $this->Event_model->get_event($event_id);
        $form_data = $this->input->post('dynamic_field'); // Array of dynamic responses

        // Quota Check Logic
        $quota = $this->Quota_model->get_quota_for_role($event_id, $user_role);
        $status = 'pending';

        if ($quota) {
            $current_count = $this->Registration_model->count_role_registrations($event_id, $user_role);
            if ($current_count >= $quota->quota_limit) {
                $status = 'waitlisted';
            }
        }

        $registration_data = array(
            'event_id' => $event_id,
            'user_id' => $user_id,
            'status' => $status,
            'form_data' => json_encode($form_data ? $form_data : array()),
            'current_approval_level' => 1
        );

        $this->Registration_model->create_registration($registration_data);

        if ($status === 'waitlisted') {
            $this->session->set_flashdata('warning', 'The quota for your role (' . $user_role . ') is full. You have been placed on the waitlist.');
        } else {
            $this->session->set_flashdata('success', 'Registration submitted successfully! Current status: Pending Approval.');
        }

        redirect('events/detail/' . $event_id);
    }
}
