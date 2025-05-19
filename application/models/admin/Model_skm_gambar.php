<?php

class Model_skm_gambar extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('skm_gambar');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function idmax()
    {
        $this->db->select_max('id_skm_gambar', 'idmax');
        $this->db->from('skm_gambar');
        $query = $this->db->get();
        return $query;
    }

    public function tambah_data($data)
    {
        return $this->db->insert('skm_gambar', $data);
    }

    public function getGambarById($id)
    {
        return $this->db->get_where('skm_gambar', ['id_skm_gambar' => $id])->row_array();
    }

    public function insertGambar($data)
    {
        return $this->db->insert('skm_gambar', $data);
    }

    public function updateGambar($id, $data)
    {
        $this->db->where('id_skm_gambar', $id);
        return $this->db->update('skm_gambar', $data);
    }

    public function deleteGambar($id)
    {
        $this->db->where('id_skm_gambar', $id);
        return $this->db->delete('skm_gambar');
    }
}
