<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Skm extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role_user = $this->session->userdata('role');

        if ($role_user !== 'Administrator') {
            redirect('admin/home');
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
        $data['title'] = 'SKM & Nilai IKM';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/skm', $data, FALSE);

        $this->load->view('modal/tambah/nilai_riwayat_skm', FALSE);

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
        $dompdf->stream('Survei Kepuasan Masyarakat (' . $id_skm . ').pdf', array('Attachment' => false));
    }

    public function filter()
    {
        $bulan_awal = $this->input->get('bulan_awal') ?? 1;
        $bulan_akhir = $this->input->get('bulan_akhir') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $result = $this->Model_skm->get_filter_data_skm($bulan_awal, $bulan_akhir, $tahun);

        $data = array(
            'home' => 'Home',
            'title' => 'SKM & Nilai IKM',
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

    public function simpan_ikm_manual()
    {
        // 1. Ambil inputan dari form
        $tahun = $this->input->post('tahun', TRUE);
        $semester = $this->input->post('semester', TRUE);

        // Kumpulkan semua data ke dalam array
        $data = [
            'tahun' => $tahun,
            'semester' => $semester,
            'periode' => $this->input->post('periode', TRUE),
            'nilai_ikm' => $this->input->post('nilai_ikm', TRUE),

            // Demografi
            'jumlah_responden' => $this->input->post('jumlah_responden', TRUE),
            'jmlh_lk' => $this->input->post('jmlh_lk', TRUE),
            'jmlh_pr' => $this->input->post('jmlh_pr', TRUE),

            'jmlh_sd' => $this->input->post('jmlh_sd', TRUE),
            'jmlh_smp' => $this->input->post('jmlh_smp', TRUE),
            'jmlh_sma' => $this->input->post('jmlh_sma', TRUE),
            'jmlh_d1' => $this->input->post('jmlh_d1', TRUE),
            'jmlh_s1' => $this->input->post('jmlh_s1', TRUE),
            'jmlh_s2' => $this->input->post('jmlh_s2', TRUE),

            'jmlh_pns' => $this->input->post('jmlh_pns', TRUE),
            'jmlh_tni' => $this->input->post('jmlh_tni', TRUE),
            'jmlh_polri' => $this->input->post('jmlh_polri', TRUE),
            'jmlh_swasta' => $this->input->post('jmlh_swasta', TRUE),
            'jmlh_wirausaha' => $this->input->post('jmlh_wirausaha', TRUE),
            'jmlh_lainnya' => $this->input->post('jmlh_lainnya', TRUE)
        ];

        // 2. Cek apakah di database sudah ada data untuk semester dan tahun tersebut
        $cek_data = $this->db->get_where('ikm_manual', [
            'tahun' => $tahun,
            'semester' => $semester
        ])->row();

        // 3. Simpan atau Update
        if ($cek_data) {
            // Jika sudah ada, lakukan UPDATE
            $this->db->where('id', $cek_data->id);
            $this->db->update('ikm_manual', $data);
            $this->session->set_flashdata('success', 'Laporan IKM berhasil diperbarui!');
        } else {
            // Jika belum ada, lakukan INSERT data baru
            $this->db->insert('ikm_manual', $data);
            $this->session->set_flashdata('success', 'Laporan IKM berhasil ditambahkan!');
        }

        // 4. Kembali ke halaman admin SKM
        redirect('admin/skm');
    }

    public function hapus_ikm_manual($id)
    {
        // Pastikan parameter ID ada
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete('ikm_manual');

            // Set pesan notifikasi berhasil
            $this->session->set_flashdata('success', 'Riwayat Laporan IKM berhasil dihapus!');
        }

        // Kembali ke halaman admin SKM
        redirect('admin/skm');
    }
}
