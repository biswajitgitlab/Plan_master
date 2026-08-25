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
        $search = $this->input->get('search');
        $health_filter = $this->input->get('health') ? $this->input->get('health') : 'all';
        $page = max(1, (int)($this->input->get('page') ? $this->input->get('page') : 1));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $res = $this->Event_model->get_paginated_events($search, $health_filter, 'start_date_asc', $limit, $offset);

        $data['events'] = $res['events'];
        $data['total_records'] = $res['total'];
        $data['total_pages'] = ceil($res['total'] / $limit);
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['search'] = $search;
        $data['health_filter'] = $health_filter;

        $data['total_active_regs'] = $this->Registration_model->count_active_registrations();
        $data['total_waitlisted'] = $this->Registration_model->count_waitlisted_registrations();

        $this->load->view('admin/dashboard', $data);
    }

    public function events() {
        $search = $this->input->get('search');
        $demand_filter = $this->input->get('demand') ? $this->input->get('demand') : 'all';
        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'start_date_asc';
        $page = max(1, (int)($this->input->get('page') ? $this->input->get('page') : 1));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $res = $this->Event_model->get_paginated_events($search, $demand_filter, $sort, $limit, $offset);

        $data['events'] = $res['events'];
        $data['total_records'] = $res['total'];
        $data['total_pages'] = ceil($res['total'] / $limit);
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['search'] = $search;
        $data['demand_filter'] = $demand_filter;
        $data['sort'] = $sort;

        $this->load->view('admin/events_index', $data);
    }

    public function create_event() {
        $this->load->view('admin/create_event');
    }

    public function store_event() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $form_schema = $this->input->post('form_schema');

        // Handle Image Upload
        $image_path = NULL;
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/events/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 5120; // 5MB
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $image_path = 'events/' . $uploadData['file_name'];
            }
        }

        $event_data = array(
            'name' => $name,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location' => $location,
            'image_path' => $image_path,
            'created_by' => $this->session->userdata('user_id'),
            'form_schema' => $form_schema
        );

        $event_id = $this->Event_model->create_event($event_data);

        // Process Quotas
        $quotas = $this->input->post('quotas');
        if (!empty($quotas) && is_array($quotas)) {
            foreach ($quotas as $role_name => $limit) {
                if ($limit !== '' && $limit !== NULL) {
                    $this->Quota_model->save_quota($event_id, $role_name, (int)$limit);
                }
            }
        }

        // Process Approval Bands
        $bands = $this->input->post('approval_bands');
        if (!empty($bands) && is_array($bands)) {
            foreach ($bands as $idx => $role_name) {
                if (!empty($role_name)) {
                    $this->Approval_model->save_band($event_id, $role_name, $idx + 1);
                }
            }
        }

        $this->session->set_flashdata('success', 'Event created successfully!');
        redirect('admin/events');
    }

    public function edit_event($id) {
        $data['event'] = $this->Event_model->get_event($id);
        if (!$data['event']) {
            show_404();
        }
        $this->load->view('admin/edit_event', $data);
    }

    public function update_event($id) {
        $event = $this->Event_model->get_event($id);
        if (!$event) {
            show_404();
        }

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $form_schema = $this->input->post('form_schema');

        $event_data = array(
            'name' => $name,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location' => $location,
            'form_schema' => $form_schema
        );

        // Handle Image Upload
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/events/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 5120;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $event_data['image_path'] = 'events/' . $uploadData['file_name'];
            }
        }

        $this->Event_model->update_event($id, $event_data);

        $this->session->set_flashdata('success', 'Event details updated successfully!');
        redirect('admin/edit_event/' . $id);
    }

    public function store_quota($event_id) {
        $role_name = $this->input->post('role_name');
        $quota_limit = (int)$this->input->post('quota_limit');

        if ($role_name && $quota_limit > 0) {
            $this->Quota_model->save_quota($event_id, $role_name, $quota_limit);
            $this->session->set_flashdata('success', 'Quota allocation updated.');
        }

        redirect('admin/edit_event/' . $event_id);
    }

    public function delete_quota($quota_id, $event_id) {
        $this->Quota_model->delete_quota($quota_id);
        $this->session->set_flashdata('success', 'Quota limit removed.');
        redirect('admin/edit_event/' . $event_id);
    }

    public function delete_event($id) {
        $this->Event_model->delete_event($id);
        $this->session->set_flashdata('success', 'Event deleted successfully.');
        redirect('admin/events');
    }
}
