<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
        $this->load->model('Model_pengaduan');
    }

    public function index()
    {
        $data['pengaduan'] = $this->Model_pengaduan->tampil_data();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/pengaduan', $data);
        $this->load->view('modal/modal_tambah_pengaduan');
        $this->load->view('edit/edit_pengaduan', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('hp', 'Nomor WhatsApp', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('jenis_pengaduan', 'Jenis Pengaduan', 'required');
        $this->form_validation->set_rules('lokasi_kejadian', 'Lokasi Kejadian', 'required');
        $this->form_validation->set_rules('waktu_kejadian', 'Waktu Kejadian', 'required');
        $this->form_validation->set_rules('status', 'Status Pengaduan', 'required');
        $this->form_validation->set_rules('materi_pengaduan', 'Uraian Pengaduan', 'required');

        if ($this->form_validation->run() == TRUE) {

            $no_pengaduan = $this->input->post('no_pengaduan');

            $input = [
                'no_pengaduan' => $no_pengaduan,
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
            $this->Model_pengaduan->insert_pengaduan($data);

            $this->session->set_flashdata('berhasil', "Pengaduan berhasil disimpan dengan Nomor <b>$no_pengaduan</b>. Tracking sudah bisa dilakukan, Terimakasih!!");
        } else {
            $this->session->set_flashdata('gagal', 'Pengaduan gagal disimpan. Perhatikan semua inputan!!');
        }

        redirect('admin/pengaduan');
    }

    public function ubah()
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
        $this->load->model('Model_pengaduan');
        $this->Model_pengaduan->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama</b> berhasil !");
        redirect('admin/pengaduan');
    }

    public function hapus($id)
    {
        $this->db->where('id_pengaduan', $id);
        $query = $this->db->get('pengaduan');
        $row = $query->row();

        $this->load->model('Model_pengaduan');
        $this->Model_pengaduan->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->nama</b> berhasil !");
        redirect('admin/pengaduan');
    }
}
