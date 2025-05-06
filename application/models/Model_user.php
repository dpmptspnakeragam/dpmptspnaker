<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function cek_user($data)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($data);
        $query = $this->db->get();
        return $query;
    }

    public function update_online_status($id, $status)
    {
        $this->db->set('online', $status);
        $this->db->where('id', $id);
        $this->db->update('user');

        if ($this->db->affected_rows() > 0) {
            log_message('info', "User ID $id status updated to $status");
        } else {
            log_message('error', "Failed to update status for User ID $id");
        }
    }
}
