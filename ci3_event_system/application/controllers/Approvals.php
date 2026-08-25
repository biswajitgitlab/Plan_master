<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approvals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_role = $this->session->userdata('role');
        if ($user_role !== 'Admin' && $user_role !== 'Sub-Admin' && $user_role !== 'Manager') {
            $this->session->set_flashdata('error', 'Access denied. Approver privileges required.');
            redirect('auth');
        }
    }

    public function index() {
        $user_role = $this->session->userdata('role');
        $status_filter = $this->input->get('status') ? $this->input->get('status') : 'pending';
        $role_filter = $this->input->get('role') ? $this->input->get('role') : 'all';
        $search = $this->input->get('search');
        $page = max(1, (int)($this->input->get('page') ? $this->input->get('page') : 1));
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $res = $this->Registration_model->get_approver_registrations_paginated($user_role, $status_filter, $role_filter, $search, $limit, $offset);

        $data['registrations'] = $res['registrations'];
        $data['total_records'] = $res['total'];
        $data['total_pages'] = ceil($res['total'] / $limit);
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['status_filter'] = $status_filter;
        $data['role_filter'] = $role_filter;
        $data['search'] = $search;

        $this->load->view('approvals/index', $data);
    }

    public function approve($registration_id) {
        $approver_id = $this->session->userdata('user_id');
        $comments = $this->input->post('comments') ? $this->input->post('comments') : 'Approved by reviewer';

        $reg = $this->Registration_model->get_registration_details($registration_id);
        if (!$reg) {
            show_404();
        }

        // Log approval step audit
        $this->Registration_model->log_approval(array(
            'registration_id' => $registration_id,
            'approver_id' => $approver_id,
            'status' => 'approved',
            'comments' => $comments
        ));

        // Check for next level approval band
        $next_band = $this->Approval_model->get_band_by_sequence($reg->event_id, $reg->current_approval_level + 1);

        if ($next_band) {
            $this->Registration_model->update_registration($registration_id, array(
                'current_approval_level' => $reg->current_approval_level + 1
            ));
            $this->session->set_flashdata('success', 'Registration approved and escalated to Level ' . ($reg->current_approval_level + 1) . ' approvers.');
        } else {
            $this->Registration_model->update_registration($registration_id, array(
                'status' => 'approved'
            ));
            $this->session->set_flashdata('success', 'Registration has been fully approved!');
        }

        redirect('approvals');
    }

    public function reject($registration_id) {
        $approver_id = $this->session->userdata('user_id');
        $comments = $this->input->post('comments') ? $this->input->post('comments') : 'Rejected by reviewer';

        $reg = $this->Registration_model->get_registration_details($registration_id);
        if (!$reg) {
            show_404();
        }

        $this->Registration_model->log_approval(array(
            'registration_id' => $registration_id,
            'approver_id' => $approver_id,
            'status' => 'rejected',
            'comments' => $comments
        ));

        $this->Registration_model->update_registration($registration_id, array(
            'status' => 'rejected'
        ));

        // Waitlist Promotion Logic
        $waitlisted = $this->Registration_model->get_next_waitlisted_user($reg->event_id, $reg->user_role);

        if ($waitlisted) {
            $this->Registration_model->update_registration($waitlisted->id, array(
                'status' => 'pending',
                'current_approval_level' => 1
            ));
            $this->session->set_flashdata('success', 'Registration rejected. A spot opened up for role "' . $reg->user_role . '", and waitlisted applicant (ID: #' . $waitlisted->id . ') was automatically promoted to Pending Approval!');
        } else {
            $this->session->set_flashdata('success', 'Registration rejected.');
        }

        redirect('approvals');
    }
}
