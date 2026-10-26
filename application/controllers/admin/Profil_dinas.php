<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_dinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek Sesi Login
        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        // Cek Hak Akses Role
        $role_user = $this->session->userdata('role');
        if ($role_user !== 'Administrator') {
            redirect('admin/home');
        }

        // Load Model
        $this->load->model('Model_pengaturan');
    }

    public function index()
    {
        $data['pengaturan'] = $this->Model_pengaturan->tampil_data();
        $data['home']       = 'Home';
        $data['title']      = 'Profil Dinas';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/profil_dinas', $data, FALSE);
        $this->load->view('modal/edit/profil_dinas', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function edit()
    {
        $id_setting = $this->input->post('id', true);
        $sejarah    = $this->input->post('sejarah', true);
        $visi       = $this->input->post('visi', true);
        $misi       = $this->input->post('misi', true);
        $tugas      = $this->input->post('tugas', true);
        $fungsi     = $this->input->post('fungsi', true);

        // Ambil nama file struktur lama
        $old_struktur = $this->input->post('old1', true);
        $struktur     = $old_struktur; // Default gunakan file lama

        // Proses unggah file struktur organisasi jika ada yang dipilih
        if (!empty($_FILES['struktur']['name'])) {
            $nmfile                  = "struktur-" . time();
            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;

            // Inisialisasi atau re-initialize CI Upload Library
            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('struktur')) {
                // Hapus file struktur lama jika ada di server
                if (!empty($old_struktur) && file_exists(FCPATH . 'assets/imgupload/' . $old_struktur)) {
                    unlink(FCPATH . 'assets/imgupload/' . $old_struktur);
                }

                // Simpan nama file yang baru
                $struktur = $this->upload->data('file_name');
            } else {
                // Tampilkan pesan kesalahan jika gagal upload
                $this->session->set_flashdata('error', 'Gagal mengunggah file struktur: ' . $this->upload->display_errors('', ''));
                redirect('admin/profil_dinas', 'refresh');
                return;
            }
        }

        // Data yang akan diperbarui
        $data = array(
            'id_setting' => $id_setting,
            'sejarah'    => $sejarah,
            'visi'       => $visi,
            'misi'       => $misi,
            'tugas'      => $tugas,
            'fungsi'     => $fungsi,
            'struktur'   => $struktur
        );

        $result = $this->Model_pengaturan->update($data, $id_setting);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Profil Dinas berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/profil_dinas', 'refresh');
    }
}
