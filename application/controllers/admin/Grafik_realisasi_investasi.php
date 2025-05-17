<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_realisasi_investasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_grafik_investasi');
    }

    public function index()
    {
        $data['grafik_investasi'] = $this->Model_grafik_investasi->tampil_data();
        $data['periode_grafik_investasi'] = $this->Model_grafik_investasi->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik_investasi->idmax();

        $data['home'] = 'Home';
        $data['title'] = 'Grafik Realisasi Investasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_realisasi_investasi', $data);

        $this->load->view('modal/tambah/grafik_realisasi_investasi');
        $this->load->view('modal/edit/grafik_realisasi_investasi', $data);
        $this->load->view('modal/hapus/grafik_realisasi_investasi', $data, FALSE);

        $this->load->view('modal/edit/periode_grafik_realisasi_investasi', $data);

        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $tahun = $this->input->post('tahun', true);
        $nilai = $this->input->post('nilai', true);
        $nilai2 = $this->input->post('nilai2', true);

        $data = array(
            'id_grafik' => $id,
            'tahun' => $tahun,
            'nilai' => $nilai,
            'nilai2' => $nilai2
        );

        $result = $this->Model_grafik_investasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Grafik Realisasi Investasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id', true);
        $tahun = $this->input->post('tahun', true);
        $nilai = $this->input->post('nilai', true);
        $nilai2 = $this->input->post('nilai2', true);

        $data = array(
            'id_grafik' => $id,
            'tahun' => $tahun,
            'nilai' => $nilai,
            'nilai2' => $nilai2
        );

        $result = $this->Model_grafik_investasi->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Grafik Realisasi Investasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }

    public function edit_periode()
    {
        $id = $this->input->post('id', true);
        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);

        $data = array(
            'id_periode' => $id,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );

        $result = $this->Model_grafik_investasi->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Periode Grafik Realisasi Investasi berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }

    public function hapus($id)
    {
        $query = $this->db->get_where('grafik_investasi', ['id_grafik' => $id]);

        if ($query->num_rows() > 0) {
            $result = $this->Model_grafik_investasi->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data Grafik Realisasi Investasi berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }
}
