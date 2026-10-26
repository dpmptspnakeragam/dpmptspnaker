
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    private $upload_path;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
            return;
        }

        if ($this->session->userdata('role') !== 'Administrator') {
            redirect('admin/home');
            return;
        }

        $this->load->model('Model_pegawai');
        $this->load->library('upload');
        $this->load->helper(array('url', 'security'));

        $this->upload_path = FCPATH . 'assets/imgupload/';
    }

    /**
     * Halaman utama pegawai dan Kabid.
     */
    public function index()
    {
        $data['home']     = 'Home';
        $data['title']    = 'Pegawai';
        $data['kabid']    = $this->Model_pegawai->tampil_kabid();
        $data['pegawai']  = $this->Model_pegawai->tampil_pegawai();
        $data['idmax']    = $this->Model_pegawai->idmax();
        $data['no_urut']  = $this->Model_pegawai->get_total_count() + 1;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pegawai', $data);

        $this->load->view('modal/tambah/pegawai', $data);
        $this->load->view('modal/edit/pegawai', $data);
        $this->load->view('modal/hapus/pegawai', $data);

        $this->load->view('edit/edit_kabid', $data);
        $this->load->view('templates/admin_footer');
    }

    /**
     * Validasi upload dan simpan gambar.
     *
     * Mengembalikan nama file jika berhasil.
     * Mengembalikan FALSE jika gagal.
     */
    private function upload_gambar($prefix = 'pegawai')
    {
        if (
            !isset($_FILES['gambar']) ||
            !isset($_FILES['gambar']['error']) ||
            $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE
        ) {
            return array(
                'success' => true,
                'file'    => null
            );
        }

        if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
            $pesan = 'Upload gambar gagal.';

            if (
                $_FILES['gambar']['error'] === UPLOAD_ERR_INI_SIZE ||
                $_FILES['gambar']['error'] === UPLOAD_ERR_FORM_SIZE
            ) {
                $pesan = 'Ukuran gambar melebihi batas yang diizinkan.';
            }

            return array(
                'success' => false,
                'error'   => $pesan
            );
        }

        if (
            !is_dir($this->upload_path) ||
            !is_writable($this->upload_path)
        ) {
            return array(
                'success' => false,
                'error'   => 'Folder gambar tidak ditemukan atau tidak dapat ditulis.'
            );
        }

        $config = array(
            'upload_path'      => $this->upload_path,
            'allowed_types'    => 'jpg|jpeg|png|gif',
            'max_size'         => 2048,
            'max_width'        => 3000,
            'max_height'       => 3000,
            'file_name'        => $prefix . '-' . uniqid(),
            'overwrite'        => false,
            'remove_spaces'    => true,
            'detect_mime'      => true,
            'mod_mime_fix'     => true
        );

        $this->upload->initialize($config, true);

        if (!$this->upload->do_upload('gambar')) {
            return array(
                'success' => false,
                'error'   => trim(
                    strip_tags($this->upload->display_errors('', ''))
                )
            );
        }

        $hasil = $this->upload->data();

        return array(
            'success' => true,
            'file'    => $hasil['file_name']
        );
    }

    /**
     * Menghapus file gambar hanya dari folder upload.
     */
    private function hapus_file_gambar($nama_file)
    {
        if (empty($nama_file)) {
            return;
        }

        // Pastikan hanya nama file, bukan path dari input pengguna.
        $nama_file = basename($nama_file);
        $path = $this->upload_path . $nama_file;

        if (is_file($path)) {
            @unlink($path);
        }
    }

    /**
     * Tambah pegawai.
     */
    public function tambah()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut    = $this->input->post('no_urut', true);
        $nama       = trim((string) $this->input->post('nama', true));
        $jenis_nip  = $this->input->post('jenis_nip', true);
        $nip        = $this->input->post('nip', true);
        $jabatan    = $this->input->post('jabatan', true);
        $golongan   = $this->input->post('golongan', true);
        $alamat     = $this->input->post('alamat', true);

        if ($nama === '') {
            $this->session->set_flashdata('error', 'Nama pegawai wajib diisi.');
            redirect('admin/pegawai');
            return;
        }

        $upload = $this->upload_gambar('pegawai');

        if (!$upload['success']) {
            $this->session->set_flashdata(
                'error',
                'Gagal mengunggah gambar: ' . $upload['error']
            );
            redirect('admin/pegawai');
            return;
        }

        $gambar = $upload['file'];

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

        $result = $this->Model_pegawai->input($data);

        if ($result) {
            $this->session->set_flashdata(
                'success',
                "Data {$nama} berhasil disimpan."
            );
        } else {
            // Jangan biarkan file yatim jika insert gagal.
            $this->hapus_file_gambar($gambar);

            $this->session->set_flashdata(
                'error',
                "Penyimpanan data {$nama} gagal. Silakan coba lagi."
            );
        }

        redirect('admin/pegawai');
    }

    /**
     * Edit data dan gambar pegawai.
     */
    public function ubah_pegawai()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);

        if (empty($id_pegawai)) {
            $this->session->set_flashdata('error', 'ID pegawai tidak valid.');
            redirect('admin/pegawai');
            return;
        }

        // Ambil data lama dari database, bukan dari input hidden.
        $pegawai_lama = $this->Model_pegawai->get_by_id_pegawai($id_pegawai);

        if (!$pegawai_lama) {
            $this->session->set_flashdata('error', 'Data pegawai tidak ditemukan.');
            redirect('admin/pegawai');
            return;
        }

        $no_urut   = $this->input->post('no_urut', true);
        $nama      = trim((string) $this->input->post('nama', true));
        $jenis_nip = $this->input->post('jenis_nip', true);
        $nip       = $this->input->post('nip', true);
        $jabatan   = $this->input->post('jabatan', true);
        $golongan  = $this->input->post('golongan', true);
        $alamat    = $this->input->post('alamat', true);

        if ($nama === '') {
            $this->session->set_flashdata('error', 'Nama pegawai wajib diisi.');
            redirect('admin/pegawai');
            return;
        }

        $gambar_lama = $pegawai_lama->gambar;
        $gambar_baru = null;
        $gambar      = $gambar_lama;

        $upload = $this->upload_gambar('pegawai');

        if (!$upload['success']) {
            $this->session->set_flashdata(
                'error',
                'Gagal mengunggah gambar: ' . $upload['error']
            );
            redirect('admin/pegawai');
            return;
        }

        if (!empty($upload['file'])) {
            $gambar_baru = $upload['file'];
            $gambar = $gambar_baru;
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

        $result = $this->Model_pegawai->update_pegawai(
            $data,
            $id_pegawai
        );

        if ($result) {
            // Hapus gambar lama hanya setelah update database berhasil.
            if (!empty($gambar_baru) && $gambar_lama !== $gambar_baru) {
                $this->hapus_file_gambar($gambar_lama);
            }

            $this->session->set_flashdata(
                'success',
                "Data {$nama} berhasil diperbarui."
            );
        } else {
            // Pertahankan gambar lama bila update gagal.
            $this->hapus_file_gambar($gambar_baru);

            $this->session->set_flashdata(
                'error',
                "Perbarui data {$nama} gagal. Silakan coba lagi."
            );
        }

        redirect('admin/pegawai');
    }

    /**
     * Edit data Kabid.
     * Mempertahankan nama field pada kode lama.
     */
    public function ubah_kabid()
    {
        $id_kabid = $this->input->post('id_kabid', true);

        if (empty($id_kabid)) {
            $this->session->set_flashdata('error', 'ID Kabid tidak valid.');
            redirect('admin/pegawai');
            return;
        }

        $nama_kabid    = trim((string) $this->input->post('nama', true));
        $nip_kabid     = $this->input->post('nip', true);
        $jabatan_kabid = $this->input->post('jabatan', true);
        $golongan_kabid = $this->input->post('golongan', true);
        $alamat_kabid  = $this->input->post('alamat', true);
        $gambar_kabid  = $this->input->post('old', true);

        $upload = $this->upload_gambar('kabid');

        if (!$upload['success']) {
            $this->session->set_flashdata(
                'error',
                'Gagal mengunggah gambar Kabid: ' . $upload['error']
            );
            redirect('admin/pegawai');
            return;
        }

        if (!empty($upload['file'])) {
            $gambar_kabid = $upload['file'];
        }

        $data = array(
            'id_kabid'     => $id_kabid,
            'nama_kabid'   => $nama_kabid,
            'nip_kabid'    => $nip_kabid,
            'jabatan_kabid' => $jabatan_kabid,
            'golongan_kabid' => $golongan_kabid,
            'alamat_kabid' => $alamat_kabid,
            'gambar_kabid' => $gambar_kabid
        );

        $result = $this->Model_pegawai->update_kabid($data, $id_kabid);

        if ($result) {
            $this->session->set_flashdata(
                'success',
                "Data Kabid {$nama_kabid} berhasil diperbarui."
            );
        } else {
            if (!empty($upload['file'])) {
                $this->hapus_file_gambar($upload['file']);
            }

            $this->session->set_flashdata(
                'error',
                "Perbarui data Kabid {$nama_kabid} gagal."
            );
        }

        redirect('admin/pegawai');
    }

    /**
     * Hapus pegawai.
     */
    public function hapus($id_pegawai = null)
    {
        if (empty($id_pegawai)) {
            $this->session->set_flashdata('error', 'ID pegawai tidak valid.');
            redirect('admin/pegawai');
            return;
        }

        $data_pegawai = $this->Model_pegawai->get_by_id_pegawai($id_pegawai);

        if (!$data_pegawai) {
            $this->session->set_flashdata('error', 'Data pegawai tidak ditemukan.');
            redirect('admin/pegawai');
            return;
        }

        $nama = $data_pegawai->nama;
        $gambar = $data_pegawai->gambar;

        // Hapus record dahulu, kemudian file jika database berhasil.
        $result = $this->Model_pegawai->delete($id_pegawai);

        if ($result) {
            $this->hapus_file_gambar($gambar);

            $this->session->set_flashdata(
                'success',
                "Data {$nama} berhasil dihapus."
            );
        } else {
            $this->session->set_flashdata(
                'error',
                "Penghapusan data {$nama} gagal. Silakan coba lagi."
            );
        }

        redirect('admin/pegawai');
    }
}
