<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role_user   = $this->session->userdata('role');
        $divisi_user = $this->session->userdata('divisi');

        $is_allowed = ($role_user === 'Administrator' || ($role_user === 'User' && $divisi_user === 'Konsultasi'));

        if (!$is_allowed) {
            redirect('admin/home');
        }

        $this->load->model('Model_konsultasi');
    }

    /**
     * PRIVATE HELPER: Mengecek tipe unit user saat ini (PTSP, BLK, atau Admin)
     */
    private function _get_user_type()
    {
        $role     = $this->session->userdata('role');
        $username = strtolower($this->session->userdata('username') ?? '');

        if ($role === 'Administrator') {
            return 'ADMIN';
        }
        if (strpos($username, 'ptsp') !== false) {
            return 'PTSP';
        }
        if (strpos($username, 'blk') !== false) {
            return 'BLK';
        }

        return 'ALL';
    }

    /**
     * PRIVATE HELPER: Mengecek apakah user bertipe PROSES atau ADMIN
     */
    private function _is_proses_or_admin()
    {
        $role     = $this->session->userdata('role');
        $username = strtolower($this->session->userdata('username') ?? '');

        $is_admin  = ($role === 'Administrator');
        $is_proses = (strpos($username, 'proses') !== false);

        return ($is_admin || $is_proses);
    }

    /**
     * PRIVATE HELPER: Validasi apakah User berhak memproses/mengakses backend data tersebut
     */
    private function _check_access($detail)

    public function index()
    {
        $data['title']      = 'Layanan Konsultasi';

        // TAMPILKAN SELURUH DATA: Agar nomor tiket & urutan antrean terlihat utuh (0001, 0002, 0003...)
        // Pembatasan tombol Aksi (Proses/Hapus/Buka) dikontrol langsung di View & Method Aksi.
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
        // Proteksi Backend: Hanya User Input atau Admin yang boleh mengeksekusi method simpan
        $username = strtolower($this->session->userdata('username') ?? '');
        $role     = $this->session->userdata('role');
        $is_input = (strpos($username, 'input') !== false || $role === 'Administrator');

        if (!$is_input) {
            $this->session->set_flashdata('error', 'Akses ditolak! Hanya Operator Input yang dapat menambah data.');
            redirect('admin/konsultasi');
            return;
        }

        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('upload');

        $target_dir = FCPATH . 'assets/konsultasi/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, TRUE);
        }

        // 1. PROSES UPLOAD LAMPIRAN
        $file_lampiran = NULL;
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path']   = $target_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size']      = 5048;
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('lampiran')) {
                $uploadData    = $this->upload->data();
                $file_lampiran = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload lampiran: ' . $this->upload->display_errors('', ''));
                redirect('admin/konsultasi');
                return;
            }
        }

        // 2. PROSES FOTO PEMOHON
        $foto_pemohon = NULL;
        $foto_webcam  = $this->input->post('foto_webcam');

        if (!empty($foto_webcam)) {
            $image_parts = explode(";base64,", $foto_webcam);
            if (count($image_parts) == 2) {
                $image_base64   = base64_decode($image_parts[1]);
                $nama_file_foto = 'foto_' . date('Ymd_His') . '_' . uniqid() . '.jpg';
                $path_simpan    = $target_dir . $nama_file_foto;

                if (file_put_contents($path_simpan, $image_base64)) {
                    $foto_pemohon = $nama_file_foto;
                }
            }
        } else if (!empty($_FILES['foto_pemohon']['name'])) {
            $config_foto['upload_path']   = $target_dir;
            $config_foto['allowed_types'] = 'jpg|jpeg|png';
            $config_foto['max_size']      = 2048;
            $config_foto['encrypt_name']  = TRUE;

            $this->upload->initialize($config_foto);

            if ($this->upload->do_upload('foto_pemohon')) {
                $uploadFoto   = $this->upload->data();
                $foto_pemohon = $uploadFoto['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto pemohon: ' . $this->upload->display_errors('', ''));
                redirect('admin/konsultasi');
                return;
            }
        }

        // 3. SIMPAN DATA
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
            // Gunakan gabungan nama & username jika ingin pencarian unit selalu akurat:
            'petugas_penerima' => ($this->session->userdata('nama') ?? '') . ' (' . $this->session->userdata('username') . ')',
            'status'           => 'Menunggu'
            // 'created_by' DIHAPUS agar tidak error lagi
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
        // PERKETAT: Hanya User PROSES & ADMIN yang boleh buka halaman proses
        if (!$this->_is_proses_or_admin()) {
            $this->session->set_flashdata('error', 'Akses ditolak! Operator Input tidak memiliki akses ke halaman proses.');
            redirect('admin/konsultasi');
            return;
        }

        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);

        if (!$detail) {
            $this->session->set_flashdata('error', 'Data konsultasi tidak ditemukan!');
            redirect('admin/konsultasi');
            return;
        }

        // VALIDASI AKSES UNIT: Cek apakah User Proses berhak mengedit data unit ini
        if (!$this->_check_access($detail)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses untuk memproses data dari unit lain!');
            redirect('admin/konsultasi');
            return;
        }

        $data['title']  = 'Proses Konsultasi';
        $data['detail'] = $detail;

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/konsultasi_proses', $data);
        $this->load->view('templates/admin_footer', $data, FALSE);
    }

    public function simpan_proses()
    {
        // PERKETAT: Hanya User PROSES & ADMIN
        if (!$this->_is_proses_or_admin()) {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda tidak memiliki akses untuk memproses.');
            redirect('admin/konsultasi');
            return;
        }

        date_default_timezone_set('Asia/Jakarta');

        $id          = $this->input->post('id_konsultasi', TRUE);
        $status_baru = $this->input->post('status', TRUE);

        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);

        // VALIDASI AKSES
        if (!$detail || !$this->_check_access($detail)) {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda tidak berhak memproses data ini.');
            redirect('admin/konsultasi');
            return;
        }

        $data = [
            'bidang_tujuan' => $this->input->post('bidang_tujuan', TRUE),
            'tindak_lanjut' => $this->input->post('tindak_lanjut', TRUE),
            'status'        => $status_baru,
        ];

        if (in_array($status_baru, ['Selesai', 'Ditolak'])) {
            $data['tanggal_selesai'] = date('Y-m-d H:i:s');
        }

        $this->Model_konsultasi->update_tindak_lanjut($id, $data);
        $this->session->set_flashdata('success', 'Tindak lanjut konsultasi berhasil disimpan!');
        redirect('admin/konsultasi/proses/' . $id);
    }

    public function hapus($id)
    {
        // PERKETAT: Hanya User PROSES & ADMIN
        if (!$this->_is_proses_or_admin()) {
            $this->session->set_flashdata('error', 'Akses ditolak! Operator Input tidak diperbolehkan menghapus data.');
            redirect('admin/konsultasi');
            return;
        }

        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);

        // VALIDASI AKSES UNIT
        if (!$detail || !$this->_check_access($detail)) {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda tidak berhak menghapus data ini.');
            redirect('admin/konsultasi');
            return;
        }

        // 1. Hapus berkas lampiran
        if (!empty($detail->lampiran) && file_exists('./assets/konsultasi/' . $detail->lampiran)) {
            unlink('./assets/konsultasi/' . $detail->lampiran);
        }

        // 2. Hapus berkas foto
        if (!empty($detail->foto_pemohon) && file_exists('./assets/konsultasi/' . $detail->foto_pemohon)) {
            unlink('./assets/konsultasi/' . $detail->foto_pemohon);
        }

        // 3. Hapus data
        $this->Model_konsultasi->delete_konsultasi($id);
        $this->session->set_flashdata('success', 'Data konsultasi berhasil dihapus!');

        redirect('admin/konsultasi');
    }

    public function cetak($id)
    {
        $detail = $this->Model_konsultasi->get_konsultasi_by_id($id);

        if (!$detail || !$this->_check_access($detail)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan atau Anda tidak memiliki hak akses!');
            redirect('admin/konsultasi');
            return;
        }

        $data['title']  = 'Cetak Bukti Konsultasi';
        $data['detail'] = $detail;

        $this->load->view('admin/konsultasi_cetak', $data);
    }
}
