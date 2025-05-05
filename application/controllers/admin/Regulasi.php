<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regulasi extends CI_controller
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
        $this->load->model('Model_regulasi');
        $data['regulasi'] = $this->Model_regulasi->tampil_data();
        $data['idmax'] = $this->Model_regulasi->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/regulasi', $data);
        $this->load->view('modal/modal_tambah_regulasi');
        $this->load->view('edit/edit_regulasi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $tentang = $this->input->post('tentang', true);
        $file = '';

        // Cek apakah ada file yang diupload
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $nmfile = "regulasi-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                // Handle error upload
                $error = $this->upload->display_errors();
                $this->session->set_flashdata("error", "Upload file gagal: $error");
                redirect('admin/regulasi');
                return;
            }
        }

        // Cek apakah semua data yang diperlukan telah diisi
        if (empty($judul) || empty($tentang)) {
            $this->session->set_flashdata("error", "Judul dan Tentang tidak boleh kosong.");
            redirect('admin/regulasi');
            return;
        }

        $data = array(
            'id_regulasi' => $id,
            'judul' => $judul,
            'tentang' => $tentang,
            'file' => $file
        );

        $this->load->model('Model_regulasi');
        $this->Model_regulasi->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$judul</b> berhasil!");
        redirect('admin/regulasi');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $tentang = $this->input->post('tentang', true);
        $file = '';

        // Ambil file lama dari input hidden
        $old_file = $this->input->post('old', true);

        // Cek apakah ada file yang diupload
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $nmfile = "regulasi-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');

                // Hapus file lama jika ada
                if ($old_file && file_exists('./assets/fileupload/' . $old_file)) {
                    unlink('./assets/fileupload/' . $old_file);
                }
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata("gagal", "Maaf, file <b>$judul</b> gagal diunggah. $error");
                redirect('admin/regulasi');
                return;
            }
        } else {
            // Gunakan file lama jika tidak ada file baru yang diupload
            $file = $old_file;
        }

        // Cek apakah semua data yang diperlukan telah diisi
        if (empty($judul) || empty($tentang)) {
            $this->session->set_flashdata("error", "Judul dan Tentang tidak boleh kosong.");
            redirect('admin/regulasi');
            return;
        }

        $data = array(
            'id_regulasi' => $id,
            'judul' => $judul,
            'tentang' => $tentang,
            'file' => $file
        );

        $this->load->model('Model_regulasi');
        $this->Model_regulasi->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$judul</b> berhasil!");
        redirect('admin/regulasi');
    }

    public function hapus($id)
    {
        $this->db->where('id_regulasi', $id);
        $query = $this->db->get('regulasi');
        $row = $query->row();

        unlink("./assets/fileupload/$row->file");

        $this->load->model('Model_regulasi');
        $this->Model_regulasi->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->judul</b> berhasil !");
        redirect('admin/regulasi');
    }
}
