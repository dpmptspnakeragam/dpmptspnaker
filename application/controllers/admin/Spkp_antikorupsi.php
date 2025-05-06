<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Spkp_antikorupsi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_spkp_antikorupsi');
    }

    public function index()
    {
        $BulanIni = date('n');
        $TahunIni = date('Y');

        // tentukan semester berdasarkan bulan
        $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

        // tentukan range bulan berdasarkan semester
        if ($semester == 1) {
            $awalBulan = 1;
            $akhirBulan = 6;
            $awalTahun = $TahunIni; // Tahun awal semester 1 adalah tahun saat ini
            $akhirTahun = $TahunIni;
        } else {
            $awalBulan = 7;
            $akhirBulan = 12;
            $awalTahun = $TahunIni; // Tahun awal semester 2 adalah tahun saat ini
            $akhirTahun = $TahunIni;
        }

        $data['rating'] = $this->Model_spkp_antikorupsi->get_data_rating($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['home'] = 'Home';
        $data['title'] = 'SPKP & SPAK';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/spkp_antikorupsi', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function delete($id_spkp)
    {
        $result = $this->Model_spkp_antikorupsi->hapus_data_terkait($id_spkp);

        if ($result) {
            $this->session->set_flashdata('success', 'Data SPKP, SPAK, dan SKM berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

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

    public function filter()
    {
        $bulan_awal = $this->input->get('bulan_awal') ?? 1;
        $bulan_akhir = $this->input->get('bulan_akhir') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $result = $this->Model_spkp_antikorupsi->get_filter_data_spkp_spak($bulan_awal, $bulan_akhir, $tahun);

        $data = array(
            'home'  => 'Home',
            'title' => 'SPKP & SPAK',
            'rating' => $result,
        );

        if (empty($result)) {
            $this->session->set_flashdata('warning', 'Filter Data tidak ditemukan.');
        }

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/spkp_antikorupsi', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }
}

/* End of file  Spkp_antikorupsi.php */
