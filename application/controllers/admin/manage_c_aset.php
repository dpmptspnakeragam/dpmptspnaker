<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class manage_c_aset extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
        $this->load->helper('download');
    }

    public function index()
    {
        $this->load->model('Model_pegawai');
        $this->load->model('Model_aset');
        $data['aset'] = $this->Model_aset->tampil_data();
        $data['pegawai'] = $this->Model_pegawai->tampil_pegawai();
        $data['idmax'] = $this->Model_aset->idmax();
        $this->load->view('templates/header_aset');
        $this->load->view('admin/aset', $data);
        $this->load->view('modal/modal_tambah_aset', $data);
        $this->load->view('edit/edit_aset', $data);
        $this->load->view('templates/footer_aset');
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

        if ($foto_brg == '') {
            $this->session->set_flashdata("gagal", "Foto tidak boleh kosong");
            redirect('manage-aset');
        } else {
            $nmfile = "Aset-" . $id_aset;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_brg')) {
                $foto_brg = $this->upload->data('file_name');
            }
        }

        $dataqrcode = '' . $kode_brg . ' | ' . $kode_rekening . ' | ' . $nama_brg . ' | ' . $no_register . ' | ' . $tahun_beli . '
        | ' . $asal_usul . ' | ' . $kondisi_brg . ' | ' . $nilai_aset . ' | ' . $pemakai . '';

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './qr/'; //string, the default is application/cache/
        $config['errorlog']     = './qr/'; //string, the default is application/logs/
        $config['imagedir']     = './qr/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = 'Aset-' . $id_aset . '.png'; //buat name dari qr code sesuai dengan data

        $params['data'] = $dataqrcode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = array(
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
        );

        $this->load->model('Model_aset');
        $this->Model_aset->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$nama_brg</b> berhasil !");
        redirect('manage-aset');
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
        $qrold = $this->input->post('qrold', true);
        $foto_brg = $_FILES['foto_brg']['name'];

        if (empty($_FILES['foto_brg']['name'])) {
            $foto_brg = $this->input->post('old', true);
        } else {
            $nmfile = "Aset-" . $id_aset;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_brg')) {
                $foto_brg = $this->upload->data('file_name');
                $fotolama = $this->input->post('old', true);
                unlink("./assets/imgupload/" . $fotolama);
            }
        }

        $dataqrcode = '' . $kode_brg . ' | ' . $kode_rekening . ' | ' . $nama_brg . ' | ' . $no_register . ' | ' . $tahun_beli . '
        | ' . $asal_usul . ' | ' . $kondisi_brg . ' | ' . $nilai_aset . ' | ' . $pemakai . '';

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './qr/'; //string, the default is application/cache/
        $config['errorlog']     = './qr/'; //string, the default is application/logs/
        $config['imagedir']     = './qr/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = 'Aset-' . $id_aset . '.png'; //buat name dari qr code sesuai dengan data

        $params['data'] = $dataqrcode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = array(
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
        );

        $this->load->model('Model_aset');
        $this->Model_aset->update($data, $id_aset);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$nama_brg</b> berhasil !");
        redirect('manage-aset');
    }

    public function hapus($id)
    {
        $this->db->where('id_aset', $id);
        $query = $this->db->get('aset');
        $row = $query->row();

        unlink("./assets/imgupload/" . $row->foto_brg);
        unlink("./qr/" . $row->qrcode);

        $this->load->model('Model_aset');
        $this->Model_aset->delete($id);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->nama_brg</b> berhasil !");
        redirect('manage-aset');
    }

    public function download($qrcode)
    {
        force_download('./qr/' . $qrcode . '', NULL);
    }
}
