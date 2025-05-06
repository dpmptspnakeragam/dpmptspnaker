<?php
class Pesan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pesan');
    }

    public function save_message()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean');
        $this->form_validation->set_rules('device_id', 'Device ID', 'trim|required|xss_clean');


        if ($this->form_validation->run() == false) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $message = $this->input->post('message', true); // Menggunakan xss_clean untuk menghindari XSS
        $device_id = $this->input->post('device_id', true);
        $user_type = 'user';

        // Mendapatkan IP pengguna untuk mencari lokasi
        $ip_address = $this->input->ip_address();
        $location = $this->get_location_by_ip($ip_address); // Fungsi untuk mendapatkan lokasi berdasarkan IP

        // Upload gambar jika ada
        $config['upload_path'] = './assets/fileupload/chat/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 22528; // Maksimal 22 MB (22 * 1024 KB)

        $this->load->library('upload', $config);

        $image_url = null;
        if (!empty($_FILES['image']['name'])) {
            // Periksa ukuran file sebelum upload
            if ($_FILES['image']['size'] > (22 * 1024 * 1024)) { // Ukuran dalam byte
                echo json_encode(['status' => 'error', 'message' => 'Ukuran file tidak boleh lebih dari 22 MB.']);
                return;
            }

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $image_info = getimagesize($_FILES['image']['tmp_name']);
                if ($image_info === false) {
                    echo json_encode(['status' => 'error', 'message' => 'File yang diunggah bukan gambar yang valid.']);
                    return;
                }

                $image_url = base_url('assets/fileupload/chat/' . $uploadData['file_name']);
            } else {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            }
        }

        if (empty($message) && !$image_url) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan masukkan pesan atau pilih gambar yang akan dikirim.']);
            return;
        }

        // Panggil model untuk menyimpan pesan dan lokasi
        $result = $this->Model_pesan->insert_message($user_type, $message, $image_url, $location, $device_id); // Pass lokasi ke model
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }

    private function get_location_by_ip($ip)
    {
        // Contoh menggunakan ip-api (API gratis terbatas)
        $api_url = "http://ip-api.com/json/{$ip}";
        $response = file_get_contents($api_url);
        $location_data = json_decode($response, true);

        // Mengecek jika API mengembalikan data yang valid
        if ($location_data && $location_data['status'] === 'fail') {
            return null; // Jika gagal, kembalikan null
        }

        // Mengambil informasi lokasi yang diperlukan (misalnya, negara, kota)
        $location = isset($location_data['city']) ? $location_data['city'] : 'Unknown';
        $location .= ', ' . (isset($location_data['country']) ? $location_data['country'] : 'Unknown');

        return $location;
    }

    public function load_messages()
    {
        $last_id = $this->input->get('last_id');
        $device_id = $this->input->get('device_id');
        $ipAddress = $this->input->ip_address();

        if (empty($device_id)) {
            echo json_encode([]);
            return;
        }

        $messages = $this->Model_pesan->get_messages($last_id, $device_id, $ipAddress);
        $admins = $this->Model_pesan->get_online_admins();

        echo json_encode([
            'messages' => $messages,
            'admins' => $admins,
        ]);
    }
}
