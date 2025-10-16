<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layanan_publik extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_pengaturan');
    }

    public function index()
    {

        $data['pengaturan'] = $this->Model_pengaturan->tampil_data();
        $data['home'] = 'Home';
        $data['title'] = 'Layanan Publik';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/layanan_publik', $data);
        $this->load->view('edit/edit_layanan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit()
    {
        $id_setting = $this->input->post('id', true);
        $layanan = $this->input->post('layanan', true);

        // File maklumat
        $maklumat = $this->input->post('old2', true);
        if (isset($_FILES['maklumat']) && !empty($_FILES['maklumat']['name'])) {
            $nmfile = "maklumat-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;
            $config['max_size'] = 22048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('maklumat')) {
                // Hapus file lama
                if (file_exists('./assets/imgupload/' . $maklumat)) {
                    unlink('./assets/imgupload/' . $maklumat);
                }
                $maklumat = $this->upload->data('file_name');
            } else {
                // Menangani error upload
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                redirect('admin/pengaturan');
            }
        }

        // Data yang akan diperbarui
        $data = array(
            'id_setting' => $id_setting,
            'layanan' => $layanan,
            'maklumat' => $maklumat
        );

        $result = $this->Model_pengaturan->update($data, $id_setting);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Layanan Publik berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/layanan_publik', 'refresh');
    }
}
