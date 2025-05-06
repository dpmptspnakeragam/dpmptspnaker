<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_investasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load->model('Model_grafik_investasi');
        $data['grafik_investasi'] = $this->Model_grafik_investasi->tampil_data();
        $data['periode_grafik_investasi'] = $this->Model_grafik_investasi->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik_investasi->idmax();

        $data['home'] = 'Home';
        $data['title'] = 'Grafik Investasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/grafik_investasi', $data);
        $this->load->view('modal/modal_tambah_grafik_investasi');
        $this->load->view('edit/edit_grafik_investasi', $data);
        $this->load->view('edit/edit_periode_grafik_investasi', $data);
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
        $this->load->model('Model_grafik_investasi');
        $this->Model_grafik_investasi->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$tahun</b> berhasil !");
        redirect('admin/grafik_investasi');
    }

    public function ubah()
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
        $this->load->model('Model_grafik_investasi');
        $this->Model_grafik_investasi->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$tahun</b> berhasil !");
        redirect('admin/grafik_investasi');
    }

    public function ubah_periode()
    {
        $id = $this->input->post('id', true);
        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);

        $data = array(
            'id_periode' => $id,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );
        $this->load->model('Model_grafik_investasi');
        $this->Model_grafik_investasi->update_periode($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data Periode berhasil !");
        redirect('admin/grafik_investasi');
    }

    public function hapus($id)
    {
        $this->db->where('id_grafik', $id);
        $query = $this->db->get('grafik_investasi');
        $row = $query->row();

        $this->load->model('Model_grafik_investasi');
        $this->Model_grafik_investasi->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->tahun</b> berhasil !");
        redirect('admin/grafik_investasi');
    }
}
