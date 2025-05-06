<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Running_teks extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_running_teks');
    }

    public function index()
    {
        $data['teks'] = $this->Model_running_teks->tampil_data();
        $data['idmax'] = $this->Model_running_teks->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Running Teks';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/running_teks', $data, FALSE);
        $this->load->view('modal/modal_tambah_running_teks', $data, FALSE);
        $this->load->view('edit/edit_running_teks', $data, FALSE);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);

        $data = array(
            'id_teks' => $id,
            'teks' => $teks
        );

        $result = $this->Model_running_teks->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Running Teks berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/running_teks', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);

        $data = array(
            'id_teks' => $id,
            'teks' => $teks
        );

        $result = $this->Model_running_teks->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Running Teks berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/running_teks', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_teks', $id);
        $query = $this->db->get('runningteks');
        $row = $query->row();


        $result = $this->Model_running_teks->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Running Teks berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/running_teks', 'refresh');
    }
}
