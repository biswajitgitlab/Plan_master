<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_events() {
        $this->db->order_by('start_date', 'ASC');
        return $this->db->get('events')->result();
    }

    public function get_event($id) {
        return $this->db->get_where('events', array('id' => $id))->row();
    }

    public function create_event($data) {
        $this->db->insert('events', $data);
        return $this->db->insert_id();
    }

    public function update_event($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('events', $data);
    }

    public function delete_event($id) {
        return $this->db->delete('events', array('id' => $id));
    }
}
