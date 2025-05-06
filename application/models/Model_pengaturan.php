<?php

class Model_pengaturan extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('setting_dinas');
        $query = $this->db->get();
        return $query;
    }

    public function update($data, $id)
    {
        $this->db->where('id_setting', $id);
        return $this->db->update('setting_dinas', $data);
    }
}
