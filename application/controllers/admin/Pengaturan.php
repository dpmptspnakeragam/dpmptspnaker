<?php
class Pengaturan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
    }

    public function index()
    {
        $this->load->model('Model_pengaturan');
        $data['pengaturan'] = $this->Model_pengaturan->tampil_data();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('edit/edit_pengaturan', $data);
        $this->load->view('templates/footer_admin');
    }

    public function ubah()
    {
        $id_setting = $this->input->post('id', true);
        $sejarah = $this->input->post('sejarah', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);
        $tugas = $this->input->post('tugas', true);
        $fungsi = $this->input->post('fungsi', true);
        $struktur = $_FILES['struktur']['name'];
        $maklumat = $_FILES['maklumat']['name'];

        if (empty($_FILES['struktur']['name'])) {
            $struktur = $this->input->post('old1', true);
        } else {
            $nmfile = "struktur-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('struktur')) {
                $struktur = $this->upload->data('file_name');
            }
        }

        if (empty($_FILES['maklumat']['name'])) {
            $maklumat = $this->input->post('old2', true);
        } else {
            $nmfile = "maklumat-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('maklumat')) {
                $maklumat = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_setting' => $id_setting,
            'sejarah' => $sejarah,
            'visi' => $visi,
            'misi' => $misi,
            'tugas' => $tugas,
            'fungsi' => $fungsi,
            'struktur' => $struktur,
            'maklumat' => $maklumat
        );
        $this->load->model('Model_pengaturan');
        $this->Model_pengaturan->update($data, $id_setting);
        $this->session->set_flashdata("berhasil", "Ubah data Pengaturan berhasil !");
        redirect('admin/pengaturan');
    }
}
