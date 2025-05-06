<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_spkp_antikorupsi extends CI_Model
{

    public function get_data_rating($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('spkp.*, IFNULL(spak.r1, 0) AS r1, IFNULL(spak.r2, 0) AS r2, IFNULL(spak.r3, 0) AS r3, IFNULL(spak.r4, 0) AS r4, IFNULL(spak.r5, 0) AS r5, IFNULL(spkp.z1, 0) AS z1, IFNULL(spkp.z2, 0) AS z2, IFNULL(spkp.z3, 0) AS z3, IFNULL(spkp.z4, 0) AS z4, IFNULL(spkp.z5, 0) AS z5, IFNULL(spkp.z6, 0) AS z6, IFNULL(spkp.z7, 0) AS z7, IFNULL(spkp.z8, 0) AS z8');
        $this->db->from('spkp');
        $this->db->join('spak', 'spkp.id_spkp = spak.id_spkp', 'left');
        $this->db->where('MONTH(spkp.date) >=', $awalBulan);
        $this->db->where('MONTH(spkp.date) <=', $akhirBulan);
        $this->db->where('YEAR(spkp.date) >=', $awalTahun);
        $this->db->where('YEAR(spkp.date) <=', $akhirTahun);
        $this->db->order_by('spkp.date', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filter_data_spkp_spak($bulan_awal, $bulan_akhir, $tahun)
    {
        $this->db->select('spkp.*, IFNULL(spak.r1, 0) AS r1, IFNULL(spak.r2, 0) AS r2, IFNULL(spak.r3, 0) AS r3, IFNULL(spak.r4, 0) AS r4, IFNULL(spak.r5, 0) AS r5, IFNULL(spkp.z1, 0) AS z1, IFNULL(spkp.z2, 0) AS z2, IFNULL(spkp.z3, 0) AS z3, IFNULL(spkp.z4, 0) AS z4, IFNULL(spkp.z5, 0) AS z5, IFNULL(spkp.z6, 0) AS z6, IFNULL(spkp.z7, 0) AS z7, IFNULL(spkp.z8, 0) AS z8');
        $this->db->from('spkp');
        $this->db->join('spak', 'spkp.id_spkp = spak.id_spkp', 'left');
        $this->db->where('MONTH(spkp.date) >=', $bulan_awal);
        $this->db->where('MONTH(spkp.date) <=', $bulan_akhir);
        $this->db->where('YEAR(spkp.date)', $tahun);
        $this->db->order_by('spkp.date', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function total_responden($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->from('spkp');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $total = $this->db->count_all_results();
        return $total;
    }

    public function get_rating_spkp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $ratings = [];

        // Mengambil data dari tabel 'spkp'
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get('spkp');
        $results = $query->result_array();

        // Inisialisasi total bintang untuk nilai 1-6
        $total_bintang = [0, 0, 0, 0, 0, 0];

        // Menghitung total bintang untuk setiap nilai (1-6)
        foreach ($results as $result) {
            for ($i = 1; $i <= 8; $i++) { // Ubah dari 1-8 sesuai dengan kolom z1 - z8
                $field = "z$i";
                if ($result[$field] >= 1 && $result[$field] <= 6) { // Hanya menghitung bintang 1-6
                    $total_bintang[$result[$field] - 1]++;
                }
            }
        }

        // Menghitung total jawaban
        $total_jawaban = array_sum($total_bintang);

        // Menghitung persentase untuk setiap nilai (1-6) jika total jawaban tidak nol
        if ($total_jawaban != 0) {
            for ($i = 0; $i < 6; $i++) {
                $percentage = ($total_bintang[$i] / $total_jawaban) * 100;
                $ratings[$i + 1] = ['total' => $total_bintang[$i], 'percentage' => round($percentage, 2)];
            }
        } else {
            // Jika total jawaban nol, kosongkan nilai persentase
            for ($i = 0; $i < 6; $i++) {
                $ratings[$i + 1] = ['total' => $total_bintang[$i], 'percentage' => 0];
            }
        }

        return $ratings;
    }

    public function get_rating_antikorupsi($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $ratings = [];

        // Mengambil data dari tabel 'spak'
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get('spak');
        $results = $query->result_array();

        // Inisialisasi total bintang untuk nilai 1-6
        $total_bintang = [0, 0, 0, 0, 0, 0];

        // Menghitung total bintang untuk setiap nilai (1-6) dari kolom r1 hingga r5
        foreach ($results as $result) {
            for ($i = 1; $i <= 5; $i++) { // Ubah dari 1-5 sesuai dengan kolom r1 - r5
                $field = "r$i";
                if (isset($result[$field]) && $result[$field] >= 1 && $result[$field] <= 6) { // Hanya menghitung bintang 1-6
                    $total_bintang[$result[$field] - 1]++;
                }
            }
        }

        // Menghitung total jawaban
        $total_jawaban = array_sum($total_bintang);

        // Menghitung persentase untuk setiap nilai (1-6) jika total jawaban tidak nol
        if ($total_jawaban != 0) {
            for ($i = 0; $i < 6; $i++) {
                $percentage = ($total_bintang[$i] / $total_jawaban) * 100;
                $ratings[$i + 1] = ['total' => $total_bintang[$i], 'percentage' => round($percentage, 2)];
            }
        } else {
            // Jika total jawaban nol, kosongkan nilai persentase
            for ($i = 0; $i < 6; $i++) {
                $ratings[$i + 1] = ['total' => $total_bintang[$i], 'percentage' => 0];
            }
        }

        return $ratings;
    }

    public function hapus_data_terkait($id_spkp)
    {
        $this->db->trans_start();

        $this->db->select('id_skm');
        $this->db->where('id_spkp', $id_spkp);
        $skm_ids = $this->db->get('spak')->result_array();

        if (!empty($skm_ids)) {
            $skm_ids = array_column($skm_ids, 'id_skm');

            $this->db->where_in('id_skm', $skm_ids);
            $this->db->delete('skm');
        }

        $this->db->where('id_spkp', $id_spkp);
        $this->db->delete('spak');

        $this->db->where('id_spkp', $id_spkp);
        $this->db->delete('spkp');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_data_by_id($id_spkp)
    {
        $this->db->select('spkp.*, spak.*, skm.*'); // Memilih semua kolom dari kedua tabel
        $this->db->from('spkp');
        $this->db->where('spkp.id_spkp', $id_spkp); // Menggunakan alias untuk kolom id_spkp
        $this->db->join('spak', 'spak.id_spkp = spkp.id_spkp', 'left'); // Menggunakan alias untuk penggabungan
        $this->db->join('skm', 'skm.id_skm = spkp.id_spkp', 'left'); // Menggunakan alias untuk penggabungan
        $query = $this->db->get();
        return $query->result();
    }

    // Nilai Survey
    public function get_avg_z($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('AVG(z1) as avg_z1, AVG(z2) as avg_z2, AVG(z3) as avg_z3, AVG(z4) as avg_z4, AVG(z5) as avg_z5, AVG(z6) as avg_z6, AVG(z7) as avg_z7, AVG(z8) as avg_z8');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get('spkp')->row();
        return $query;
    }

    public function get_avg_r($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('AVG(r1) as avg_r1, AVG(r2) as avg_r2, AVG(r3) as avg_r3, AVG(r4) as avg_r4, AVG(r5) as avg_r5');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get('spak')->row();
        return $query;
    }
}

/* End of file Model_spkp_antikorupsi.php */
