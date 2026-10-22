
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_laporan_konsultasi extends CI_Model
{
    public function get_laporan(
        $tgl_mulai = null,
        $tgl_selesai = null,
        $status = null,
        $unit = null,
        $urutan = 'DESC'
    ) {
        $this->db->select('*');
        $this->db->from('konsultasi');

        // Filter rentang tanggal masuk
        if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
            $this->db->where('DATE(tanggal_masuk) >=', $tgl_mulai);
            $this->db->where('DATE(tanggal_masuk) <=', $tgl_selesai);
        }

        // Filter status
        if (!empty($status) && $status !== 'semua') {
            $this->db->where('status', $status);
        }

        // Filter unit operator: PTSP / BLK
        if (!empty($unit) && $unit !== 'ALL') {
            if ($unit === 'PTSP') {
                $this->db->group_start();
                $this->db->like('LOWER(petugas_penerima)', 'ptsp');

                if ($this->db->field_exists('created_by', 'konsultasi')) {
                    $this->db->or_like('LOWER(created_by)', 'ptsp');
                }

                $this->db->group_end();
            } elseif ($unit === 'BLK') {
                $this->db->group_start();
                $this->db->like('LOWER(petugas_penerima)', 'blk');

                if ($this->db->field_exists('created_by', 'konsultasi')) {
                    $this->db->or_like('LOWER(created_by)', 'blk');
                }

                $this->db->group_end();
            }
        }

        // Urutan data
        // ASC  = terlama ke terbaru
        // DESC = terbaru ke terlama
        $urutan = strtoupper($urutan) === 'ASC' ? 'ASC' : 'DESC';

        $this->db->order_by('tanggal_masuk', $urutan);

        return $this->db->get()->result();
    }
}
