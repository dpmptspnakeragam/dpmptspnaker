<?php
class Banner extends CI_controller
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
        $this->load->model('Model_banner');
        $data['banner'] = $this->Model_banner->tampil_data();
        $data['idmax'] = $this->Model_banner->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/banner', $data);
        $this->load->view('modal/modal_tambah_banner', $data);
        $this->load->view('edit/edit_banner', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_banner = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $gambar = $_FILES['gambar']['name'];

        if ($gambar = '') {
        } else {
            $nmfile = "banner-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_banner' => $id_banner,
            'teks' => $teks,
            'gambar' => $gambar
        );
        $this->load->model('Model_banner');
        $this->Model_banner->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data Banner berhasil !");
        redirect('admin/banner');
    }

    public function ubah()
    {
        $id_banner = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $old_image = $this->input->post('old', true);

        // Jika ada gambar baru diunggah
        if (!empty($_FILES['gambar']['name'])) {
            $nmfile = "banner-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if ($old_image) {
                    $path = './assets/imgupload/' . $old_image;
                    if (file_exists($path)) {
                        unlink($path); // Menghapus gambar lama dari folder
                    }
                }
                $gambar = $this->upload->data('file_name');
            } else {
                $gambar = $old_image; // Gunakan gambar lama jika upload gagal
            }
        } else {
            $gambar = $old_image; // Gunakan gambar lama jika tidak ada gambar baru
        }

        $data = array(
            'id_banner' => $id_banner,
            'teks' => $teks,
            'gambar' => $gambar
        );
        $this->load->model('Model_banner');
        $this->Model_banner->update($data, $id_banner);
        $this->session->set_flashdata("berhasil", "Ubah data Banner berhasil !");
        redirect('admin/banner');
    }

    public function hapus($id_banner)
    {
        $this->db->where('id_banner', $id_banner);
        $query = $this->db->get('banner');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $this->load->model('Model_banner');
        $this->Model_banner->delete($id_banner);
        $this->session->set_flashdata("gagal", "Hapus data Banner berhasil !");

        redirect('admin/banner');
    }
}
