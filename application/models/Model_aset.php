<?php

class Model_aset extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('aset');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_aset', 'idmax');
        $this->db->from('aset');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('aset', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_aset', $id);
        return $this->db->update('aset', $data);
    }

    public function delete($id_aset)
    {
        $this->db->where('id_aset', $id_aset);
        return $this->db->delete('aset');
    }
}
