<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Standar_pelayanan extends CI_controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_standar_pelayanan');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['pdf'] = $this->Model_standar_pelayanan->tampil_data();
        $data['idmax'] = $this->Model_standar_pelayanan->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Standar Pelayanan';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/standar_pelayanan', $data, FALSE);
        $this->load->view('templates/admin_footer');

        $this->load->view('modal/modal_tambah_standar_pelayanan');
        $this->load->view('edit/edit_standar_pelayanan', $data, FALSE);
    }

    public function tambah()
    {
        $file_name = 'sp-' . time();

        $config['upload_path'] = './assets/fileupload/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $file_name;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_name')) {
            $this->session->set_flashdata('gagal', $this->upload->display_errors());
            redirect('admin/standar_pelayanan');
        } else {
            $fileData = $this->upload->data();
            $data = [
                'id_sp' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'file_name' => $fileData['file_name']
            ];

            $result = $this->Model_standar_pelayanan->tambah_data($data);

            if ($result) {
                $this->session->set_flashdata('success', 'File Standar Pelayanan berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Penyimpanan file gagal. Silahkan coba lagi.');
            }
        }
        redirect('admin/standar_pelayanan', 'refresh');
    }

    public function update($id)
    {
        $file_name = 'sp-' . time();
        $config['upload_path'] = './assets/fileupload/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $file_name;
        $this->upload->initialize($config);

        $data = [
            'title' => $this->input->post('title')
        ];

        if ($this->upload->do_upload('file_name')) {
            // Menghapus file lama
            $old_file = $this->Model_standar_pelayanan->get_by_id($id)->file_name;
            if (file_exists('./assets/fileupload/' . $old_file)) {
                unlink('./assets/fileupload/' . $old_file);
            }
            $fileData = $this->upload->data();
            $data['file_name'] = $fileData['file_name'];
        }


        $result = $this->Model_standar_pelayanan->update_data($id, $data);

        if ($result) {
            $this->session->set_flashdata('success', 'File Standar Pelayanan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui file gagal. Silahkan coba lagi.');
        }

        redirect('admin/standar_pelayanan', 'refresh');
    }


    public function hapus($id)
    {
        // Mengambil nama file
        $file = $this->Model_standar_pelayanan->get_by_id($id)->file_name;

        // Menghapus file dari server
        if (file_exists('./assets/fileupload/' . $file)) {
            unlink('./assets/fileupload/' . $file);
        }

        $result = $this->Model_standar_pelayanan->delete_data($id);

        if ($result) {
            $this->session->set_flashdata('success', 'File Standar Pelayanan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan file gagal. Silahkan coba lagi.');
        }

        redirect('admin/standar_pelayanan', 'refresh');
    }
}

/* End of file standar_pelayanan.php */
