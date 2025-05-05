<?php
class Kadis extends CI_controller
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
        $this->load->model('Model_kadis');
        $data['kadis'] = $this->Model_kadis->tampil_kadis();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/kadis', $data);
        $this->load->view('modal/modal_tambah_kadis', $data);
        $this->load->view('edit/edit_kadis', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_kadis = $this->input->post('id_kadis', true);
        $nama = $this->input->post('nama', true);
        $foto = $_FILES['foto']['name'];
        $periode = $this->input->post('periode', true);

        if ($foto = '') {
        } else {
            $nmfile = "kadis-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_kadis' => $id_kadis,
            'nama' => $nama,
            'periode' => $periode,
            'foto' => $foto
        );
        $this->load->model('Model_kadis');
        $this->Model_kadis->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$nama</b> berhasil !");
        redirect('admin/kadis');
    }

    public function edit()
    {
        $id_kadis = $this->input->post('id_kadis', true);
        $nama = $this->input->post('nama', true);
        $foto = $_FILES['foto']['name'];
        $periode = $this->input->post('periode', true);

        if (empty($_FILES['foto']['name'])) {
            $foto = $this->input->post('old', true);
        } else {
            $nmfile = "kadis-" . $nama;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
                $fotolama = $this->input->post('old', true);
                unlink("./assets/imgupload/" . $fotolama);
            }
        }
        $data = array(
            'id_kadis' => $id_kadis,
            'nama' => $nama,
            'periode' => $periode,
            'foto' => $foto
        );
        $this->load->model('Model_kadis');
        $this->Model_kadis->update($data, $id_kadis);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama</b> berhasil !");
        redirect('admin/kadis');
    }

    public function hapus($id_kadis)
    {
        $this->db->where('id_kadis', $id_kadis);
        $query = $this->db->get('kadis');
        $row = $query->row();

        unlink("./assets/imgupload/$row->foto");

        $this->load->model('Model_kadis');
        $this->Model_kadis->delete($id_kadis);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->nama</b> berhasil !");

        redirect('admin/kadis');
    }
}
