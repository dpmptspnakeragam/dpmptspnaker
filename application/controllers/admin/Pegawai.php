<?php
class Pegawai extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_pegawai');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Pegawai';

        $data['kabid'] = $this->Model_pegawai->tampil_kabid();
        $data['pegawai'] = $this->Model_pegawai->tampil_pegawai();
        $data['idmax'] = $this->Model_pegawai->idmax();
        $data['no_urut'] = $this->Model_pegawai->get_total_count() + 1;

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/pegawai', $data);
        $this->load->view('modal/modal_tambah_pegawai', $data);
        $this->load->view('edit/edit_pegawai', $data);
        $this->load->view('edit/edit_kabid', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut = $this->input->post('no_urut', true);
        // $id_kabid = $this->input->post('id_kabid', true);
        $nama = $this->input->post('nama', true);
        $gambar = $_FILES['gambar']['name'];
        $jenis_nip = $this->input->post('jenis_nip', true);
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
            // 'id_kabid' => $id_kabid,
            'nama' => $nama,
            'jenis_nip' => $jenis_nip,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'alamat' => $alamat,
            'gambar' => $gambar
        );

        $result = $this->Model_pegawai->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pegawai berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/pegawai', 'refresh');
    }

    public function ubah_pegawai()
    {
        $id_pegawai = $this->input->post('id_pegawai', true);
        $no_urut = $this->input->post('no_urut', true);
        $nama = $this->input->post('nama', true);
        $jenis_nip = $this->input->post('jenis_nip', true);
        $nip = $this->input->post('nip', true);
        $jabatan = $this->input->post('jabatan', true);
        $golongan = $this->input->post('golongan', true);
        $alamat = $this->input->post('alamat', true);

        $gambar_lama = $this->input->post('old', true);
        $gambar_baru = $_FILES['gambar']['name'];

        if (!empty($gambar_baru)) {
            $nmfile = "pegawai-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                if (!empty($gambar_lama) && file_exists('./assets/imgupload/' . $gambar_lama)) {
                    unlink('./assets/imgupload/' . $gambar_lama);
                }

                $gambar = $this->upload->data('file_name');
            } else {
                $gambar = $gambar_lama;
            }
        } else {
            $gambar = $gambar_lama;
        }

        $data = array(
            'id_pegawai' => $id_pegawai,
            'no_urut' => $no_urut,
            'nama' => $nama,
            'jenis_nip' => $jenis_nip,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'alamat' => $alamat,
            'gambar' => $gambar
        );

        $result = $this->Model_pegawai->update_pegawai($data, $id_pegawai);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pegawai berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/pegawai', 'refresh');
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
        $this->Model_pegawai->update_kabid($data, $id_kabid);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama_kabid</b> berhasil !");
        redirect('admin/pegawai');
    }

    public function hapus($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $query = $this->db->get('pegawai');
        $row = $query->row();

        if (!empty($row->gambar) && file_exists("./assets/imgupload/$row->gambar")) {
            unlink("./assets/imgupload/$row->gambar");
        }

        $result = $this->Model_pegawai->delete($id_pegawai);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Pegawai berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/pegawai', 'refresh');
    }
}
