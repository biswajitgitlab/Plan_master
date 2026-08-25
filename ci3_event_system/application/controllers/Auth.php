<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('events');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            $session_data = array(
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            );
            $this->session->set_userdata($session_data);
            $this->session->set_flashdata('success', 'Logged in successfully as ' . $user->role);

            if ($user->role === 'Admin') {
                redirect('admin');
            } elseif ($user->role === 'Sub-Admin') {
                redirect('approvals');
            } else {
                redirect('events');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
