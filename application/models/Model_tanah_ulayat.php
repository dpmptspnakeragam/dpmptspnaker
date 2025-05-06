<?php

class Model_tanah_ulayat extends CI_model
{
    public function tampil_data($id_kecamatan)
    {
        $this->db->select('*');
        $this->db->from('tanah_ulayat');
        $this->db->where('kecamatan', $id_kecamatan);
        $query = $this->db->get();
        return $query;
    }

    public function tampil_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $query = $this->db->get();
        return $query;
    }

    public function get_kecamatan($id_kecamatan)
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where('id_kecamatan', $id_kecamatan);
        $query = $this->db->get();
        return $query->row();
    }

    public function input($data)
    {
        return $this->db->insert('tanah_ulayat', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_ulayat', $id);
        return $this->db->update('tanah_ulayat', $data);
    }

    public function delete($id_ulayat)
    {
        $this->db->where('id_ulayat', $id_ulayat);
        return $this->db->delete('tanah_ulayat');
    }
}
