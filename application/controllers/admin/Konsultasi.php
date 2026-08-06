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
            // Opsional: Beri pesan error agar user tahu kenapa dilempar
            // $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses ke modul Konsultasi.');
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

        // Pastikan folder assets/konsultasi/ sudah dibuat
        $config['upload_path']   = './assets/konsultasi/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 5048; // Max 5MB
        $config['encrypt_name']  = TRUE;
        $this->upload->initialize($config);

        $file_lampiran = NULL;
        if (!empty($_FILES['lampiran']['name'])) {
            if ($this->upload->do_upload('lampiran')) {
                $uploadData = $this->upload->data();
                $file_lampiran = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload lampiran: ' . $this->upload->display_errors('', ''));
                redirect('admin/konsultasi');
                return;
            }
        }

        // PERUBAHAN: Tidak perlu memanggil fungsi generate_tiket() lagi secara manual
        // Nomor tiket akan di-generate secara otomatis dan aman (anti-bentrok) di dalam Model
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
            'petugas_penerima' => $this->session->userdata('nama'),
            'status'           => 'Menunggu'
        ];

        // Model akan mengembalikan Nomor Tiket jika sukses, atau FALSE jika gagal
        $hasil_simpan = $this->Model_konsultasi->simpan_data($data);

        if ($hasil_simpan !== FALSE) {
            $this->session->set_flashdata('success', "Data Konsultasi berhasil ditambahkan dengan No Tiket: <b>{$hasil_simpan}</b>");
        } else {
            // Berikan pesan jika terjadi kegagalan sistem (termasuk jika transaksi database gagal)
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

    // D. Menyimpan Balasan Tindak Lanjut Admin
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

    // E. Menghapus Data Konsultasi
    public function hapus($id)
    {
        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);
        if ($detail) {
            // Hapus file fisik jika ada lampiran
            if (!empty($detail->lampiran) && file_exists('./assets/konsultasi/' . $detail->lampiran)) {
                unlink('./assets/konsultasi/' . $detail->lampiran);
            }
            $this->Model_konsultasi->delete_konsultasi($id);
            $this->session->set_flashdata('success', 'Data konsultasi berhasil dihapus!');
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
