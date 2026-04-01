<?php

class Model_grafik_investasi extends CI_model
{
    public function tampil_data()
    {
        $sql = "
        SELECT 
            p.id_grafik,
            p.tahun,
            p.nilai,
            (SELECT COALESCE(SUM(nilai2), 0) FROM grafik_investasi WHERE parent_id = p.id_grafik AND tipe = 'jenis') AS nilai2,
            
            -- 🔥 PERBAIKAN: Tambahkan CONVERT(jenis_investasi USING utf8) agar tidak bentrok dengan utf8
            (SELECT GROUP_CONCAT(CONCAT(CONVERT(jenis_investasi USING utf8), ': ', FORMAT(nilai2, 2, 'id_ID')) SEPARATOR ' | ') 
             FROM grafik_investasi 
             WHERE parent_id = p.id_grafik AND tipe = 'jenis') as rincian_jenis,
             
            p.tipe
        FROM grafik_investasi p
        WHERE p.tipe = 'tahun'
        ORDER BY p.tahun ASC
        ";

        return $this->db->query($sql);
    }

    // 🔥 PERBAIKAN 2: Menambahkan perhitungan otomatis (SUM) untuk nilai parent (Tahun)
    public function get_all_data()
    {
        $sql = "
        SELECT 
            p.id_grafik,
            p.tahun,
            p.nilai, -- 🔥 PERBAIKAN: Ambil nilai asli milik Parent (Target)
            (SELECT COALESCE(SUM(nilai2), 0) FROM grafik_investasi WHERE parent_id = p.id_grafik AND tipe = 'jenis') AS nilai2, -- Ambil SUM(Realisasi) dari anak
            NULL AS jenis_investasi,
            p.parent_id,
            p.tipe,
            0 AS level
        FROM grafik_investasi p
        WHERE p.tipe = 'tahun'

        UNION ALL

        SELECT 
            c.id_grafik,
            c.tahun,
            c.nilai,
            c.nilai2,
            c.jenis_investasi,
            c.parent_id,
            c.tipe,
            1 AS level
        FROM grafik_investasi c
        WHERE c.tipe = 'jenis'

        ORDER BY tahun ASC, level ASC
        ";

        return $this->db->query($sql);
    }

    public function tampil_data_periode()
    {
        $this->db->select('*');
        $this->db->from('periode_grafik_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_grafik', 'idmax');
        $this->db->from('grafik_investasi');
        $query = $this->db->get();
        return $query;
    }

    // 🔥 PERBAIKAN 2 (Sama dengan get_all_data)
    public function get_investasi_bertingkat()
    {
        $sql = "
        SELECT 
            p.id_grafik,
            p.tahun,
            (SELECT COALESCE(SUM(nilai), 0) FROM grafik_investasi WHERE parent_id = p.id_grafik) AS nilai,
            (SELECT COALESCE(SUM(nilai2), 0) FROM grafik_investasi WHERE parent_id = p.id_grafik) AS nilai2,
            NULL AS jenis_investasi,
            0 AS level
        FROM grafik_investasi p
        WHERE p.tipe = 'tahun'

        UNION ALL

        SELECT 
            c.id_grafik,
            c.tahun,
            c.nilai,
            c.nilai2,
            c.jenis_investasi,
            1 AS level
        FROM grafik_investasi c
        WHERE c.tipe = 'jenis'

        ORDER BY tahun ASC, level ASC
        ";

        return $this->db->query($sql);
    }

    public function input($data)
    {
        return $this->db->insert('grafik_investasi', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return $this->db->update('grafik_investasi', $data);
    }

    public function update_periode($data, $id)
    {
        $this->db->where('id_periode', $id);
        return $this->db->update('periode_grafik_investasi', $data);
    }

    // 🔥 PERBAIKAN 3: Cascade Delete (Hapus anak-anaknya juga saat Parent dihapus)
    public function delete($id_grafik)
    {
        // 1. Cek dulu apakah data ini punya child/anak (Sebagai Parent)
        $this->db->where('parent_id', $id_grafik);
        $this->db->delete('grafik_investasi');

        // 2. Hapus dirinya sendiri (Berlaku untuk menghapus Parent maupun menghapus Jenis saja)
        $this->db->where('id_grafik', $id_grafik);
        return $this->db->delete('grafik_investasi');
    }
}
