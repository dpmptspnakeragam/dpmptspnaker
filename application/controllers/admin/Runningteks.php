<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Runningteks extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
    }

    public function index()
    {
        $this->load->model('Model_runningteks');
        $data['teks'] = $this->Model_runningteks->tampil_data();
        $data['idmax'] = $this->Model_runningteks->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/teks', $data);
        $this->load->view('modal/modal_tambah_teks');
        $this->load->view('edit/edit_teks', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);

        $data = array(
            'id_teks' => $id,
            'teks' => $teks
        );
        $this->load->model('Model_runningteks');
        $this->Model_runningteks->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$teks</b> berhasil !");
        redirect('admin/runningteks');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);

        $data = array(
            'id_teks' => $id,
            'teks' => $teks
        );
        $this->load->model('Model_runningteks');
        $this->Model_runningteks->update($data, $id);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$teks</b> berhasil !");
        redirect('admin/runningteks');
    }

    public function hapus($id)
    {
        $this->db->where('id_teks', $id);
        $query = $this->db->get('runningteks');
        $row = $query->row();

        $this->load->model('Model_runningteks');
        $this->Model_runningteks->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->teks</b> berhasil !");
        redirect('admin/runningteks');
    }
}
