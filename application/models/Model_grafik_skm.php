<?php

class Model_grafik_skm extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('grafik_skm');
        $this->db->group_by('tahun');
        $query = $this->db->get();
        return $query;
    }

    public function tampil_data_periode()
    {
        $this->db->select('*');
        $this->db->from('periode_grafik_skm');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_grafik', 'idmax');
        $this->db->from('grafik_skm');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return  $this->db->insert('grafik_skm', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return $this->db->update('grafik_skm', $data);
    }

    public function update_periode($data, $id)
    {
        $this->db->where('id_periode', $id);
        return $this->db->update('periode_grafik_skm', $data);
    }

    public function delete($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return $this->db->delete('grafik_skm');
    }
}
