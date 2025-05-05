<?php
class Tanah_ulayat extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('home');
        }
    }

    public function index()
    {
        $this->load->model('Model_tanah_ulayat');
        $data['kecamatan'] = $this->Model_tanah_ulayat->tampil_kecamatan();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/tanah_ulayat', $data);
        $this->load->view('modal/modal_tambah_tanahulayat');
        //$this->load->view('modal/modal_tambah_tanah_ulayat', $data);
        //$this->load->view('edit/edit_tanah_ulayat', $data);
        $this->load->view('templates/footer_admin');
    }

    public function rincian($id_kecamatan)
    {
        $this->load->model('Model_tanah_ulayat');
        $id_kecamatan = $id_kecamatan;
        $kecamatan = $this->Model_tanah_ulayat->tampil_kecamatan();
        $get_kecamatan = $this->Model_tanah_ulayat->get_kecamatan($id_kecamatan);
        $tanah_ulayat = $this->Model_tanah_ulayat->tampil_data($id_kecamatan);
        $this->load->view('templates/header_admin');
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin/rincian_ulayat', array('id_kecamatan' => $id_kecamatan, 'kecamatan' => $kecamatan, 'tanah_ulayat' => $tanah_ulayat, 'get_kecamatan' => $get_kecamatan));
        $this->load->view('edit/edit_tanahulayat', $tanah_ulayat);
        $this->load->view('templates/footer_admin');
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
        $this->load->model('Model_tanah_ulayat');
        $this->Model_tanah_ulayat->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data <b>$lokasi</b> berhasil !");
        echo '<script>history.back(self)</script>';
    }

    public function ubah()
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
        $this->load->model('Model_tanah_ulayat');
        $this->Model_tanah_ulayat->update($data, $id_ulayat);
        $this->session->set_flashdata("berhasil", "Ubah data <b>$lokasi</b> berhasil !");
        echo '<script>history.back(self)</script>';
    }

    public function hapus($id_ulayat)
    {
        $this->db->where('id_ulayat', $id_ulayat);
        $query = $this->db->get('tanah_ulayat');
        $row = $query->row();

        $this->load->model('Model_tanah_ulayat');
        $this->Model_tanah_ulayat->delete($id_ulayat);
        $this->session->set_flashdata("gagal", "Hapus data <b>$row->lokasi</b> berhasil !");

        echo '<script>history.back(self)</script>';
    }
}
