<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_skm extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_grafik_skm');
        $this->load->model('admin/Model_skm_gambar');
        $this->load->library('upload');
    }

    public function index()
    {

        $data['grafik_skm'] = $this->Model_grafik_skm->tampil_data();
        $data['periode_grafik_skm'] = $this->Model_grafik_skm->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik_skm->idmax();

        $data['skm_gambar'] = $this->Model_skm_gambar->tampil_data();
        $data['idmaxx'] = $this->Model_skm_gambar->idmax();

        $data['home'] = 'Home';
        $data['title'] = 'Grafik SKM';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_skm', $data);

        $this->load->view('modal/tambah/grafik_skm');
        $this->load->view('modal/edit/grafik_skm', $data);
        $this->load->view('modal/hapus/grafik_skm', $data);

        $this->load->view('modal/tambah/skm_gambar');
        $this->load->view('modal/edit/skm_gambar', $data);
        $this->load->view('modal/hapus/grafik_skm_gambar', $data);

        $this->load->view('modal/edit/periode_grafik_skm', $data);

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

        $result = $this->Model_grafik_skm->input($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data Tahun $tahun berhasil ditambahkan.");
        } else {
            $this->session->set_flashdata('error', "Penyimpanan data tahun $tahun gagal. Silahkan coba lagi.");
        }

        redirect('admin/grafik_skm', 'refresh');
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

        $result = $this->Model_grafik_skm->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', "Data Tahun $tahun berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', "Perbarui data tahun $tahun gagal. Silakan coba lagi.");
        }

        redirect('admin/grafik_skm', 'refresh');
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

        $result = $this->Model_grafik_skm->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Periode Grafik SKM berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    public function hapus($id)
    {
        $data_skm = $this->Model_grafik_skm->get_by_id_skm($id);

        if ($data_skm) {
            $skm = $data_skm->tahun;

            $result = $this->Model_grafik_skm->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$skm</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    // --------------------- INDEKS KEPUASAN MASYARAKAT (IKM) ---------------------
    public function tambah_skm_gambar()
    {
        $title = $this->input->post('title');

        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_upload')) {
            $file_data = $this->upload->data();

            $file_extension = pathinfo($file_data['file_name'], PATHINFO_EXTENSION);
            $unique_file_name = 'skm_gambar_' . uniqid() . '.' . $file_extension;

            rename($file_data['full_path'], $file_data['file_path'] . $unique_file_name);

            $data = [
                'title' => $title,
                'file_name' => $unique_file_name
            ];

            $result = $this->Model_skm_gambar->insertGambar($data);

            if ($result) {
                $this->session->set_flashdata('success', "Data $title berhasil ditambahkan.");
            } else {
                $this->session->set_flashdata('error', "Penyimpanan data $title gagal. Silahkan coba lagi.");
            }
        } else {
            $this->session->set_flashdata("error", "Terjadi kesalahan. Silahkan coba lagi.");
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    public function ubah_skm_gambar()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');

        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_upload')) {
            $gambar_lama = $this->Model_skm_gambar->getGambarById($id);

            if (file_exists('./assets/imgupload/' . $gambar_lama['file_name'])) {
                unlink('./assets/imgupload/' . $gambar_lama['file_name']);
            }

            $file_data = $this->upload->data();

            $file_extension = pathinfo($file_data['file_name'], PATHINFO_EXTENSION);
            $unique_file_name = 'skm_gambar_' . uniqid() . '.' . $file_extension;

            rename($file_data['full_path'], $file_data['file_path'] . $unique_file_name);

            $data = [
                'title' => $title,
                'file_name' => $unique_file_name
            ];

            $this->Model_skm_gambar->updateGambar($id, $data);

            $this->session->set_flashdata('success', "Data $title berhasil diperbarui.");
        } else {
            $data = [
                'title' => $title
            ];

            $this->Model_skm_gambar->updateGambar($id, $data);

            $this->session->set_flashdata('success', "Data $title berhasil diperbarui.");
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    public function hapus_skm_gambar($id)
    {
        $datagambar = $this->Model_skm_gambar->get_by_id_gambar($id);

        if ($datagambar) {
            $gambar = $datagambar['title'];

            if (!empty($datagambar['file_name']) && file_exists('./assets/imgupload/' . $datagambar['file_name'])) {
                unlink('./assets/imgupload/' . $datagambar['file_name']);
            }

            $result = $this->Model_skm_gambar->deleteGambar($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$gambar</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_skm', 'refresh');
    }
}
