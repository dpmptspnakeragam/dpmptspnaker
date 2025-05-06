<?php
class Banner extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_banner');
    }

    public function index()
    {
        $data['banner'] = $this->Model_banner->tampil_data();
        $data['idmax'] = $this->Model_banner->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Banner';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/banner', $data, FALSE);
        $this->load->view('modal/modal_tambah_banner', $data, FALSE);
        $this->load->view('edit/edit_banner', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_banner = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $gambar_baru = $_FILES['gambar']['name'];

        if (!empty($gambar_baru)) {
            // Generate nama file baru
            $nmfile = "banner-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal: ' . strip_tags($this->upload->display_errors()));
                redirect('admin/banner', 'refresh');
            }
        } else {
            $gambar = null; // Default jika tidak ada gambar
        }

        $data = array(
            'id_banner' => $id_banner,
            'teks' => $teks,
            'gambar' => $gambar
        );

        $result = $this->Model_banner->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Banner berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silakan coba lagi.');
        }

        redirect('admin/banner', 'refresh');
    }

    public function edit()
    {
        $id_banner = $this->input->post('id_banner', true);
        $teks = $this->input->post('teks', true);
        $gambar_baru = $_FILES['gambar']['name'];
        $gambar_lama = $this->input->post('old', true);

        if (!empty($gambar_baru)) {
            // Generate nama file baru
            $nmfile = "banner-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name']; // Nama file baru

                // Hapus gambar lama jika ada
                if (!empty($gambar_lama) && file_exists('./assets/imgupload/' . $gambar_lama)) {
                    unlink('./assets/imgupload/' . $gambar_lama);
                }
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal: ' . strip_tags($this->upload->display_errors()));
                redirect('admin/banner', 'refresh');
            }
        } else {
            $gambar = $gambar_lama; // Gunakan gambar lama jika tidak ada upload baru
        }

        // Data yang akan diupdate
        $data = array(
            'id_banner' => $id_banner,
            'teks' => $teks,
            'gambar' => $gambar
        );

        $result = $this->Model_banner->update($data, $id_banner);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Banner berhasil diperbarui.');
        } else {
            log_message('error', 'Gagal memperbarui banner: ' . json_encode($data));
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/banner', 'refresh');
    }

    public function hapus($id_banner)
    {
        $this->db->where('id_banner', $id_banner);
        $query = $this->db->get('banner');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $result = $this->Model_banner->delete($id_banner);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Banner berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/banner', 'refresh');
    }
}
