<?php
class Login_reklame extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
    }

    public function index()
    {
        $this->load->view('templates/login_header');
        $this->load->view('login_reklame');
        $this->load->view('templates/login_footer');
    }

    public function cek_login_reklame()
    {
        $this->form_validation->set_rules('usrname', 'Username', 'required', [
            'required' => 'Kolom %s wajib diisi.'
        ]);
        $this->form_validation->set_rules('pssword', 'Password', 'required', [
            'required' => 'Kolom %s wajib diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/login_header');
            $this->load->view('login_reklame');
            $this->load->view('templates/login_footer');
        } else {
            $input_username = $this->input->post('usrname', TRUE);
            $input_password = $this->input->post('pssword', TRUE);

            // 1. Menggunakan fungsi model baru khusus tabel user_reklame
            $hasil = $this->Model_user->cek_user_reklame($input_username, $input_password);

            if ($hasil->num_rows() == 1) {
                // Ambil data user
                $user_data = $hasil->row();

                // 2. Set Session khusus Reklame (Tambahkan akhiran _reklame agar aman)
                $sess_data['id_reklame'] = $user_data->id;
                $sess_data['nama_reklame'] = $user_data->nama;
                $sess_data['username_reklame'] = $user_data->username;
                $sess_data['role_reklame'] = $user_data->role;
                $sess_data['online_reklame'] = $user_data->online;
                $sess_data['logged_in_reklame'] = TRUE;

                $this->session->set_userdata($sess_data);

                // 3. Update status online menggunakan fungsi model yang baru
                $this->Model_user->update_online_status_reklame($user_data->id, 1);

                // 4. Arahkan otomatis berdasarkan Role
                if ($user_data->role == 'admin') {
                    redirect('dashboard');
                } elseif ($user_data->role == 'satpolpp') {
                    redirect('reklame/satpolpp/dashboard'); // Sesuaikan dengan folder/rute SATPOL PP

                } elseif ($user_data->role == 'bapenda') {
                    redirect('reklame/bapenda/dashboard'); // Sesuaikan dengan folder/rute BAPENDA

                } else {
                    redirect('reklame'); // Rute default jika role tidak dikenali
                }
            } else {
                $this->session->set_flashdata('pesan', 'Maaf, Username atau Password anda <b>Salah</b>');
                redirect('reklame');
            }
        }
    }

    public function logout()
    {
        // 5. Pastikan memanggil ID dari session yang benar (id_reklame)
        $id = $this->session->userdata('id_reklame');
        if ($id) {
            $this->Model_user->update_online_status_reklame($id, 0);
        }

        // 6. Hapus hanya array session milik reklame
        $hapus_session = ['id_reklame', 'nama_reklame', 'username_reklame', 'role_reklame', 'online_reklame', 'logged_in_reklame'];
        $this->session->unset_userdata($hapus_session);

        $this->session->set_flashdata('pesan', 'Anda berhasil logout dari SIREKAM.');
        redirect('login_reklame');
    }
}
