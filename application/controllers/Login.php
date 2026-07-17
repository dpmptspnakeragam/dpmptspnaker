<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
    }
    public function index()
    {
        $this->load->view('templates/login_header');
        $this->load->view('login');
        $this->load->view('templates/login_footer');
    }
    public function cek_login()
    {
        $this->form_validation->set_rules('usrname', 'Username', 'required|trim', [
            'required' => 'Kolom %s wajib diisi.'
        ]);
        $this->form_validation->set_rules('pssword', 'Password', 'required', [
            'required' => 'Kolom %s wajib diisi.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/login_header');
            $this->load->view('login');
            $this->load->view('templates/login_footer');
        } else {
            $username = $this->input->post('usrname', TRUE);
            $password = $this->input->post('pssword');
            $user_data = $this->Model_user->login_secure($username, $password);
            if ($user_data !== FALSE) {
                $user_login = $user_data->username;
                if ($user_login == 'agamdpmptsp') {
                    $url_tujuan = 'admin/home';
                } elseif ($user_login == 'pengaduan') {
                    $url_tujuan = 'admin/pengaduan';
                } elseif ($user_login == 'asetdpmptspagam') {
                    $url_tujuan = 'admin/aset';
                } else {
                    $this->session->set_flashdata('error', 'Maaf, akun Anda terdaftar namun <b>tidak memiliki hak akses</b> ke halaman ini.');
                    redirect('login');
                    return;
                }
                $sess_data = [
                    'id' => $user_data->id,
                    'nama' => $user_data->nama,
                    'username' => $user_data->username,
                    'role' => $user_data->role,
                    'online' => 1,
                    'logged_in_utama' => TRUE
                ];
                $this->session->set_userdata($sess_data);
                $this->Model_user->update_online_status($user_data->id, 1);
                $this->session->set_flashdata('success', 'Login berhasil.');
                redirect($url_tujuan);
            } else {
                $this->session->set_flashdata('error', 'Maaf, Username <b>tidak terdaftar</b> atau Password Anda <b>Salah</b>.');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $id_user = $this->session->userdata('id');
        if (!empty($id_user)) {
            $this->Model_user->update_online_status($id_user, 0);
        }
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Anda telah <b>berhasil keluar</b> dari sistem.');
        redirect('login');
    }
}