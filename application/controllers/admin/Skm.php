<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Skm extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
        $this->load->model('Model_skm');
    }

    public function index()
    {
        $data['skm'] = $this->Model_skm->get_data_skm();

        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/skm', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete($id_skm)
    {
        $this->Model_skm->hapus_skm($id_skm);
        $this->session->set_flashdata('berhasil', 'Data SKM berhasil dihapus.');
        redirect('admin/skm', 'refresh');
    }

    public function cetak($id_skm)
    {
        require_once 'vendor/autoload.php';

        $dompdf = new Dompdf();

        $data['skm'] = $this->Model_skm->get_data_by_id($id_skm);

        $html = $this->load->view('admin/print/skm', $data, true);

        $options = $dompdf->getOptions();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);

        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Legal', 'portrait');
        $dompdf->render();
        $dompdf->stream('Survey Kepuasan Masyarakat (' . $id_skm . ').pdf', array('Attachment' => false));
    }
}
