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
            $this->_redirect_based_on_role($role_user);
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

                // 4. MENGGUNAKAN ROLE (Sesuai Permintaan)
                $user_role = $user_data->role;

                // Dapatkan URL tujuan berdasarkan Role
                $url_tujuan = $this->_get_redirect_url($user_role);

                // Jika role tidak dikenali (mencegah bypass jika ada user dengan role 'Aneh')
                if (!$url_tujuan) {
                    $this->session->set_flashdata('error', 'Maaf, akun Anda terdaftar namun <b>tidak memiliki hak akses</b> yang valid.');
                    redirect('login');
                    return;
                }

                // 5. Set Data Sesi (Jangan simpan password di sesi)
                $sess_data = [
                    'id'              => $user_data->id,
                    'nama'            => $user_data->nama,
                    'username'        => $user_data->username,
                    'role'            => $user_role,
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

        // Catatan: Karena sess_destroy() menghapus SEMUA sesi, termasuk flashdata yang baru diset.
        // Jika ingin flashdata 'success' logout tetap tampil, jangan pakai sess_destroy, 
        // melainkan unset_userdata spesifik seperti ini:

        // $data_sesi = ['id', 'nama', 'username', 'role', 'online', 'logged_in_utama'];
        // $this->session->unset_userdata($data_sesi);
        // $this->session->set_flashdata('success', 'Anda telah <b>berhasil keluar</b> dari sistem.');

        redirect('login');
    }

    /**
     * PRIVATE HELPER: Menentukan URL tujuan berdasarkan ROLE
     * Ini membuat kode utama lebih bersih dan mudah dikelola jika nanti ada role baru.
     */
    private function _get_redirect_url($role)
    {
        // Pastikan case (huruf besar/kecil) sesuai dengan isi tabel database Anda
        switch ($role) {
            case 'Administrator':
                return 'admin/home';
            case 'Pengaduan':
                return 'admin/home'; // Atau ubah ke 'admin/pengaduan' jika ingin langsung ke sana
            case 'Aset':
                return 'admin/home'; // Atau ubah ke 'admin/aset' jika ingin langsung ke sana
            default:
                return false; // Role tidak dikenali = Tolak akses
        }
    }

    /**
     * PRIVATE HELPER: Mengeksekusi redirect (digunakan oleh index jika user sudah login)
     */
    private function _redirect_based_on_role($role)
    {
        $url_tujuan = $this->_get_redirect_url($role);
        if ($url_tujuan) {
            redirect($url_tujuan);
        } else {
            // Jika role rusak di sesi, paksa logout
            redirect('login/logout');
        }
    }
}
