<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_sop');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['pdf']   = $this->Model_sop->tampil_data();
        $data['idmax'] = $this->Model_sop->idmax();

        $data['home']  = 'Home';
        $data['title'] = 'Standar Operasional Prosedur (SOP)';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/sop', $data, FALSE);

        $this->load->view('modal/tambah/sop', $data, FALSE);
        $this->load->view('modal/edit/sop', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $config['upload_path']   = './assets/fileupload/';
        $config['allowed_types'] = 'pdf';
        $config['file_name']     = 'sop-' . time();
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_name')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            $fileData = $this->upload->data();
            $data = [
                'title'     => $this->input->post('title'),
                'file_name' => $fileData['file_name']
            ];

            $result = $this->Model_sop->tambah_data($data);

            if ($result) {
                $this->session->set_flashdata('success', 'File SOP berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Penyimpanan file gagal. Silahkan coba lagi.');
            }
        }
        redirect('admin/sop', 'refresh');
    }

    public function update($id)
    {
        $data = [
            'title' => $this->input->post('title')
        ];

        if (!empty($_FILES['file_name']['name'])) {
            $config['upload_path']   = './assets/fileupload/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = 'sop-' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_name')) {
                // Hapus file lama
                $old_file = $this->Model_sop->get_by_id($id)->file_name;
                if (file_exists('./assets/fileupload/' . $old_file)) {
                    unlink('./assets/fileupload/' . $old_file);
                }
                $fileData = $this->upload->data();
                $data['file_name'] = $fileData['file_name'];
            }
        }

        $result = $this->Model_sop->update_data($id, $data);

        if ($result) {
            $this->session->set_flashdata('success', 'File SOP berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui file gagal. Silahkan coba lagi.');
        }
        redirect('admin/sop', 'refresh');
    }

    public function hapus($id)
    {
        $file = $this->Model_sop->get_by_id($id)->file_name;
        if (file_exists('./assets/fileupload/' . $file)) {
            unlink('./assets/fileupload/' . $file);
        }

        $result = $this->Model_sop->delete_data($id);

        if ($result) {
            $this->session->set_flashdata('success', 'File SOP berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan file gagal. Silahkan coba lagi.');
        }
        redirect('admin/sop', 'refresh');
    }
}
