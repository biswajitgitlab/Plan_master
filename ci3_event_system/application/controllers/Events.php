<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $search = $this->input->get('search');
        $availability_filter = $this->input->get('availability') ? $this->input->get('availability') : 'all';
        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'start_date_asc';
        $page = max(1, (int)($this->input->get('page') ? $this->input->get('page') : 1));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $res = $this->Event_model->get_paginated_events($search, $availability_filter, $sort, $limit, $offset);

        $data['events'] = $res['events'];
        $data['total_records'] = $res['total'];
        $data['total_pages'] = ceil($res['total'] / $limit);
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['search'] = $search;
        $data['availability_filter'] = $availability_filter;
        $data['sort'] = $sort;

        $this->load->view('events/index', $data);
    }

    public function detail($event_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }

        $data['event'] = $this->Event_model->get_event($event_id);
        if (!$data['event']) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');
        $data['registration'] = $this->Registration_model->get_user_registration($event_id, $user_id);
        $data['quotas'] = $this->Quota_model->get_quotas_by_event($event_id);
        $data['approval_bands'] = $this->Approval_model->get_bands_by_event($event_id);

        $this->load->view('events/detail', $data);
    }

    public function register($event_id) {
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }

        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('role') ? $this->session->userdata('role') : 'Employee';

        $existing = $this->Registration_model->get_user_registration($event_id, $user_id);
        if ($existing) {
            $this->session->set_flashdata('error', 'You have already registered for this event.');
            redirect('events/detail/' . $event_id);
        }

        $event = $this->Event_model->get_event($event_id);
        if (!$event) {
            show_404();
        }

        $form_data = $this->input->post('dynamic_field');
        if (!$form_data) {
            $form_data = $this->input->post();
            unset($form_data['ci_csrf_token']);
        }

        // Quota Logic
        $quota = $this->Quota_model->get_quota_for_role($event_id, $user_role);
        $status = 'pending';

        if ($quota && $quota->quota_limit > 0) {
            $current_count = $this->Registration_model->count_role_registrations($event_id, $user_role);
            if ($current_count >= $quota->quota_limit) {
                $status = 'waitlisted';
            }
        }

        $registration_data = array(
            'event_id' => $event_id,
            'user_id' => $user_id,
            'status' => $status,
            'form_data' => json_encode($form_data ? $form_data : new stdClass()),
            'current_approval_level' => 1
        );

        $this->Registration_model->create_registration($registration_data);

        if ($status === 'waitlisted') {
            $this->session->set_flashdata('warning', 'The quota limit for your role (' . $user_role . ') has been reached. You have been placed on the waitlist.');
        } else {
            $this->session->set_flashdata('success', 'Registration submitted successfully! Current status: Pending Approval.');
        }

        redirect('events/detail/' . $event_id);
    }
}
