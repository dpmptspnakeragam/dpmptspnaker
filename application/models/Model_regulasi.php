<?php

class Model_regulasi extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('regulasi');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_regulasi', 'idmax');
        $this->db->from('regulasi');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('regulasi', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_regulasi', $id);
        return $this->db->update('regulasi', $data);
    }

    public function delete($id_regulasi)
    {
        $this->db->where('id_regulasi', $id_regulasi);
        return $this->db->delete('regulasi');
    }
}
