<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Proteksi halaman
        if ($this->session->userdata('username') == "") {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('home');
        }

        $this->load->database();
        $this->load->model('Model_user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->Model_user->tampil_semua_data();
        $data['home'] = 'Home';
        $data['title'] = 'Manajemen User';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/user', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    /**
     * Menyimpan data pengguna baru
     */
    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role / Hak Akses', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<li>', '</li>'));
            redirect('admin/user');
        } else {
            $insert_data = [
                'nama' => $this->input->post('nama', TRUE), // TRUE mengaktifkan XSS Filter
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password'), // Di-hash otomatis di Model
                'role' => $this->input->post('role', TRUE),
                'online' => 0
            ];

            if ($this->Model_user->insert_user($insert_data)) {
                $this->session->set_flashdata('success', 'Pengguna baru berhasil ditambahkan secara aman!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data.');
            }
            redirect('admin/user');
        }
    }

    /**
     * Memperbarui data pengguna
     */
    public function edit($id)
    {
        $user_data = $this->Model_user->get_user_by_id($id);
        if (!$user_data) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan!');
            redirect('admin/user');
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('role', 'Role / Hak Akses', 'required|trim');

        $username_post = $this->input->post('username', TRUE);
        if ($username_post != $user_data->username) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<li>', '</li>'));
            redirect('admin/user');
        } else {
            $update_data = [
                'nama' => $this->input->post('nama', TRUE),
                'username' => $username_post,
                'role' => $this->input->post('role', TRUE)
            ];

            // Jika form password diisi, sertakan ke array untuk di-hash di Model
            $password_baru = $this->input->post('password');
            if (!empty($password_baru)) {
                if (strlen($password_baru) < 6) {
                    $this->session->set_flashdata('error', 'Password baru minimal harus 6 karakter.');
                    redirect('admin/user');
                }
                $update_data['password'] = $password_baru;
            }

            if ($this->Model_user->update_user($id, $update_data)) {
                $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data.');
            }
            redirect('admin/user');
        }
    }

    /**
     * Menghapus pengguna
     */
    public function hapus($id)
    {
        $user_data = $this->Model_user->get_user_by_id($id);
        if (!$user_data) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('user');
        }

        // Keamanan: Cegah menghapus diri sendiri yang sedang login
        if ($user_data->username === $this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda tidak diperbolehkan menghapus akun Anda sendiri.');
            redirect('user');
        }

        if ($this->Model_user->delete_user($id)) {
            $this->session->set_flashdata('success', 'Akun ' . $user_data->nama . ' telah berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('admin/user');
    }
}