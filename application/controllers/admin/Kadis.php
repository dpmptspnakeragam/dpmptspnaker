<?php
class Kadis extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_kadis');
    }

    public function index()
    {

        $data['kadis'] = $this->Model_kadis->tampil_kadis();
        $data['home'] = 'Home';
        $data['title'] = 'Kepala Dinas';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/kadis', $data, FALSE);
        $this->load->view('modal/modal_tambah_kadis', $data);
        $this->load->view('edit/edit_kadis', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_kadis = $this->input->post('id_kadis', true);
        $nama = $this->input->post('nama', true);
        $foto = $_FILES['foto']['name'];
        $periode = $this->input->post('periode', true);

        if ($foto = '') {
        } else {
            $nmfile = "kadis-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_kadis' => $id_kadis,
            'nama' => $nama,
            'periode' => $periode,
            'foto' => $foto
        );

        $result = $this->Model_kadis->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }

    public function edit()
    {
        $id_kadis = $this->input->post('id_kadis', true);
        $nama = $this->input->post('nama', true);
        $periode = $this->input->post('periode', true);
        $foto_baru = $_FILES['foto']['name'];
        $foto_lama = $this->input->post('old', true);

        if (!empty($foto_baru)) {
            // $nmfile = "kadis-" . time() . "-" . str_replace(' ', '-', strtolower($nama));
            $nmfile = "kadis-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;
            $config['max_size'] = 22048; // Maksimal 22MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');

                if (!empty($foto_lama) && file_exists('./assets/imgupload/' . $foto_lama)) {
                    unlink('./assets/imgupload/' . $foto_lama);
                }
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal: ' . $this->upload->display_errors('', ''));
                redirect('admin/kadis', 'refresh');
            }
        } else {
            $foto = $foto_lama;
        }

        $data = [
            'nama' => $nama,
            'periode' => $periode,
            'foto' => $foto,
        ];

        $result = $this->Model_kadis->update($data, $id_kadis);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }

    public function hapus($id_kadis)
    {
        $this->db->where('id_kadis', $id_kadis);
        $query = $this->db->get('kadis');
        $row = $query->row();

        if (!empty($row->foto) && file_exists("./assets/imgupload/$row->foto")) {
            unlink("./assets/imgupload/$row->foto");
        }

        $result = $this->Model_kadis->delete($id_kadis);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Kadis berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/kadis', 'refresh');
    }
}
