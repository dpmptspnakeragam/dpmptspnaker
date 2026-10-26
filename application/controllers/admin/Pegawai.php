<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
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
        $this->load->model('Model_pegawai');
    }

    public function index()
    {
        $data['home']     = 'Home';
        $data['title']    = 'Pegawai';

        $data['kabid']    = $this->Model_pegawai->tampil_kabid();
        $data['pegawai']  = $this->Model_pegawai->tampil_pegawai();
        $data['idmax']    = $this->Model_pegawai->idmax();
        $data['no_urut']  = $this->Model_pegawai->get_total_count() + 1;

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/pegawai', $data, FALSE);

        $this->load->view('modal/tambah/pegawai', $data, FALSE);
        $this->load->view('modal/edit/pegawai', $data, FALSE);
        $this->load->view('modal/hapus/pegawai', $data, FALSE);

        $this->load->view('edit/edit_kabid', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut    = $this->input->post('no_urut', true);
        $nama       = $this->input->post('nama', true);
        $jenis_nip  = $this->input->post('jenis_nip', true);
        $nip        = $this->input->post('nip', true);
        $jabatan    = $this->input->post('jabatan', true);
        $golongan   = $this->input->post('golongan', true);
        $alamat     = $this->input->post('alamat', true);

        $file_name  = null;

        // Proses unggah gambar jika ada file yang dipilih
        if (!empty($_FILES['gambar']['name'])) {
            $nmfile                  = "pegawai-" . time();
            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;

            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('gambar')) {
                $file_name = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah gambar: ' . $this->upload->display_errors('', ''));
                redirect('admin/pegawai', 'refresh');
                return;
            }
        }

        $data = array(
            'id_pegawai' => $id_pegawai,
            'no_urut'    => $no_urut,
            'nama'       => $nama,
            'jenis_nip'  => $jenis_nip,
            'nip'        => $nip,
            'jabatan'    => $jabatan,
            'golongan'   => $golongan,
            'alamat'     => $alamat,
            'gambar'     => $file_name
        );

        $result = $this->Model_pegawai->input($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$nama</b> berhasil disimpan.");
        } else {
            $this->session->set_flashdata('error', "Penyimpanan data <b>$nama</b> gagal. Silakan coba lagi.");
        }

        redirect('admin/pegawai', 'refresh');
    }

    public function ubah_pegawai()
    {
        $id_pegawai  = $this->input->post('id_pegawai', true);
        $no_urut     = $this->input->post('no_urut', true);
        $nama        = $this->input->post('nama', true);
        $jenis_nip   = $this->input->post('jenis_nip', true);
        $nip         = $this->input->post('nip', true);
        $jabatan     = $this->input->post('jabatan', true);
        $golongan    = $this->input->post('golongan', true);
        $alamat      = $this->input->post('alamat', true);

        $gambar_lama = $this->input->post('old', true);
        $gambar      = $gambar_lama; // Default gunakan gambar lama

        // Proses penggantian gambar jika ada file baru disubmit
        if (!empty($_FILES['gambar']['name'])) {
            $nmfile                  = "pegawai-" . time();
            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;

            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama dari server jika file fisik ada
                if (!empty($gambar_lama) && file_exists(FCPATH . 'assets/imgupload/' . $gambar_lama)) {
                    unlink(FCPATH . 'assets/imgupload/' . $gambar_lama);
                }

                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah gambar baru: ' . $this->upload->display_errors('', ''));
                redirect('admin/pegawai', 'refresh');
                return;
            }
        }

        $data = array(
            'id_pegawai' => $id_pegawai,
            'no_urut'    => $no_urut,
            'nama'       => $nama,
            'jenis_nip'  => $jenis_nip,
            'nip'        => $nip,
            'jabatan'    => $jabatan,
            'golongan'   => $golongan,
            'alamat'     => $alamat,
            'gambar'     => $gambar
        );

        $result = $this->Model_pegawai->update_pegawai($data, $id_pegawai);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$nama</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', "Perbarui data <b>$nama</b> gagal. Silakan coba lagi.");
        }

        redirect('admin/pegawai', 'refresh');
    }

    public function ubah_kabid()
    {
        $id_kabid       = $this->input->post('id_kabid', true);
        $nama_kabid     = $this->input->post('nama', true);
        $nip_kabid      = $this->input->post('nip', true);
        $jabatan_kabid  = $this->input->post('jabatan', true);
        $golongan_kabid = $this->input->post('golongan', true);
        $alamat_kabid   = $this->input->post('alamat', true);

        $gambar_lama    = $this->input->post('old', true);
        $gambar_kabid   = $gambar_lama; // Default gunakan gambar lama

        if (!empty($_FILES['gambar']['name'])) {
            $nmfile                  = "kabid-" . time();
            $config['upload_path']   = FCPATH . 'assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = $nmfile;

            if (!isset($this->upload)) {
                $this->load->library('upload', $config);
            } else {
                $this->upload->initialize($config);
            }

            if ($this->upload->do_upload('gambar')) {
                if (!empty($gambar_lama) && file_exists(FCPATH . 'assets/imgupload/' . $gambar_lama)) {
                    unlink(FCPATH . 'assets/imgupload/' . $gambar_lama);
                }

                $gambar_kabid = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah gambar Kabid: ' . $this->upload->display_errors('', ''));
                redirect('admin/pegawai', 'refresh');
                return;
            }
        }

        $data = array(
            'id_kabid'       => $id_kabid,
            'nama_kabid'     => $nama_kabid,
            'nip_kabid'      => $nip_kabid,
            'jabatan_kabid'  => $jabatan_kabid,
            'golongan_kabid' => $golongan_kabid,
            'alamat_kabid'   => $alamat_kabid,
            'gambar_kabid'   => $gambar_kabid
        );

        $result = $this->Model_pegawai->update_kabid($data, $id_kabid);

        if ($result) {
            $this->session->set_flashdata('success', "Data Kabid <b>$nama_kabid</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', "Perbarui data Kabid <b>$nama_kabid</b> gagal. Silakan coba lagi.");
        }

        redirect('admin/pegawai', 'refresh');
    }

    public function hapus($id_pegawai)
    {
        // Ambil data pegawai berdasarkan ID
        $data_pegawai = $this->Model_pegawai->get_by_id_pegawai($id_pegawai);

        if ($data_pegawai) {
            // Hapus gambar fisik jika tersedia
            if (!empty($data_pegawai->gambar) && file_exists(FCPATH . 'assets/imgupload/' . $data_pegawai->gambar)) {
                unlink(FCPATH . 'assets/imgupload/' . $data_pegawai->gambar);
            }

            $pegawai = $data_pegawai->nama;

            // Hapus data dari database
            $result = $this->Model_pegawai->delete($id_pegawai);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$pegawai</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', "Penghapusan data <b>$pegawai</b> gagal. Silakan coba lagi.");
            }
        } else {
            $this->session->set_flashdata('error', 'Data pegawai tidak ditemukan.');
        }

        redirect('admin/pegawai', 'refresh');
    }
}
