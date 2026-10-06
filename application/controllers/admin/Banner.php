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

        $gambar = null;

        // =========================
        // UPLOAD GAMBAR
        // =========================
        if (!empty($_FILES['gambar']['name'])) {

            // Path folder upload
            $upload_path = FCPATH . 'assets/imgupload/';

            // Pastikan folder upload tersedia
            if (!is_dir($upload_path)) {
                $this->session->set_flashdata(
                    'error',
                    'Folder upload tidak ditemukan: ' . $upload_path
                );

                redirect('admin/banner', 'refresh');
            }

            // Pastikan folder bisa ditulis
            if (!is_writable($upload_path)) {
                $this->session->set_flashdata(
                    'error',
                    'Folder upload tidak memiliki izin untuk ditulis.'
                );

                redirect('admin/banner', 'refresh');
            }

            // Konfigurasi upload
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = 'banner-' . time();
            $config['overwrite']     = false;

            $this->load->library('upload', $config);

            // Proses upload
            if ($this->upload->do_upload('gambar')) {

                $upload_data = $this->upload->data();
                $gambar      = $upload_data['file_name'];
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Upload foto gagal: ' .
                        strip_tags($this->upload->display_errors())
                );

                redirect('admin/banner', 'refresh');
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
        // SIMPAN DATA
        // =========================
        $result = $this->Model_banner->input($data);

        if ($result) {

            $this->session->set_flashdata(
                'success',
                'Data Banner berhasil disimpan.'
            );
        } else {

            // Jika database gagal tetapi gambar sudah terupload,
            // hapus gambar agar tidak menjadi file sampah.
            if (!empty($gambar)) {

                $file_gambar = FCPATH . 'assets/imgupload/' . $gambar;

                if (file_exists($file_gambar)) {
                    unlink($file_gambar);
                }
            }

            $this->session->set_flashdata(
                'error',
                'Penyimpanan data gagal. Silakan coba lagi.'
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
        // CEK APAKAH ADA GAMBAR BARU
        // =========================
        if (!empty($_FILES['gambar']['name'])) {

            // Path folder upload
            $upload_path = FCPATH . 'assets/imgupload/';

            // Pastikan folder upload tersedia
            if (!is_dir($upload_path)) {

                $this->session->set_flashdata(
                    'error',
                    'Folder upload tidak ditemukan: ' . $upload_path
                );

                redirect('admin/banner', 'refresh');
            }

            // Pastikan folder bisa ditulis
            if (!is_writable($upload_path)) {

                $this->session->set_flashdata(
                    'error',
                    'Folder upload tidak memiliki izin untuk ditulis.'
                );

                redirect('admin/banner', 'refresh');
            }

            // Konfigurasi upload
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = 'banner-' . time();
            $config['overwrite']     = false;

            $this->load->library('upload', $config);

            // =========================
            // UPLOAD GAMBAR BARU
            // =========================
            if ($this->upload->do_upload('gambar')) {

                $upload_data = $this->upload->data();
                $gambar      = $upload_data['file_name'];

                // =========================
                // HAPUS GAMBAR LAMA
                // =========================
                if (!empty($gambar_lama)) {

                    $file_lama = $upload_path . $gambar_lama;

                    if (file_exists($file_lama)) {
                        unlink($file_lama);
                    }
                }
            } else {

                $this->session->set_flashdata(
                    'error',
                    'Upload foto gagal: ' .
                        strip_tags($this->upload->display_errors())
                );

                redirect('admin/banner', 'refresh');
            }
        }

        // =========================
        // DATA YANG AKAN DIUPDATE
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

            // Kalau database gagal dan ada gambar baru,
            // hapus gambar baru supaya tidak jadi sampah.
            if (!empty($_FILES['gambar']['name']) && !empty($gambar)) {

                $file_baru = $upload_path . $gambar;

                if (file_exists($file_baru)) {
                    unlink($file_baru);
                }
            }

            log_message(
                'error',
                'Gagal memperbarui banner: ' . json_encode($data)
            );

            $this->session->set_flashdata(
                'error',
                'Perbarui data gagal. Silakan coba lagi.'
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
        // HAPUS FILE GAMBAR
        // =========================
        if ($row && !empty($row->gambar)) {

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
                'Penghapusan data gagal. Silakan coba lagi.'
            );
        }

        redirect('admin/banner', 'refresh');
    }
}
