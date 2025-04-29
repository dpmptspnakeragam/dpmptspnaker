<?php

class Model_potensi_investasi extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('id_investasi, nama_investasi, GROUP_CONCAT(gambar) as gambar, GROUP_CONCAT(deskripsi) as deskripsi');
        $this->db->from('potensi_investasi');
        $this->db->group_by('id_investasi, nama_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function informasi()
    {
        $this->db->select('*');
        $this->db->from('potensi_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_investasi', 'idmax');
        $this->db->from('potensi_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        $this->db->insert('potensi_investasi', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_investasi', $id);
        $this->db->update('potensi_investasi', $data);
    }

    public function delete($id_investasi)
    {
        $this->db->where('id_investasi', $id_investasi);
        $this->db->delete('potensi_investasi');
    }

    public function tampil_investasi_pagination($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('potensi_investasi');
        $this->db->order_by('id_investasi', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function hitung_investasi()
    {
        $this->db->select('*');
        $this->db->from('potensi_investasi');
        $query = $this->db->get()->num_rows();
        return $query;
    }
}
