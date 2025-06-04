<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grafik_nib extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load->model('Model_grafik_nib');
        $data['grafik_nib'] = $this->Model_grafik_nib->tampil_data_nib();
        $data['grafik_risiko'] = $this->Model_grafik_nib->tampil_data_risiko();
        $data['grafik_kecamatan'] = $this->Model_grafik_nib->tampil_data_kecamatan();
        $data['grafik_kbli'] = $this->Model_grafik_nib->tampil_data_kbli();
        $data['periode_grafik'] = $this->Model_grafik_nib->tampil_data_periode();

        $data['home'] = 'Home';
        $data['title'] = 'Grafik NIB';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);

        $this->load->view('admin/grafik_nib', $data);

        $this->load->view('modal/tambah/grafik_nib');
        $this->load->view('modal/edit/grafik_nib');
        $this->load->view('modal/hapus/grafik_nib');

        $this->load->view('modal/tambah/grafik_risiko');
        $this->load->view('modal/edit/grafik_risiko');
        $this->load->view('modal/hapus/grafik_risiko');

        $this->load->view('modal/tambah/grafik_kecamatan');
        $this->load->view('modal/edit/grafik_kecamatan');
        $this->load->view('modal/hapus/grafik_kecamatan');

        $this->load->view('modal/tambah/grafik_kbli');
        $this->load->view('modal/edit/grafik_kbli');
        $this->load->view('modal/hapus/grafik_kbli');

        $this->load->view('modal/edit/periode_grafik_nib');

        $this->load->view('templates/admin_footer');
    }

    // -----------------------------Grafik NIB----------------------------- //
    public function tambah_nib()
    {
        $nib = $this->input->post('nib', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'nib' => $nib,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->input_nib($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$nib</b> berhasil ditambahkan.");
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function ubah()
    {
        $id = $this->input->post('id', true);
        $nib = $this->input->post('nib', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'nib' => $nib,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->update_nib($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$nib</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function hapus_nib($id)
    {
        $this->load->model('Model_grafik_nib');

        $data_nib = $this->Model_grafik_nib->get_by_id_nib($id);

        if ($data_nib) {
            $nib = $data_nib->nib;

            $result = $this->Model_grafik_nib->delete_nib($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$nib</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }
    // -----------------------------Grafik NIB----------------------------- //

    // -----------------------------Grafik Risiko----------------------------- //
    public function tambah_risiko()
    {
        $risiko = $this->input->post('risiko', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'risiko' => $risiko,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->input_risiko($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data Risiko <b>$risiko</b> berhasil ditambahkan.");
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function ubah_risiko()
    {
        $id = $this->input->post('id', true);
        $risiko = $this->input->post('risiko', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'risiko' => $risiko,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->update_risiko($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', "Data Risiko <b>$risiko</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function hapus_risiko($id)
    {
        $this->load->model('Model_grafik_nib');

        $data_risiko = $this->Model_grafik_nib->get_by_id_risiko($id);

        if ($data_risiko) {
            $risiko = $data_risiko->risiko;

            $result = $this->Model_grafik_nib->delete_risiko($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data Risiko <b>$risiko</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }
    // -----------------------------Grafik Risiko----------------------------- //

    // -----------------------------Grafik Kecamatan----------------------------- //
    public function tambah_kecamatan()
    {
        $kecamatan = $this->input->post('kecamatan', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'kecamatan' => $kecamatan,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->input_kecamatan($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$kecamatan</b> berhasil ditambahkan.");
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function ubah_kecamatan()
    {
        $id = $this->input->post('id', true);
        $kecamatan = $this->input->post('kecamatan', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'kecamatan' => $kecamatan,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->update_kecamatan($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$kecamatan</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function hapus_kecamatan($id)
    {
        $this->load->model('Model_grafik_nib');

        $data_kecamatan = $this->Model_grafik_nib->get_by_id_kecamatan($id);

        if ($data_kecamatan) {
            $kecamatan = $data_kecamatan->kecamatan;

            $result = $this->Model_grafik_nib->delete_kecamatan($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$kecamatan</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }
    // -----------------------------Grafik Kecamatan----------------------------- //

    // -----------------------------Grafik KBLI----------------------------- //
    public function tambah_kbli()
    {
        $kbli = $this->input->post('kbli', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'kbli' => $kbli,
            'jumlah' => $jumlah
        );
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->input_kbli($data);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$kbli</b> berhasil ditambahkan.");
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function ubah_kbli()
    {
        $id = $this->input->post('id', true);
        $kbli = $this->input->post('kbli', true);
        $jumlah = $this->input->post('jumlah', true);

        $data = array(
            'id_grafik' => $id,
            'kbli' => $kbli,
            'jumlah' => $jumlah
        );

        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->update_kbli($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', "Data <b>$kbli</b> berhasil diperbarui.");
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }

    public function hapus_kbli($id)
    {

        $this->load->model('Model_grafik_nib');

        $data_kbli = $this->Model_grafik_nib->get_by_id_kbli($id);

        if ($data_kbli) {
            $kbli = $data_kbli->kbli;

            $result = $this->Model_grafik_nib->delete_kbli($id);

            if ($result) {
                $this->session->set_flashdata('success', "Data <b>$kbli</b> berhasil dihapus.");
            } else {
                $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('admin/grafik_nib', 'refresh');
    }
    // -----------------------------Grafik KBLI----------------------------- //

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
        $this->load->model('Model_grafik_nib');

        $result = $this->Model_grafik_nib->update_periode($data, $id);

        if ($result) {
            $this->session->set_flashdata('success', 'Periode Grafik NIB berhasil diperbarui ');
        } else {
            $this->session->set_flashdata('error', 'Perbarui periode gagal. Silahkan coba lagi');
        }

        redirect('admin/grafik_nib', 'refresh');
    }
}
