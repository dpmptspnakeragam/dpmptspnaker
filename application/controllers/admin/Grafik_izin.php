<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_izin extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_grafik');
    }

    public function index()
    {
        $data['grafik'] = $this->Model_grafik->tampil_data();
        $data['periode_grafik'] = $this->Model_grafik->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Grafik Izin Terbit';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/grafik', $data, FALSE);
        $this->load->view('modal/modal_tambah_grafik', $data, FALSE);
        $this->load->view('edit/edit_grafik', $data, FALSE);
        $this->load->view('edit/edit_periode_grafik', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $izin = $this->input->post('izin', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'izin' => $izin,
            'jumlah' => $jumlah
        );

        $result = $this->Model_grafik->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Grafik Izin Terbit berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_izin', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id', true);
        $izin = $this->input->post('izin', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'izin' => $izin,
            'jumlah' => $jumlah
        );

        $result = $this->Model_grafik->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Periode Grafik Izin Terbit berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/grafik_izin', 'refresh');
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

        $result = $this->Model_grafik->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Periode Grafik Izin Terbit berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_izin', 'refresh');
    }

    public function hapus($id)
    {
        $query = $this->db->get_where('grafik', ['id_grafik' => $id]);

        if ($query->num_rows() > 0) {
            $result = $this->Model_grafik->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data Grafik Izin Terbit berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
        }

        redirect('admin/grafik_izin', 'refresh');
    }
}
