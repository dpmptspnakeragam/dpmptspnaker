<?php
class Informasi extends CI_controller
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
        $this->load->model('Model_informasi');
        $data['berita'] = $this->Model_informasi->tampil_data();
        $data['idmax'] = $this->Model_informasi->idmax();
        $data['kategori'] = $this->Model_informasi->kategori();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/informasi', $data);
        $this->load->view('modal/modal_tambah_berita', $data);
        $this->load->view('edit/edit_informasi', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_berita = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita = $this->input->post('tgl_berita', true);
        $gambar = $_FILES['gambar']['name'];
        $rangkuman = $this->input->post('rangkuman', true);
        $isi_berita = $this->input->post('isi_berita', true);
        $id_kategori = $this->input->post('id_kategori', true);

        if ($gambar = '') {
        } else {
            $nmfile = "berita-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_berita' => $id_berita,
            'id_kategori' => $id_kategori,
            'judul_berita' => $judul_berita,
            'rangkuman' => $rangkuman,
            'isi_berita' => $isi_berita,
            'tgl_berita' => $tgl_berita,
            'gambar' => $gambar
        );
        $this->load->model('Model_informasi');
        $this->Model_informasi->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$judul_berita</b> berhasil !");
        redirect('admin/informasi');
    }

    public function ubah()
    {
        $id_berita = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita = $this->input->post('tgl_berita', true);
        $gambar = $_FILES['gambar']['name'];
        $rangkuman = $this->input->post('rangkuman', true);
        $isi_berita = $this->input->post('isi_berita', true);
        $id_kategori = $this->input->post('id_kategori', true);

        if (empty($_FILES['gambar']['name'])) {
            $gambar = $this->input->post('old', true);
        } else {
            $nmfile = "berita-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_berita' => $id_berita,
            'id_kategori' => $id_kategori,
            'judul_berita' => $judul_berita,
            'rangkuman' => $rangkuman,
            'isi_berita' => $isi_berita,
            'tgl_berita' => $tgl_berita,
            'gambar' => $gambar
        );
        $this->load->model('Model_informasi');
        $this->Model_informasi->update($data, $id_berita);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$judul_berita</b> berhasil !");
        redirect('admin/informasi');
    }

    public function hapus($id_berita)
    {
        $this->db->where('id_berita', $id_berita);
        $query = $this->db->get('berita');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $this->load->model('Model_informasi');
        $this->Model_informasi->delete($id_berita);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->judul_berita</b> berhasil !");

        redirect('admin/informasi');
    }
}
