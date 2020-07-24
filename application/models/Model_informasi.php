<?php

class Model_informasi extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('tgl_berita', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function idmax()
    {
        $this->db->select_max('id_berita', 'idmax');
        $this->db->from('berita');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        $this->db->insert('berita', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_berita', $id);
        $this->db->update('berita', $data);
    }

    public function delete($id_berita)
    {
        $this->db->where('id_berita', $id_berita);
        $this->db->delete('berita');
    }

    public function tampil_berita_pagination($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('id_berita', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function hitung_berita()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $query = $this->db->get()->num_rows();
        return $query;
    }
}