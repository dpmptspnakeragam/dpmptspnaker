<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ppid extends CI_controller
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
        $this->load->model('Model_ppid');
        $data['ppid'] = $this->Model_ppid->tampil_data();
        $data['idmax'] = $this->Model_ppid->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/ppid', $data);
        $this->load->view('modal/modal_tambah_ppid');
        $this->load->view('edit/edit_ppid', $data);
        $this->load->view('templates/footer_admin');
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
        $this->load->model('Model_ppid');
        $this->Model_ppid->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$judul</b> berhasil !");
        redirect('admin/ppid');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $file = $_FILES['file']['name'];

        if (empty($_FILES['file']['name'])) {
            $file = $this->input->post('old', true);
        } else {
            $nmfile = "ppid-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata("gagal", "Maaf, file <b>$judul</b> gagal diunggah. Format file tidak sesuai !");
                redirect('admin/ppid');
            }
        }

        $data = array(
            'id_ppid' => $id,
            'judul' => $judul,
            'file' => $file
        );
        $this->load->model('Model_ppid');
        $this->Model_ppid->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$judul</b> berhasil !");
        redirect('admin/ppid');
    }

    public function hapus($id)
    {
        $this->db->where('id_ppid', $id);
        $query = $this->db->get('ppid');
        $row = $query->row();

        unlink("./assets/fileupload/$row->file");

        $this->load->model('Model_ppid');
        $this->Model_ppid->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->judul</b> berhasil !");
        redirect('admin/ppid');
    }
}
