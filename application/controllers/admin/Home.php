<?php
class Home extends Admin_Utama_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'DPMPTSP Kab. Agam';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/home', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function logout()
    {
        $id = $this->session->userdata('id');
        if ($id) {
            $this->Model_user->update_online_status($id, 0);
        }

        // PERBAIKAN: Gunakan unset_userdata, JANGAN sess_destroy()
        $this->session->unset_userdata('logged_in_utama');

        // Opsional: Anda bisa tambahkan pesan flashdata jika mau
        // $this->session->set_flashdata('pesan', 'Anda berhasil logout dari Web Utama.');

        redirect('login');
    }
}
