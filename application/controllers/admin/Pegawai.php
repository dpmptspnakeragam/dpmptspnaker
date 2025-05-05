<?php
class Pegawai extends CI_controller
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
        $this->load->model('Model_pegawai');
        $data['kabid'] = $this->Model_pegawai->tampil_kabid();
        $data['pegawai'] = $this->Model_pegawai->tampil_pegawai();
        $data['idmax'] = $this->Model_pegawai->idmax();
        $data['no_urut'] = $this->Model_pegawai->get_total_count() + 1;
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/pegawai', $data);
        $this->load->view('modal/modal_tambah_pegawai', $data);
        $this->load->view('edit/edit_pegawai', $data);
        $this->load->view('edit/edit_kabid', $data);
        $this->load->view('templates/footer_admin');
    }

    public function tambah()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut = $this->input->post('no_urut', true);
        $id_kabid = $this->input->post('id_kabid', true);
        $nama = $this->input->post('nama', true);
        $gambar = $_FILES['gambar']['name'];
        $nip = $this->input->post('nip', true);
        $jabatan = $this->input->post('jabatan', true);
        $golongan = $this->input->post('golongan', true);
        $alamat = $this->input->post('alamat', true);

        if ($gambar = '') {
        } else {
            $nmfile = "pegawai-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_pegawai' => $id_pegawai,
            'no_urut' => $no_urut,
            'id_kabid' => $id_kabid,
            'nama' => $nama,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'alamat' => $alamat,
            'gambar' => $gambar
        );
        $this->load->model('Model_pegawai');
        $this->Model_pegawai->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$nama</b> berhasil !");
        redirect('admin/pegawai');
    }

    public function ubah_pegawai()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut = $this->input->post('no_urut', true);
        $id_kabid = $this->input->post('id_kabid', true);
        $nama = $this->input->post('nama', true);
        $gambar = $_FILES['gambar']['name'];
        $nip = $this->input->post('nip', true);
        $jabatan = $this->input->post('jabatan', true);
        $golongan = $this->input->post('golongan', true);
        $alamat = $this->input->post('alamat', true);

        if (empty($_FILES['gambar']['name'])) {
            $gambar = $this->input->post('old', true);
        } else {
            $nmfile = "pegawai-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_pegawai' => $id_pegawai,
            'no_urut' => $no_urut,
            'id_kabid' => $id_kabid,
            'nama' => $nama,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'alamat' => $alamat,
            'gambar' => $gambar
        );
        $this->load->model('Model_pegawai');
        $this->Model_pegawai->update_pegawai($data, $id_pegawai);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama</b> berhasil !");
        redirect('admin/pegawai');
    }

    public function ubah_kabid()
    {
        $id_kabid = $this->input->post('id_kabid', true);
        $nama_kabid = $this->input->post('nama', true);
        $gambar_kabid = $_FILES['gambar']['name'];
        $nip_kabid = $this->input->post('nip', true);
        $jabatan_kabid = $this->input->post('jabatan', true);
        $golongan_kabid = $this->input->post('golongan', true);
        $alamat_kabid = $this->input->post('alamat', true);

        if (empty($_FILES['gambar']['name'])) {
            $gambar_kabid = $this->input->post('old', true);
        } else {
            $nmfile = "pegawai-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $gambar_kabid = $this->upload->data('file_name');
            }
        }
        $data = array(
            'id_kabid' => $id_kabid,
            'nama_kabid' => $nama_kabid,
            'nip_kabid' => $nip_kabid,
            'jabatan_kabid' => $jabatan_kabid,
            'golongan_kabid' => $golongan_kabid,
            'alamat_kabid' => $alamat_kabid,
            'gambar_kabid' => $gambar_kabid
        );
        $this->load->model('Model_pegawai');
        $this->Model_pegawai->update_kabid($data, $id_kabid);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama_kabid</b> berhasil !");
        redirect('admin/pegawai');
    }

    public function hapus($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $query = $this->db->get('pegawai');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $this->load->model('Model_pegawai');
        $this->Model_pegawai->delete($id_pegawai);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->nama</b> berhasil !");

        redirect('admin/pegawai');
    }
}
