<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{

    public function index()
    {
        $this->load->model('Model_informasi');
        // //konfigurasi pagination
        // $config['base_url'] = site_url('informasi/index'); //site url
        // $config['total_rows'] = $this->Model_informasi->hitung_berita(); //total row
        // $config['per_page'] = 30;  //show record per halaman
        // $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        // $config["num_links"] = floor($choice);

        // $this->pagination->initialize($config);
        // $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['berita'] = $this->Model_informasi->tampil_berita_pagination();
        // $data['berita'] = $this->Model_informasi->tampil_berita_pagination($config['per_page'], $data['page']);
        $data['terbaru'] = $this->Model_informasi->berita_terbaru();
        // $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header');
        $this->load->view('view_informasi', $data);
        $this->load->view('modal/modal_detail_informasi', $data);
        $this->load->view('templates/footer');
    }
}
