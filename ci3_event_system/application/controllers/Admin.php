<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'Admin') {
            $this->session->set_flashdata('error', 'Access denied. Administrator privileges required.');
            redirect('auth');
        }
    }

    public function index() {
        $data['events'] = $this->Event_model->get_all_events();
        $this->load->view('admin/dashboard', $data);
    }

    public function create_event() {
        $this->load->view('admin/create_event');
    }

    public function store_event() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $form_schema = $this->input->post('form_schema'); // Expecting valid JSON string

        $event_data = array(
            'name' => $name,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'form_schema' => $form_schema
        );

        $event_id = $this->Event_model->create_event($event_data);

        // Process Quotas
        $roles = $this->input->post('quota_role');
        $limits = $this->input->post('quota_limit');
        if (!empty($roles) && is_array($roles)) {
            foreach ($roles as $idx => $role) {
                if (!empty($role) && isset($limits[$idx])) {
                    $this->Quota_model->save_quota($event_id, $role, (int)$limits[$idx]);
                }
            }
        }

        // Process Approval Bands
        $band_roles = $this->input->post('band_role');
        if (!empty($band_roles) && is_array($band_roles)) {
            foreach ($band_roles as $seq => $brole) {
                if (!empty($brole)) {
                    $this->Approval_model->save_band($event_id, $brole, $seq + 1);
                }
            }
        }

        $this->session->set_flashdata('success', 'Event created successfully with Quotas and Approval Bands!');
        redirect('admin');
    }

    public function delete_event($id) {
        $this->Event_model->delete_event($id);
        $this->session->set_flashdata('success', 'Event deleted successfully.');
        redirect('admin');
    }
}
