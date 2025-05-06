<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	var $API = "";
	public function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
		$this->load->library('email');

		$this->API = "https://sicantikws.layanan.go.id/api/TemplateData/keluaran/24218.json";

		$this->load->model('Model_informasi');
		$this->load->model('Model_peluang_investasi');
		$this->load->model('Model_grafik');
		$this->load->model('Model_running_teks');
		$this->load->model('Model_banner');
		$this->load->model('Model_grafik_investasi');
		$this->load->model('Model_grafik_skm');
		$this->load->model('Model_grafik_izin_tahun');
		$this->load->model('Model_potensi_investasi');
		$this->load->model('Model_sarpras');
		$this->load->model('Model_tanah_ulayat');
		$this->load->model('Model_grafik_nib');
		$this->load->model('Model_pengaturan');
		$this->load->model('Model_kadis');

		$this->load->model('Model_pegawai');
		$this->load->model('Model_pengaduan');

		$this->load->model('Model_standar_pelayanan');
		$this->load->model('admin/Model_skm_gambar');

		$this->load->model('Model_pesan');
	}

	public function index()
	{
		$ip    = $this->input->ip_address(); // Mendapatkan IP user
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
		$tahunlalu = date("Y") - 1;
		$tahunini = date("Y");
		$waktu = time(); //
		$timeinsert = date("Y-m-d H:i:s");
		// Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
		$s = $this->db->query("SELECT * FROM visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
		$ss = isset($s) ? ($s) : 0;
		// Kalau belum ada, simpan data user tersebut ke database
		if ($ss == 0) {
			$this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
		}
		// Jika sudah ada, update
		else {
			$this->db->query("UPDATE visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
		}

		$pengunjunghariini  = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung
		$dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();
		$totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung
		$bataswaktu = time() - 300;
		$pengunjungonline  = $this->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->num_rows(); // hitung pengunjung online
		$dbpengunjung2020 = $this->db->query("SELECT COUNT(hits) as hits FROM visitor WHERE YEAR(date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) ")->row();
		$pengunjung2020 = isset($dbpengunjung2020->hits) ? ($dbpengunjung2020->hits) : 0;
		$dbpengunjung2021 = $this->db->query("SELECT COUNT(hits) as hits FROM visitor WHERE YEAR(date) = YEAR(CURRENT_DATE())")->row();
		$pengunjung2021 = isset($dbpengunjung2021->hits) ? ($dbpengunjung2021->hits) : 0;
		$dbbulanlalu = $this->db->query("SELECT COUNT(hits) as hits FROM visitor WHERE MONTH(date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) and YEAR(date) = YEAR(CURRENT_DATE())")->row();
		$bulanlalu = isset($dbbulanlalu->hits) ? ($dbbulanlalu->hits) : 0;
		$dbbulanini = $this->db->query("SELECT COUNT(hits) as hits FROM visitor WHERE MONTH(date) = MONTH(CURRENT_DATE()) and YEAR(date) = YEAR(CURRENT_DATE())")->row();
		$bulanini = isset($dbbulanini->hits) ? ($dbbulanini->hits) : 0;

		$data = [
			'pengunjunghariini' 	=> $pengunjunghariini,
			'totalpengunjung' 		=> $totalpengunjung,
			'pengunjungonline' 		=> $pengunjungonline,
			'pengunjung2020' 		=> $pengunjung2020,
			'pengunjung2021' 		=> $pengunjung2021,
			'pengunjungbulanlalu' 	=> $bulanlalu,
			'pengunjungbulanini' 	=> $bulanini,

			'periode_grafik' 			=> $this->Model_grafik->tampil_data_periode(),
			'periode_grafik_investasi' 	=> $this->Model_grafik_investasi->tampil_data_periode(),
			'periode_grafik_skm' 		=> $this->Model_grafik_skm->tampil_data_periode(),

			'grafik_tahun'		 		=> $this->Model_grafik_izin_tahun->tampil_data(),
			'tahun_fields'		 	=> $this->Model_grafik_izin_tahun->tampil_data_tahun(),

			'periode_grafik_oss'	=> $this->Model_grafik_nib->tampil_data_periode(),
			'banner'				=> $this->Model_banner->tampil_data(),
			'teks' 					=> $this->Model_running_teks->tampil_data(),
			'grafik' 				=> $this->Model_grafik->tampil_data(),
			'grafik_investasi' 		=> $this->Model_grafik_investasi->tampil_data(),
			'grafik_skm'			=> $this->Model_grafik_skm->tampil_data(),
			'berita' 				=> $this->Model_informasi->informasi(),
			'investasi' 			=> $this->Model_peluang_investasi->tampil_data(),
			'potensi_investasi' 	=> $this->Model_potensi_investasi->tampil_data(),
			'kabid' 				=> $this->Model_pegawai->tampil_kabid(),
			'pegawai' 				=> $this->Model_pegawai->tampil_pegawai(),
			'sarpras' 				=> $this->Model_sarpras->tampil_data(),
			'idmax' 				=> $this->Model_informasi->idmax(),
			'ulayat' 				=> $this->Model_tanah_ulayat->tampil_kecamatan(),
			'grafik_nib' 			=> $this->Model_grafik_nib->tampil_data_nib(),
			'grafik_risiko' 		=> $this->Model_grafik_nib->tampil_data_risiko(),
			'grafik_kecamatan' 		=> $this->Model_grafik_nib->tampil_data_kecamatan(),
			'grafik_kbli' 			=> $this->Model_grafik_nib->tampil_data_kbli(),
			'pengaturan' 			=> $this->Model_pengaturan->tampil_data(),
			'kadis' 				=> $this->Model_kadis->tampil_kadis(),

			'pdf' 					=> $this->Model_standar_pelayanan->tampil_data(),
			'skm_gambar'			=> $this->Model_skm_gambar->tampil_data(),

			'adminonline'			=> $this->Model_pesan->get_online_admins()
		];

		// $data['grafik_tahun'] = $this->Model_grafik_izin_tahun->tampil_data();
		$this->load->view('templates/header');
		$this->load->view('home', $data);
		$this->load->view('modal/modal_pelayanan');
		$this->load->view('modal/modal_standar_pelayanan');
		$this->load->view('modal/modal_visi');
		$this->load->view('modal/modal_misi');
		$this->load->view('modal/modal_fungsi');
		$this->load->view('modal/modal_tugas');
		$this->load->view('modal/modal_investasi');
		$this->load->view('modal/modal_potensi_investasi');
		$this->load->view('modal/modal_tracking');
		$this->load->view('modal/modal_tracking_pengaduan');
		$this->load->view('modal/modal_struktur');
		$this->load->view('modal/modal_maklumat');
		$this->load->view('modal/modal_sarpras');
		$this->load->view('modal/modal_retribusi');
		$this->load->view('modal/modal_kabid', $data);
		$this->load->view('modal/modal_detail_investasi', $data);
		$this->load->view('modal/modal_detail_potensi_investasi', $data);
		$this->load->view('modal/modal_informasi', $data);
		$this->load->view('modal/modal_tanahulayat', $data);
		$this->load->view('modal/modal_kadis', $data);
		$this->load->view('templates/footer');
	}

	public function view_pegawai()
	{
		$id_kabid = $_GET['id_kabid'];
		$data['view_pegawai'] = $this->Model_pegawai->view_pegawai($id_kabid);
		$this->load->view('templates/header');
		$this->load->view('view_pegawai', $data);
		$this->load->view('templates/footer');
	}

	public function tracking_sicantik()
	{
		$no_permohonan = $_GET['no_permohonan'];
		echo json_encode(file_get_contents("https://sicantik.go.id/api/TemplateData/keluaran/24218.json?no_permohonan=$no_permohonan"), TRUE);
	}

	public function tracking_pengaduan()
	{
		$no_pengaduan = $_GET['no_pengaduan'];
		$pengaduan = $this->Model_pengaduan->getPengaduan($no_pengaduan);
		echo json_encode($pengaduan, TRUE);
	}

	public function kirim_pengaduan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('hp', 'Nomor WhatsApp', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('lokasi_kejadian', 'Lokasi Kejadian', 'required');
		$this->form_validation->set_rules('materi_pengaduan', 'Uraian Pengaduan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$unique_id = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
			$date = new DateTime();
			$formatted_date = $date->format('Y-m-d H:i:s');

			// Default file name
			$file_name = null;

			// Proses upload file jika ada
			if (!empty($_FILES['file_pengaduan']['name'])) {
				$config['upload_path']   = './assets/imgupload/';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx';
				$config['max_size']      = 22000; // Max 22MB
				$config['file_name']     = 'PENGADUAN_' . $unique_id . '_' . time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_pengaduan')) {
					$file_name = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata('error_pengaduan', $this->upload->display_errors());
					redirect('#pengaduan');
				}
			}

			// Input data
			$input = [
				'no_pengaduan' => $unique_id,
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'hp' => $this->input->post('hp'),
				'email' => $this->input->post('email'),
				'jenis_pengaduan' => 'Online',
				'lokasi_kejadian' => $this->input->post('lokasi_kejadian'),
				'waktu_kejadian' => $formatted_date,
				'materi_pengaduan' => $this->input->post('materi_pengaduan'),
				'file_pengaduan' => $file_name,
				'status' => 'Proses'
			];

			// Sanitize and save data
			$data = $this->security->xss_clean($input);
			$this->Model_pengaduan->insert_pengaduan($data);

			// Send email
			$this->email->from('pengaduan@dpmptsp.agamkab.go.id', 'DPMPTSP Kabupaten Agam');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Pengaduan Berhasil Dikirim');
			$this->email->message("
            Pengaduan Anda dengan nomor <b>$unique_id</b> telah berhasil disimpan, 
            silahkan melakukan tracking di 
            <a href='https://dpmptsp.agamkab.go.id#pengaduan'>https://dpmptsp.agamkab.go.id#pengaduan</a> 
            untuk mengetahui <b>Proses Pengaduan</b>. Terima kasih.");
			$this->session->set_flashdata('berhasil_pengaduan', "Pengaduan berhasil disimpan dengan Nomor <b>$unique_id</b>. Lakukan Tracking Pengaduan untuk mengetahui informasi lebih lanjut. Terima kasih!!");
		} else {
			$this->session->set_flashdata('error_pengaduan', 'Pengaduan gagal disimpan. Perhatikan semua inputan!!');
		}

		redirect('#pengaduan');
	}

	public function clear_flashdata()
	{
		$alertKey = $this->input->post('alert_key');

		if ($alertKey) {
			$this->session->set_flashdata($alertKey, null);
		}
	}
}
