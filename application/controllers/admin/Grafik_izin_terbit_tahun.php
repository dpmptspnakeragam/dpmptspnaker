<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_izin_terbit_tahun extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        // load models
        $this->load->model('Model_grafik_izin_tahun');
    }

    public function index()
    {
        $data = [
            'idmax' => $this->Model_grafik_izin_tahun->idmax(),
            'grafik' => $this->Model_grafik_izin_tahun->tampil_data(),
            'tahun_fields' => $this->Model_grafik_izin_tahun->tampil_data_tahun()
        ];

        $data['home'] = 'Home';
        $data['title'] = 'Grafik Izin Terbit (Tahun)';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_izin_terbit_tahun', $data, FALSE);

        $this->load->view('modal/tambah/grafik_izin_terbit_tahun', $data, FALSE);
        $this->load->view('modal/edit/grafik_izin_terbit_tahun', $data, FALSE);
        $this->load->view('modal/hapus/grafik_izin_terbit_tahun', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $izin = $this->input->post('izin', true);
        $id = $this->input->post('id', true);

        // Ambil semua tahun yang ada di database
        $tahun_fields = $this->Model_grafik_izin_tahun->tampil_data_tahun();

        $data = [
            'id_grafik' => $id,
            'izin' => $izin
        ];

        // Loop melalui setiap tahun dan tambahkan ke data array
        foreach ($tahun_fields as $field) {
            $year = str_replace('thn', '', $field->Field);
            $data['thn' . $year] = $this->input->post('thn' . $year, true);
        }

        $this->Model_grafik_izin_tahun->input($data);
        $this->session->set_flashdata("success", "Tambah data <b>$izin</b> berhasil !");
        redirect('admin/grafik_izin_terbit_tahun');
    }


    public function edit()
    {
        $id = $this->input->post('id', true);
        $izin = $this->input->post('izin', true);

        // Ambil semua tahun yang ada di database
        $tahun_fields = $this->Model_grafik_izin_tahun->tampil_data_tahun();

        $data = [
            'id_grafik' => $id,
            'izin' => $izin
        ];

        // Loop melalui setiap tahun dan tambahkan ke data array
        foreach ($tahun_fields as $field) {
            $year = str_replace('thn', '', $field->Field);
            $data['thn' . $year] = $this->input->post('thn' . $year, true);
        }

        $this->Model_grafik_izin_tahun->update($data, $id);
        $this->session->set_flashdata("success", "Ubah data <b>$izin</b> berhasil !");
        redirect('admin/grafik_izin_terbit_tahun');
    }


    public function hapus($id)
    {
        $row = $this->db->get_where('grafik_izin_tahun', ['id_grafik' => $id])->row();

        if ($row) {
            $this->Model_grafik_izin_tahun->delete($id);
            $this->session->set_flashdata("success", "Hapus data <b>{$row->izin}</b> berhasil !");
        } else {
            $this->session->set_flashdata("error", "Data tidak ditemukan atau sudah dihapus.");
        }

        redirect('admin/grafik_izin_terbit_tahun');
    }


    public function tambah_field_tahun()
    {
        $tahun = $this->input->post('tahun', true);

        if ($tahun) {
            $field_name = 'thn' . $tahun;

            // Cek apakah tahun sudah ada di database
            $tahun_fields = $this->Model_grafik_izin_tahun->tampil_data_tahun();
            foreach ($tahun_fields as $field) {
                $year = str_replace('thn', '', $field->Field);
                if ($year == $tahun) {
                    $this->session->set_flashdata("gagal", "Tahun <b>$tahun</b> sudah ada!");
                    redirect('admin/grafik_izin_terbit_tahun');
                    return;
                }
            }

            // Jika tahun belum ada, tambahkan field tahun baru
            $this->Model_grafik_izin_tahun->add_tahun($field_name);
            $this->session->set_flashdata("success", "Tahun <b>$tahun</b> berhasil ditambahkan!");
        } else {
            $this->session->set_flashdata("error", "Tahun tidak boleh kosong!");
        }

        redirect('admin/grafik_izin_terbit_tahun');
    }


    public function hapus_field_tahun()
    {
        $tahun = $this->input->post('tahun', true);

        if ($tahun) {
            $field_name = 'thn' . $tahun;

            // Cek apakah tahun sudah ada
            $tahun_fields = $this->Model_grafik_izin_tahun->tampil_data_tahun();
            $exists = false;
            foreach ($tahun_fields as $field) {
                if ($field->Field == $field_name) {
                    $exists = true;
                    break;
                }
            }

            if ($exists) {
                // Hapus field tahun dari database
                $this->Model_grafik_izin_tahun->delete_tahun($field_name);
                $this->session->set_flashdata("success", "Tahun <b>$tahun</b> berhasil dihapus!");
            } else {
                $this->session->set_flashdata("error", "Tahun <b>$tahun</b> tidak ditemukan!");
            }
        } else {
            $this->session->set_flashdata("error", "Tahun tidak boleh kosong!");
        }

        redirect('admin/grafik_izin_terbit_tahun');
    }
}
