<?php
class Model_pesan extends CI_Model
{
    // User
    public function insert_message($user_type, $message, $image_url = null, $location = null, $device_id = null)
    {
        if (empty($message) && !$image_url) {
            return false;
        }

        // Set timezone to Indonesia (Jakarta)
        date_default_timezone_set('Asia/Jakarta');

        // Data untuk disimpan di database
        $data = [
            'user_type' => $this->db->escape_str($user_type), // Bersihkan input
            'message' => $this->db->escape_str($message), // Bersihkan input
            'image_url' => $image_url ? $this->db->escape_str($image_url) : null,
            'is_read' => 0,
            'ip_address' => $this->input->ip_address(),
            'location' => $location ? $this->db->escape_str($location) : null, // Menyimpan lokasi
            'device_id' => $this->db->escape_str($device_id),
            'date' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s")
        ];

        // Menyimpan data ke dalam tabel 'pesan'
        return $this->db->insert('pesan', $data);
    }

    public function get_messages($last_id, $device_id)
    {
        $this->db->where('id >', $last_id);
        $this->db->where('device_id', $device_id);
        $this->db->order_by('id', 'ASC');
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get('pesan');

        return $query->result();
    }

    // Admin
    public function get_messages_grouped_by_ip()
    {
        // Hanya memilih pesan yang dikirim oleh user (bukan admin)
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->where('user_type', 'user'); // Sesuaikan nama kolom jika berbeda
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        $messages = $query->result_array();

        // Mengelompokkan pesan berdasarkan alamat IP
        $groupedMessages = [];
        foreach ($messages as $message) {
            $groupedMessages[$message['ip_address']][] = $message;
        }

        return $groupedMessages;
    }

    public function get_messages_by_ip_and_device($ipAddress, $deviceId, $lastMessageId = 0)
    {
        if (empty($ipAddress) || empty($deviceId)) {
            return []; // Validasi jika data kosong
        }

        $this->db->select('*')
            ->from('pesan')
            ->where('ip_address', $ipAddress)
            ->where('device_id', $deviceId);

        if ($lastMessageId > 0) {
            $this->db->where('id >', intval($lastMessageId));
        }

        $this->db->order_by('id', 'ASC'); // Urutkan berdasarkan ID agar lebih konsisten
        $query = $this->db->get();

        return $query->result_array();
    }

    public function mark_as_read_by_ip($ipAddress)
    {
        $this->db->where('ip_address', $ipAddress);
        $this->db->update('pesan', ['is_read' => 1]); // Tandai sebagai dibaca
    }

    public function reply_message($message_id, $reply_message, $device_id, $ip)
    {
        // Mulai transaksi
        $this->db->trans_start();

        // Validasi data pesan asli
        $query = $this->db->select('device_id, ip_address')
            ->from('pesan')
            ->where('id', $message_id)
            ->get();

        if ($query->num_rows() === 0) {
            return false;
        }

        $originalMessage = $query->row();

        if ($originalMessage->device_id !== $device_id || $originalMessage->ip_address !== $ip) {
            return false;
        }

        // Update pesan dengan balasan
        $this->db->where('id', $message_id)
            ->update('pesan', ['admin_reply' => $reply_message, 'is_read' => 1]);

        if ($this->db->affected_rows() === 0) {
            return false;
        }

        // Tambahkan balasan sebagai pesan baru
        $reply_data = [
            'device_id' => $device_id,
            'ip_address' => $ip,
            'user_type' => 'admin',
            'message' => $reply_message,
            'is_read' => 1,
            'date' => date("Y-m-d"),
            'created_at' => date("Y-m-d H:i:s"),
        ];

        $this->db->insert('pesan', $reply_data);

        if ($this->db->affected_rows() === 0) {
            return false;
        }

        // Selesaikan transaksi
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    public function mark_all_as_read_by_ip($ip)
    {
        $this->db->where('ip_address', $ip);
        $this->db->where('is_read', 0); // Only update unread messages
        $this->db->update('pesan', ['is_read' => 1]);

        return $this->db->affected_rows() > 0;
    }

    public function get_new_messages($timestamp)
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->where('UNIX_TIMESTAMP(created_at) >', $timestamp);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function deleteMessagesAndImagesByIp($ip)
    {
        // Ambil URL gambar yang terkait dengan pesan dari IP tertentu
        $images = $this->db->select('image_url')
            ->where('ip_address', $ip)
            ->where('image_url !=', null)
            ->get('pesan')
            ->result();

        // Hapus file gambar fisik
        foreach ($images as $img) {
            $file_path = FCPATH . 'assets/fileupload/chat/' . basename($img->image_url);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Hapus semua pesan dari database berdasarkan IP
        return $this->db->where('ip_address', $ip)->delete('pesan');
    }
}