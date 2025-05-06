<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nonperizinan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_nonperizinan');
    }

    public function index()
    {

        $data['nonperizinan'] = $this->Model_nonperizinan->tampil_data();
        $data['idmax'] = $this->Model_nonperizinan->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Non Perizinan';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/nonperizinan', $data, FALSE);
        $this->load->view('modal/modal_tambah_nonperizinan');
        $this->load->view('edit/edit_nonperizinan', $data, FALSE);
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
            'hukum' => $hukum,
            'biaya' => $biaya,
            'lamaproses' => $lamaproses,
            'syarat' => $syarat
        );

        $result = $this->Model_nonperizinan->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Non Perizinan berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }
        redirect('admin/nonperizinan', 'refresh');
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

        $result = $this->Model_nonperizinan->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Non Perizinan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/nonperizinan', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_izin', $id);
        $query = $this->db->get('nonperizinan');
        $row = $query->row();

        unlink("./assets/fileupload/$row->form");

        $result = $this->Model_nonperizinan->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Non Perizinan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/nonperizinan', 'refresh');
    }
}
