<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perizinan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_perizinan');
    }

    public function index()
    {
        $data['perizinan'] = $this->Model_perizinan->tampil_data();
        $data['idmax'] = $this->Model_perizinan->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Perizinan';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/perizinan', $data, FALSE);
        $this->load->view('modal/modal_tambah_perizinan');
        $this->load->view('edit/edit_perizinan', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $form = $_FILES['form']['name'];
        $syarat = $this->input->post('syarat', true);
        $nama_izin = $this->input->post('nama_izin', true);
        $biaya = $this->input->post('biaya', true);
        $lamaproses = $this->input->post('lamaproses', true);
        $hukum = $this->input->post('hukum', true);

        if ($form = '') {
            $form = "";
        } else {
            $nmfile = $form;
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('form')) {
                $form = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_izin' => $id,
            'nama_izin' => $nama_izin,
            'form' => $form,
            'syarat' => $syarat,
            'biaya' => $biaya,
            'lamaproses' => $lamaproses,
            'hukum' => $hukum
        );

        $result = $this->Model_perizinan->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
        redirect('admin/perizinan', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id', true);
        $nama_izin = $this->input->post('nama_izin', true);
        $form = $_FILES['form']['name'];
        $old_file = $this->input->post('old', true); // File lama
        $syarat = $this->input->post('syarat', true);
        $biaya = $this->input->post('biaya', true);
        $lamaproses = $this->input->post('lamaproses', true);
        $hukum = $this->input->post('hukum', true);

        if (!empty($form)) {
            $nmfile = $form; // Memberi nama unik pada file baru
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('form')) {
                // Hapus file lama jika ada file baru
                if (!empty($old_file) && file_exists('./assets/fileupload/' . $old_file)) {
                    unlink('./assets/fileupload/' . $old_file);
                }

                $form = $this->upload->data('file_name'); // File baru
            } else {
                $this->session->set_flashdata("gagal", "Maaf, file <b>$nama_izin</b> gagal diunggah. Format file tidak sesuai!");
                redirect('admin/perizinan', 'refresh');
            }
        } else {
            $form = $old_file; // Gunakan file lama jika tidak ada file baru
        }

        $data = array(
            'id_izin' => $id,
            'nama_izin' => $nama_izin,
            'form' => $form,
            'syarat' => $syarat,
            'biaya' => $biaya,
            'lamaproses' => $lamaproses,
            'hukum' => $hukum
        );

        $result = $this->Model_perizinan->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/perizinan', 'refresh');
    }

    public function hapus($id)
    {
        // Ambil data berdasarkan id
        $this->db->where('id_izin', $id);
        $query = $this->db->get('perizinan');
        $row = $query->row();

        // Cek apakah file ada sebelum dihapus
        if ($row && !empty($row->form)) {
            $file_path = FCPATH . 'assets/fileupload/' . $row->form;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Hapus data dari database
        $result = $this->Model_perizinan->delete($id);

        // Notifikasi hasil
        if ($result) {
            $this->session->set_flashdata('success', 'Data Perizinan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/perizinan', 'refresh');
    }
}
