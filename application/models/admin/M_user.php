<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

    public function tampil_semua_data()
    {
        return $this->db->get('user')->result();
    }
}

/* End of file M_user.php */
