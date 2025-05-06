<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ppid extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_ppid');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'PPID';
        $data['ppid'] = $this->Model_ppid->tampil_data();
        $data['idmax'] = $this->Model_ppid->idmax();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/ppid', $data);
        $this->load->view('modal/modal_tambah_ppid');
        $this->load->view('edit/edit_ppid', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $file = $_FILES['file']['name'];
        $judul = $this->input->post('judul', true);

        if ($file = '') {
            $file = "";
        } else {
            $nmfile = "ppid-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_ppid' => $id,
            'judul' => $judul,
            'file' => $file
        );

        $result = $this->Model_ppid->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data PPID berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $fileLama = $this->input->post('old', true);
        $fileBaru = $_FILES['file']['name'];

        // Inisialisasi nilai awal file
        $file = $fileLama;

        // Jika ada file baru yang diunggah
        if (!empty($fileBaru)) {
            $nmfile = "ppid-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            // Proses unggah file baru
            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada
                if (file_exists('./assets/fileupload/' . $fileLama)) {
                    unlink('./assets/fileupload/' . $fileLama);
                }
                // Ambil nama file baru
                $file = $this->upload->data('file_name');
            } else {
                // Jika gagal mengunggah file baru
                $this->session->set_flashdata("gagal", "Maaf, file <b>$judul</b> gagal diunggah. Format file tidak sesuai !");
                redirect('admin/ppid');
            }
        }

        // Data untuk diperbarui
        $data = array(
            'id_ppid' => $id,
            'judul' => $judul,
            'file' => $file
        );

        // Update data ke database
        $result = $this->Model_ppid->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data PPID berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_ppid', $id);
        $query = $this->db->get('ppid');
        $row = $query->row();

        if (!empty($row->file) && file_exists("./assets/fileupload/$row->file")) {
            unlink("./assets/fileupload/$row->file");
        }

        $result = $this->Model_ppid->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data PPID berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }
}
