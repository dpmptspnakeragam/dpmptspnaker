<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qr_survey extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_qr_survey');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'QR Survey';

        $data['qr_survei'] = $this->Model_qr_survey->tampil_semua_data();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/qr_survey', $data);

        $this->load->view('modal/tambah/qr_survey');
        $this->load->view('modal/edit/qr_survey', $data);
        $this->load->view('modal/hapus/qr_survey', $data);

        $this->load->view('templates/admin_footer');
    }

    public function simpan()
    {
        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 10048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('qr_code')) {
            $upload_data = $this->upload->data();

            $data = [
                'link_survey' => $this->input->post('link_survey'),
                'qr_code' => $upload_data['file_name'],
                'status' => $this->input->post('status')
            ];

            $result = $this->Model_qr_survey->insert($data);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survey berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Penambahan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survey', 'refresh');

    }

    public function ubah($id)
    {
        $survey = $this->Model_qr_survey->get_by_id($id);

        if ($survey) {
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10048;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $data = [
                'link_survey' => $this->input->post('link_survey'),
                'status' => $this->input->post('status')
            ];

            if (!empty($_FILES['qr_code']['name'])) {
                if ($this->upload->do_upload('qr_code')) {
                    $path_lama = './assets/imgupload/' . $survey->qr_code;
                    if (!empty($survey->qr_code) && file_exists($path_lama)) {
                        unlink($path_lama);
                    }

                    $upload_data = $this->upload->data();
                    $data['qr_code'] = $upload_data['file_name'];
                }
            }

            $result = $this->Model_qr_survey->update($id, $data);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survey berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Pembaruan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survey', 'refresh');

    }

    public function hapus($id)
    {
        $survey = $this->Model_qr_survey->get_by_id($id);

        if ($survey) {
            $path_gambar = './assets/imgupload/' . $survey->qr_code;

            if (!empty($survey->qr_code) && file_exists($path_gambar)) {
                unlink($path_gambar);
            }

            $result = $this->Model_qr_survey->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survey berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survey', 'refresh');
    }

}
