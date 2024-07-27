<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mod_auth');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            // Get the username and level name from session
            $username = $this->session->userdata('username');
            $level_name = $this->session->userdata('level_name');

            // Log username and level name
            log_message('info', "User logged in: Username: " . $username . ", Level: " . $level_name);

            // Load the dashboard view
            $this->load->view('admin/dashboard');
        } else {
            // Log the access attempt if the user is not logged in
            log_message('warning', 'Access attempt to dashboard without logging in.');

            // Redirect to login page
            redirect('auth');
        }
    }
}
