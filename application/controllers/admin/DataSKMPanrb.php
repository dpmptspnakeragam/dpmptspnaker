<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataSKMPanrb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('skm_panrb_api');
    }

    public function index()
    {
        // 1. Ambil Parameter Tanggal dari Filter Form
        $startDate = $this->input->get('startDate');
        $endDate   = $this->input->get('endDate');

        // 2. Logika Otomatisasi Semester Berdasarkan Tanggal Saat Ini / Mendatang
        if (!$startDate || !$endDate) {
            $currentMonth = (int) date('m');
            $currentYear  = date('Y');

            if ($currentMonth >= 7) {
                // Semester 2 (1 Juli - 31 Desember)
                $startDate = '01-07-' . $currentYear;
                $endDate   = '31-12-' . $currentYear;
                $labelSemester = 'Semester 2 (' . $currentYear . ')';
            } else {
                // Semester 1 (1 Januari - 30 Juni)
                $startDate = '01-01-' . $currentYear;
                $endDate   = '30-06-' . $currentYear;
                $labelSemester = 'Semester 1 (' . $currentYear . ')';
            }
        } else {
            $labelSemester = 'Periode ' . $startDate . ' s/d ' . $endDate;
        }

        // 3. Panggil API getListSurvei
        $api_result = $this->skm_panrb_api->get_list_survey($startDate, $endDate);

        // 4. Kalkulasi Responden & Nilai SKM Akhir
        $total_responden_keseluruhan = 0;
        $total_bobot_nilai = 0;
        $nilai_skm_akhir = 0;

        if (isset($api_result['code']) && $api_result['code'] == 200 && !empty($api_result['data'])) {
            foreach ($api_result['data'] as $survey) {
                $responden = (int) ($survey['total_responden'] ?? 0);
                $nilai     = (float) ($survey['rata_rata_nilai'] ?? 0);

                $total_responden_keseluruhan += $responden;
                $total_bobot_nilai += ($nilai * $responden);
            }

            if ($total_responden_keseluruhan > 0) {
                $nilai_skm_akhir = round($total_bobot_nilai / $total_responden_keseluruhan, 2);
            }
        }

        // 5. Penentuan Mutu Pelayanan KemenPANRB (Skala 100)
        $mutu = 'D';
        $kinerja = 'Tidak Baik';
        if ($nilai_skm_akhir >= 88.31) {
            $mutu = 'A';
            $kinerja = 'Sangat Baik';
        } elseif ($nilai_skm_akhir >= 76.61) {
            $mutu = 'B';
            $kinerja = 'Baik';
        } elseif ($nilai_skm_akhir >= 65.00) {
            $mutu = 'C';
            $kinerja = 'Kurang Baik';
        }

        // 6. Lempar Data ke View
        $data['title']                      = 'Data SKM PANRB';
        $data['home']                       = 'Home';
        $data['startDate']                  = $startDate;
        $data['endDate']                    = $endDate;
        $data['labelSemester']              = $labelSemester;
        $data['api_result']                 = $api_result;
        $data['total_responden_keseluruhan'] = $total_responden_keseluruhan;
        $data['nilai_skm_akhir']            = $nilai_skm_akhir;
        $data['mutu_pelayanan']             = $mutu;
        $data['kinerja']                    = $kinerja;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/skm_panrb', $data);
        $this->load->view('templates/admin_footer');
    }

    // Sub-menu: Raw Data Jawaban Responden (getJawabanHasilSurvei)
    public function raw_jawaban()
    {
        $startDate = $this->input->get('startDate') ?? '01-07-' . date('Y');
        $endDate   = $this->input->get('endDate') ?? '31-12-' . date('Y');

        $data['raw_data'] = $this->skm_panrb_api->get_jawaban_hasil_survey($startDate, $endDate);
        // Bisa dimuat ke view khusus export/tabel mentah
    }
}
