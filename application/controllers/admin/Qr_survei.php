<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qr_survei extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in_utama') !== TRUE) {
            redirect('login');
        }

        $role_user = $this->session->userdata('role');

        if ($role_user !== 'Administrator') {
            redirect('admin/home');
        }

        $this->load->model('Model_qr_survei');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'QR Survei';

        $data['qr_survei'] = $this->Model_qr_survei->tampil_semua_data();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/qr_survei', $data);

        $this->load->view('modal/tambah/qr_survei');
        $this->load->view('modal/edit/qr_survei', $data);
        $this->load->view('modal/hapus/qr_survei', $data);

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
                'link_survei' => $this->input->post('link_survei'),
                'qr_code' => $upload_data['file_name'],
                'status' => $this->input->post('status')
            ];

            $result = $this->Model_qr_survei->insert($data);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survei berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Penambahan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survei', 'refresh');
    }

    public function ubah($id)
    {
        $survei = $this->Model_qr_survei->get_by_id($id);

        if ($survei) {
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10048;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $data = [
                'link_survei' => $this->input->post('link_survei'),
                'status' => $this->input->post('status')
            ];

            if (!empty($_FILES['qr_code']['name'])) {
                if ($this->upload->do_upload('qr_code')) {
                    $path_lama = './assets/imgupload/' . $survei->qr_code;
                    if (!empty($survei->qr_code) && file_exists($path_lama)) {
                        unlink($path_lama);
                    }

                    $upload_data = $this->upload->data();
                    $data['qr_code'] = $upload_data['file_name'];
                }
            }

            $result = $this->Model_qr_survei->update($id, $data);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survei berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Pembaruan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survei', 'refresh');
    }

    public function hapus($id)
    {
        $survei = $this->Model_qr_survei->get_by_id($id);

        if ($survei) {
            $path_gambar = './assets/imgupload/' . $survei->qr_code;

            if (!empty($survei->qr_code) && file_exists($path_gambar)) {
                unlink($path_gambar);
            }

            $result = $this->Model_qr_survei->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data QR Survei berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        }

        redirect('admin/qr_survei', 'refresh');
    }
}
