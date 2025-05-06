<?php

class Model_peluang_investasi extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('peluang_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function informasi()
    {
        $this->db->select('*');
        $this->db->from('peluang_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_investasi', 'idmax');
        $this->db->from('peluang_investasi');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('peluang_investasi', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_investasi', $id);
        return  $this->db->update('peluang_investasi', $data);
    }

    public function delete($id_investasi)
    {
        $this->db->where('id_investasi', $id_investasi);
        return $this->db->delete('peluang_investasi');
    }

    public function tampil_investasi_pagination($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('peluang_investasi');
        $this->db->order_by('id_investasi', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function hitung_investasi()
    {
        $this->db->select('*');
        $this->db->from('peluang_investasi');
        $query = $this->db->get()->num_rows();
        return $query;
    }
}
