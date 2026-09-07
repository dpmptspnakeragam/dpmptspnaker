<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_konsultasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role     = $this->session->userdata('role');
        $divisi   = $this->session->userdata('divisi');
        $username = strtolower($this->session->userdata('username') ?? '');

        $is_admin  = ($role === 'Administrator');
        $is_proses = (strpos($username, 'proses') !== false);

        // HANYA Administrator & Operator Proses yang boleh mengakses
        if (!$is_admin && !($role === 'User' && $divisi === 'Konsultasi' && $is_proses)) {
            $this->session->set_flashdata('error', 'Akses Ditolak! Laporan hanya dapat diakses oleh Operator Proses dan Administrator.');
            redirect('admin/home');
        }

        $this->load->model('Model_laporan_konsultasi');
    }

    private function _get_user_unit()
    {
        $role     = $this->session->userdata('role');
        $username = strtolower($this->session->userdata('username') ?? '');

        if ($role === 'Administrator') {
            return 'ALL';
        }
        if (strpos($username, 'ptsp') !== false) {
            return 'PTSP';
        }
        if (strpos($username, 'blk') !== false) {
            return 'BLK';
        }

        return 'ALL';
    }

    public function index()
    {
        $data['title'] = 'Laporan Layanan Konsultasi';

        // Tangkap Filter dari Request GET (tanpa fallback default date)
        $tgl_mulai   = $this->input->get('tgl_mulai', TRUE);
        $tgl_selesai = $this->input->get('tgl_selesai', TRUE);
        $status      = $this->input->get('status', TRUE) ?? 'semua';

        $user_unit   = $this->_get_user_unit();
        $unit_filter = ($user_unit === 'ALL') ? ($this->input->get('unit', TRUE) ?? 'ALL') : $user_unit;

        // Cek apakah form filter sudah dikirim (User klik "Tampilkan")
        $is_filtered = (!empty($tgl_mulai) && !empty($tgl_selesai));

        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;
        $data['status']      = $status;
        $data['unit_filter'] = $unit_filter;
        $data['user_unit']   = $user_unit;
        $data['is_filtered'] = $is_filtered;

        // Jalankan query HANYA JIKA sudah difilter
        if ($is_filtered) {
            $data['laporan'] = $this->Model_laporan_konsultasi->get_laporan($tgl_mulai, $tgl_selesai, $status, $unit_filter);
        } else {
            $data['laporan'] = [];
        }

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/laporan_konsultasi_index', $data);
        $this->load->view('templates/admin_footer', $data, FALSE);
    }

    public function cetak()
    {
        $tgl_mulai   = $this->input->get('tgl_mulai', TRUE);
        $tgl_selesai = $this->input->get('tgl_selesai', TRUE);
        $status      = $this->input->get('status', TRUE);

        $user_unit   = $this->_get_user_unit();
        $unit_filter = ($user_unit === 'ALL') ? ($this->input->get('unit', TRUE) ?? 'ALL') : $user_unit;

        $data['title']       = 'Cetak Laporan Konsultasi';
        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;
        $data['status']      = $status;
        $data['unit_filter'] = $unit_filter;

        $data['laporan'] = $this->Model_laporan_konsultasi->get_laporan($tgl_mulai, $tgl_selesai, $status, $unit_filter);

        $this->load->view('admin/laporan_konsultasi_cetak', $data);
    }
}
