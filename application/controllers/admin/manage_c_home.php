<?php
class Manage_c_home extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
    }

    public function index()
    {
        // $data['home'] = 'Home';
        // $data['title'] = '';

        // $this->load->view('templates/admin_header', $data, FALSE);
        // $this->load->view('templates/admin_navbar', $data, FALSE);
        // $this->load->view('templates/admin_sidebar', $data, FALSE);
        // $this->load->view('admin/v_home', $data, FALSE);
        // $this->load->view('templates/admin_footer');

        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/v_home');
        $this->load->view('templates/footer_admin');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        session_destroy();
        redirect('home');
    }
}
