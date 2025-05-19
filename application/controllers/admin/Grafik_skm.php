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

        $this->load->view('modal/modal_tambah_grafik_skm');
        $this->load->view('edit/edit_grafik_skm', $data);
        $this->load->view('modal/hapus/grafik_skm', $data);

        $this->load->view('modal/modal_tambah_skm_gambar');
        $this->load->view('edit/edit_skm_gambar', $data);
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
            $this->session->set_flashdata('success', 'Data Grafik SKM berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_skm', 'refresh');
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

        $result = $this->Model_grafik_skm->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Grafik SKM berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
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
            $this->session->set_flashdata('success', 'Periode Grafik SKM berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    public function hapus($id)
    {
        $query = $this->db->get_where('grafik_skm', ['id_grafik' => $id]);

        if ($query->num_rows() > 0) {
            $result = $this->Model_grafik_skm->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data Grafik SKM berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
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

            $result = $this->Model_skm_gambar->insertGambar($data);

            if ($result) {
                $this->session->set_flashdata('success', 'Data Gambar IKM berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
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

            $this->session->set_flashdata('success', 'Data Gambar IKM berhasil diperbarui.');
        } else {
            // Jika tidak ada file yang diunggah, hanya update title
            $data = [
                'title' => $title
            ];

            $this->Model_skm_gambar->updateGambar($id, $data);

            $this->session->set_flashdata('success', 'Data Gambar IKM berhasil diperbarui.');
        }

        redirect('admin/grafik_skm', 'refresh');
    }

    public function hapus_skm_gambar($id)
    {
        $gambar = $this->Model_skm_gambar->getGambarById($id);

        // Hapus gambar dari direktori
        if (file_exists('./assets/imgupload/' . $gambar['file_name'])) {
            unlink('./assets/imgupload/' . $gambar['file_name']);
        }

        // Hapus data dari database
        $this->Model_skm_gambar->deleteGambar($id);

        $this->session->set_flashdata('success', 'Data Gambar IKM berhasil dihapus');

        redirect('admin/grafik_skm', 'refresh');
    }
}
