<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_skm extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
        $this->load->model('admin/Model_skm_gambar');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->model('Model_grafik_skm');

        $data['grafik_skm'] = $this->Model_grafik_skm->tampil_data();
        $data['periode_grafik_skm'] = $this->Model_grafik_skm->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik_skm->idmax();

        $data['skm_gambar'] = $this->Model_skm_gambar->tampil_data();
        $data['idmaxx'] = $this->Model_skm_gambar->idmax();

        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/grafik_skm', $data);
        $this->load->view('modal/modal_tambah_grafik_skm');
        $this->load->view('modal/modal_tambah_skm_gambar');
        $this->load->view('edit/edit_grafik_skm', $data);
        $this->load->view('edit/edit_periode_grafik_skm', $data);
        $this->load->view('edit/edit_skm_gambar', $data);
        $this->load->view('templates/footer_admin');
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
        $this->load->model('Model_grafik_skm');
        $this->Model_grafik_skm->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$tahun</b> berhasil !");
        redirect('admin/grafik_skm');
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
        $this->load->model('Model_grafik_skm');
        $this->Model_grafik_skm->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$tahun</b> berhasil !");
        redirect('admin/grafik_skm');
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
        $this->load->model('Model_grafik_skm');
        $this->Model_grafik_skm->update_periode($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data Periode berhasil !");
        redirect('admin/grafik_skm');
    }

    public function hapus($id)
    {
        $this->db->where('id_grafik', $id);
        $query = $this->db->get('grafik_skm');
        $row = $query->row();

        $this->load->model('Model_grafik_skm');
        $this->Model_grafik_skm->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->tahun</b> berhasil !");
        redirect('admin/grafik_skm');
    }

    // --------------------- INDEKS KEPUASAN MASYARAKAT (IKM) ---------------------
    public function tambah_skm_gambar()
    {
        $title = $this->input->post('title');

        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_upload')) {
            // Dapatkan data file yang diunggah
            $file_data = $this->upload->data();

            // Buat nama file baru yang unik
            $file_extension = pathinfo($file_data['file_name'], PATHINFO_EXTENSION);
            $unique_file_name = 'skm_gambar_' . uniqid() . '.' . $file_extension;

            // Pindahkan file dengan nama baru yang unik
            rename($file_data['full_path'], $file_data['file_path'] . $unique_file_name);

            // Simpan data ke database
            $data = [
                'title' => $title,
                'file_name' => $unique_file_name
            ];

            $this->Model_skm_gambar->insertGambar($data);

            $this->session->set_flashdata("berhasil", "Berhasil menambahkan <b>$title</b>!");
        } else {
            $this->session->set_flashdata("gagal", "Gagal menambahkan <b>$title</b>!");
        }

        redirect('admin/grafik_skm');
    }

    public function ubah_skm_gambar()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');

        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_upload')) {
            // Dapatkan data gambar yang sudah ada
            $gambar_lama = $this->Model_skm_gambar->getGambarById($id);

            // Hapus gambar lama jika ada
            if (file_exists('./assets/imgupload/' . $gambar_lama['file_name'])) {
                unlink('./assets/imgupload/' . $gambar_lama['file_name']);
            }

            // Dapatkan data file baru yang diunggah
            $file_data = $this->upload->data();

            // Buat nama file baru yang unik
            $file_extension = pathinfo($file_data['file_name'], PATHINFO_EXTENSION);
            $unique_file_name = 'skm_gambar_' . uniqid() . '.' . $file_extension;

            // Pindahkan file dengan nama baru yang unik
            rename($file_data['full_path'], $file_data['file_path'] . $unique_file_name);

            // Update data di database
            $data = [
                'title' => $title,
                'file_name' => $unique_file_name
            ];

            $this->Model_skm_gambar->updateGambar($id, $data);

            $this->session->set_flashdata("berhasil", "Berhasil mengubah <b>$title</b>!");
        } else {
            // Jika tidak ada file yang diunggah, hanya update title
            $data = [
                'title' => $title
            ];

            $this->Model_skm_gambar->updateGambar($id, $data);

            $this->session->set_flashdata("gagal", "Gagal mengubah <b>$title</b>!");
        }

        redirect('admin/grafik_skm');
    }

    public function hapus_skm_gambar($id)
    {
        // Dapatkan data gambar yang akan dihapus
        $gambar = $this->Model_skm_gambar->getGambarById($id);

        // Hapus gambar dari direktori
        if (file_exists('./assets/imgupload/' . $gambar['file_name'])) {
            unlink('./assets/imgupload/' . $gambar['file_name']);
        }

        // Hapus data dari database
        $this->Model_skm_gambar->deleteGambar($id);

        $this->session->set_flashdata("berhasil", "Berhasil menghapus <b>" . $gambar['title'] . "</b>!");

        redirect('admin/grafik_skm');
    }
}
