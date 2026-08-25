<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approvals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_role = $this->session->userdata('role');
        if ($user_role !== 'Admin' && $user_role !== 'Sub-Admin') {
            $this->session->set_flashdata('error', 'Access denied. Approver privileges required.');
            redirect('auth');
        }
    }

    public function index() {
        $user_role = $this->session->userdata('role');
        $status_filter = $this->input->get('status') ? $this->input->get('status') : 'pending';

        $data['registrations'] = $this->Registration_model->get_approver_registrations($user_role, $status_filter);
        $data['status_filter'] = $status_filter;
        
        $this->load->view('approvals/index', $data);
    }

    public function approve($registration_id) {
        $approver_id = $this->session->userdata('user_id');
        $comments = $this->input->post('comments') ? $this->input->post('comments') : 'Approved by sub-admin';

        $reg = $this->Registration_model->get_registration_details($registration_id);
        if (!$reg) {
            show_404();
        }

        // Log approval
        $this->Registration_model->log_approval(array(
            'registration_id' => $registration_id,
            'approver_id' => $approver_id,
            'status' => 'approved',
            'comments' => $comments
        ));

        // Check if there is a next approval level
        $next_band = $this->Approval_model->get_band_by_sequence($reg->event_id, $reg->current_approval_level + 1);

        if ($next_band) {
            // Move to next approval level
            $this->Registration_model->update_registration($registration_id, array(
                'current_approval_level' => $reg->current_approval_level + 1
            ));
            $this->session->set_flashdata('success', 'Registration approved and forwarded to Level ' . ($reg->current_approval_level + 1) . ' approvers.');
        } else {
            // Fully approved
            $this->Registration_model->update_registration($registration_id, array(
                'status' => 'approved'
            ));
            $this->session->set_flashdata('success', 'Registration has been fully approved!');
        }

        redirect('approvals');
    }

    public function reject($registration_id) {
        $approver_id = $this->session->userdata('user_id');
        $comments = $this->input->post('comments') ? $this->input->post('comments') : 'Rejected by sub-admin';

        $reg = $this->Registration_model->get_registration_details($registration_id);
        if (!$reg) {
            show_404();
        }

        // Log rejection
        $this->Registration_model->log_approval(array(
            'registration_id' => $registration_id,
            'approver_id' => $approver_id,
            'status' => 'rejected',
            'comments' => $comments
        ));

        // Mark registration as rejected
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
            $this->session->set_flashdata('success', 'Registration rejected. A spot opened up and waitlisted user (ID: ' . $waitlisted->id . ') was promoted to pending!');
        } else {
            $this->session->set_flashdata('success', 'Registration rejected successfully.');
        }

        redirect('approvals');
    }
}
