<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Spkp_antikorupsi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
        $this->load->model('Model_spkp_antikorupsi');
    }

    public function index()
    {
        $data['rating'] = $this->Model_spkp_antikorupsi->get_data_rating();

        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/spkp_antikorupsi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete($id_spkp)
    {
        $this->Model_spkp_antikorupsi->hapus_spkp($id_spkp);
        $this->Model_spkp_antikorupsi->hapus_spak($id_spkp);
        $this->session->set_flashdata('berhasil', 'Data SPKP dan Anti Korupsi berhasil dihapus.');
        redirect('admin/spkp_antikorupsi', 'refresh');
    }

    public function cetak($id_spkp)
    {
        require_once 'vendor/autoload.php';

        $dompdf = new Dompdf();

        $data['spkp'] = $this->Model_spkp_antikorupsi->get_data_by_id($id_spkp);

        $html = $this->load->view('admin/print/spkp', $data, true);

        $options = $dompdf->getOptions();
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);

        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Legal', 'portrait');
        $dompdf->render();
        $dompdf->stream('SPKP dan SPAK (' . $id_spkp . ').pdf', array('Attachment' => false));
    }
}

/* End of file  Spkp_antikorupsi.php */
