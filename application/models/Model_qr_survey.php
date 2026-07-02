<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_qr_survey extends CI_Model
{
    private $table = 'survey_skm';

    public function tampil_semua_data()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_active_survey()
    {
        $this->db->where('status', 'aktif');
        return $this->db->get($this->table)->row();
    }

    public function get_by_id($id)
    {
        $this->db->where('id_survey', $id);
        return $this->db->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_survey', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id_survey', $id);
        return $this->db->delete($this->table);
    }
}
/* End of file Model_qr_survey.php */