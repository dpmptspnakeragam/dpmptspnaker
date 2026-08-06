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
        // KEAMANAN & UX: Cegah user yang sudah login untuk mengakses halaman login lagi
        if ($this->session->userdata('logged_in_utama') === TRUE) {
            $role_user = $this->session->userdata('role');
            $divisi_user = $this->session->userdata('divisi'); // Ambil juga divisinya dari session

            // Pass kedua variabel ke helper redirect
            $this->_redirect_based_on_role($role_user, $divisi_user);
            return; // Hentikan eksekusi index() agar view login tidak dimuat
        }

        $this->load->view('templates/login_header');
        $this->load->view('login');
        $this->load->view('templates/login_footer');
    }

    public function cek_login()
    {
        // 1. Validasi Input (Mencegah input kosong atau spasi doang)
        $this->form_validation->set_rules('usrname', 'Username', 'required|trim', [
            'required' => 'Kolom %s wajib diisi.'
        ]);
        $this->form_validation->set_rules('pssword', 'Password', 'required', [
            'required' => 'Kolom %s wajib diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Validasi gagal, kembalikan ke form login
            $this->load->view('templates/login_header');
            $this->load->view('login');
            $this->load->view('templates/login_footer');
        } else {
            // 2. Ambil Input (Gunakan TRUE pada username untuk XSS Filtering)
            // Catatan Keamanan: Jangan gunakan TRUE pada password agar karakter khusus (seperti < atau >) tidak rusak
            $username = $this->input->post('usrname', TRUE);
            $password = $this->input->post('pssword');

            // 3. Proses Login di Model (Asumsi model menggunakan db->get_where dan password_verify)
            $user_data = $this->Model_user->login_secure($username, $password);

            if ($user_data !== FALSE) {

                // 4. MENGGUNAKAN ROLE DAN DIVISI
                $user_role = $user_data->role;
                $user_divisi = isset($user_data->divisi) ? $user_data->divisi : '';

                // Dapatkan URL tujuan berdasarkan Role dan Divisi-nya
                $url_tujuan = $this->_get_redirect_url($user_role, $user_divisi);

                // Jika role tidak dikenali (mencegah bypass jika ada user dengan role 'Aneh')
                if (!$url_tujuan) {
                    $this->session->set_flashdata('error', 'Maaf, akun Anda terdaftar namun <b>tidak memiliki hak akses</b> yang valid.');
                    redirect('login');
                    return;
                }

                // 5. Set Data Sesi (Pastikan divisi masuk ke session agar bisa dibaca di seluruh aplikasi)
                $sess_data = [
                    'id'              => $user_data->id,
                    'nama'            => $user_data->nama,
                    'username'        => $user_data->username,
                    'role'            => $user_role,
                    'divisi'          => $user_divisi,
                    'online'          => 1,
                    'logged_in_utama' => TRUE
                ];
                $this->session->set_userdata($sess_data);

                // Update status online
                $this->Model_user->update_online_status($user_data->id, 1);

                $this->session->set_flashdata('success', 'Login berhasil.');

                // 6. Redirect ke halaman yang sesuai dengan Role-nya
                redirect($url_tujuan);
            } else {
                // Login gagal (Pesan error dibuat umum agar attacker tidak tahu username benar tapi password salah)
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

        // Keamanan: Hancurkan seluruh sesi
        $this->session->sess_destroy();

        // redirect('login');
        redirect('login');
    }

    /**
     * PRIVATE HELPER: Menentukan URL tujuan berdasarkan ROLE & DIVISI
     * Ini membuat kode utama lebih bersih dan mudah dikelola jika nanti ada role baru.
     */
    private function _get_redirect_url($role, $divisi = '')
    {
        // 1. Jika dia Administrator Utama
        if ($role === 'Administrator') {
            return 'admin/home';
        }

        // 2. Jika dia User, arahkan berdasarkan Divisinya
        elseif ($role === 'User') {
            switch ($divisi) {
                case 'Konsultasi':
                    return 'admin/konsultasi';
                case 'Pengaduan':
                    return 'admin/pengaduan';
                case 'Aset':
                    return 'admin/aset';
                default:
                    // Jika user tapi divisinya kosong (belum diset admin)
                    return 'admin/home';
            }
        }

        // 3. Jika role tidak valid / disabotase
        return false;
    }

    /**
     * PRIVATE HELPER: Mengeksekusi redirect (digunakan oleh index jika user sudah login)
     */
    private function _redirect_based_on_role($role, $divisi = '')
    {
        $url_tujuan = $this->_get_redirect_url($role, $divisi);
        if ($url_tujuan) {
            redirect($url_tujuan);
        } else {
            // Jika role rusak di sesi, paksa logout
            redirect('login/logout');
        }
    }
}
