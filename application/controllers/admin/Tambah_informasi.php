<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_informasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_informasi');
    }

    public function index()
    {
        $data['informasi'] = $this->Model_informasi->tampil_data();
        $data['idmax'] = $this->Model_informasi->idmax();
        $data['kategori'] = $this->Model_informasi->kategori();
        $data['home'] = 'Home';
        $data['title'] = 'Tambah Informasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('modal/tambah/informasi', $data);
    }
}

/* End of file Tambah_informasi.php */
