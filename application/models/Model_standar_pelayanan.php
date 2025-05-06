<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_standar_pelayanan extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('standar_pelayanan');
        $query = $this->db->get();
        return $query->result();
    }

    public function idmax()
    {
        $this->db->select_max('id_sp', 'idmax');
        $this->db->from('standar_pelayanan');
        $query = $this->db->get();
        return $query;
    }

    public function tambah_data($data)
    {
        return $this->db->insert('standar_pelayanan', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_sp', $id);
        return $this->db->update('standar_pelayanan', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id_sp', $id);
        return $this->db->delete('standar_pelayanan');
    }

    public function get_by_id($id)
    {
        $this->db->where('id_sp', $id);
        $query = $this->db->get('standar_pelayanan');
        return $query->row();
    }
}

/* End of file Model_standar_pelayanan.php */
