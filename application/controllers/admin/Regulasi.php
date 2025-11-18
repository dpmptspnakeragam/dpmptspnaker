<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regulasi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_regulasi');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Regulasi';
        $data['regulasi'] = $this->Model_regulasi->tampil_data();
        $data['idmax'] = $this->Model_regulasi->idmax();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/regulasi', $data);
        $this->load->view('modal/tambah/regulasi');
        $this->load->view('modal/edit/regulasi', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id      = $this->input->post('id', true);
        $judul   = $this->input->post('judul', true);
        $tentang = $this->input->post('tentang', true);
        $file    = '';

        // Validasi input wajib
        if (empty($judul) || empty($tentang)) {
            $this->session->set_flashdata("error", "Judul dan Tentang tidak boleh kosong.");
            redirect('admin/regulasi');
            return;
        }

        // Jika ada file yang diupload
        if (!empty($_FILES['file']['name'])) {

            $nmfile = "regulasi-" . time();
            $config = [
                'upload_path'   => './assets/fileupload/',
                'allowed_types' => 'pdf|doc|docx|xls|xlsx',
                'file_name'     => $nmfile,
                'max_size'      => 64000, // 64MB
                'detect_mime'   => TRUE,
                'mod_mime_fix'  => TRUE,

                // Tambahan agar MIME cPanel tidak ditolak
                'mime_types' => [
                    'pdf'  => ['application/pdf'],
                    'doc'  => ['application/msword'],
                    'docx' => [
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip'
                    ],
                    'xls'  => ['application/vnd.ms-excel'],
                    'xlsx' => [
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/zip'
                    ]
                ]
            ];

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                $error = strip_tags($this->upload->display_errors());
                $this->session->set_flashdata("error", "Upload file gagal: $error");
                redirect('admin/regulasi');
                return;
            }
        }

        // Simpan data
        $data = [
            'id_regulasi' => $id,
            'judul'       => $judul,
            'tentang'     => $tentang,
            'file'        => $file
        ];

        if ($this->Model_regulasi->input($data)) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/regulasi');
    }

    public function ubah()
    {
        $id      = $this->input->post('id', true);
        $judul   = $this->input->post('judul', true);
        $tentang = $this->input->post('tentang', true);
        $oldFile = $this->input->post('old', true);

        $file    = $oldFile;

        // Validasi input wajib
        if (empty($judul) || empty($tentang)) {
            $this->session->set_flashdata("error", "Judul dan Tentang tidak boleh kosong.");
            redirect('admin/regulasi');
            return;
        }

        // Jika ada file baru diupload
        if (!empty($_FILES['file']['name'])) {

            $nmfile = "regulasi-" . time();
            $config = [
                'upload_path'   => './assets/fileupload/',
                'allowed_types' => 'pdf|doc|docx|xls|xlsx',
                'file_name'     => $nmfile,
                'max_size'      => 64000,
                'detect_mime'   => TRUE,
                'mod_mime_fix'  => TRUE,
                'mime_types' => [
                    'pdf'  => ['application/pdf'],
                    'doc'  => ['application/msword'],
                    'docx' => [
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip'
                    ],
                    'xls'  => ['application/vnd.ms-excel'],
                    'xlsx' => [
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/zip'
                    ]
                ]
            ];

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {

                $file = $this->upload->data('file_name');

                // Hapus file lama
                if (!empty($oldFile) && file_exists('./assets/fileupload/' . $oldFile)) {
                    unlink('./assets/fileupload/' . $oldFile);
                }
            } else {
                $error = strip_tags($this->upload->display_errors());
                $this->session->set_flashdata("error", "File baru gagal diunggah: $error");
                redirect('admin/regulasi');
                return;
            }
        }

        // Update data
        $data = [
            'id_regulasi' => $id,
            'judul'       => $judul,
            'tentang'     => $tentang,
            'file'        => $file
        ];

        if ($this->Model_regulasi->update($data, $id)) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/regulasi');
    }

    public function hapus($id)
    {
        $this->db->where('id_regulasi', $id);
        $query = $this->db->get('regulasi');
        $row = $query->row();

        if (!empty($row->file) && file_exists("./assets/fileupload/$row->file")) {
            unlink("./assets/fileupload/$row->file");
        }

        $result = $this->Model_regulasi->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Regulasi berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/regulasi', 'refresh');
    }
}
