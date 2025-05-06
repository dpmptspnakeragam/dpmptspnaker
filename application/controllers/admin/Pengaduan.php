<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_pengaduan');
    }

    public function index()
    {
        $data['pengaduan'] = $this->Model_pengaduan->tampil_data();
        $data['home'] = 'Home';
        $data['title'] = 'Pengaduan';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/pengaduan', $data, FALSE);
        $this->load->view('modal/modal_tambah_pengaduan', $data, FALSE);
        $this->load->view('edit/edit_pengaduan', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $input = [
            'no_pengaduan' => $this->input->post('no_pengaduan'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
            'email' => $this->input->post('email'),
            'jenis_pengaduan' => $this->input->post('jenis_pengaduan'),
            'lokasi_kejadian' => $this->input->post('lokasi_kejadian'),
            'waktu_kejadian' => $this->input->post('waktu_kejadian'),
            'materi_pengaduan' => $this->input->post('materi_pengaduan'),
            'status' => $this->input->post('status')
        ];

        $data = $this->security->xss_clean($input);

        $result = $this->Model_pengaduan->insert_pengaduan($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pengaduan berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/pengaduan', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id', true);
        $no_pengaduan = $this->input->post('no_pengaduan', true);
        $nama = $this->input->post('nama', true);
        $alamat = $this->input->post('alamat', true);
        $hp = $this->input->post('hp', true);
        $email = $this->input->post('email', true);
        $jenis_pengaduan = $this->input->post('jenis_pengaduan', true);
        $lokasi_kejadian = $this->input->post('lokasi_kejadian', true);
        $waktu_kejadian = $this->input->post('waktu_kejadian', true);
        $materi_pengaduan = $this->input->post('materi_pengaduan', true);
        $status = $this->input->post('status', true);

        $data = array(
            'id_pengaduan' => $id,
            'no_pengaduan' => $no_pengaduan,
            'nama' => $nama,
            'alamat' => $alamat,
            'hp' => $hp,
            'email' => $email,
            'jenis_pengaduan' => $jenis_pengaduan,
            'lokasi_kejadian' => $lokasi_kejadian,
            'waktu_kejadian' => $waktu_kejadian,
            'materi_pengaduan' => $materi_pengaduan,
            'status' => $status
        );

        $result = $this->Model_pengaduan->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pengaduan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/pengaduan', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_pengaduan', $id);
        $query = $this->db->get('pengaduan');
        $row = $query->row();

        if ($row) {
            $file_path = FCPATH . 'assets/imgupload/' . $row->file_pengaduan;

            if (file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }

            $result = $this->Model_pengaduan->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data Pengaduan berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata("error", "Data ID tidak ditemukan. Silahkan hubungi pengembang.");
        }

        redirect('admin/pengaduan', 'refresh');
    }
}
