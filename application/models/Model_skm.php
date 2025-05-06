<?php

class Model_skm extends CI_model
{
    public function get_data_skm($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('*');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->order_by('date', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_filter_data_skm($bulan_awal, $bulan_akhir, $tahun)
    {
        $this->db->select('*');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $bulan_awal);
        $this->db->where('MONTH(date) <=', $bulan_akhir);
        $this->db->where('YEAR(date)', $tahun);
        $this->db->order_by('date', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function tampil_data($id_kecamatan)
    {
        $this->db->select('*');
        $this->db->from('skm');
        $this->db->where('kecamatan', $id_kecamatan);
        $query = $this->db->get();
        return $query;
    }

    public function tampil_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $query = $this->db->get();
        return $query;
    }

    public function get_kecamatan($id_kecamatan)
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $query = $this->db->get();
        return $query;
    }

    public function idmax_skm()
    {
        $this->db->select_max('id_skm', 'idmax_skm');
        $this->db->from('skm');
        $query = $this->db->get();
        return $query;
    }

    public function idmax_rating()
    {
        $this->db->select_max('id_spkp', 'idmax_rating');
        $this->db->from('spkp');
        $query = $this->db->get();
        return $query;
    }

    public function idmax_spak()
    {
        $this->db->select_max('id_spak', 'idmax_spak');
        $this->db->from('spak');
        $query = $this->db->get();
        return $query;
    }

    public function simpan_skm($data_skm)
    {
        $this->db->insert('skm', $data_skm);
    }

    public function simpan_spak($data_spak)
    {
        $this->db->insert('spak', $data_spak);
    }

    public function simpan_spkp($data_spkp)
    {
        $this->db->insert('spkp', $data_spkp);
    }

    public function update($data, $id)
    {
        $this->db->where('id_ulayat', $id);
        $this->db->update('skm', $data);
    }

    public function delete($id_ulayat)
    {
        $this->db->where('id_ulayat', $id_ulayat);
        $this->db->delete('skm');
    }

    //--------------------------------------Hitung Data

    public function jmlh_data($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(*) as jmlh_data');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->jmlh_data;
        return $query;
    }

    public function jmlh_lk($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(jk) as jmlh_lk');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('jk', '1');
        $query = $this->db->get()->row()->jmlh_lk;
        return $query;
    }

    public function jmlh_pr($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(jk) as jmlh_pr');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('jk', '2');
        $query = $this->db->get()->row()->jmlh_pr;
        return $query;
    }

    //---------------------------Jumlah data pendidikan

    public function jmlh_sd($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_sd');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '1');
        $query = $this->db->get()->row()->jmlh_sd;
        return $query;
    }

    public function jmlh_smp($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_smp');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '2');
        $query = $this->db->get()->row()->jmlh_smp;
        return $query;
    }

    public function jmlh_sma($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_sma');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '3');
        $query = $this->db->get()->row()->jmlh_sma;
        return $query;
    }

    public function jmlh_d1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_d1');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '4');
        $query = $this->db->get()->row()->jmlh_d1;
        return $query;
    }

    public function jmlh_s1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_s1');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '5');
        $query = $this->db->get()->row()->jmlh_s1;
        return $query;
    }

    public function jmlh_s2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pendidikan) as jmlh_s2');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pendidikan', '6');
        $query = $this->db->get()->row()->jmlh_s2;
        return $query;
    }

    //---------------------------Hitung Data Pekerjaan

    public function jmlh_pns($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_pns');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '1');
        $query = $this->db->get()->row()->jmlh_pns;
        return $query;
    }

    public function jmlh_tni($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_tni');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '2');
        $query = $this->db->get()->row()->jmlh_tni;
        return $query;
    }

    public function jmlh_polri($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_polri');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '3');
        $query = $this->db->get()->row()->jmlh_polri;
        return $query;
    }

    public function jmlh_swasta($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_swasta');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '4');
        $query = $this->db->get()->row()->jmlh_swasta;
        return $query;
    }

    public function jmlh_wirausaha($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_wirausaha');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '5');
        $query = $this->db->get()->row()->jmlh_wirausaha;
        return $query;
    }

    public function jmlh_lainnya($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Count(pekerjaan) as jmlh_lainnya');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $this->db->where('pekerjaan', '6');
        $query = $this->db->get()->row()->jmlh_lainnya;
        return $query;
    }

    //---------------------------Hitung Nilai SKM

    public function avg_u1($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u1) as avg_u1');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u1;
        return $query;
    }

    public function avg_u2($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u2) as avg_u2');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u2;
        return $query;
    }

    public function avg_u3($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u3) as avg_u3');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u3;
        return $query;
    }

    public function avg_u4($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u4) as avg_u4');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u4;
        return $query;
    }

    public function avg_u5($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u5) as avg_u5');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u5;
        return $query;
    }

    public function avg_u6($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u6) as avg_u6');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u6;
        return $query;
    }

    public function avg_u7($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u7) as avg_u7');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u7;
        return $query;
    }

    public function avg_u8($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u8) as avg_u8');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u8;
        return $query;
    }

    public function avg_u9($awalBulan, $akhirBulan, $awalTahun, $akhirTahun)
    {
        $this->db->select('Avg(u9) as avg_u9');
        $this->db->from('skm');
        $this->db->where('MONTH(date) >=', $awalBulan);
        $this->db->where('MONTH(date) <=', $akhirBulan);
        $this->db->where('YEAR(date) >=', $awalTahun);
        $this->db->where('YEAR(date) <=', $akhirTahun);
        $query = $this->db->get()->row()->avg_u9;
        return $query;
    }

    //--------------------------- Model untuk Admin Pada Tabel SKM
    public function get_data_by_id($id_skm)
    {
        $this->db->where('id_skm', $id_skm);
        $query = $this->db->get('skm');
        return $query->result();
    }

    public function hapus_data_terkait($id_skm)
    {
        $this->db->trans_start();

        $this->db->select('id_spkp');
        $this->db->where('id_skm', $id_skm);
        $spak_ids = $this->db->get('spak')->result_array();

        if (!empty($spak_ids)) {
            $spkp_ids = array_column($spak_ids, 'id_spkp');

            $this->db->where_in('id_spkp', $spkp_ids);
            $this->db->delete('spkp');
        }

        $this->db->where('id_skm', $id_skm);
        $this->db->delete('skm');

        $this->db->where('id_skm', $id_skm);
        $this->db->delete('spak');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
