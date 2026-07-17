<?php
class Home extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'DPMPTSP Kab. Agam';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/home', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }


}
