<?php

class Model_grafik extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('grafik');
        $this->db->order_by('id_grafik', 'ASC');
        return $this->db->get();
    }

    public function tampil_data_periode()
    {
        $this->db->select('*');
        $this->db->from('periode_grafik');
        return $this->db->get();
    }

    public function idmax()
    {
        $this->db->select_max('id_grafik', 'idmax');
        $this->db->from('grafik');
        return $this->db->get();
    }

    public function input($data)
    {
        return $this->db->insert('grafik', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return $this->db->update('grafik', $data);
    }

    public function update_periode($data, $id)
    {
        $this->db->where('id_periode', $id);
        return $this->db->update('periode_grafik', $data);
    }

    public function delete($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return $this->db->delete('grafik');
    }

    public function get_bidang()
    {
        $this->db->select('*');
        $this->db->from('grafik');
        $this->db->where('tipe', 'bidang');
        $this->db->where('parent_id IS NULL', null, false);
        $this->db->order_by('izin', 'ASC');
        return $this->db->get();
    }

    public function get_jenis_by_parent($parent_id)
    {
        $this->db->select('*');
        $this->db->from('grafik');
        $this->db->where('tipe', 'jenis');
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('izin', 'ASC');
        return $this->db->get();
    }

    public function update_total_bidang($parent_id)
    {
        $this->db->select_sum('jumlah');
        $this->db->from('grafik');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('tipe', 'jenis');
        $query = $this->db->get();

        $total = 0;
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $total = !empty($row->jumlah) ? (int)$row->jumlah : 0;
        }

        $this->db->where('id_grafik', $parent_id);
        return $this->db->update('grafik', array('jumlah' => $total));
    }

    public function get_grafik_bertingkat()
    {
        $sql = "
            SELECT * FROM (
                SELECT
                    p.id_grafik,
                    p.id_grafik AS parent_order,
                    p.izin AS nama_bidang,
                    '' AS jenis_izin,
                    p.jumlah,
                    p.parent_id,
                    0 AS level,
                    'bidang' AS tipe
                FROM grafik p
                WHERE p.tipe = 'bidang' AND p.parent_id IS NULL

                UNION ALL

                SELECT
                    c.id_grafik,
                    c.parent_id AS parent_order,
                    p.izin AS nama_bidang,
                    c.izin AS jenis_izin,
                    c.jumlah,
                    c.parent_id,
                    1 AS level,
                    'jenis' AS tipe
                FROM grafik c
                INNER JOIN grafik p ON p.id_grafik = c.parent_id
                WHERE c.tipe = 'jenis'
            ) AS hasil
            ORDER BY hasil.parent_order ASC, hasil.level ASC, hasil.id_grafik ASC
        ";

        return $this->db->query($sql);
    }

    public function delete_bidang_dan_anak($id_grafik)
    {
        $this->db->where('parent_id', $id_grafik);
        $this->db->delete('grafik');

        $this->db->where('id_grafik', $id_grafik);
        return $this->db->delete('grafik');
    }

    public function get_by_id($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return $this->db->get('grafik');
    }

    public function get_chart_bidang()
    {
        $this->db->select('id_grafik, izin, jumlah');
        $this->db->from('grafik');
        $this->db->where('tipe', 'bidang');
        $this->db->where('parent_id IS NULL', null, false);
        $this->db->order_by('id_grafik', 'ASC');
        return $this->db->get();
    }

    public function get_chart_jenis()
    {
        $sql = "
        SELECT 
            c.id_grafik,
            p.izin AS bidang,
            c.izin AS jenis_izin,
            c.jumlah
        FROM grafik c
        INNER JOIN grafik p ON p.id_grafik = c.parent_id
        WHERE c.tipe = 'jenis'
        ORDER BY p.id_grafik ASC, c.id_grafik ASC
    ";

        return $this->db->query($sql);
    }
}
