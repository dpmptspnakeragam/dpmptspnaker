<?php
class Login extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
    }

    public function index()
    {
        // $this->load->model('Model_alumni_lpks');
        // $data ['alumnilpk'] = $this->Model_alumni_lpks->tampil_data();
        $this->load->view('templates/login_header');
        $this->load->view('login');
        $this->load->view('templates/login_footer');
    }

    public function cek_login()
    {
        $this->form_validation->set_rules('usrname', 'Username', 'required', [
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
            $data = array(
                'username' => $this->input->post('usrname', TRUE),
                'password' => $this->input->post('pssword', TRUE)
            );

            $hasil = $this->Model_user->cek_user($data);

            // Cek apakah username dan password cocok di database
            if ($hasil->num_rows() == 1) {
                // Ambil data user dari database
                $user_data = $hasil->row();
                $user_login = $user_data->username;

                // 1. CEK HAK AKSES DULU (Sebelum set userdata)
                if ($user_login == 'agamdpmptsp') {
                    $url_tujuan = 'admin/home';
                } elseif ($user_login == 'pengaduan') {
                    $url_tujuan = 'admin/pengaduan';
                } elseif ($user_login == 'asetdpmptspagam') {
                    $url_tujuan = 'admin/aset';
                } else {
                    // JIKA TIDAK PUNYA AKSES: Langsung buat pesan dan kembalikan ke form login
                    $this->session->set_flashdata('pesan', 'Maaf, akun Anda terdaftar namun <b>tidak memiliki hak akses</b> ke halaman ini.');
                    redirect('login');
                    return; // Menghentikan eksekusi agar tidak lanjut membuat sesi di bawah
                }

                // 2. JIKA PUNYA AKSES: Baru kita set session login-nya
                $sess_data['id'] = $user_data->id;
                $sess_data['nama'] = $user_data->nama;
                $sess_data['username'] = $user_data->username;
                $sess_data['online'] = $user_data->online;
                $sess_data['logged_in_utama'] = TRUE;

                $this->session->set_userdata($sess_data);
                $this->Model_user->update_online_status($user_data->id, 1);

                // 3. Arahkan ke halaman sesuai hak akses
                redirect($url_tujuan);
            } else {
                // JIKA USERNAME TIDAK DITEMUKAN DI DATABASE ATAU PASSWORD SALAH
                $this->session->set_flashdata('pesan', 'Maaf, Username <b>tidak terdaftar</b> atau Password anda <b>Salah</b>.');
                redirect('login');
            }
        }
    }
}
