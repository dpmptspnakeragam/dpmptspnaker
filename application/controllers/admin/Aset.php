<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aset extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->helper('download');

        $this->load->model('Model_pegawai');
        $this->load->model('Model_aset');
    }

    public function index()
    {
        $data['home'] = 'Home';
        $data['title'] = 'Manajemen Aset';

        $data['aset'] = $this->Model_aset->tampil_data();
        $data['pegawai'] = $this->Model_pegawai->tampil_pegawai();
        $data['idmax'] = $this->Model_aset->idmax();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/aset', $data);
        $this->load->view('modal/modal_tambah_aset', $data);
        $this->load->view('edit/edit_aset', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_aset = $this->input->post('id_aset', true);
        $kode_brg = $this->input->post('kode_brg', true);
        $kode_rekening = $this->input->post('kode_rekening', true);
        $nama_brg = $this->input->post('nama_brg', true);
        $no_register = $this->input->post('no_register', true);
        $tahun_beli = $this->input->post('tahun_beli', true);
        $asal_usul = $this->input->post('asal_usul', true);
        $kondisi_brg = $this->input->post('kondisi_brg', true);
        $nilai_aset = $this->input->post('nilai_aset', true);
        $pemakai = $this->input->post('pemakai', true);
        $foto_brg = $_FILES['foto_brg']['name'];

        if (empty($foto_brg)) {
            $this->session->set_flashdata("gagal", "Foto tidak boleh kosong");
            redirect('admin/aset');
        } else {
            $nmfile = "Aset-" . $id_aset;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_brg')) {
                $foto_brg = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal. ' . $this->upload->display_errors());
                redirect('admin/aset');
            }
        }

        $dataqrcode = "$kode_brg | $kode_rekening | $nama_brg | $no_register | $tahun_beli | $asal_usul | $kondisi_brg | $nilai_aset | $pemakai";

        // Pemanggilan library QR Code
        $this->load->library('ciqrcode');

        $config['cacheable']    = true;
        $config['cachedir']     = './assets/qr/';
        $config['errorlog']     = './assets/qr/';
        $config['imagedir']     = './assets/qr/';
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [224, 255, 255];
        $config['white']        = [70, 130, 180];
        $this->ciqrcode->initialize($config);

        $image_name = 'QR-Code Aset ' . $kode_brg . ' - ' . $nama_brg . '.png';

        $params['data'] = $dataqrcode;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
        $this->ciqrcode->generate($params);

        $data = [
            'id_aset' => $id_aset,
            'kode_brg' => $kode_brg,
            'kode_rekening' => $kode_rekening,
            'nama_brg' => $nama_brg,
            'no_register' => $no_register,
            'tahun_beli' => $tahun_beli,
            'asal_usul' => $asal_usul,
            'kondisi_brg' => $kondisi_brg,
            'nilai_aset' => $nilai_aset,
            'pemakai' => $pemakai,
            'foto_brg' => $foto_brg,
            'qrcode' => $image_name
        ];

        $result = $this->Model_aset->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Aset berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/aset', 'refresh');
    }

    public function ubah()
    {
        $id_aset = $this->input->post('id', true);
        $kode_brg = $this->input->post('kode_brg', true);
        $kode_rekening = $this->input->post('kode_rekening', true);
        $nama_brg = $this->input->post('nama_brg', true);
        $no_register = $this->input->post('no_register', true);
        $tahun_beli = $this->input->post('tahun_beli', true);
        $asal_usul = $this->input->post('asal_usul', true);
        $kondisi_brg = $this->input->post('kondisi_brg', true);
        $nilai_aset = $this->input->post('nilai_aset', true);
        $pemakai = $this->input->post('pemakai', true);
        $foto_brg = $_FILES['foto_brg']['name'];
        $foto_lama = $this->input->post('old', true);

        // Logika untuk foto barang
        if (!empty($foto_brg)) {
            $nmfile = "Aset-" . $id_aset;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_brg')) {
                $foto_brg = $this->upload->data('file_name');

                // Hapus foto lama
                if (!empty($foto_lama) && file_exists("./assets/imgupload/" . $foto_lama)) {
                    unlink("./assets/imgupload/" . $foto_lama);
                }
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal. ' . $this->upload->display_errors());
                redirect('admin/aset');
            }
        } else {
            $foto_brg = $foto_lama; // Gunakan foto lama jika tidak ada perubahan
        }

        // Data untuk QR Code
        $dataqrcode = "$kode_brg | $kode_rekening | $nama_brg | $no_register | $tahun_beli | $asal_usul | $kondisi_brg | $nilai_aset | $pemakai";

        // Pemanggilan library QR Code
        $this->load->library('ciqrcode');

        $config['cacheable']    = true;
        $config['cachedir']     = './assets/qr/';
        $config['errorlog']     = './assets/qr/';
        $config['imagedir']     = './assets/qr/';
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [224, 255, 255];
        $config['white']        = [70, 130, 180];
        $this->ciqrcode->initialize($config);

        $image_name = 'QR-Code Aset ' . $kode_brg . ' - ' . $nama_brg . '.png';

        $params['data'] = $dataqrcode;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
        $this->ciqrcode->generate($params);

        // Data untuk database
        $data = [
            'id_aset' => $id_aset,
            'kode_brg' => $kode_brg,
            'kode_rekening' => $kode_rekening,
            'nama_brg' => $nama_brg,
            'no_register' => $no_register,
            'tahun_beli' => $tahun_beli,
            'asal_usul' => $asal_usul,
            'kondisi_brg' => $kondisi_brg,
            'nilai_aset' => $nilai_aset,
            'pemakai' => $pemakai,
            'foto_brg' => $foto_brg,
            'qrcode' => $image_name
        ];

        $result = $this->Model_aset->update($data, $id_aset);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Aset berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        redirect('admin/aset', 'refresh');
    }

    public function hapus($id)
    {
        $this->db->where('id_aset', $id);
        $query = $this->db->get('aset');
        $row = $query->row();

        if (!empty($row->foto_brg) && file_exists("./assets/imgupload/$row->foto_brg")) {
            unlink("./assets/imgupload/$row->foto_brg");
        }

        if (!empty($row->qrcode) && file_exists("./assets/qr/$row->qrcode")) {
            unlink("./assets/qr/$row->qrcode");
        }

        $result = $this->Model_aset->delete($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Aset berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/aset', 'refresh');
    }
}
