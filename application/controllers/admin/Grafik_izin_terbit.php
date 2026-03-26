<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_izin_terbit extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        $this->load->model('Model_grafik');
    }

    public function index()
    {
        $data['grafik'] = $this->Model_grafik->tampil_data();
        $data['periode_grafik'] = $this->Model_grafik->tampil_data_periode();
        $data['idmax'] = $this->Model_grafik->idmax();
        $data['home'] = 'Home';
        $data['title'] = 'Grafik Izin Terbit';

        $data['grafik'] = $this->Model_grafik->get_grafik_bertingkat();
        $data['bidang'] = $this->Model_grafik->get_bidang();

        $data['chart_bidang'] = $this->Model_grafik->get_chart_bidang();
        $data['chart_jenis']  = $this->Model_grafik->get_chart_jenis();

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_izin_terbit', $data, FALSE);

        $this->load->view('modal/tambah/grafik_izin_terbit_bidang', $data, FALSE);
        $this->load->view('modal/tambah/grafik_izin_terbit_jenis_izin', $data, FALSE);

        $this->load->view('modal/edit/grafik_izin_terbit', $data, FALSE);
        $this->load->view('modal/hapus/grafik_izin_terbit', $data, FALSE);

        $this->load->view('modal/edit/periode_grafik_izin_terbit', $data, FALSE);

        $this->load->view('templates/admin_footer');
    }

    public function tambah_bidang()
    {
        $izin = trim($this->input->post('izin', true));

        if ($izin == '') {
            $this->session->set_flashdata('error', 'Nama bidang wajib diisi.');
            redirect('admin/grafik_izin_terbit', 'refresh');
        }

        $data = array(
            'izin'      => $izin,
            'jumlah'    => 0,
            'parent_id' => null,
            'tipe'      => 'bidang'
        );

        $result = $this->Model_grafik->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data bidang berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan bidang gagal.');
        }

        redirect('admin/grafik_izin_terbit', 'refresh');
    }

    public function tambah_jenis()
    {
        $parent_id = (int) $this->input->post('parent_id', true);
        $izin      = trim($this->input->post('izin', true));
        $jumlah    = (int) $this->input->post('jumlah', true);

        if ($parent_id <= 0 || $izin == '') {
            $this->session->set_flashdata('error', 'Bidang induk dan nama jenis izin wajib diisi.');
            redirect('admin/grafik_izin_terbit', 'refresh');
        }

        $this->db->trans_begin();

        $data = array(
            'izin'      => $izin,
            'jumlah'    => $jumlah,
            'parent_id' => $parent_id,
            'tipe'      => 'jenis'
        );

        $result = $this->Model_grafik->input($data);

        if ($result) {
            $this->Model_grafik->update_total_bidang($parent_id);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Penyimpanan jenis izin gagal.');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data jenis izin berhasil disimpan.');
        }

        redirect('admin/grafik_izin_terbit', 'refresh');
    }

    // public function edit()
    // {
    //     $id = $this->input->post('id', true);
    //     $izin = $this->input->post('izin', true);
    //     $jumlah = $this->input->post('jumlah', true);

    //     $data = array(
    //         'id_grafik' => $id,
    //         'izin' => $izin,
    //         'jumlah' => $jumlah
    //     );

    //     $result = $this->Model_grafik->update($data, $id);

    //     if ($result) {
    //         $this->session->set_flashdata('success', 'Data Periode Grafik Izin Terbit berhasil diperbarui.');
    //     } else {
    //         $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
    //     }

    //     redirect('admin/grafik_izin_terbit', 'refresh');
    // }

    public function edit($id_grafik)
    {
        $row = $this->Model_grafik->get_by_id($id_grafik)->row();

        if (!$row) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/grafik_izin_terbit', 'refresh');
        }

        $izin = trim($this->input->post('izin', true));

        if ($izin == '') {
            $this->session->set_flashdata('error', 'Nama data wajib diisi.');
            redirect('admin/grafik_izin_terbit', 'refresh');
        }

        $this->db->trans_begin();

        if ($row->tipe == 'bidang') {
            $data = array(
                'izin' => $izin
            );

            $this->Model_grafik->update($data, $id_grafik);
        } else {
            $parent_id_lama = (int) $row->parent_id;
            $parent_id_baru = (int) $this->input->post('parent_id', true);
            $jumlah         = (int) $this->input->post('jumlah', true);

            if ($parent_id_baru <= 0) {
                $this->session->set_flashdata('error', 'Bidang induk wajib dipilih.');
                redirect('admin/grafik_izin_terbit', 'refresh');
            }

            $data = array(
                'izin'      => $izin,
                'jumlah'    => $jumlah,
                'parent_id' => $parent_id_baru
            );

            $this->Model_grafik->update($data, $id_grafik);

            // update total parent lama
            $this->Model_grafik->update_total_bidang($parent_id_lama);

            // update total parent baru kalau pindah bidang
            if ($parent_id_baru != $parent_id_lama) {
                $this->Model_grafik->update_total_bidang($parent_id_baru);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Data gagal diupdate.');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data berhasil diupdate.');
        }

        redirect('admin/grafik_izin_terbit', 'refresh');
    }

    public function edit_periode()
    {
        $id = $this->input->post('id', true);
        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);

        $data = array(
            'id_periode' => $id,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );

        $result = $this->Model_grafik->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Periode Grafik Izin Terbit berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_izin_terbit', 'refresh');
    }

    // public function hapus($id)
    // {
    //     $query = $this->db->get_where('grafik', ['id_grafik' => $id]);

    //     if ($query->num_rows() > 0) {
    //         $result = $this->Model_grafik->delete($id);

    //         if ($result) {
    //             $this->session->set_flashdata('success', 'Data Grafik Izin Terbit berhasil dihapus');
    //         } else {
    //             $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi');
    //         }
    //     } else {
    //         $this->session->set_flashdata('error', 'Data tidak ditemukan');
    //     }

    //     redirect('admin/grafik_izin_terbit', 'refresh');
    // }

    public function hapus($id_grafik)
    {
        $row = $this->Model_grafik->get_by_id($id_grafik)->row();

        if (!$row) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/grafik_izin_terbit', 'refresh');
        }

        $this->db->trans_begin();

        if ($row->tipe == 'bidang') {
            // hapus bidang + semua child
            $this->Model_grafik->delete_bidang_dan_anak($id_grafik);
        } else {
            // hapus jenis izin, lalu update total bidang induk
            $parent_id = (int) $row->parent_id;

            $this->Model_grafik->delete($id_grafik);
            $this->Model_grafik->update_total_bidang($parent_id);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Data gagal dihapus.');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }

        redirect('admin/grafik_izin_terbit', 'refresh');
    }
}
