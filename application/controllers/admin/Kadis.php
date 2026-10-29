<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kadis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek Sesi Login
        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        // Cek Hak Akses Role
        $role_user = $this->session->userdata('role');
        if ($role_user !== 'Administrator') {
            redirect('admin/home');
        }

        // Load Model
        $this->load->model('Model_kadis');
    }

    public function index()
    {
        $data['kadis'] = $this->Model_kadis->tampil_kadis();
        $data['home']  = 'Home';
        $data['title'] = 'Kepala Dinas';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/kadis', $data, FALSE);
        $this->load->view('modal/modal_tambah_kadis', $data);
        $this->load->view('edit/edit_kadis', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_kadis = $this->input->post('id_kadis', true);
        $nama     = $this->input->post('nama', true);
        $periode  = $this->input->post('periode', true);
        $file_foto = null;

        // Pastikan folder direktori upload tersedia
        $upload_path = FCPATH . 'assets/imgupload/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Proses unggah foto jika ada file yang dipilih
        if (isset($_FILES['foto']) && !empty($_FILES['foto']['name'])) {
            $nmfile                  = "kadis-" . time();
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG';
            $config['max_size']      = 5120; // Maksimal 5MB
            $config['file_name']     = $nmfile;

            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('foto')) {
                $file_foto = $this->upload->data('file_name');
            } else {
                $error_msg = strip_tags($this->upload->display_errors());
                $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $error_msg);
                redirect('admin/kadis', 'refresh');
                return;
            }
        }

        $data = array(
            'id_kadis' => $id_kadis,
            'nama'     => $nama,
            'periode'  => $periode,
            'foto'     => $file_foto
        );

        $result = $this->Model_kadis->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }

    public function edit()
    {
        $id_kadis  = $this->input->post('id_kadis', true);
        $nama      = $this->input->post('nama', true);
        $periode   = $this->input->post('periode', true);
        $foto_lama = $this->input->post('old', true);
        $foto      = $foto_lama; // Default menggunakan foto lama

        // Pastikan folder direktori upload tersedia
        $upload_path = FCPATH . 'assets/imgupload/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Proses unggah foto baru jika ada file yang dipilih
        if (isset($_FILES['foto']) && !empty($_FILES['foto']['name'])) {
            $nmfile                  = "kadis-" . time();
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG';
            $config['max_size']      = 5120; // Maksimal 5MB
            $config['file_name']     = $nmfile;

            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('foto')) {
                // Hapus foto lama jika file fisik tersedia
                if (!empty($foto_lama) && file_exists($upload_path . $foto_lama)) {
                    unlink($upload_path . $foto_lama);
                }

                $foto = $this->upload->data('file_name');
            } else {
                $error_msg = strip_tags($this->upload->display_errors());
                $this->session->set_flashdata('error', 'Upload foto gagal: ' . $error_msg);
                redirect('admin/kadis', 'refresh');
                return;
            }
        }

        $data = array(
            'nama'    => $nama,
            'periode' => $periode,
            'foto'    => $foto,
        );

        $result = $this->Model_kadis->update($data, $id_kadis);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }

    public function hapus($id_kadis)
    {
        $this->db->where('id_kadis', $id_kadis);
        $query = $this->db->get('kadis');
        $row   = $query->row();

        $upload_path = FCPATH . 'assets/imgupload/';

        // Hapus foto jika file ada di server
        if ($row && !empty($row->foto) && file_exists($upload_path . $row->foto)) {
            unlink($upload_path . $row->foto);
        }

        $result = $this->Model_kadis->delete($id_kadis);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }
}
