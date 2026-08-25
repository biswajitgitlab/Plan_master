<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quota_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_quotas_by_event($event_id) {
        return $this->db->get_where('event_quotas', array('event_id' => $event_id))->result();
    }

    public function get_quota_for_role($event_id, $role_name) {
        return $this->db->get_where('event_quotas', array(
            'event_id' => $event_id,
            'role_name' => $role_name
        ))->row();
    }

    public function save_quota($event_id, $role_name, $quota_limit) {
        $existing = $this->get_quota_for_role($event_id, $role_name);
        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update('event_quotas', array('quota_limit' => $quota_limit));
        } else {
            return $this->db->insert('event_quotas', array(
                'event_id' => $event_id,
                'role_name' => $role_name,
                'quota_limit' => $quota_limit
            ));
        }
    }

    public function delete_quota($quota_id) {
        return $this->db->delete('event_quotas', array('id' => $quota_id));
    }

    public function delete_quotas_by_event($event_id) {
        return $this->db->delete('event_quotas', array('event_id' => $event_id));
    }
}
