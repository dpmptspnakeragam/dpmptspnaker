<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_sop extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('sop')->result();
    }

    public function idmax()
    {
        $this->db->select_max('id_sop', 'idmax');
        $this->db->from('sop');
        $query = $this->db->get();
        return $query;
    }

    public function tambah_data($data)
    {
        return $this->db->insert('sop', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_sop', $id);
        return $this->db->update('sop', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id_sop', $id);
        return $this->db->delete('sop');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('sop', ['id_sop' => $id])->row();
    }
}
/* End of file Model_sop.php */