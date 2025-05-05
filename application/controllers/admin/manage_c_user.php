<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_c_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('username') == "") {
            redirect('home');
        }

        $this->load->model('admin/M_user');
    }

    public function index()
    {
        $data['user'] = $this->M_user->tampil_semua_data();
        $data['home'] = 'Home';
        $data['title'] = 'Manajemen User';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/v_user', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }
}

/* End of file manage_c_user.php */
