<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class DataIKM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_skm');
        $this->load->model('Model_spkp_antikorupsi');

        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
    }

    // public function index()
    // {
    //     $BulanIni = date('n');
    //     $TahunIni = date('Y');

    //     // tentukan semester berdasarkan bulan
    //     $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

    //     // tentukan range bulan berdasarkan semester
    //     if ($semester == 1) {
    //         $awalBulan = 1;
    //         $akhirBulan = 6;
    //         $awalTahun = $TahunIni; // Tahun awal semester 1 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     } else {
    //         $awalBulan = 7;
    //         $akhirBulan = 12;
    //         $awalTahun = $TahunIni; // Tahun awal semester 2 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     }

    //     // SKM
    //     $data['jumlah'] = $this->Model_skm->jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lk'] = $this->Model_skm->jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pr'] = $this->Model_skm->jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sd'] = $this->Model_skm->jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_smp'] = $this->Model_skm->jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sma'] = $this->Model_skm->jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_d1'] = $this->Model_skm->jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s1'] = $this->Model_skm->jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s2'] = $this->Model_skm->jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pns'] = $this->Model_skm->jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_tni'] = $this->Model_skm->jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_polri'] = $this->Model_skm->jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_swasta'] = $this->Model_skm->jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_wirausaha'] = $this->Model_skm->jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lainnya'] = $this->Model_skm->jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $avg_u1 = $this->Model_skm->avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u2 = $this->Model_skm->avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u3 = $this->Model_skm->avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u4 = $this->Model_skm->avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u5 = $this->Model_skm->avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u6 = $this->Model_skm->avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u7 = $this->Model_skm->avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u8 = $this->Model_skm->avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u9 = $this->Model_skm->avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['u1'] = $avg_u1;
    //     $data['u2'] = $avg_u2;
    //     $data['u3'] = $avg_u3;
    //     $data['u4'] = $avg_u4;
    //     $data['u5'] = $avg_u5;
    //     $data['u6'] = $avg_u6;
    //     $data['u7'] = $avg_u7;
    //     $data['u8'] = $avg_u8;
    //     $data['u9'] = $avg_u9;

    //     $nrr_u1 = $avg_u1 * 0.1111;
    //     $nrr_u2 = $avg_u2 * 0.1111;
    //     $nrr_u3 = $avg_u3 * 0.1111;
    //     $nrr_u4 = $avg_u4 * 0.1111;
    //     $nrr_u5 = $avg_u5 * 0.1111;
    //     $nrr_u6 = $avg_u6 * 0.1111;
    //     $nrr_u7 = $avg_u7 * 0.1111;
    //     $nrr_u8 = $avg_u8 * 0.1111;
    //     $nrr_u9 = $avg_u9 * 0.1111;

    //     $sum_nrr = $nrr_u1 + $nrr_u2 + $nrr_u3 + $nrr_u4 + $nrr_u5 + $nrr_u6 + $nrr_u7 + $nrr_u8 + $nrr_u9;
    //     $data['ikm'] = $sum_nrr * 25;
    //     // end of SKM

    //     // ----------------------------------------- SPKP and SPAK -----------------------------------------
    //     $data['rating_spkp'] = $this->Model_spkp_antikorupsi->get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['rating_antikorupsi'] = $this->Model_spkp_antikorupsi->get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['total_responden'] = $this->Model_spkp_antikorupsi->total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     // Get average z and r values
    //     $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['z1'] = $avg_z->avg_z1;
    //     $data['z2'] = $avg_z->avg_z2;
    //     $data['z3'] = $avg_z->avg_z3;
    //     $data['z4'] = $avg_z->avg_z4;
    //     $data['z5'] = $avg_z->avg_z5;
    //     $data['z6'] = $avg_z->avg_z6;
    //     $data['z7'] = $avg_z->avg_z7;
    //     $data['z8'] = $avg_z->avg_z8;

    //     $data['r1'] = $avg_r->avg_r1;
    //     $data['r2'] = $avg_r->avg_r2;
    //     $data['r3'] = $avg_r->avg_r3;
    //     $data['r4'] = $avg_r->avg_r4;
    //     $data['r5'] = $avg_r->avg_r5;

    //     // Calculate NRR
    //     $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
    //     $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;

    //     $sum_nrr = $nrr_z - $nrr_r;
    //     $result = $sum_nrr * 50;
    //     $result = min(max($result, 0), 100);

    //     // Load view with result
    //     $data['spkp_spak'] = $result;
    //     $data['semester'] = $semester;
    //     $data['home'] = 'Home';
    //     $data['title'] = 'Rekap IKM';

    //     $this->load->view('templates/admin_header', $data, FALSE);
    //     $this->load->view('templates/admin_navbar', $data, FALSE);
    //     $this->load->view('templates/admin_sidebar', $data, FALSE);
    //     $this->load->view('admin/rekap_skm', $data, FALSE);
    //     $this->load->view('templates/admin_footer');
    // }

    function index()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');

        // === SEMESTER 1 ===
        $s1_awal = 1;
        $s1_akhir = 6;
        $data['s1'] = $this->get_skm_data($s1_awal, $s1_akhir, $tahun);

        // === SEMESTER 2 ===
        $s2_awal = 7;
        $s2_akhir = 12;
        $data['s2'] = $this->get_skm_data($s2_awal, $s2_akhir, $tahun);

        $data['home'] = 'Home';
        $data['title'] = 'Data IKM Tahunan';
        $data['tahun'] = $tahun;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/rekap_skm', $data);
        $this->load->view('templates/admin_footer');
    }

    private function get_skm_data($awalBulan, $akhirBulan, $tahun)
    {
        $m = $this->Model_skm;

        // Ambil nilai U1 - U9
        $avg_u = [];
        $ikm = 0;
        for ($i = 1; $i <= 9; $i++) {
            $avg_u[$i] = $m->{"avg_u$i"}($awalBulan, $akhirBulan, $tahun, $tahun);
            $ikm += $avg_u[$i] * 0.1111;
        }

        // Ambil nilai R dan Z
        $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $tahun, $tahun);
        $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $tahun, $tahun);

        $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
        $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;
        $spkp_spak = min(max(($nrr_z - $nrr_r) * 50, 0), 100);

        return [
            'jumlah' => $m->jmlh_data($awalBulan, $akhirBulan, $tahun, $tahun),
            'lk' => $m->jmlh_lk($awalBulan, $akhirBulan, $tahun, $tahun),
            'pr' => $m->jmlh_pr($awalBulan, $akhirBulan, $tahun, $tahun),

            // Umur
            'umur' => [
                '<20'   => $m->jmlh_umur('<', 20, $awalBulan, $akhirBulan, $tahun) ?: 0,
                '20-29' => $m->jmlh_umur_range(20, 29, $awalBulan, $akhirBulan, $tahun) ?: 0,
                '30-39' => $m->jmlh_umur_range(30, 39, $awalBulan, $akhirBulan, $tahun) ?: 0,
                '40-49' => $m->jmlh_umur_range(40, 49, $awalBulan, $akhirBulan, $tahun) ?: 0,
                '50-59' => $m->jmlh_umur_range(50, 59, $awalBulan, $akhirBulan, $tahun) ?: 0,
                '60+'   => $m->jmlh_umur('>=', 60, $awalBulan, $akhirBulan, $tahun) ?: 0,
            ],

            // Pendidikan
            'sd' => $m->jmlh_sd($awalBulan, $akhirBulan, $tahun, $tahun),
            'smp' => $m->jmlh_smp($awalBulan, $akhirBulan, $tahun, $tahun),
            'sma' => $m->jmlh_sma($awalBulan, $akhirBulan, $tahun, $tahun),
            'd1' => $m->jmlh_d1($awalBulan, $akhirBulan, $tahun, $tahun),
            's1' => $m->jmlh_s1($awalBulan, $akhirBulan, $tahun, $tahun),
            's2' => $m->jmlh_s2($awalBulan, $akhirBulan, $tahun, $tahun),

            // Pekerjaan
            'pns' => $m->jmlh_pns($awalBulan, $akhirBulan, $tahun, $tahun),
            'tni' => $m->jmlh_tni($awalBulan, $akhirBulan, $tahun, $tahun),
            'polri' => $m->jmlh_polri($awalBulan, $akhirBulan, $tahun, $tahun),
            'swasta' => $m->jmlh_swasta($awalBulan, $akhirBulan, $tahun, $tahun),
            'wirausaha' => $m->jmlh_wirausaha($awalBulan, $akhirBulan, $tahun, $tahun),
            'lainnya' => $m->jmlh_lainnya($awalBulan, $akhirBulan, $tahun, $tahun),

            // Nilai U
            'u' => $avg_u,
            'ikm' => round($ikm * 25, 2),

            // Nilai R
            'r' => [
                1 => $avg_r->avg_r1,
                2 => $avg_r->avg_r2,
                3 => $avg_r->avg_r3,
                4 => $avg_r->avg_r4,
                5 => $avg_r->avg_r5,
            ],

            // Nilai Z
            'z' => [
                1 => $avg_z->avg_z1,
                2 => $avg_z->avg_z2,
                3 => $avg_z->avg_z3,
                4 => $avg_z->avg_z4,
                5 => $avg_z->avg_z5,
                6 => $avg_z->avg_z6,
                7 => $avg_z->avg_z7,
                8 => $avg_z->avg_z8,
            ],

            // Nilai Akhir SPKP-SPAK
            'spkp_spak' => round($spkp_spak, 2),
        ];
    }

    // public function skm()
    // {
    //     require_once 'vendor/autoload.php';

    //     $dompdf = new Dompdf();

    //     $BulanIni = date('n');
    //     $TahunIni = date('Y');

    //     // tentukan semester berdasarkan bulan
    //     $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

    //     // tentukan range bulan berdasarkan semester
    //     if ($semester == 1) {
    //         $awalBulan = 1;
    //         $akhirBulan = 6;
    //         $awalTahun = $TahunIni; // Tahun awal semester 1 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     } else {
    //         $awalBulan = 7;
    //         $akhirBulan = 12;
    //         $awalTahun = $TahunIni; // Tahun awal semester 2 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     }

    //     // SKM
    //     $data['jumlah'] = $this->Model_skm->jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lk'] = $this->Model_skm->jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pr'] = $this->Model_skm->jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sd'] = $this->Model_skm->jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_smp'] = $this->Model_skm->jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sma'] = $this->Model_skm->jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_d1'] = $this->Model_skm->jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s1'] = $this->Model_skm->jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s2'] = $this->Model_skm->jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pns'] = $this->Model_skm->jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_tni'] = $this->Model_skm->jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_polri'] = $this->Model_skm->jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_swasta'] = $this->Model_skm->jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_wirausaha'] = $this->Model_skm->jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lainnya'] = $this->Model_skm->jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $avg_u1 = $this->Model_skm->avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u2 = $this->Model_skm->avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u3 = $this->Model_skm->avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u4 = $this->Model_skm->avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u5 = $this->Model_skm->avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u6 = $this->Model_skm->avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u7 = $this->Model_skm->avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u8 = $this->Model_skm->avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u9 = $this->Model_skm->avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['u1'] = $avg_u1;
    //     $data['u2'] = $avg_u2;
    //     $data['u3'] = $avg_u3;
    //     $data['u4'] = $avg_u4;
    //     $data['u5'] = $avg_u5;
    //     $data['u6'] = $avg_u6;
    //     $data['u7'] = $avg_u7;
    //     $data['u8'] = $avg_u8;
    //     $data['u9'] = $avg_u9;

    //     $nrr_u1 = $avg_u1 * 0.1111;
    //     $nrr_u2 = $avg_u2 * 0.1111;
    //     $nrr_u3 = $avg_u3 * 0.1111;
    //     $nrr_u4 = $avg_u4 * 0.1111;
    //     $nrr_u5 = $avg_u5 * 0.1111;
    //     $nrr_u6 = $avg_u6 * 0.1111;
    //     $nrr_u7 = $avg_u7 * 0.1111;
    //     $nrr_u8 = $avg_u8 * 0.1111;
    //     $nrr_u9 = $avg_u9 * 0.1111;

    //     $sum_nrr = $nrr_u1 + $nrr_u2 + $nrr_u3 + $nrr_u4 + $nrr_u5 + $nrr_u6 + $nrr_u7 + $nrr_u8 + $nrr_u9;
    //     $data['ikm'] = $sum_nrr * 25;
    //     // end of SKM

    //     // ----------------------------------------- SPKP and SPAK -----------------------------------------
    //     $data['rating_spkp'] = $this->Model_spkp_antikorupsi->get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['rating_antikorupsi'] = $this->Model_spkp_antikorupsi->get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['total_responden'] = $this->Model_spkp_antikorupsi->total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     // Get average z and r values
    //     $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['z1'] = $avg_z->avg_z1;
    //     $data['z2'] = $avg_z->avg_z2;
    //     $data['z3'] = $avg_z->avg_z3;
    //     $data['z4'] = $avg_z->avg_z4;
    //     $data['z5'] = $avg_z->avg_z5;
    //     $data['z6'] = $avg_z->avg_z6;
    //     $data['z7'] = $avg_z->avg_z7;
    //     $data['z8'] = $avg_z->avg_z8;

    //     $data['r1'] = $avg_r->avg_r1;
    //     $data['r2'] = $avg_r->avg_r2;
    //     $data['r3'] = $avg_r->avg_r3;
    //     $data['r4'] = $avg_r->avg_r4;
    //     $data['r5'] = $avg_r->avg_r5;

    //     // Calculate NRR
    //     $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
    //     $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;

    //     $sum_nrr = $nrr_z - $nrr_r;
    //     $result = $sum_nrr * 50;
    //     $result = min(max($result, 0), 100);

    //     // Load view with result
    //     $data['spkp_spak'] = $result;
    //     $data['semester'] = $semester;
    //     $data['home'] = 'Rekap SKM';
    //     $data['title'] = 'Cetak Rekap SKM';

    //     $html = $this->load->view('admin/print/rekap_skm', $data, true);

    //     $options = $dompdf->getOptions();
    //     $options->setIsHtml5ParserEnabled(true);
    //     $options->set('isRemoteEnabled', true);

    //     $dompdf->setOptions($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'landscape');
    //     $dompdf->render();
    //     $dompdf->stream('Survey Kepuasan Masyarakat (SKM) Semester ' . $semester . ' Tahun ' . date('Y') . '.pdf', array('Attachment' => false));
    // }

    // public function spkp()
    // {
    //     require_once 'vendor/autoload.php';

    //     $dompdf = new Dompdf();

    //     $BulanIni = date('n');
    //     $TahunIni = date('Y');

    //     // tentukan semester berdasarkan bulan
    //     $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

    //     // tentukan range bulan berdasarkan semester
    //     if ($semester == 1) {
    //         $awalBulan = 1;
    //         $akhirBulan = 6;
    //         $awalTahun = $TahunIni; // Tahun awal semester 1 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     } else {
    //         $awalBulan = 7;
    //         $akhirBulan = 12;
    //         $awalTahun = $TahunIni; // Tahun awal semester 2 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     }

    //     // SKM
    //     $data['jumlah'] = $this->Model_skm->jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lk'] = $this->Model_skm->jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pr'] = $this->Model_skm->jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sd'] = $this->Model_skm->jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_smp'] = $this->Model_skm->jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sma'] = $this->Model_skm->jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_d1'] = $this->Model_skm->jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s1'] = $this->Model_skm->jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s2'] = $this->Model_skm->jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pns'] = $this->Model_skm->jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_tni'] = $this->Model_skm->jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_polri'] = $this->Model_skm->jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_swasta'] = $this->Model_skm->jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_wirausaha'] = $this->Model_skm->jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lainnya'] = $this->Model_skm->jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $avg_u1 = $this->Model_skm->avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u2 = $this->Model_skm->avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u3 = $this->Model_skm->avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u4 = $this->Model_skm->avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u5 = $this->Model_skm->avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u6 = $this->Model_skm->avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u7 = $this->Model_skm->avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u8 = $this->Model_skm->avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u9 = $this->Model_skm->avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['u1'] = $avg_u1;
    //     $data['u2'] = $avg_u2;
    //     $data['u3'] = $avg_u3;
    //     $data['u4'] = $avg_u4;
    //     $data['u5'] = $avg_u5;
    //     $data['u6'] = $avg_u6;
    //     $data['u7'] = $avg_u7;
    //     $data['u8'] = $avg_u8;
    //     $data['u9'] = $avg_u9;

    //     $nrr_u1 = $avg_u1 * 0.1111;
    //     $nrr_u2 = $avg_u2 * 0.1111;
    //     $nrr_u3 = $avg_u3 * 0.1111;
    //     $nrr_u4 = $avg_u4 * 0.1111;
    //     $nrr_u5 = $avg_u5 * 0.1111;
    //     $nrr_u6 = $avg_u6 * 0.1111;
    //     $nrr_u7 = $avg_u7 * 0.1111;
    //     $nrr_u8 = $avg_u8 * 0.1111;
    //     $nrr_u9 = $avg_u9 * 0.1111;

    //     $sum_nrr = $nrr_u1 + $nrr_u2 + $nrr_u3 + $nrr_u4 + $nrr_u5 + $nrr_u6 + $nrr_u7 + $nrr_u8 + $nrr_u9;
    //     $data['ikm'] = $sum_nrr * 25;
    //     // end of SKM

    //     // ----------------------------------------- SPKP and SPAK -----------------------------------------
    //     $data['rating_spkp'] = $this->Model_spkp_antikorupsi->get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['rating_antikorupsi'] = $this->Model_spkp_antikorupsi->get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['total_responden'] = $this->Model_spkp_antikorupsi->total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     // Get average z and r values
    //     $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['z1'] = $avg_z->avg_z1;
    //     $data['z2'] = $avg_z->avg_z2;
    //     $data['z3'] = $avg_z->avg_z3;
    //     $data['z4'] = $avg_z->avg_z4;
    //     $data['z5'] = $avg_z->avg_z5;
    //     $data['z6'] = $avg_z->avg_z6;
    //     $data['z7'] = $avg_z->avg_z7;
    //     $data['z8'] = $avg_z->avg_z8;

    //     $data['r1'] = $avg_r->avg_r1;
    //     $data['r2'] = $avg_r->avg_r2;
    //     $data['r3'] = $avg_r->avg_r3;
    //     $data['r4'] = $avg_r->avg_r4;
    //     $data['r5'] = $avg_r->avg_r5;

    //     // Calculate NRR
    //     $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
    //     $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;

    //     $sum_nrr = $nrr_z - $nrr_r;
    //     $result = $sum_nrr * 50;
    //     $result = min(max($result, 0), 100);

    //     // Load view with result
    //     $data['spkp_spak'] = $result;
    //     $data['semester'] = $semester;
    //     $data['home'] = 'Rekap SPKP';
    //     $data['title'] = 'Cetak Rekap SPKP';

    //     $html = $this->load->view('admin/print/rekap_spkp', $data, true);

    //     $options = $dompdf->getOptions();
    //     $options->setIsHtml5ParserEnabled(true);
    //     $options->set('isRemoteEnabled', true);

    //     $dompdf->setOptions($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'landscape');
    //     $dompdf->render();
    //     $dompdf->stream('Survey Persepsi Kualitas Pelayanan (SPKP) Semester ' . $semester . ' Tahun ' . date('Y') . '.pdf', array('Attachment' => false));
    // }

    // public function spak()
    // {
    //     require_once 'vendor/autoload.php';

    //     $dompdf = new Dompdf();

    //     $BulanIni = date('n');
    //     $TahunIni = date('Y');

    //     // tentukan semester berdasarkan bulan
    //     $semester = ($BulanIni >= 1 && $BulanIni <= 6) ? 1 : 2;

    //     // tentukan range bulan berdasarkan semester
    //     if ($semester == 1) {
    //         $awalBulan = 1;
    //         $akhirBulan = 6;
    //         $awalTahun = $TahunIni; // Tahun awal semester 1 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     } else {
    //         $awalBulan = 7;
    //         $akhirBulan = 12;
    //         $awalTahun = $TahunIni; // Tahun awal semester 2 adalah tahun saat ini
    //         $akhirTahun = $TahunIni;
    //     }

    //     // SKM
    //     $data['jumlah'] = $this->Model_skm->jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lk'] = $this->Model_skm->jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pr'] = $this->Model_skm->jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sd'] = $this->Model_skm->jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_smp'] = $this->Model_skm->jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_sma'] = $this->Model_skm->jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_d1'] = $this->Model_skm->jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s1'] = $this->Model_skm->jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_s2'] = $this->Model_skm->jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_pns'] = $this->Model_skm->jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_tni'] = $this->Model_skm->jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_polri'] = $this->Model_skm->jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_swasta'] = $this->Model_skm->jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_wirausaha'] = $this->Model_skm->jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['jmlh_lainnya'] = $this->Model_skm->jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $avg_u1 = $this->Model_skm->avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u2 = $this->Model_skm->avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u3 = $this->Model_skm->avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u4 = $this->Model_skm->avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u5 = $this->Model_skm->avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u6 = $this->Model_skm->avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u7 = $this->Model_skm->avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u8 = $this->Model_skm->avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_u9 = $this->Model_skm->avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['u1'] = $avg_u1;
    //     $data['u2'] = $avg_u2;
    //     $data['u3'] = $avg_u3;
    //     $data['u4'] = $avg_u4;
    //     $data['u5'] = $avg_u5;
    //     $data['u6'] = $avg_u6;
    //     $data['u7'] = $avg_u7;
    //     $data['u8'] = $avg_u8;
    //     $data['u9'] = $avg_u9;

    //     $nrr_u1 = $avg_u1 * 0.1111;
    //     $nrr_u2 = $avg_u2 * 0.1111;
    //     $nrr_u3 = $avg_u3 * 0.1111;
    //     $nrr_u4 = $avg_u4 * 0.1111;
    //     $nrr_u5 = $avg_u5 * 0.1111;
    //     $nrr_u6 = $avg_u6 * 0.1111;
    //     $nrr_u7 = $avg_u7 * 0.1111;
    //     $nrr_u8 = $avg_u8 * 0.1111;
    //     $nrr_u9 = $avg_u9 * 0.1111;

    //     $sum_nrr = $nrr_u1 + $nrr_u2 + $nrr_u3 + $nrr_u4 + $nrr_u5 + $nrr_u6 + $nrr_u7 + $nrr_u8 + $nrr_u9;
    //     $data['ikm'] = $sum_nrr * 25;
    //     // end of SKM

    //     // ----------------------------------------- SPKP and SPAK -----------------------------------------
    //     $data['rating_spkp'] = $this->Model_spkp_antikorupsi->get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['rating_antikorupsi'] = $this->Model_spkp_antikorupsi->get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $data['total_responden'] = $this->Model_spkp_antikorupsi->total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     // Get average z and r values
    //     $avg_z = $this->Model_spkp_antikorupsi->get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);
    //     $avg_r = $this->Model_spkp_antikorupsi->get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun);

    //     $data['z1'] = $avg_z->avg_z1;
    //     $data['z2'] = $avg_z->avg_z2;
    //     $data['z3'] = $avg_z->avg_z3;
    //     $data['z4'] = $avg_z->avg_z4;
    //     $data['z5'] = $avg_z->avg_z5;
    //     $data['z6'] = $avg_z->avg_z6;
    //     $data['z7'] = $avg_z->avg_z7;
    //     $data['z8'] = $avg_z->avg_z8;

    //     $data['r1'] = $avg_r->avg_r1;
    //     $data['r2'] = $avg_r->avg_r2;
    //     $data['r3'] = $avg_r->avg_r3;
    //     $data['r4'] = $avg_r->avg_r4;
    //     $data['r5'] = $avg_r->avg_r5;

    //     // Calculate NRR
    //     $nrr_z = ($avg_z->avg_z1 + $avg_z->avg_z2 + $avg_z->avg_z3 + $avg_z->avg_z4 + $avg_z->avg_z5 + $avg_z->avg_z6 + $avg_z->avg_z7 + $avg_z->avg_z8) * 0.1111;
    //     $nrr_r = ($avg_r->avg_r1 + $avg_r->avg_r2 + $avg_r->avg_r3 + $avg_r->avg_r4 + $avg_r->avg_r5) * 0.1111;

    //     $sum_nrr = $nrr_z - $nrr_r;
    //     $result = $sum_nrr * 50;
    //     $result = min(max($result, 0), 100);

    //     // Load view with result
    //     $data['spkp_spak'] = $result;
    //     $data['semester'] = $semester;
    //     $data['home'] = 'Rekap SPAK';
    //     $data['title'] = 'Cetak Rekap SPAK';

    //     $html = $this->load->view('admin/print/rekap_spak', $data, true);

    //     $options = $dompdf->getOptions();
    //     $options->setIsHtml5ParserEnabled(true);
    //     $options->set('isRemoteEnabled', true);

    //     $dompdf->setOptions($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'landscape');
    //     $dompdf->render();
    //     $dompdf->stream('Survey Persepsi Anti Korupsi (SPAK) Semester ' . $semester . ' Tahun ' . date('Y') . '.pdf', array('Attachment' => false));
    // }
}

/* End of file Rekap_ikm.php */
