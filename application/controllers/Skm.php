<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_skm');
        $this->load->model('Model_spkp_antikorupsi');
        $this->load->model('Model_qr_survei');
    }

    public function index()
    {
        $BulanIni = date('n');
        $TahunIni = date('Y');

        $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

        if ($semester == 1) {
            $awalBulan = 1;
            $akhirBulan = 6;
            $awalTahun = $TahunIni;
            $akhirTahun = $TahunIni;
        } else {
            $awalBulan = 7;
            $akhirBulan = 12;
            $awalTahun = $TahunIni;
            $akhirTahun = $TahunIni;
        }

        // --- 1. AMBIL DATA IKM DARI TABEL MANUAL (YANG DIINPUT ADMIN) ---
        $this->db->where('tahun', $TahunIni);
        $this->db->where('semester', $semester);
        $ikm_manual = $this->db->get('ikm_manual')->row();

        if ($ikm_manual) {
            // Jika admin sudah input data untuk semester ini
            $data['ikm'] = $ikm_manual->nilai_ikm;
            $data['jumlah'] = $ikm_manual->jumlah_responden;
            $data['jmlh_lk'] = $ikm_manual->jmlh_lk;
            $data['jmlh_pr'] = $ikm_manual->jmlh_pr;
            $data['jmlh_sd'] = $ikm_manual->jmlh_sd;
            $data['jmlh_smp'] = $ikm_manual->jmlh_smp;
            $data['jmlh_sma'] = $ikm_manual->jmlh_sma;
            $data['jmlh_d1'] = $ikm_manual->jmlh_d1;
            $data['jmlh_s1'] = $ikm_manual->jmlh_s1;
            $data['jmlh_s2'] = $ikm_manual->jmlh_s2;
            $data['jmlh_pns'] = $ikm_manual->jmlh_pns;
            $data['jmlh_tni'] = $ikm_manual->jmlh_tni;
            $data['jmlh_polri'] = $ikm_manual->jmlh_polri;
            $data['jmlh_swasta'] = $ikm_manual->jmlh_swasta;
            $data['jmlh_wirausaha'] = $ikm_manual->jmlh_wirausaha;
            $data['jmlh_lainnya'] = $ikm_manual->jmlh_lainnya;
            $data['teks_periode'] = $ikm_manual->periode;
        } else {
            // Jika admin belum input, set ke 0
            $data['ikm'] = 0;
            $data['jumlah'] = 0;
            $data['jmlh_lk'] = 0;
            $data['jmlh_pr'] = 0;
            $data['jmlh_sd'] = 0;
            $data['jmlh_smp'] = 0;
            $data['jmlh_sma'] = 0;
            $data['jmlh_d1'] = 0;
            $data['jmlh_s1'] = 0;
            $data['jmlh_s2'] = 0;
            $data['jmlh_pns'] = 0;
            $data['jmlh_tni'] = 0;
            $data['jmlh_polri'] = 0;
            $data['jmlh_swasta'] = 0;
            $data['jmlh_wirausaha'] = 0;
            $data['jmlh_lainnya'] = 0;
            $data['teks_periode'] = "Semester $semester Tahun $TahunIni";
        }

        // --- 2. AMBIL DATA TREN (HISTORIS) UNTUK GRAFIK ---
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('semester', 'ASC');
        $data['tren_ikm'] = $this->db->get('ikm_manual')->result();
        // end of SKM

        // ----------------------------------------- SPKP and SPAK -----------------------------------------
        $data['rating_spkp'] = $this->Model_spkp_antikorupsi->get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['rating_antikorupsi'] = $this->Model_spkp_antikorupsi->get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['total_responden'] = $this->Model_spkp_antikorupsi->total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

        // Get average z and r values
        $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

        $data['z1'] = $avg_z->avg_z1;
        $data['z2'] = $avg_z->avg_z2;
        $data['z3'] = $avg_z->avg_z3;
        $data['z4'] = $avg_z->avg_z4;
        $data['z5'] = $avg_z->avg_z5;
        $data['z6'] = $avg_z->avg_z6;
        $data['z7'] = $avg_z->avg_z7;
        $data['z8'] = $avg_z->avg_z8;

        $data['r1'] = $avg_r->avg_r1;
        $data['r2'] = $avg_r->avg_r2;
        $data['r3'] = $avg_r->avg_r3;
        $data['r4'] = $avg_r->avg_r4;
        $data['r5'] = $avg_r->avg_r5;

        // Calculate NRR
        $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
        $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;

        $sum_nrr = $nrr_z - $nrr_r;
        $result = $sum_nrr * 50;
        $result = min(max($result, 0), 100);

        // Load view with result
        $data['spkp_spak'] = $result;
        $data['semester'] = $semester;
        // -------------------------------------- end of SPKP and SPAK --------------------------------------

        $survei_aktif = $this->Model_qr_survei->get_active_survei();
        $data['survei_skm_aktif'] = $survei_aktif;

        $this->load->view('templates/header');
        $this->load->view('view_skm', $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        $this->load->view('templates/header');
        $this->load->view('form_skm');
        $this->load->view('templates/footer');
    }

    public function _rules_skm()
    {
        $this->form_validation->set_rules('jk', 'jenis kelamin', 'required', [
            'required' => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('umur', 'usia', 'required', [
            'required' => 'Masukan %s!',
        ]);
        $this->form_validation->set_rules('pendidikan', 'pendidikan', 'required', [
            'required' => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required', [
            'required' => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('layanan', 'jenis layanan yang diterima', 'required', [
            'required' => 'Masukan %s!',
        ]);

        $validation_rules = [
            // ['field' => 'u1', 'label' => 'pendapat nomor 1 diatas', 'rules' => 'required'],
            // ['field' => 'u2', 'label' => 'pendapat nomor 2 diatas', 'rules' => 'required'],
            // ['field' => 'u3', 'label' => 'pendapat nomor 3 diatas', 'rules' => 'required'],
            // ['field' => 'u4', 'label' => 'pendapat nomor 4 diatas', 'rules' => 'required'],
            // ['field' => 'u5', 'label' => 'pendapat nomor 5 diatas', 'rules' => 'required'],
            // ['field' => 'u6', 'label' => 'pendapat nomor 6 diatas', 'rules' => 'required'],
            // ['field' => 'u7', 'label' => 'pendapat nomor 7 diatas', 'rules' => 'required'],
            // ['field' => 'u8', 'label' => 'pendapat nomor 8 diatas', 'rules' => 'required'],
            // ['field' => 'u9', 'label' => 'pendapat nomor 9 diatas', 'rules' => 'required'],
            ['field' => 'rating_r1', 'label' => 'bintang dari pernyataan nomor 1 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_r2', 'label' => 'bintang dari pernyataan nomor 2 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_r3', 'label' => 'bintang dari pernyataan nomor 3 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_r4', 'label' => 'bintang dari pernyataan nomor 4 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_r5', 'label' => 'bintang dari pernyataan nomor 5 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z1', 'label' => 'bintang dari pernyataan nomor 1 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z2', 'label' => 'bintang dari pernyataan nomor 2 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z3', 'label' => 'bintang dari pernyataan nomor 3 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z4', 'label' => 'bintang dari pernyataan nomor 4 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z5', 'label' => 'bintang dari pernyataan nomor 5 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z6', 'label' => 'bintang dari pernyataan nomor 6 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z7', 'label' => 'bintang dari pernyataan nomor 7 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
            ['field' => 'rating_z8', 'label' => 'bintang dari pernyataan nomor 8 diatas', 'rules' => 'required|greater_than[0]|less_than[7]'],
        ];
        foreach ($validation_rules as $rule) {
            $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules'], [
                'required' => 'Pilih %s!'
            ]);
        }
    }

    public function tambah_skm()
    {
        date_default_timezone_set('Asia/Jakarta');
        $formatted_date = date('Y-m-d H:i:s');

        $date = $this->input->post('date_all');
        $date = date('Y-m-d H:i:s', strtotime($date));

        $this->_rules_skm();

        if ($this->form_validation->run() == TRUE) {
            $input_skm = [
                'date' => $formatted_date,
                'nama' => $this->input->post('nama'),
                'no_hp' => $this->input->post('no_hp'),
                'jk' => $this->input->post('jk'),
                'umur' => $this->input->post('umur'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'layanan' => $this->input->post('layanan'),
                'u1' => $this->input->post('u1'),
                'u2' => $this->input->post('u2'),
                'u3' => $this->input->post('u3'),
                'u4' => $this->input->post('u4'),
                'u5' => $this->input->post('u5'),
                'u6' => $this->input->post('u6'),
                'u7' => $this->input->post('u7'),
                'u8' => $this->input->post('u8'),
                'u9' => $this->input->post('u9')
            ];
            $data_skm = $this->security->xss_clean($input_skm);
            $this->Model_skm->simpan_skm($data_skm);
            $id_skm = $this->db->insert_id();

            $input_spkp = [
                'date' => $formatted_date,
                'z1' => $this->input->post('rating_z1'),
                'z2' => $this->input->post('rating_z2'),
                'z3' => $this->input->post('rating_z3'),
                'z4' => $this->input->post('rating_z4'),
                'z5' => $this->input->post('rating_z5'),
                'z6' => $this->input->post('rating_z6'),
                'z7' => $this->input->post('rating_z7'),
                'z8' => $this->input->post('rating_z8'),
            ];
            $data_spkp = $this->security->xss_clean($input_spkp);
            $this->Model_skm->simpan_spkp($data_spkp);
            $id_spkp = $this->db->insert_id();

            $input_spak = [
                'id_spkp' => $id_spkp,
                'id_skm' => $id_skm,
                'date' => $formatted_date,
                'r1' => $this->input->post('rating_r1'),
                'r2' => $this->input->post('rating_r2'),
                'r3' => $this->input->post('rating_r3'),
                'r4' => $this->input->post('rating_r4'),
                'r5' => $this->input->post('rating_r5'),
            ];
            $data_spak = $this->security->xss_clean($input_spak);
            $this->Model_skm->simpan_spak($data_spak);

            $this->session->set_flashdata('berhasil', 'Pengisian survei berhasil, Terima kasih!');
            redirect('skm');
        } else {
            $this->load->view('templates/header');
            $this->load->view('form_skm');
            $this->load->view('templates/footer');
        }
    }
}
