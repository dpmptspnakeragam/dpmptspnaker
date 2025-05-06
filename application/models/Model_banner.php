<?php

class Model_banner extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('banner');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_banner', 'idmax');
        $this->db->from('banner');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('banner', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_banner', $id);
        return $this->db->update('banner', $data);
    }

    public function delete($id_banner)
    {
        $this->db->where('id_banner', $id_banner);
        return $this->db->delete('banner');
    }
}
