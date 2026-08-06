<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
{
    // Tabel yang digunakan di database
    private $_table = 'user';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk memvalidasi login (sudah sangat aman dengan BCRYPT)
    public function login_secure($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->_table);

        if ($query->num_rows() === 1) {
            $user = $query->row();
            // Cek kecocokan hash password
            if (password_verify($password, $user->password)) {
                return $user; // Akan mengembalikan seluruh data (termasuk role & divisi)
            }
        }
        return FALSE;
    }

    public function cek_user($data)
    {
        $this->db->where($data);
        return $this->db->get($this->_table);
    }

    // Mengubah status online (1 = Online, 0 = Offline)
    public function update_online_status($id, $status)
    {
        $this->db->set('online', $status);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }

    // Menampilkan seluruh daftar pengguna (Untuk halaman Admin -> Kelola User)
    public function tampil_semua_data()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    // Mengambil 1 data spesifik berdasarkan ID (Untuk Edit User)
    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->_table)->row();
    }

    // Menambahkan User Baru (Data role dan divisi otomatis ikut masuk dari $data)
    public function insert_user($data)
    {
        // Enkripsi password secara otomatis sebelum disimpan
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return $this->db->insert($this->_table, $data);
    }

    // Memperbarui User (Termasuk update role dan divisi)
    public function update_user($id, $data)
    {
        // Enkripsi password baru jika diisi, jika kosong jangan ubah password lama
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']); // Hapus elemen password dari array agar tidak ikut terupdate kosong
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
