<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ppid extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_ppid');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'PPID';
        $data['idmax'] = $this->Model_ppid->idmax();

        // Memisahkan data berdasarkan kategori dari Model
        $data['itss'] = $this->Model_ppid->get_ppid_by_kategori('ITSS');
        $data['ib']   = $this->Model_ppid->get_ppid_by_kategori('IB');
        $data['ism']  = $this->Model_ppid->get_ppid_by_kategori('ISM');
        $data['id']   = $this->Model_ppid->get_ppid_by_kategori('ID');

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/ppid', $data);

        // Load Semua Modal Tambah
        $this->load->view('modal/tambah/itss');
        $this->load->view('modal/tambah/ib');
        $this->load->view('modal/tambah/ism');
        $this->load->view('modal/tambah/id');

        // Load Modal Edit (Gunakan $data karena modal edit butuh looping data untuk ID)
        $this->load->view('modal/edit/itss', $data);
        $this->load->view('modal/edit/ib', $data);
        $this->load->view('modal/edit/ism', $data);
        $this->load->view('modal/edit/id', $data);

        $this->load->view('templates/admin_footer');
    }

    public function tambah_itss()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $file = ""; // Set default nilai file kosong

        // Perbaikan: Gunakan !empty untuk mengecek apakah ada file yang diunggah
        if (!empty($_FILES['file']['name'])) {
            $nmfile = "itss-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                // (Opsional) Menangkap error jika upload gagal
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/ppid', 'refresh');
                return; // Hentikan proses jika gagal upload
            }
        }

        // Susun array data untuk disimpan
        $data = array(
            'id_ppid'  => $id,
            'judul'    => $judul,
            'kategori' => 'ITSS', // PENAMBAHAN BARU: Set kategori secara hardcode sesuai fungsi
            'file'     => $file
        );

        $result = $this->Model_ppid->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function tambah_ib()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $file = ""; // Set default nilai file kosong

        // Perbaikan: Gunakan !empty untuk mengecek apakah ada file yang diunggah
        if (!empty($_FILES['file']['name'])) {
            $nmfile = "ib-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                // (Opsional) Menangkap error jika upload gagal
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/ppid', 'refresh');
                return; // Hentikan proses jika gagal upload
            }
        }

        // Susun array data untuk disimpan
        $data = array(
            'id_ppid'  => $id,
            'judul'    => $judul,
            'kategori' => 'IB', // PENAMBAHAN BARU: Set kategori secara hardcode sesuai fungsi
            'file'     => $file
        );

        $result = $this->Model_ppid->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function tambah_ism()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $file = ""; // Set default nilai file kosong

        // Perbaikan: Gunakan !empty untuk mengecek apakah ada file yang diunggah
        if (!empty($_FILES['file']['name'])) {
            $nmfile = "ism-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                // (Opsional) Menangkap error jika upload gagal
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/ppid', 'refresh');
                return; // Hentikan proses jika gagal upload
            }
        }

        // Susun array data untuk disimpan
        $data = array(
            'id_ppid'  => $id,
            'judul'    => $judul,
            'kategori' => 'ISM', // PENAMBAHAN BARU: Set kategori secara hardcode sesuai fungsi
            'file'     => $file
        );

        $result = $this->Model_ppid->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function tambah_id()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $file = ""; // Set default nilai file kosong

        // Perbaikan: Gunakan !empty untuk mengecek apakah ada file yang diunggah
        if (!empty($_FILES['file']['name'])) {
            $nmfile = "id-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                // (Opsional) Menangkap error jika upload gagal
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/ppid', 'refresh');
                return; // Hentikan proses jika gagal upload
            }
        }

        // Susun array data untuk disimpan
        $data = array(
            'id_ppid'  => $id,
            'judul'    => $judul,
            'kategori' => 'ID', // PENAMBAHAN BARU: Set kategori secara hardcode sesuai fungsi
            'file'     => $file
        );

        $result = $this->Model_ppid->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function ubah_itss()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $kategori = $this->input->post('kategori', true); // Tambahkan ini
        $fileLama = $this->input->post('old', true);
        $fileBaru = $_FILES['file']['name'];

        $file = $fileLama;

        if (!empty($fileBaru)) {
            $nmfile = "itss-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada dan file lama bukan string kosong
                if (!empty($fileLama) && file_exists('./assets/fileupload/' . $fileLama)) {
                    unlink('./assets/fileupload/' . $fileLama);
                }
                $file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata("error", $this->upload->display_errors());
                redirect('admin/ppid');
                return;
            }
        }

        $data = array(
            'judul'    => $judul,
            'kategori' => $kategori, // Pastikan kategori ikut di-update
            'file'     => $file
        );

        $result = $this->Model_ppid->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function ubah_ib()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $kategori = $this->input->post('kategori', true); // Tambahkan ini
        $fileLama = $this->input->post('old', true);
        $fileBaru = $_FILES['file']['name'];

        $file = $fileLama;

        if (!empty($fileBaru)) {
            $nmfile = "ib-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada dan file lama bukan string kosong
                if (!empty($fileLama) && file_exists('./assets/fileupload/' . $fileLama)) {
                    unlink('./assets/fileupload/' . $fileLama);
                }
                $file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata("error", $this->upload->display_errors());
                redirect('admin/ppid');
                return;
            }
        }

        $data = array(
            'judul'    => $judul,
            'kategori' => $kategori, // Pastikan kategori ikut di-update
            'file'     => $file
        );

        $result = $this->Model_ppid->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function ubah_ism()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $kategori = $this->input->post('kategori', true); // Tambahkan ini
        $fileLama = $this->input->post('old', true);
        $fileBaru = $_FILES['file']['name'];

        $file = $fileLama;

        if (!empty($fileBaru)) {
            $nmfile = "ism-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada dan file lama bukan string kosong
                if (!empty($fileLama) && file_exists('./assets/fileupload/' . $fileLama)) {
                    unlink('./assets/fileupload/' . $fileLama);
                }
                $file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata("error", $this->upload->display_errors());
                redirect('admin/ppid');
                return;
            }
        }

        $data = array(
            'judul'    => $judul,
            'kategori' => $kategori, // Pastikan kategori ikut di-update
            'file'     => $file
        );

        $result = $this->Model_ppid->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function ubah_id()
    {
        $id = $this->input->post('id', true);
        $judul = $this->input->post('judul', true);
        $kategori = $this->input->post('kategori', true); // Tambahkan ini
        $fileLama = $this->input->post('old', true);
        $fileBaru = $_FILES['file']['name'];

        $file = $fileLama;

        if (!empty($fileBaru)) {
            $nmfile = "id-" . time();
            $config['upload_path'] = './assets/fileupload/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada dan file lama bukan string kosong
                if (!empty($fileLama) && file_exists('./assets/fileupload/' . $fileLama)) {
                    unlink('./assets/fileupload/' . $fileLama);
                }
                $file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata("error", $this->upload->display_errors());
                redirect('admin/ppid');
                return;
            }
        }

        $data = array(
            'judul'    => $judul,
            'kategori' => $kategori, // Pastikan kategori ikut di-update
            'file'     => $file
        );

        $result = $this->Model_ppid->update($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal.');
        }

        redirect('admin/ppid', 'refresh');
    }

    public function hapus_data($id)
    {
        $this->db->where('id_ppid', $id);
        $query = $this->db->get('ppid');
        $row = $query->row();

        // Cek apakah data ditemukan sebelum lanjut hapus
        if ($row) {
            // Hapus file fisik jika ada
            if (!empty($row->file) && file_exists("./assets/fileupload/$row->file")) {
                unlink("./assets/fileupload/$row->file");
            }

            $result = $this->Model_ppid->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data dari database.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/ppid', 'refresh');
    }
}
