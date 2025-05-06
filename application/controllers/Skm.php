<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_skm');
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

        // SKM
        $data['jumlah'] = $this->Model_skm->jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_lk'] = $this->Model_skm->jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_pr'] = $this->Model_skm->jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_sd'] = $this->Model_skm->jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_smp'] = $this->Model_skm->jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_sma'] = $this->Model_skm->jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_d1'] = $this->Model_skm->jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_s1'] = $this->Model_skm->jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_s2'] = $this->Model_skm->jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_pns'] = $this->Model_skm->jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_tni'] = $this->Model_skm->jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_polri'] = $this->Model_skm->jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_swasta'] = $this->Model_skm->jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_wirausaha'] = $this->Model_skm->jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $data['jmlh_lainnya'] = $this->Model_skm->jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

        $avg_u1 = $this->Model_skm->avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u2 = $this->Model_skm->avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u3 = $this->Model_skm->avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u4 = $this->Model_skm->avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u5 = $this->Model_skm->avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u6 = $this->Model_skm->avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u7 = $this->Model_skm->avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u8 = $this->Model_skm->avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
        $avg_u9 = $this->Model_skm->avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

        $data['u1'] = $avg_u1;
        $data['u2'] = $avg_u2;
        $data['u3'] = $avg_u3;
        $data['u4'] = $avg_u4;
        $data['u5'] = $avg_u5;
        $data['u6'] = $avg_u6;
        $data['u7'] = $avg_u7;
        $data['u8'] = $avg_u8;
        $data['u9'] = $avg_u9;

        $nrr_u1 = $avg_u1 * 0.1111;
        $nrr_u2 = $avg_u2 * 0.1111;
        $nrr_u3 = $avg_u3 * 0.1111;
        $nrr_u4 = $avg_u4 * 0.1111;
        $nrr_u5 = $avg_u5 * 0.1111;
        $nrr_u6 = $avg_u6 * 0.1111;
        $nrr_u7 = $avg_u7 * 0.1111;
        $nrr_u8 = $avg_u8 * 0.1111;
        $nrr_u9 = $avg_u9 * 0.1111;

        $sum_nrr = $nrr_u1 + $nrr_u2 + $nrr_u3 + $nrr_u4 + $nrr_u5 + $nrr_u6 + $nrr_u7 + $nrr_u8 + $nrr_u9;
        $data['ikm'] = $sum_nrr * 25;
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

        $this->load->view('templates/header');
        $this->load->view('view_skm',  $data);
        $this->load->view('templates/footer');
    }

    public function form()
    {
        // $this->load->model('Model_skm');
        // $data['ppid'] = $this->Model_ppid->tampil_data();
        $data['idmax_skm'] = $this->Model_skm->idmax_skm();
        $data['idmax_rating'] = $this->Model_skm->idmax_rating();
        $data['idmax_spak'] = $this->Model_skm->idmax_spak();
        $this->load->view('templates/header');
        $this->load->view('form_skm', $data);
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
            ['field' => 'u1', 'label' => 'pendapat nomor 1 diatas', 'rules' => 'required'],
            ['field' => 'u2', 'label' => 'pendapat nomor 2 diatas', 'rules' => 'required'],
            ['field' => 'u3', 'label' => 'pendapat nomor 3 diatas', 'rules' => 'required'],
            ['field' => 'u4', 'label' => 'pendapat nomor 4 diatas', 'rules' => 'required'],
            ['field' => 'u5', 'label' => 'pendapat nomor 5 diatas', 'rules' => 'required'],
            ['field' => 'u6', 'label' => 'pendapat nomor 6 diatas', 'rules' => 'required'],
            ['field' => 'u7', 'label' => 'pendapat nomor 7 diatas', 'rules' => 'required'],
            ['field' => 'u8', 'label' => 'pendapat nomor 8 diatas', 'rules' => 'required'],
            ['field' => 'u9', 'label' => 'pendapat nomor 9 diatas', 'rules' => 'required'],
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

    // ------------------ User
    public function tambah_skm()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $formatted_date = $date->format('Y-m-d H:i:s');

        $this->_rules_skm();

        if ($this->form_validation->run() == TRUE) {

            $input_skm = [
                'id_skm'        => $this->input->post('id_skm'),
                'nama'          => $this->input->post('nama'),
                'no_hp'         => $this->input->post('no_hp'),
                'jk'            => $this->input->post('jk'),
                'umur'          => $this->input->post('umur'),
                'pendidikan'    => $this->input->post('pendidikan'),
                'pekerjaan'     => $this->input->post('pekerjaan'),
                'layanan'       => $this->input->post('layanan'),
                'u1'            => $this->input->post('u1'),
                'u2'            => $this->input->post('u2'),
                'u3'            => $this->input->post('u3'),
                'u4'            => $this->input->post('u4'),
                'u5'            => $this->input->post('u5'),
                'u6'            => $this->input->post('u6'),
                'u7'            => $this->input->post('u7'),
                'u8'            => $this->input->post('u8'),
                'u9'            => $this->input->post('u9'),
                'date'          => $formatted_date
            ];
            $data_skm = $this->security->xss_clean($input_skm);
            $this->Model_skm->simpan_skm($data_skm);

            $input_spkp = [
                'id_spkp'       => $this->input->post('id_spkp'),
                'date'          => $formatted_date,
                'z1'            => $this->input->post('rating_z1'),
                'z2'            => $this->input->post('rating_z2'),
                'z3'            => $this->input->post('rating_z3'),
                'z4'            => $this->input->post('rating_z4'),
                'z5'            => $this->input->post('rating_z5'),
                'z6'            => $this->input->post('rating_z6'),
                'z7'            => $this->input->post('rating_z7'),
                'z8'            => $this->input->post('rating_z8'),
            ];
            $data_spkp = $this->security->xss_clean($input_spkp);
            $this->Model_skm->simpan_spkp($data_spkp);

            $input_spak = [
                'id_spak'       => $this->input->post('id_spak'),
                'id_spkp'       => $this->input->post('id_spkp'),
                'id_skm'        => $this->input->post('id_skm'),
                'date'          => $formatted_date,
                'r1'            => $this->input->post('rating_r1'),
                'r2'            => $this->input->post('rating_r2'),
                'r3'            => $this->input->post('rating_r3'),
                'r4'            => $this->input->post('rating_r4'),
                'r5'            => $this->input->post('rating_r5'),
            ];
            $data_spak = $this->security->xss_clean($input_spak);
            $this->Model_skm->simpan_spak($data_spak);

            $this->session->set_flashdata('berhasil', 'Pengisian konsioner berhasil. Terima kasih');
            redirect('skm');
        } else {
            $data['idmax_skm'] = $this->Model_skm->idmax_skm();
            $data['idmax_rating'] = $this->Model_skm->idmax_rating();
            $data['idmax_spak'] = $this->Model_skm->idmax_spak();
            $this->load->view('templates/header');
            $this->load->view('form_skm', $data);
            $this->load->view('templates/footer');
        }
    }
}
