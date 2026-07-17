<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_user extends CI_Model
{
    private $_table = 'user';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function login_secure($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->_table);

        if ($query->num_rows() === 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return FALSE;
    }
    public function cek_user($data)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where($data);
        return $this->db->get();
    }
    public function update_online_status($id, $status)
    {
        $this->db->set('online', $status);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }
    public function tampil_semua_data()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->_table)->result();
    }
    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row();
    }
    public function insert_user($data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return $this->db->insert($this->_table, $data);
    }
    public function update_user($id, $data)
    {
        // Enkripsi password baru jika diisi, jika kosong jangan ubah password lama
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        $this->db->where('id', $id);
        return $this->db->update($this->_table, $data);
    }
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }
}