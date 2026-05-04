<?php

class Model_ppid extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('ppid');
        $query = $this->db->get();
        return $query;
    }

    public function get_ppid_by_kategori($kategori)
    {
        $this->db->where('kategori', $kategori);
        return $this->db->get('ppid');
    }

    public function idmax()
    {
        $this->db->select_max('id_ppid', 'idmax');
        $this->db->from('ppid');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('ppid', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_ppid', $id);
        return $this->db->update('ppid', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_ppid', $id);
        return $this->db->delete('ppid');
    }
}
