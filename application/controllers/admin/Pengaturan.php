<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends CI_controller
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
        $data['title'] = 'Pengaturan Teks';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('edit/edit_pengaturan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit1()
    {
        $id_setting = $this->input->post('id', true);
        $sejarah = $this->input->post('sejarah', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);
        $tugas = $this->input->post('tugas', true);
        $fungsi = $this->input->post('fungsi', true);
        $struktur = $_FILES['struktur']['name'];
        $maklumat = $_FILES['maklumat']['name'];

        if (empty($_FILES['struktur']['name'])) {
            $struktur = $this->input->post('old1', true);
        } else {
            $nmfile = "struktur-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('struktur')) {
                $struktur = $this->upload->data('file_name');
            }
        }

        if (empty($_FILES['maklumat']['name'])) {
            $maklumat = $this->input->post('old2', true);
        } else {
            $nmfile = "maklumat-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('maklumat')) {
                $maklumat = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_setting' => $id_setting,
            'sejarah' => $sejarah,
            'visi' => $visi,
            'misi' => $misi,
            'tugas' => $tugas,
            'fungsi' => $fungsi,
            'struktur' => $struktur,
            'maklumat' => $maklumat
        );

        $result = $this->Model_pengaturan->update($data, $id_setting);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pengaturan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/pengaturan', 'refresh');
    }

    public function edit()
    {
        $id_setting = $this->input->post('id', true);
        $sejarah = $this->input->post('sejarah', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);
        $tugas = $this->input->post('tugas', true);
        $fungsi = $this->input->post('fungsi', true);

        // File struktur
        $struktur = $this->input->post('old1', true);
        if (!empty($_FILES['struktur']['name'])) {
            $nmfile = "struktur-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('struktur')) {
                // Hapus file lama
                if (file_exists('./assets/imgupload/' . $struktur)) {
                    unlink('./assets/imgupload/' . $struktur);
                }
                $struktur = $this->upload->data('file_name');
            }
        }

        // File maklumat
        $maklumat = $this->input->post('old2', true);
        if (!empty($_FILES['maklumat']['name'])) {
            $nmfile = "maklumat-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('maklumat')) {
                // Hapus file lama
                if (file_exists('./assets/imgupload/' . $maklumat)) {
                    unlink('./assets/imgupload/' . $maklumat);
                }
                $maklumat = $this->upload->data('file_name');
            }
        }

        // Data yang akan diperbarui
        $data = array(
            'id_setting' => $id_setting,
            'sejarah' => $sejarah,
            'visi' => $visi,
            'misi' => $misi,
            'tugas' => $tugas,
            'fungsi' => $fungsi,
            'struktur' => $struktur,
            'maklumat' => $maklumat
        );

        $result = $this->Model_pengaturan->update($data, $id_setting);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pengaturan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/pengaturan', 'refresh');
    }
}
