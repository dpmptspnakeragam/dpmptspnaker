<?php
class Potensi_investasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_potensi_investasi');
    }

    public function index()
    {
        $data['potensi_investasi'] = $this->Model_potensi_investasi->tampil_data();
        $data['idmax'] = $this->Model_potensi_investasi->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Potensi Investasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/potensi_investasi', $data, FALSE);
        $this->load->view('modal/modal_tambah_potensi_investasi', $data, FALSE);
        $this->load->view('edit/edit_potensi_investasi', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_investasi = $this->input->post('id', true);
        $nama_investasi = $this->input->post('nama_investasi', true);
        $gambar = $_FILES['gambar']['name'];
        $deskripsi = $this->input->post('deskripsi', true);

        if ($gambar = '') {
        } else {
            $nmfile = "potensi-investasi-" . time();
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

        $result = $this->Model_potensi_investasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Potensi Investasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/potensi_investasi', 'refresh');
    }

    public function edit()
    {
        $id_investasi = $this->input->post('id', true);
        $nama_investasi = $this->input->post('nama_investasi', true);
        $deskripsi = $this->input->post('deskripsi', true);
        $old_gambar = $this->input->post('old', true);
        $gambar = $old_gambar; // Default to old image

        // Proses penggantian gambar jika ada file baru
        if (!empty($_FILES['gambar']['name'])) {
            $nmfile = "potensi-investasi-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if (!empty($old_gambar) && file_exists('./assets/imgupload/' . $old_gambar)) {
                    unlink('./assets/imgupload/' . $old_gambar);
                }

                // Gunakan nama file gambar baru
                $gambar = $this->upload->data('file_name');
            } else {
                // Jika gagal upload, tetap gunakan gambar lama
                $this->session->set_flashdata('error', 'Gagal mengunggah gambar baru. Pastikan format file sesuai.');
                redirect('admin/peluang_investasi', 'refresh');
            }
        }

        $data = array(
            'id_investasi' => $id_investasi,
            'nama_investasi' => $nama_investasi,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
        );

        $result = $this->Model_potensi_investasi->update($data, $id_investasi);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Potensi Investasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/potensi_investasi', 'refresh');
    }

    public function hapus($id_investasi)
    {
        $this->db->where('id_investasi', $id_investasi);
        $query = $this->db->get('potensi_investasi');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");


        $result = $this->Model_potensi_investasi->delete($id_investasi);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Potensi Investasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/potensi_investasi', 'refresh');
    }
}
