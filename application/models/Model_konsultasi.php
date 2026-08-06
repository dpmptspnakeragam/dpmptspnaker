<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_konsultasi extends CI_Model
{
    private $_table = 'konsultasi';

    /**
     * 1. Fungsi Membuat Nomor Tiket Otomatis 
     * Dibuat PRIVATE (awalan underscore) agar hanya bisa dipanggil oleh fungsi simpan_data di dalam model ini.
     * Ini menjamin nomor tidak akan dibuat sebelum waktunya (mencegah bentrok).
     */
    private function _generate_tiket()
    {
        $hari_ini = date('Ymd'); // Format: YYYYMMDD

        // Cari nomor tiket terakhir di hari ini
        $this->db->select_max('no_tiket', 'max_tiket');

        // Gunakan 'after' agar pencarian lebih cepat/optimal di database
        $this->db->like('no_tiket', 'KNS-' . $hari_ini, 'after');
        $query = $this->db->get($this->_table);
        $hasil = $query->row();

        // Jika sudah ada tiket hari ini, urutan ditambah 1
        if ($hasil->max_tiket) {
            $urutan = (int) substr($hasil->max_tiket, -3);
            $urutan++;
        } else {
            // Jika belum ada, mulai dari 1
            $urutan = 1;
        }

        // Gabungkan teks KNS, Tanggal, dan Nomor Urut (3 digit)
        return "KNS-" . $hari_ini . "-" . sprintf("%03s", $urutan);
    }

    /**
     * 2. Fungsi Menyimpan Data Konsultasi (Anti Bentrok / Concurrent Safe)
     */
    public function simpan_data($data)
    {
        // MULAI TRANSAKSI: Sistem database "mengunci" tabel sebentar untuk user ini
        $this->db->trans_start();

        // Generate tiket persis di milidetik sebelum data disimpan
        $no_tiket_baru = $this->_generate_tiket();

        // Masukkan nomor tiket ke dalam array data
        $data['no_tiket'] = $no_tiket_baru;

        // Insert ke database
        $this->db->insert($this->_table, $data);

        // SELESAIKAN TRANSAKSI: Sistem melepas "kunci" agar user lain bisa lanjut antre
        $this->db->trans_complete();

        // Cek apakah ada yang gagal selama transaksi
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        // Berhasil! Kembalikan nomor tiket agar bisa ditampilkan di Controller
        return $no_tiket_baru;
    }

    // 3. Fungsi Menampilkan Semua Data (Untuk Tabel Admin)
    public function get_all_konsultasi()
    {
        $this->db->order_by('tanggal_masuk', 'DESC'); // Asumsi Anda punya kolom tanggal_masuk
        return $this->db->get($this->_table)->result();
    }

    // 4. Fungsi Menampilkan 1 Data Berdasarkan ID (Untuk Detail/Proses Admin)
    public function get_konsultasi_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row();
    }

    // 5. Fungsi Menyimpan Balasan/Tindak Lanjut dari Admin
    public function update_tindak_lanjut($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->_table, $data);
    }

    // 6. Fungsi Menghapus Data Konsultasi (Opsional untuk Admin)
    public function delete_konsultasi($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }
}
