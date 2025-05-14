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
        //$this->load->model('Model_alumni_lpks');
        //$data ['alumnilpk'] = $this->Model_alumni_lpks->tampil_data();
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

            if ($hasil->num_rows() == 1) {
                foreach ($hasil->result() as $sess) {
                    $sess_data['id'] = $sess->id;
                    $sess_data['nama'] = $sess->nama;
                    $sess_data['username'] = $sess->username;
                    $sess_data['online'] = $sess->online;
                    $sess_data['logged_in'] = TRUE;

                    $this->session->set_userdata($sess_data);

                    $this->Model_user->update_online_status($sess->id, 1);
                }

                if ($this->session->userdata('username') == 'agamdpmptsp') {
                    redirect('admin/home');
                } elseif ($this->session->userdata('username') == 'pengaduan') {
                    redirect('admin/pengaduan');
                } elseif ($this->session->userdata('username') == 'asetdpmptspagam') {
                    redirect('admin/aset');
                } elseif ($this->session->userdata('username') == 'reklameagam') {
                    redirect('admin/reklame');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Maaf, Username atau Password anda <b>Salah</b>');
                redirect('login');
            }
        }
    }
}
