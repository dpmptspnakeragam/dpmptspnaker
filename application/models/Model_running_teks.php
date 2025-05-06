<?php

class Model_running_teks extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('runningteks');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_teks', 'idmax');
        $this->db->from('runningteks');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('runningteks', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_teks', $id);
        return $this->db->update('runningteks', $data);
    }

    public function delete($id_teks)
    {
        $this->db->where('id_teks', $id_teks);
        return $this->db->delete('runningteks');
    }
}
