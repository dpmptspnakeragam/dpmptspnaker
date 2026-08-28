<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role_user = $this->session->userdata('role');

        if ($role_user !== 'Administrator') {
            redirect('admin/home');
        }

        $this->load->model('Model_informasi');
    }

    public function index()
    {
        $data['informasi'] = $this->Model_informasi->tampil_data();
        $data['idmax']     = $this->Model_informasi->idmax();
        $data['kategori']  = $this->Model_informasi->kategori();
        $data['home']      = 'Home';
        $data['title']     = 'Informasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/informasi', $data, FALSE);
        $this->load->view('modal/edit/informasi', $data, FALSE);
        $this->load->view('modal/hapus/informasi', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_berita    = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita   = $this->input->post('tgl_berita', true);
        $isi_berita   = $this->input->post('isi_berita', true);
        $id_kategori  = $this->input->post('id_kategori', true);

        $gambar_final = null;

        if (!empty($_FILES['gambar']['name'])) {
            // Gunakan FCPATH untuk path absolut direktori utama proyek
            $upload_path = FCPATH . 'assets/imgupload/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = "berita-" . time();

            // Memuat dan menginisialisasi library upload
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                $gambar_final = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('error', 'Upload gambar gagal: ' . $error);
                redirect('admin/informasi');
                return;
            }
        }

        $data = [
            'id_berita'    => $id_berita,
            'id_kategori'  => $id_kategori,
            'judul_berita' => $judul_berita,
            'rangkuman'    => $judul_berita,
            'isi_berita'   => $isi_berita,
            'tgl_berita'   => $tgl_berita,
            'gambar'       => $gambar_final
        ];

        $result = $this->Model_informasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/informasi');
    }

    public function edit()
    {
        $id_berita   = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita   = $this->input->post('tgl_berita', true);
        $isi_berita   = $this->input->post('isi_berita', true);
        $id_kategori  = $this->input->post('id_kategori', true);
        $gambar_lama  = $this->input->post('old', true);

        $gambar_baru = $gambar_lama;

        if (!empty($_FILES['gambar']['name'])) {
            $upload_path = FCPATH . 'assets/imgupload/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = "berita-" . time();

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                $gambar_baru = $this->upload->data('file_name');

                // Hapus gambar lama jika ada
                $old_file_path = $upload_path . $gambar_lama;
                if (!empty($gambar_lama) && file_exists($old_file_path) && is_file($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('error', 'Upload gambar baru gagal: ' . $error);
                redirect('admin/informasi');
                return;
            }
        }

        $data = [
            'id_kategori'  => $id_kategori,
            'judul_berita' => $judul_berita,
            'rangkuman'    => $judul_berita,
            'isi_berita'   => $isi_berita,
            'tgl_berita'   => $tgl_berita,
            'gambar'       => $gambar_baru
        ];

        $result = $this->Model_informasi->update($data, $id_berita);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/informasi');
    }

    public function hapus($id_berita)
    {
        $this->db->where('id_berita', $id_berita);
        $query = $this->db->get('berita');
        $row   = $query->row();

        if ($row && !empty($row->gambar)) {
            $file_path = FCPATH . 'assets/imgupload/' . $row->gambar;

            if (file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
        }

        $result = $this->Model_informasi->delete($id_berita);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/informasi');
    }
}
