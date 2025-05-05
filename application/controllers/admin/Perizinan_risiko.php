<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perizinan_risiko extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
    }

    public function index()
    {
        $this->load->model('Model_perizinan');
        $data['perizinan'] = $this->Model_perizinan->tampil_data_risiko();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/perizinan_risiko', $data);
        $this->load->view('modal/modal_tambah_perizinan_risiko');
        $this->load->view('edit/edit_perizinan_risiko');
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $syarat = $this->input->post('syarat', true);
        $jenis = $this->input->post('jenis', true);
        $biaya = $this->input->post('biaya', true);
        $lamaproses = $this->input->post('lamaproses', true);

        $data = array(
            'id_izin' => $id,
            'jenis' => $jenis,
            'syarat' => $syarat,
            'biaya' => $biaya,
            'lamaproses' => $lamaproses
        );
        $this->load->model('Model_perizinan');
        $this->Model_perizinan->input_risiko($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$jenis</b> berhasil !");
        redirect('admin/perizinan_risiko');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $jenis = $this->input->post('jenis', true);
        $syarat = $this->input->post('syarat', true);
        $biaya = $this->input->post('biaya', true);
        $lamaproses = $this->input->post('lamaproses', true);

        $data = array(
            'id_izin' => $id,
            'jenis' => $jenis,
            'syarat' => $syarat,
            'biaya' => $biaya,
            'lamaproses' => $lamaproses
        );
        $this->load->model('Model_perizinan');
        $this->Model_perizinan->update_risiko($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$jenis</b> berhasil !");
        redirect('admin/perizinan_risiko');
    }

    public function hapus($id)
    {
        $this->db->where('id_izin', $id);
        $query = $this->db->get('perizinan_risiko');
        $row = $query->row();

        $this->load->model('Model_perizinan');
        $this->Model_perizinan->delete_risiko($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->jenis</b> berhasil !");
        redirect('admin/perizinan_risiko');
    }
}
