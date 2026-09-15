<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_skm_panrb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('skm_panrb_api');
    }

    public function index()
    {
        $startDate = $this->input->get('startDate');
        $endDate   = $this->input->get('endDate');

        // 1. Parameter Default Format DD-MM-YYYY (Contoh: 01-01-2026 s/d 31-12-2026 agar mencakup seluruh data)
        if (!$startDate || !$endDate) {
            $currentYear   = date('Y');
            $startDate     = '01-01-' . $currentYear;
            $endDate       = '31-12-' . $currentYear;
            $labelSemester = 'Tahun ' . $currentYear;
        } else {
            $labelSemester = 'Periode ' . $startDate . ' s/d ' . $endDate;
        }

        // 2. Tarik Data Murni dari API PANRB (Kirim Format DD-MM-YYYY)
        $api_result = $this->skm_panrb_api->get_list_survey($startDate, $endDate);
        $api_nilai  = $this->skm_panrb_api->get_nilai_hasil_survey($startDate, $endDate);

        // 3. Olah Nilai Murni dari API
        $total_responden_keseluruhan = $api_nilai['data']['total_responden'] ?? 0;
        $nilai_skm_akhir            = $api_nilai['data']['ikm_skala_100'] ?? $api_nilai['data']['nilai_skm'] ?? 0;
        $mutu                       = $api_nilai['data']['mutu_pelayanan'] ?? 'D';
        $kinerja                    = $api_nilai['data']['kinerja'] ?? 'Tidak Baik';

        // Hitung total dari list_survey jika get_nilai_hasil_survey kosong
        if ($total_responden_keseluruhan == 0 && !empty($api_result['data'])) {
            foreach ($api_result['data'] as $survey) {
                $total_responden_keseluruhan += (int) ($survey['total_responden'] ?? 0);
            }
        }

        $data = [
            'title'                       => 'Data SKM PANRB',
            'home'                        => 'Home',
            'startDate'                   => $startDate,
            'endDate'                     => $endDate,
            'labelSemester'               => $labelSemester,
            'api_result'                  => $api_result,
            'total_responden_keseluruhan' => $total_responden_keseluruhan,
            'nilai_skm_akhir'             => $nilai_skm_akhir,
            'mutu_pelayanan'              => $mutu,
            'kinerja'                     => $kinerja
        ];

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/skm_panrb', $data);
        $this->load->view('templates/admin_footer');
    }
}
