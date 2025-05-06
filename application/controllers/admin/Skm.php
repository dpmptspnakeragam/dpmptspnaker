<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Skm extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_skm');
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

        $data['skm'] = $this->Model_skm->get_data_skm($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['home'] = 'Home';
        $data['title'] = 'SKM';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/skm', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function delete($id_skm)
    {
        $result = $this->Model_skm->hapus_data_terkait($id_skm);

        if ($result) {
            $this->session->set_flashdata('success', 'Data SKM, SPKP, dan SPAK berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

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

    public function filter()
    {
        $bulan_awal = $this->input->get('bulan_awal') ?? 1;
        $bulan_akhir = $this->input->get('bulan_akhir') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $result = $this->Model_skm->get_filter_data_skm($bulan_awal, $bulan_akhir, $tahun);

        $data = array(
            'home' => 'Home',
            'title' => 'SKM',
            'skm' => $result,
        );

        if (empty($result)) {
            $this->session->set_flashdata('warning', 'Filter Data tidak ditemukan.');
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/skm', $data);
        $this->load->view('templates/admin_footer');
    }
}
