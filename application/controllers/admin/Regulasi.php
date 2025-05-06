<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regulasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_regulasi');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Regulasi';
        $data['regulasi'] = $this->Model_regulasi->tampil_data();
        $data['idmax'] = $this->Model_regulasi->idmax();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/regulasi', $data);
        $this->load->view('modal/modal_tambah_regulasi');
        $this->load->view('edit/edit_regulasi', $data);
        $this->load->view('templates/admin_footer');
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

        $result = $this->Model_regulasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/regulasi', 'refresh');
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

        $result = $this->Model_regulasi->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/regulasi', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_regulasi', $id);
        $query = $this->db->get('regulasi');
        $row = $query->row();

        if (!empty($row->file) && file_exists("./assets/fileupload/$row->file")) {
            unlink("./assets/fileupload/$row->file");
        }

        $result = $this->Model_regulasi->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/regulasi', 'refresh');
    }
}
