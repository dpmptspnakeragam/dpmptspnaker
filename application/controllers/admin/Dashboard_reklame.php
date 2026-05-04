<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_reklame extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_reklame');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Dashboard Reklame';

        $data['setor'] = $this->Model_reklame->hitung_setor();
        $data['belum_setor'] = $this->Model_reklame->hitung_belumsetor();
        $data['masih_berlaku'] = $this->Model_reklame->hitung_berlaku();
        $data['berlaku_habis'] = $this->Model_reklame->hitung_berlakuhabis();
        $data['total'] = $this->Model_reklame->hitung_total();

        $data_reklame = $this->Model_reklame->tampil_data();

        $reklame_grouped = [];

        foreach ($data_reklame as $row) {
            if (!isset($reklame_grouped[$row['id_reklame']])) {
                $reklame_grouped[$row['id_reklame']] = [
                    'id_reklame' => $row['id_reklame'],
                    'no_izin' => $row['no_izin'],
                    'nama_perusahaan' => $row['nama_perusahaan'],
                    'alamat_perusahaan' => $row['alamat_perusahaan'],
                    'retribusi' => $row['pajak'],
                    'pemohon' => $row['pemohon'],
                    'foto' => $row['foto'],
                    'no_hp' => $row['no_hp'],
                    'ket' => $row['ket'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'tgl_pasang' => $row['tgl_pasang'],
                    'jenis_reklame' => $row['jenis_reklame'],
                    'ukuran' => $row['ukuran'],
                    'lokasi' => []
                ];
            }

            $reklame_grouped[$row['id_reklame']]['lokasi'][] = [
                'alamat_pasang' => $row['alamat_pasang'],
                'nama_kecamatan' => $row['kecamatan'],
                'nama_nagari' => $row['nama_nagari'],
                'lat' => $row['lat'],
                'long' => $row['long']
            ];
        }


        $data['reklame_grouped'] = $reklame_grouped;
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();

        $id_kecamatan = $this->input->post('kec_pasang');
        if ($id_kecamatan) {
            $data['nagari'] = $this->Model_reklame->get_nagari_by_kecamatan($id_kecamatan);
        } else {
            $data['nagari'] = [];
        }

        $data['selected_kecamatan'] = $id_kecamatan;

        if ($data['total'] > 0) {
            $data['persen_setor'] = ($data['setor'] > 0) ? ($data['setor'] / $data['total']) * 100 : 0;
            $data['persen_belumsetor'] = ($data['belum_setor'] > 0) ? ($data['belum_setor'] / $data['total']) * 100 : 0;
            $data['persen_berlaku'] = ($data['masih_berlaku'] > 0) ? ($data['masih_berlaku'] / $data['total']) * 100 : 0;
            $data['persen_berlakuhabis'] = ($data['berlaku_habis'] > 0) ? ($data['berlaku_habis'] / $data['total']) * 100 : 0;
        } else {
            $data['persen_setor'] = 0;
            $data['persen_belumsetor'] = 0;
            $data['persen_berlaku'] = 0;
            $data['persen_berlakuhabis'] = 0;
        }

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/dashboard_reklame', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }
}
