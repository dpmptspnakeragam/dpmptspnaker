<?php
class Sarpras extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_sarpras');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Sarana & Prasarana';
        $data['sarpras'] = $this->Model_sarpras->tampil_data();
        $data['idmax'] = $this->Model_sarpras->idmax();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/sarpras', $data);
        $this->load->view('modal/modal_tambah_sarpras', $data);
        $this->load->view('edit/edit_sarpras', $data);
        $this->load->view('templates/admin_footer');
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

        $result = $this->Model_sarpras->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Sarana & Prasarana berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/sarpras', 'refresh');
    }

    public function edit()
    {
        $id_sarpras = $this->input->post('id', true);
        $teks = $this->input->post('teks', true);
        $gambar_lama = $this->input->post('old', true);
        $gambar_baru = $_FILES['gambar']['name'];

        // Cek apakah ada gambar baru yang diunggah
        if (!empty($gambar_baru)) {
            // Konfigurasi upload file
            $nmfile = "sarpras-" . time();
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if (file_exists('./assets/imgupload/' . $gambar_lama) && $gambar_lama != '') {
                    unlink('./assets/imgupload/' . $gambar_lama);
                }

                // Ambil nama file baru
                $gambar = $this->upload->data('file_name');
            } else {
                // Jika upload gagal, gunakan gambar lama
                $gambar = $gambar_lama;
                $this->session->set_flashdata('error', 'Upload gambar baru gagal. Menggunakan gambar lama.');
            }
        } else {
            // Tidak ada perubahan pada gambar
            $gambar = $gambar_lama;
        }

        // Siapkan data untuk update
        $data = array(
            'id_sarpras' => $id_sarpras,
            'teks' => $teks,
            'gambar' => $gambar
        );

        // Update data ke database
        $result = $this->Model_sarpras->update($data, $id_sarpras);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Sarana & Prasarana berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silahkan coba lagi.');
        }

        redirect('admin/sarpras', 'refresh');
    }

    public function hapus($id_sarpras)
    {
        $this->db->where('id_sarpras', $id_sarpras);
        $query = $this->db->get('sarpras');
        $row = $query->row();

        unlink("./assets/imgupload/$row->gambar");

        $result = $this->Model_sarpras->delete($id_sarpras);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Sarana & Prasarana berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/sarpras', 'refresh');
    }
}
