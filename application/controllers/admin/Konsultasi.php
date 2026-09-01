<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login/sipadu');
        }

        $role_user = $this->session->userdata('role');
        $divisi_user = $this->session->userdata('divisi');

        $is_allowed = ($role_user === 'Administrator' || ($role_user === 'User' && $divisi_user === 'Konsultasi'));

        if (!$is_allowed) {
            redirect('admin/home');
        }

        $this->load->model('Model_konsultasi');
    }

    public function index()
    {
        $data['title'] = 'Layanan Konsultasi';
        $data['konsultasi'] = $this->Model_konsultasi->get_all_konsultasi();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('modal/tambah/konsultasi', $data);
        $this->load->view('admin/konsultasi_list', $data);
        $this->load->view('templates/admin_footer', $data, FALSE);
    }

    public function tambah()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->load->library('upload');

        // 1. PROSES UPLOAD LAMPIRAN DOKUMEN (PDF/Gambar)
        $file_lampiran = NULL;
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path']   = './assets/konsultasi/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size']      = 5048; // Max 5MB
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('lampiran')) {
                $uploadData = $this->upload->data();
                $file_lampiran = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload lampiran: ' . $this->upload->display_errors('', ''));
                redirect('admin/konsultasi');
                return;
            }
        }

        // 2. PROSES FOTO PEMOHON (WEBCAM / UPLOAD FILE)
        $foto_pemohon = NULL;
        $foto_webcam  = $this->input->post('foto_webcam');

        if (!empty($foto_webcam)) {
            // Option A: JIKA MENGGUNAKAN WEBCAM (Base64 Data String)
            $image_parts = explode(";base64,", $foto_webcam);
            if (count($image_parts) == 2) {
                $image_base64 = base64_decode($image_parts[1]);

                $nama_file_foto = 'foto_' . date('Ymd_His') . '_' . uniqid() . '.jpg';
                $path_simpan    = './assets/konsultasi/' . $nama_file_foto;

                if (file_put_contents($path_simpan, $image_base64)) {
                    $foto_pemohon = $nama_file_foto;
                }
            }
        } else if (!empty($_FILES['foto_pemohon']['name'])) {
            // Option B: JIKA MENGGUNAKAN UPLOAD FILE BIASA
            $config_foto['upload_path']   = './assets/konsultasi/';
            $config_foto['allowed_types'] = 'jpg|jpeg|png';
            $config_foto['max_size']      = 2048; // Max 2MB
            $config_foto['encrypt_name']  = TRUE;

            $this->upload->initialize($config_foto);

            if ($this->upload->do_upload('foto_pemohon')) {
                $uploadFoto = $this->upload->data();
                $foto_pemohon = $uploadFoto['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto pemohon: ' . $this->upload->display_errors('', ''));
                redirect('admin/konsultasi');
                return;
            }
        }

        // 3. SUSUN DATA UNTUK DISIMPAN KE DATABASE
        $data = [
            'tanggal_masuk'    => date('Y-m-d H:i:s'),
            'nik'              => $this->input->post('nik', TRUE),
            'nama_pemohon'     => $this->input->post('nama_pemohon', TRUE),
            'pekerjaan'        => $this->input->post('pekerjaan', TRUE),
            'alamat'           => $this->input->post('alamat', TRUE),
            'no_hp'            => $this->input->post('no_hp', TRUE),
            'email'            => $this->input->post('email', TRUE),
            'jenis_izin'       => $this->input->post('jenis_izin', TRUE),
            'uraian'           => $this->input->post('uraian', TRUE),
            'lampiran'         => $file_lampiran,
            'foto_pemohon'     => $foto_pemohon,
            'petugas_penerima' => $this->session->userdata('nama'),
            'status'           => 'Menunggu'
        ];

        $hasil_simpan = $this->Model_konsultasi->simpan_data($data);

        if ($hasil_simpan !== FALSE) {
            $this->session->set_flashdata('success', "Data Konsultasi berhasil ditambahkan dengan No Tiket: <b>{$hasil_simpan}</b>");
        } else {
            $this->session->set_flashdata('error', "Gagal menyimpan data karena sistem sedang sibuk. Silakan coba lagi.");
        }

        redirect('admin/konsultasi');
    }

    public function proses($id)
    {
        $data['title'] = 'Proses Konsultasi';
        $data['detail'] = $this->Model_konsultasi->get_konsultasi_by_id($id);

        if (!$data['detail']) {
            $this->session->set_flashdata('error', 'Data konsultasi tidak ditemukan!');
            redirect('admin/konsultasi');
        }

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/konsultasi_proses', $data);
        $this->load->view('templates/admin_footer', $data, FALSE);
    }

    public function simpan_proses()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id = $this->input->post('id_konsultasi', TRUE);
        $status_baru = $this->input->post('status', TRUE);

        $data = [
            'bidang_tujuan'    => $this->input->post('bidang_tujuan', TRUE),
            'tindak_lanjut'    => $this->input->post('tindak_lanjut', TRUE),
            'status'           => $status_baru,
            'petugas_penerima' => $this->session->userdata('nama')
        ];

        if (in_array($status_baru, ['Selesai', 'Ditolak'])) {
            $data['tanggal_selesai'] = date('Y-m-d H:i:s');
        }

        $this->Model_konsultasi->update_tindak_lanjut($id, $data);
        $this->session->set_flashdata('success', 'Tindak lanjut konsultasi berhasil disimpan!');
        redirect('admin/konsultasi/proses/' . $id);
    }

    // E. Menghapus Data Konsultasi (Lengkap dengan Unlink Foto & Lampiran)
    public function hapus($id)
    {
        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);
        if ($detail) {
            // 1. Hapus berkas lampiran jika ada
            if (!empty($detail->lampiran) && file_exists('./assets/konsultasi/' . $detail->lampiran)) {
                unlink('./assets/konsultasi/' . $detail->lampiran);
            }

            // 2. Hapus berkas foto pemohon jika ada
            if (!empty($detail->foto_pemohon) && file_exists('./assets/konsultasi/' . $detail->foto_pemohon)) {
                unlink('./assets/konsultasi/' . $detail->foto_pemohon);
            }

            // 3. Hapus record dari database
            $this->Model_konsultasi->delete_konsultasi($id);
            $this->session->set_flashdata('success', 'Data konsultasi beserta file berkas berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
        }

        redirect('admin/konsultasi');
    }

    public function cetak($id)
    {
        $data['title'] = 'Cetak Bukti Konsultasi';
        $data['detail'] = $this->Model_konsultasi->get_konsultasi_by_id($id);

        if (!$data['detail']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('admin/konsultasi');
        }

        $this->load->view('admin/konsultasi_cetak', $data);
    }
}
