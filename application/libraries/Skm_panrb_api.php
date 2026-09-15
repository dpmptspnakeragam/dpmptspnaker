<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skm_panrb_api
{
    protected $ci;
    private $api_token;
    private $base_url;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->api_token = 'cfbac07ee39c9f0d429fd97b245b55dca48a9948f6bfc131e01161d31fac6353';
        $this->base_url  = 'https://skm.go.id/api/v3';
    }

    private function request($endpoint, $method = 'GET', $data = [])
    {
        $url = $this->base_url . '/' . ltrim($endpoint, '/');

        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        $ch = curl_init();

        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $this->api_token,
                'Accept: application/json',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
            ],
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST]       = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
            $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
        }

        curl_setopt_array($ch, $options);

        $response  = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_err  = curl_error($ch);
        curl_close($ch);

        if ($curl_err) {
            return ['code' => 500, 'message' => 'cURL Error: ' . $curl_err, 'data' => []];
        }

        $result = json_decode(trim($response), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'code'    => $http_code,
                'message' => 'Response bukan JSON valid',
                'raw'     => $response,
                'data'    => []
            ];
        }

        return $result;
    }

    public function get_list_survey($startDate = '', $endDate = '')
    {
        $params = [];
        if (!empty($startDate)) $params['startDate'] = $startDate; // Format: DD-MM-YYYY
        if (!empty($endDate))   $params['endDate']   = $endDate;   // Format: DD-MM-YYYY

        return $this->request('get-list-survey', 'GET', $params);
    }

    public function get_nilai_hasil_survey($startDate = '', $endDate = '')
    {
        $params = [];
        if (!empty($startDate)) $params['startDate'] = $startDate;
        if (!empty($endDate))   $params['endDate']   = $endDate;

        return $this->request('get-nilai-hasil-survey', 'GET', $params);
    }
}
