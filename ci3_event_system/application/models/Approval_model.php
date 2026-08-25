<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_bands_by_event($event_id) {
        $this->db->order_by('level_sequence', 'ASC');
        return $this->db->get_where('approval_bands', array('event_id' => $event_id))->result();
    }

    public function get_band_by_sequence($event_id, $sequence) {
        return $this->db->get_where('approval_bands', array(
            'event_id' => $event_id,
            'level_sequence' => $sequence
        ))->row();
    }

    public function save_band($event_id, $role_name, $sequence) {
        return $this->db->insert('approval_bands', array(
            'event_id' => $event_id,
            'role_name' => $role_name,
            'level_sequence' => $sequence
        ));
    }

    public function delete_band($band_id) {
        return $this->db->delete('approval_bands', array('id' => $band_id));
    }

    public function delete_bands_by_event($event_id) {
        return $this->db->delete('approval_bands', array('event_id' => $event_id));
    }
}
