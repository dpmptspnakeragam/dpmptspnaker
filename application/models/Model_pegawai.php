<?php

class Model_pegawai extends CI_model
{
    public function tampil_pegawai()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('kabid', 'pegawai.id_kabid = kabid.id_kabid');
        $query = $this->db->get();
        return $query;
    }

    public function tampil_kabid()
    {
        $this->db->select('*');
        $this->db->from('kabid');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_pegawai', 'idmax');
        $this->db->from('pegawai');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        $this->db->insert('pegawai', $data);
    }

    public function update_pegawai($data, $id)
    {
        $this->db->where('id_pegawai', $id);
        $this->db->update('pegawai', $data);
    }

    public function update_kabid($data, $id)
    {
        $this->db->where('id_kabid', $id);
        $this->db->update('kabid', $data);
    }

    public function delete($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('pegawai');
    }
}