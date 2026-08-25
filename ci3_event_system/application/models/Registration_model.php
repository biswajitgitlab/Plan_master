<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_registration($event_id, $user_id) {
        return $this->db->get_where('registrations', array(
            'event_id' => $event_id,
            'user_id' => $user_id
        ))->row();
    }

    public function count_role_registrations($event_id, $role_name) {
        $this->db->select('COUNT(r.id) as total');
        $this->db->from('registrations r');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->where('r.event_id', $event_id);
        $this->db->where('u.role', $role_name);
        $this->db->where('r.status !=', 'rejected');
        $query = $this->db->get();
        $row = $query->row();
        return $row ? (int)$row->total : 0;
    }

    public function create_registration($data) {
        $this->db->insert('registrations', $data);
        return $this->db->insert_id();
    }

    public function get_approver_registrations($role_name, $status_filter = 'pending') {
        $this->db->select('r.*, e.name as event_name, u.name as user_name, u.email as user_email, u.role as user_role');
        $this->db->from('registrations r');
        $this->db->join('events e', 'r.event_id = e.id');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->join('approval_bands ab', 'ab.event_id = r.event_id AND ab.level_sequence = r.current_approval_level');

        if ($role_name !== 'Admin') {
            $this->db->where('ab.role_name', $role_name);
        }

        if ($status_filter !== 'all') {
            $this->db->where('r.status', $status_filter);
        }

        $this->db->order_by('r.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_registration_details($id) {
        $this->db->select('r.*, e.name as event_name, u.name as user_name, u.email as user_email, u.role as user_role');
        $this->db->from('registrations r');
        $this->db->join('events e', 'r.event_id = e.id');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    public function update_registration($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('registrations', $data);
    }

    public function log_approval($data) {
        return $this->db->insert('registration_approvals', $data);
    }

    public function get_next_waitlisted_user($event_id, $role_name) {
        $this->db->select('r.*');
        $this->db->from('registrations r');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->where('r.event_id', $event_id);
        $this->db->where('r.status', 'waitlisted');
        $this->db->where('u.role', $role_name);
        $this->db->order_by('r.created_at', 'ASC');
        return $this->db->get()->row();
    }
}
