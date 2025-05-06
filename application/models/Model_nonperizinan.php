<?php

class Model_nonperizinan extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('nonperizinan');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_izin', 'idmax');
        $this->db->from('nonperizinan');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('nonperizinan', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_izin', $id);
        return $this->db->update('nonperizinan', $data);
    }

    public function delete($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        return $this->db->delete('nonperizinan');
    }
}
