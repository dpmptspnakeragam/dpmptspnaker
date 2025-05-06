<?php
class Pesan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_pesan');
    }

    public function index()
    {
        $device_id = $this->input->get('device_id');

        $messagesByIp = $this->Model_pesan->get_messages_grouped_by_ip_and_device($device_id);

        $data['messagesByIp'] = $messagesByIp;
        $data['home'] = 'Home';
        $data['title'] = 'Pesan';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/pesan', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function load_messages()
    {
        $ipAddress = $this->input->get('ip');
        $deviceId = $this->input->get('device_id');
        $lastMessageId = intval($this->input->get('last_id', true) ?? 0);

        if (empty($ipAddress) || empty($deviceId)) {
            echo json_encode(['status' => 'error', 'message' => 'IP Address atau Device ID tidak valid']);
            return;
        }

        $this->load->model('Model_pesan');
        $this->Model_pesan->mark_as_read_by_ip_and_device($ipAddress, $deviceId);

        $messages = $this->Model_pesan->get_messages_by_ip_and_device($ipAddress, $deviceId, $lastMessageId);

        foreach ($messages as &$message) {
            $message['is_admin'] = ($message['user_type'] === 'admin');
        }

        echo json_encode(['status' => 'success', 'messages' => $messages]);
    }


    // Method to reply to a user's message
    public function reply_message()
    {
        $message_id = $this->input->post('message_id');
        $reply_message = $this->input->post('reply_message');
        $device_id = $this->input->post('device_id');
        $ip = $this->input->post('ip');

        if (empty($message_id) || empty($reply_message) || empty($device_id) || empty($ip)) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap.']);
            return;
        }

        $isReplied = $this->Model_pesan->reply_message($message_id, $reply_message, $device_id, $ip);

        if ($isReplied) {
            echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan. Periksa log untuk detail.']);
        }
    }

    public function load_table_data()
    {
        $timestamp = $this->input->get('timestamp');
        $this->load->model('Model_pesan');

        $newMessages = $this->Model_pesan->get_new_messages($timestamp);

        echo json_encode([
            'newMessages' => !empty($newMessages),
            'messages' => $newMessages,
            'latestTimestamp' => time()
        ]);
    }

    public function delete_messages_and_images_by_ip_and_device()
    {
        $ip = $this->input->post('ip');
        $device_id = $this->input->post('device_id');

        if ($this->Model_pesan->deleteMessagesAndImagesByIpAndDevice($ip, $device_id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // public function mark_all_as_read()
    // {
    //     $ip = $this->input->post('ip'); // Get the IP address from the request

    //     if ($this->Model_pesan->mark_all_as_read_by_ip($ip)) {
    //         echo json_encode(['status' => 'success']);
    //     } else {
    //         echo json_encode(['status' => 'error']);
    //     }
    // }
}
