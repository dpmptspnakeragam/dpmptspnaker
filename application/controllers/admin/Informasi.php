<?php
class Informasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_informasi');
    }

    public function index()
    {
        $data['informasi'] = $this->Model_informasi->tampil_data();
        $data['idmax'] = $this->Model_informasi->idmax();
        $data['kategori'] = $this->Model_informasi->kategori();
        $data['home'] = 'Home';
        $data['title'] = 'Informasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/informasi', $data, FALSE);
        $this->load->view('modal/edit/informasi', $data, FALSE);
        $this->load->view('modal/hapus/informasi', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_berita = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita = $this->input->post('tgl_berita', true);
        $gambar = $_FILES['gambar']['name'];
        // $rangkuman = $this->input->post('rangkuman', true);
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
            'rangkuman' => $judul_berita,
            'isi_berita' => $isi_berita,
            'tgl_berita' => $tgl_berita,
            'gambar' => $gambar
        );

        $result = $this->Model_informasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/informasi', 'refresh');
    }

    public function edit()
    {
        $id_berita = $this->input->post('id', true);
        $judul_berita = $this->input->post('judul_berita', true);
        $tgl_berita = $this->input->post('tgl_berita', true);
        // $rangkuman = $this->input->post('rangkuman', true);
        $isi_berita = $this->input->post('isi_berita', true);
        $id_kategori = $this->input->post('id_kategori', true);
        $gambar_lama = $this->input->post('old', true); // Gambar lama yang disimpan sebelumnya

        // Periksa apakah ada gambar baru yang diunggah
        if (!empty($_FILES['gambar']['name'])) {
            $nmfile = "berita-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar_baru = $this->upload->data('file_name');

                // Hapus gambar lama jika ada gambar baru
                if (file_exists('./assets/imgupload/' . $gambar_lama) && $gambar_lama != '') {
                    unlink('./assets/imgupload/' . $gambar_lama);
                }
            } else {
                // Jika upload gagal, tetap gunakan gambar lama
                $gambar_baru = $gambar_lama;
            }
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $gambar_baru = $gambar_lama;
        }

        // Data yang akan diperbarui
        $data = array(
            'id_kategori' => $id_kategori,
            'judul_berita' => $judul_berita,
            'rangkuman' => $judul_berita,
            'isi_berita' => $isi_berita,
            'tgl_berita' => $tgl_berita,
            'gambar' => $gambar_baru
        );

        // Update data ke database
        $result = $this->Model_informasi->update($data, $id_berita);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/informasi', 'refresh');
    }


    public function hapus($id_berita)
    {
        $this->db->where('id_berita', $id_berita);
        $query = $this->db->get('berita');
        $row = $query->row();

        if ($row && !empty($row->gambar)) {
            $file_path = "./assets/imgupload/" . $row->gambar;

            // Cek apakah file benar-benar ada dan bukan direktori
            if (file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
        }

        $result = $this->Model_informasi->delete($id_berita);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Informasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/informasi', 'refresh');
    }
}
