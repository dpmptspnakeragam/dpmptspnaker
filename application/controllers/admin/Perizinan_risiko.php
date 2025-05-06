<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perizinan_risiko extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_perizinan');
    }

    public function index()
    {
        $data['perizinan'] = $this->Model_perizinan->tampil_data_risiko();
        $data['home'] = 'Home';
        $data['title'] = 'Perizinan Berbasis Risiko';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/perizinan_risiko', $data, FALSE);
        $this->load->view('modal/modal_tambah_perizinan_risiko');
        $this->load->view('edit/edit_perizinan_risiko', $data, FALSE);
        $this->load->view('templates/admin_footer');
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

        $result = $this->Model_perizinan->input_risiko($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan Berbasis Risiko berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
        redirect('admin/perizinan_risiko', 'refresh');
    }

    public function edit()
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

        $result = $this->Model_perizinan->update_risiko($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan Berbasis Risiko berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/perizinan_risiko', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_izin', $id);
        $query = $this->db->get('perizinan_risiko');
        $row = $query->row();

        $result = $this->Model_perizinan->delete_risiko($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan Berbasis Risiko berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/perizinan_risiko', 'refresh');
    }
}
