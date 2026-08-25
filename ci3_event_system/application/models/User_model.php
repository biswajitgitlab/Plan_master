<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_email($email) {
        return $this->db->get_where('users', array('email' => $email))->row();
    }

    public function get_by_id($id) {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function get_users_by_role($role) {
        return $this->db->get_where('users', array('role' => $role))->result();
    }
}
