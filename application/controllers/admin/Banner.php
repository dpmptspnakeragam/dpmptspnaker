<?php
class Banner extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role_user = $this->session->userdata('role');

        if ($role_user !== 'Administrator') {
            redirect('admin/home');
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
        $teks      = $this->input->post('teks', true);

        $gambar = "";

        // =========================
        // CEK UPLOAD GAMBAR
        // =========================
        if (!empty($_FILES['gambar']['name'])) {

            $nmfile = "banner-" . time();

            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;
            $config['overwrite']     = false;

            // =========================
            // LOAD / INITIALIZE UPLOAD
            // =========================
            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            // =========================
            // PROSES UPLOAD
            // =========================
            if ($this->upload->do_upload('gambar')) {

                $gambar = $this->upload->data('file_name');
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Upload foto gagal: ' .
                        $this->upload->display_errors('', '')
                );

                redirect('admin/banner', 'refresh');
                return;
            }
        }

        // =========================
        // DATA BANNER
        // =========================
        $data = array(
            'id_banner' => $id_banner,
            'teks'      => $teks,
            'gambar'    => $gambar
        );

        // =========================
        // SIMPAN DATABASE
        // =========================
        $result = $this->Model_banner->input($data);

        if ($result) {

            $this->session->set_flashdata(
                'success',
                'Data Banner berhasil disimpan.'
            );
        } else {

            // Jika database gagal, hapus file yang
            // sudah berhasil diupload
            if (!empty($gambar)) {

                $file_gambar = FCPATH . 'assets/imgupload/' . $gambar;

                if (file_exists($file_gambar)) {
                    unlink($file_gambar);
                }
            }

            $this->session->set_flashdata(
                'error',
                'Penyimpanan data gagal. Silahkan coba lagi.'
            );
        }

        redirect('admin/banner', 'refresh');
    }

    public function edit()
    {
        $id_banner   = $this->input->post('id_banner', true);
        $teks        = $this->input->post('teks', true);
        $gambar_lama = $this->input->post('old', true);

        $gambar = $gambar_lama;

        // =========================
        // CEK GAMBAR BARU
        // =========================
        if (!empty($_FILES['gambar']['name'])) {

            $nmfile = "banner-" . time();

            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;
            $config['overwrite']     = false;

            // =========================
            // LOAD / INITIALIZE UPLOAD
            // =========================
            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            // =========================
            // UPLOAD GAMBAR BARU
            // =========================
            if ($this->upload->do_upload('gambar')) {

                $upload_data = $this->upload->data();

                $gambar = $upload_data['file_name'];

                // =========================
                // HAPUS GAMBAR LAMA
                // =========================
                if (!empty($gambar_lama)) {

                    $file_lama = FCPATH . 'assets/imgupload/' . $gambar_lama;

                    if (file_exists($file_lama)) {
                        unlink($file_lama);
                    }
                }
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Upload foto gagal: ' .
                        $this->upload->display_errors('', '')
                );

                redirect('admin/banner', 'refresh');
                return;
            }
        }

        // =========================
        // DATA UPDATE
        // =========================
        $data = array(
            'id_banner' => $id_banner,
            'teks'      => $teks,
            'gambar'    => $gambar
        );

        // =========================
        // UPDATE DATABASE
        // =========================
        $result = $this->Model_banner->update($data, $id_banner);

        if ($result) {

            $this->session->set_flashdata(
                'success',
                'Data Banner berhasil diperbarui.'
            );
        } else {

            $this->session->set_flashdata(
                'error',
                'Perbarui data gagal. Silahkan coba lagi.'
            );

            log_message(
                'error',
                'Gagal update banner: ' . json_encode($data)
            );
        }

        redirect('admin/banner', 'refresh');
    }

    public function hapus($id_banner)
    {
        // =========================
        // AMBIL DATA BANNER
        // =========================
        $this->db->where('id_banner', $id_banner);
        $query = $this->db->get('banner');
        $row   = $query->row();

        // =========================
        // CEK DATA
        // =========================
        if ($row) {

            // =========================
            // HAPUS FILE GAMBAR
            // =========================
            if (!empty($row->gambar)) {

                $file_gambar = FCPATH . 'assets/imgupload/' . $row->gambar;

                if (file_exists($file_gambar)) {
                    unlink($file_gambar);
                }
            }

            // =========================
            // HAPUS DATA DATABASE
            // =========================
            $result = $this->Model_banner->delete($id_banner);

            if ($result) {

                $this->session->set_flashdata(
                    'success',
                    'Data Banner berhasil dihapus.'
                );
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Penghapusan data gagal. Silahkan coba lagi.'
                );
            }
        } else {

            $this->session->set_flashdata(
                'error',
                'Data Banner tidak ditemukan.'
            );
        }

        redirect('admin/banner', 'refresh');
    }
}
