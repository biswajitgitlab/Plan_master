<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_registrations_by_event($event_id) {
        $this->db->select('r.*, u.name as user_name, u.email as user_email, u.role as user_role');
        $this->db->from('registrations r');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->where('r.event_id', $event_id);
        return $this->db->get()->result();
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

    public function count_active_registrations() {
        $this->db->where('status !=', 'rejected');
        return $this->db->count_all_results('registrations');
    }

    public function count_waitlisted_registrations() {
        $this->db->where('status', 'waitlisted');
        return $this->db->count_all_results('registrations');
    }

    public function create_registration($data) {
        $this->db->insert('registrations', $data);
        return $this->db->insert_id();
    }

    public function get_approver_registrations_paginated($role_name, $status_filter = 'pending', $role_filter = 'all', $search = NULL, $limit = 5, $offset = 0) {
        $this->db->start_cache();

        $this->db->select('r.*, e.name as event_name, u.name as user_name, u.email as user_email, u.role as user_role');
        $this->db->from('registrations r');
        $this->db->join('events e', 'r.event_id = e.id');
        $this->db->join('users u', 'r.user_id = u.id');

        if ($role_name !== 'Admin' && $status_filter === 'pending') {
            $this->db->join('approval_bands ab', 'ab.event_id = r.event_id AND ab.level_sequence = r.current_approval_level');
            $this->db->where('ab.role_name', $role_name);
        }

        if ($status_filter !== 'all' && !empty($status_filter)) {
            $this->db->where('r.status', $status_filter);
        }

        if ($role_filter !== 'all' && !empty($role_filter)) {
            $this->db->where('u.role', $role_filter);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('u.name', $search);
            $this->db->or_like('u.email', $search);
            $this->db->or_like('e.name', $search);
            $this->db->group_end();
        }

        $this->db->stop_cache();

        $total = $this->db->count_all_results();

        $this->db->order_by('r.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $registrations = $this->db->get()->result();

        $this->db->flush_cache();

        foreach ($registrations as $reg) {
            $reg->approvals = $this->get_approval_logs($reg->id);
        }

        return array(
            'registrations' => $registrations,
            'total' => $total
        );
    }

    public function get_approver_registrations($role_name, $status_filter = 'pending', $search = NULL) {
        $res = $this->get_approver_registrations_paginated($role_name, $status_filter, 'all', $search, 1000, 0);
        return $res['registrations'];
    }

    public function get_registration_details($id) {
        $this->db->select('r.*, e.name as event_name, u.name as user_name, u.email as user_email, u.role as user_role');
        $this->db->from('registrations r');
        $this->db->join('events e', 'r.event_id = e.id');
        $this->db->join('users u', 'r.user_id = u.id');
        $this->db->where('r.id', $id);
        $reg = $this->db->get()->row();
        if ($reg) {
            $reg->approvals = $this->get_approval_logs($reg->id);
        }
        return $reg;
    }

    public function update_registration($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('registrations', $data);
    }

    public function log_approval($data) {
        return $this->db->insert('registration_approvals', $data);
    }

    public function get_approval_logs($registration_id) {
        $this->db->select('ra.*, u.name as approver_name, u.role as approver_role');
        $this->db->from('registration_approvals ra');
        $this->db->join('users u', 'ra.approver_id = u.id');
        $this->db->where('ra.registration_id', $registration_id);
        $this->db->order_by('ra.created_at', 'ASC');
        return $this->db->get()->result();
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
