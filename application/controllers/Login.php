<?php
class Login extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$this->load->model('Model_alumni_lpks');
        //$data ['alumnilpk'] = $this->Model_alumni_lpks->tampil_data();
        $this->load->view('templates/header');
        $this->load->view('login');
    }

    public function cek_login()
    {
        $this->form_validation->set_rules('usrname', 'Username', 'required');
        $this->form_validation->set_rules('pssword', 'Password', 'required');
        if ($this->form_validation->run()  == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('login');
            $this->load->view('templates/footer_admin');
        } else {
            $data = array(
                'username' => $this->input->post('usrname', TRUE),

                'password' => $this->input->post('pssword', TRUE)
            );

            $this->load->model('Model_user'); // load model_user
            $hasil = $this->Model_user->cek_user($data);

            if ($hasil->num_rows() == 1) {
                foreach ($hasil->result() as $sess) {
                    $sess_data['logged_in'] = TRUE;
                    $sess_data['nama'] = $sess->nama;
                    $sess_data['username'] = $sess->username;

                    $this->session->set_userdata($sess_data);
                }
                if ($this->session->userdata('username') == 'agamdpmptspnaker') {
                    redirect('admin/home');
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
