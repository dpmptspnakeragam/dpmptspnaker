<?php
class Sarpras extends CI_controller
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
        $this->load->model('Model_sarpras');
        $data['sarpras'] = $this->Model_sarpras->tampil_data();
        $data['idmax'] = $this->Model_sarpras->idmax();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/sarpras', $data);
        $this->load->view('modal/modal_tambah_sarpras', $data);
        $this->load->view('edit/edit_sarpras', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_sarpras = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $gambar = $_FILES['gambar']['name'];

        if ($gambar = '') {
        } else {
            $nmfile = "sarpras-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_sarpras' => $id_sarpras,
            'teks' => $teks,
            'gambar' => $gambar
        );
        $this->load->model('Model_sarpras');
        $this->Model_sarpras->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data Sarana & Prasarana berhasil !");
        redirect('admin/sarpras');
    }

    public function ubah()
    {
        $id_sarpras = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $gambar = $_FILES['gambar']['name'];

        if (empty($_FILES['gambar']['name'])) {
            $gambar = $this->input->post('old', true);
        } else {
            $nmfile = "sarpras-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_sarpras' => $id_sarpras,
            'teks' => $teks,
            'gambar' => $gambar
        );
        $this->load->model('Model_sarpras');
        $this->Model_sarpras->update($data, $id_sarpras);
        $this->session->set_flashdata("berhasil", "Ubah data Sarana & Prasarana berhasil !");
        redirect('admin/sarpras');
    }

    public function hapus($id_sarpras)
    {
        $this->db->where('id_sarpras', $id_sarpras);
        $query = $this->db->get('sarpras');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $this->load->model('Model_sarpras');
        $this->Model_sarpras->delete($id_sarpras);
        $this->session->set_flashdata("gagal", "Hapus data Sarana & Prasarana berhasil !");

        redirect('admin/sarpras');
    }
}
