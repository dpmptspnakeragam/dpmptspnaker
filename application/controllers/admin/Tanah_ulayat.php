<?php
class Tanah_ulayat extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }

        $this->load->model('Model_tanah_ulayat');
    }

    public function index()
    {
        $data['kecamatan'] = $this->Model_tanah_ulayat->tampil_kecamatan();
        $data['home'] = 'Home';
        $data['title'] = 'Tanah Ulayat';

        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/tanah_ulayat', $data);
        $this->load->view('modal/modal_tambah_tanahulayat');
        $this->load->view('templates/admin_footer');
    }

    public function rincian($id_kecamatan)
    {
        $id_kecamatan = $id_kecamatan;
        $kecamatan = $this->Model_tanah_ulayat->tampil_kecamatan(); // Mendapatkan semua kecamatan
        $get_kecamatan = $this->Model_tanah_ulayat->get_kecamatan($id_kecamatan); // Mendapatkan kecamatan berdasarkan ID
        $tanah_ulayat = $this->Model_tanah_ulayat->tampil_data($id_kecamatan); // Mendapatkan data tanah ulayat

        $data['home'] = 'Home';

        // Pastikan $get_kecamatan tidak null sebelum mengakses properti
        if ($get_kecamatan) {
            $data['title'] = $get_kecamatan->kecamatan; // Properti 'kecamatan' diambil dari objek
        } else {
            $data['title'] = 'Kecamatan Tidak Ditemukan';
        }

        // Load views
        $this->load->view('templates/admin_header', $data, FALSE);
        $this->load->view('templates/admin_navbar', $data, FALSE);
        $this->load->view('templates/admin_sidebar', $data, FALSE);
        $this->load->view('admin/rincian_ulayat', array(
            'id_kecamatan' => $id_kecamatan,
            'kecamatan' => $kecamatan,
            'tanah_ulayat' => $tanah_ulayat,
            'get_kecamatan' => $get_kecamatan
        ));
        $this->load->view('edit/edit_tanahulayat', array('tanah_ulayat' => $tanah_ulayat));
        $this->load->view('templates/admin_footer');
    }

    public function tambah()
    {
        $id_ulayat = $this->input->post('id', true);
        $kecamatan = $this->input->post('kecamatan', true);
        $lokasi = $this->input->post('lokasi', true);
        $luas = $this->input->post('luas', true);
        $status = $this->input->post('status', true);
        $jenis = $this->input->post('jenis', true);
        $bentuk = $this->input->post('bentuk', true);

        $data = array(
            'id_ulayat' => $id_ulayat,
            'kecamatan' => $kecamatan,
            'lokasi' => $lokasi,
            'luas' => $luas,
            'status' => $status,
            'jenis' => $jenis,
            'bentuk' => $bentuk
        );

        $result = $this->Model_tanah_ulayat->input($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data Tanah Ulayat berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Penyimpanan data gagal. Silahkan coba lagi.');
        }

        redirect('admin/tanah_ulayat', 'refresh');
    }

    public function edit()
    {
        $id_ulayat = $this->input->post('id', true);
        $kecamatan = $this->input->post('kecamatan', true);
        $lokasi = $this->input->post('lokasi', true);
        $luas = $this->input->post('luas', true);
        $status = $this->input->post('status', true);
        $jenis = $this->input->post('jenis', true);
        $bentuk = $this->input->post('bentuk', true);

        $data = array(
            'id_ulayat' => $id_ulayat,
            'kecamatan' => $kecamatan,
            'lokasi' => $lokasi,
            'luas' => $luas,
            'status' => $status,
            'jenis' => $jenis,
            'bentuk' => $bentuk
        );

        $result = $this->Model_tanah_ulayat->update($data, $id_ulayat);

        if ($result) {
            $this->session->set_flashdata('success', 'Data ' . $lokasi . ' berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Perbarui data gagal. Silakan coba lagi.');
        }

        echo '<script>history.back(self)</script>';
    }

    public function hapus($id_ulayat)
    {
        $this->db->where('id_ulayat', $id_ulayat);
        $query = $this->db->get('tanah_ulayat');
        $row = $query->row();

        $result = $this->Model_tanah_ulayat->delete($id_ulayat);

        if ($result) {
            $this->session->set_flashdata('success', 'Data ' . $row->lokasi . ' berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Penghapusan data gagal. Silahkan coba lagi.');
        }

        echo '<script>history.back(self)</script>';
    }
}
