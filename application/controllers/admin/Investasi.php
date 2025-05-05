<?php
class Investasi extends CI_controller
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
        $this->load->model('Model_investasi');
        $data['investasi'] = $this->Model_investasi->tampil_data();
        $data['idmax'] = $this->Model_investasi->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/investasi', $data);
        $this->load->view('modal/modal_tambah_investasi', $data);
        $this->load->view('edit/edit_investasi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_investasi = $this->input->post('id', true);
        $nama_investasi = $this->input->post('nama_investasi', true);
        $gambar = $_FILES['gambar']['name'];
        $deskripsi = $this->input->post('deskripsi', true);

        if ($gambar = '') {
        } else {
            $nmfile = "investasi-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_investasi' => $id_investasi,
            'nama_investasi' => $nama_investasi,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
        );
        $this->load->model('Model_investasi');
        $this->Model_investasi->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$nama_investasi</b> berhasil !");
        redirect('admin/investasi');
    }

    public function ubah()
    {
        $id_investasi = $this->input->post('id', true);
        $nama_investasi = $this->input->post('nama_investasi', true);
        $gambar = $_FILES['gambar']['name'];
        $deskripsi = $this->input->post('deskripsi', true);

        if (empty($_FILES['gambar']['name'])) {
            $gambar = $this->input->post('old', true);
        } else {
            $nmfile = "investasi-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_investasi' => $id_investasi,
            'nama_investasi' => $nama_investasi,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
        );
        $this->load->model('Model_investasi');
        $this->Model_investasi->update($data, $id_investasi);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama_investasi</b> berhasil !");
        redirect('admin/investasi');
    }

    public function hapus($id_investasi)
    {
        $this->db->where('id_investasi', $id_investasi);
        $query = $this->db->get('peluang_investasi');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $this->load->model('Model_investasi');
        $this->Model_investasi->delete($id_investasi);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->nama_investasi</b> berhasil !");

        redirect('admin/investasi');
    }
}
