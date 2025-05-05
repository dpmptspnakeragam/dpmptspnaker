<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_nib extends CI_controller
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
        $this->load->model('Model_grafik_nib');
        $data['grafik_nib'] = $this->Model_grafik_nib->tampil_data_nib();
        $data['grafik_risiko'] = $this->Model_grafik_nib->tampil_data_risiko();
        $data['grafik_kecamatan'] = $this->Model_grafik_nib->tampil_data_kecamatan();
        $data['grafik_kbli'] = $this->Model_grafik_nib->tampil_data_kbli();
        $data['periode_grafik'] = $this->Model_grafik_nib->tampil_data_periode();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/grafik_nib', $data);
        $this->load->view('modal/modal_tambah_grafik_nib');
        $this->load->view('edit/edit_grafik_nib');
        $this->load->view('modal/modal_tambah_grafik_risiko');
        $this->load->view('edit/edit_grafik_risiko');
        $this->load->view('modal/modal_tambah_grafik_kecamatan');
        $this->load->view('edit/edit_grafik_kecamatan');
        $this->load->view('modal/modal_tambah_grafik_kbli');
        $this->load->view('edit/edit_grafik_kbli');
        $this->load->view('edit/edit_periode_grafik_nib');
        $this->load->view('templates/footer_admin');
    }

    //-----------Grafik PMDN/PMA & UMK/Non UMK------//
    public function tambah_nib()
    {
        $nib = $this->input->post('nib', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'nib' => $nib,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->input_nib($data);
        $this->session->set_flashdata("berhasil", "Tambah data PMDN/PMA & UMK/Non UMK berhasil !");
        redirect('admin/grafik_nib');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $nib = $this->input->post('nib', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'nib' => $nib,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->update_nib($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nib</b> berhasil !");
        redirect('admin/grafik_nib');
    }

    public function hapus_nib($id)
    {
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->delete_nib($id);
        $this->session->set_flashdata("gagal", "Hapus data PMDN/PMA & UMK/Non UMK berhasil !");
        redirect('admin/grafik_nib');
    }
    //-----------Grafik PMDN/PMA & UMK/Non UMK------//

    //-----------Grafik Risiko------//
    public function tambah_risiko()
    {
        $risiko = $this->input->post('risiko', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'risiko' => $risiko,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->input_risiko($data);
        $this->session->set_flashdata("berhasil", "Tambah data Risiko berhasil !");
        redirect('admin/grafik_nib');
    }

    public function ubah_risiko()
    {
        $id = $this->input->post('id', true);
        $risiko = $this->input->post('risiko', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'risiko' => $risiko,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->update_risiko($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$risiko</b> berhasil !");
        redirect('admin/grafik_nib');
    }

    public function hapus_risiko($id)
    {
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->delete_risiko($id);
        $this->session->set_flashdata("gagal", "Hapus data Risiko berhasil !");
        redirect('admin/grafik_nib');
    }
    //-----------Grafik Risiko------//

    //-----------Grafik Kecamatan------//
    public function tambah_kecamatan()
    {
        $kecamatan = $this->input->post('kecamatan', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'kecamatan' => $kecamatan,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->input_kecamatan($data);
        $this->session->set_flashdata("berhasil", "Tambah data Proyek Per Kecamatan berhasil !");
        redirect('admin/grafik_nib');
    }

    public function ubah_kecamatan()
    {
        $id = $this->input->post('id', true);
        $kecamatan = $this->input->post('kecamatan', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'kecamatan' => $kecamatan,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->update_kecamatan($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data Proyek Per Kecamatan berhasil !");
        redirect('admin/grafik_nib');
    }

    public function hapus_kecamatan($id)
    {
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->delete_kecamatan($id);
        $this->session->set_flashdata("gagal", "Hapus data Proyek Per Kecamatan berhasil !");
        redirect('admin/grafik_nib');
    }
    //-----------Grafik kecamatan------//

    //-----------Grafik kbli------//
    public function tambah_kbli()
    {
        $kbli = $this->input->post('kbli', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'kbli' => $kbli,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->input_kbli($data);
        $this->session->set_flashdata("berhasil", "Tambah data KBLI berhasil !");
        redirect('admin/grafik_nib');
    }

    public function ubah_kbli()
    {
        $id = $this->input->post('id', true);
        $kbli = $this->input->post('kbli', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'kbli' => $kbli,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->update_kbli($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data KBLI berhasil !");
        redirect('admin/grafik_nib');
    }

    public function hapus_kbli($id)
    {
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->delete_kbli($id);
        $this->session->set_flashdata("gagal", "Hapus data KBLI berhasil !");
        redirect('admin/grafik_nib');
    }
    //-----------Grafik kbli------//

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
        $this->load->model('Model_grafik_nib');
        $this->Model_grafik_nib->update_periode($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data Periode berhasil !");
        redirect('admin/grafik_nib');
    }
}
