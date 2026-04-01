<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_realisasi_investasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_grafik_investasi');
    }

    public function index()
    {
        $data['grafik_investasi'] = $this->Model_grafik_investasi->get_all_data();
        $data['periode_grafik_investasi'] = $this->Model_grafik_investasi->tampil_data_periode();
        $data['tahun'] = $this->db->get_where('grafik_investasi', ['tipe' => 'tahun']);

        $data['idmax'] = $this->Model_grafik_investasi->idmax();

        $data['home'] = 'Home';
        $data['title'] = 'Grafik Realisasi Investasi';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_realisasi_investasi', $data);

        $this->load->view('modal/tambah/grafik_realisasi_investasi_tahun');
        $this->load->view('modal/tambah/grafik_realisasi_investasi_jenis');

        $this->load->view('modal/edit/grafik_realisasi_investasi_tahun', $data);
        $this->load->view('modal/edit/grafik_realisasi_investasi_jenis', $data);

        $this->load->view('modal/hapus/grafik_realisasi_investasi', $data, FALSE);

        $this->load->view('modal/edit/periode_grafik_realisasi_investasi', $data);

        $this->load->view('templates/admin_footer');
    }

    // public function tambah()
    // {
    //     $id = $this->input->post('id', true);
    //     $tahun = $this->input->post('tahun', true);
    //     $nilai = $this->input->post('nilai', true);
    //     $nilai2 = $this->input->post('nilai2', true);

    //     $data = array(
    //         'id_grafik' => $id,
    //         'tahun' => $tahun,
    //         'nilai' => $nilai,
    //         'nilai2' => $nilai2
    //     );

    //     $result = $this->Model_grafik_investasi->input($data);

    //     if ($result) {
    //         $this->session->set_flashdata('success', 'Data Grafik Realisasi Investasi berhasil disimpan.');
    //     } else {
    //         $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
    //     }

    //     redirect('admin/grafik_realisasi_investasi', 'refresh');
    // }

    public function tambah_tahun()
    {
        $tahun = $this->input->post('tahun', true);
        // 🔥 Tangkap nilai Target dari form
        $nilai = (float)$this->input->post('nilai', true);

        // VALIDASI KOSONG
        if (empty($tahun)) {
            $this->session->set_flashdata('error', 'Tahun wajib diisi!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // VALIDASI DUPLIKAT TAHUN
        $cek = $this->db->get_where('grafik_investasi', [
            'tahun' => $tahun,
            'tipe' => 'tahun'
        ]);

        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Tahun sudah ada!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // SIMPAN DATA
        $data = [
            'tahun'           => $tahun,
            'nilai'           => $nilai, // Masukkan target ke sini
            'nilai2'          => 0,      // Realisasi biarkan 0 dulu (nanti dijumlah otomatis dari jenis)
            'parent_id'       => NULL,
            'tipe'            => 'tahun',
            'jenis_investasi' => NULL
        ];

        $result = $this->Model_grafik_investasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Tahun dan Target berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_realisasi_investasi');
    }

    public function tambah_jenis()
    {
        $parent_id = $this->input->post('parent_id', true);
        $jenis     = trim($this->input->post('jenis_investasi', true));

        // 🔥 HAPUS baris $nilai (Target), karena Jenis hanya punya Realisasi
        $nilai2    = (float)$this->input->post('nilai2', true);

        // VALIDASI PILIH TAHUN
        if (empty($parent_id)) {
            $this->session->set_flashdata('error', 'Pilih tahun dulu!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // VALIDASI JENIS
        if (empty($jenis)) {
            $this->session->set_flashdata('error', 'Jenis investasi wajib diisi!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // AMBIL DATA TAHUN DARI PARENT
        $parent = $this->db->get_where('grafik_investasi', ['id_grafik' => $parent_id])->row();
        $tahun_parent = $parent ? $parent->tahun : '';

        // VALIDASI DUPLIKAT (tahun + jenis)
        $cek = $this->db->get_where('grafik_investasi', [
            'parent_id' => $parent_id,
            'jenis_investasi' => $jenis,
            'tipe' => 'jenis'
        ]);

        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Jenis investasi ini sudah ada di tahun yang dipilih!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // SIMPAN DATA
        $data = [
            'tahun'           => $tahun_parent,
            'jenis_investasi' => $jenis,
            'nilai'           => 0,       // Set 0 karena Jenis tidak punya Target
            'nilai2'          => $nilai2, // Masukkan Realisasi ke sini
            'parent_id'       => $parent_id,
            'tipe'            => 'jenis'
        ];

        $result = $this->Model_grafik_investasi->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Jenis investasi dan Realisasi berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan jenis investasi. Silahkan coba lagi.');
        }

        redirect('admin/grafik_realisasi_investasi');
    }

    // public function edit()
    // {
    //     $id = $this->input->post('id', true);
    //     $tahun = $this->input->post('tahun', true);
    //     $nilai = $this->input->post('nilai', true);
    //     $nilai2 = $this->input->post('nilai2', true);

    //     $data = array(
    //         'id_grafik' => $id,
    //         'tahun' => $tahun,
    //         'nilai' => $nilai,
    //         'nilai2' => $nilai2
    //     );

    //     $result = $this->Model_grafik_investasi->update($data, $id);

    //     if ($result) {
    //         $this->session->set_flashdata('success', 'Data Grafik Realisasi Investasi berhasil diperbarui.');
    //     } else {
    //         $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
    //     }

    //     redirect('admin/grafik_realisasi_investasi', 'refresh');
    // }

    public function edit_tahun()
    {
        $id_grafik = $this->input->post('id_grafik', true);
        $tahun     = $this->input->post('tahun', true);
        // 🔥 Tangkap Edit Target dari form
        $nilai     = (float)$this->input->post('nilai', true);

        if (empty($tahun)) {
            $this->session->set_flashdata('error', 'Tahun wajib diisi!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // VALIDASI DUPLIKAT (Kecuali ID ini sendiri)
        $cek = $this->db->get_where('grafik_investasi', [
            'tahun' => $tahun,
            'tipe' => 'tahun',
            'id_grafik !=' => $id_grafik
        ]);

        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Tahun tersebut sudah ada!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // UPDATE DATA TAHUN (PARENT)
        $this->db->where('id_grafik', $id_grafik);
        // 🔥 Tambahkan 'nilai' (Target) untuk di-update
        $this->db->update('grafik_investasi', ['tahun' => $tahun, 'nilai' => $nilai]);

        // CASCADE UPDATE: Update juga kolom 'tahun' di semua data JENIS (anaknya)
        $this->db->where('parent_id', $id_grafik);
        $this->db->update('grafik_investasi', ['tahun' => $tahun]);

        $this->session->set_flashdata('success', 'Data Tahun dan Target berhasil diupdate.');
        redirect('admin/grafik_realisasi_investasi');
    }

    public function edit_jenis()
    {
        $id_grafik = $this->input->post('id_grafik', true);
        $parent_id = $this->input->post('parent_id', true);
        $jenis     = trim($this->input->post('jenis_investasi', true));

        // 🔥 HAPUS baris $nilai (Target), karena Jenis hanya mengubah Realisasi
        $nilai2    = (float)$this->input->post('nilai2', true);

        if (empty($parent_id) || empty($jenis)) {
            $this->session->set_flashdata('error', 'Tahun dan Jenis wajib diisi!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // AMBIL DATA TAHUN DARI PARENT BARU (Jika usernya mengganti tahun saat edit)
        $parent = $this->db->get_where('grafik_investasi', ['id_grafik' => $parent_id])->row();
        $tahun_parent = $parent ? $parent->tahun : '';

        // VALIDASI DUPLIKAT (Cegah nama jenis yang sama di tahun yang sama, kecuali dirinya sendiri)
        $cek = $this->db->get_where('grafik_investasi', [
            'parent_id' => $parent_id,
            'jenis_investasi' => $jenis,
            'tipe' => 'jenis',
            'id_grafik !=' => $id_grafik
        ]);

        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Jenis investasi ini sudah ada di tahun tersebut!');
            redirect('admin/grafik_realisasi_investasi');
        }

        // UPDATE DATA
        $data = [
            'tahun'           => $tahun_parent,
            'jenis_investasi' => $jenis,
            'nilai2'          => $nilai2, // Update Realisasi ke sini
            'parent_id'       => $parent_id
        ];

        $this->db->where('id_grafik', $id_grafik);
        $result = $this->db->update('grafik_investasi', $data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Jenis Investasi berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data.');
        }

        redirect('admin/grafik_realisasi_investasi');
    }

    public function edit_periode()
    {
        $id = $this->input->post('id', true);
        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);

        $data = array(
            'id_periode' => $id,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );

        $result = $this->Model_grafik_investasi->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Periode Grafik Realisasi Investasi berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }

    public function hapus($id)
    {
        // 1. Ambil data baris yang akan dihapus untuk mengetahui tipenya
        $query = $this->db->get_where('grafik_investasi', ['id_grafik' => $id]);

        if ($query->num_rows() > 0) {
            $data_hapus = $query->row();

            // 2. Eksekusi hapus di Model (Model sudah otomatis menangani parent/child)
            $result = $this->Model_grafik_investasi->delete($id);

            if ($result) {
                // 3. Tentukan pesan sukses berdasarkan tipe data yang baru saja dihapus
                if ($data_hapus->tipe == 'tahun') {
                    $this->session->set_flashdata('success', 'Data Tahun beserta Jenis Investasinya berhasil dihapus.');
                } else {
                    $this->session->set_flashdata('success', 'Data Jenis Investasi berhasil dihapus.');
                }
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_realisasi_investasi', 'refresh');
    }
}
