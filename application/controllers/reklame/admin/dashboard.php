<?php

class dashboard extends CI_controller
{
    public function __construct()
    {
        parent::__construct();

        // 1. CEK SESSION: Jika tidak ada session 'logged_in_reklame', tendang ke login
        if (!$this->session->userdata('logged_in_reklame')) {
            $this->session->set_flashdata('pesan', 'Silakan login terlebih dahulu.');
            redirect('reklame'); // Sesuaikan dengan route login reklame Anda
        }

        // 2. CEGAH CACHE BROWSER: Agar tombol "Back" Chrome tidak berfungsi setelah logout
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Waktu di masa lalu

        $this->load->model('Model_reklame');
    }

    public function get_nagari_ajax()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');

        $nagari = $this->Model_reklame->get_nagari_by_kecamatan($id_kecamatan);

        echo json_encode($nagari);
    }

    // Oke
    public function index()
    {
        $data['title'] = 'Dashboard Reklame';

        $data['setor'] = $this->Model_reklame->hitung_setor();
        $data['belum_setor'] = $this->Model_reklame->hitung_belumsetor();
        $data['masih_berlaku'] = $this->Model_reklame->hitung_berlaku();
        $data['berlaku_habis'] = $this->Model_reklame->hitung_berlakuhabis();
        $data['total'] = $this->Model_reklame->hitung_total();

        $data_reklame = $this->Model_reklame->tampil_data();

        $reklame_grouped = [];

        foreach ($data_reklame as $row) {
            if (!isset($reklame_grouped[$row['id_reklame']])) {
                $reklame_grouped[$row['id_reklame']] = [
                    'id_reklame' => $row['id_reklame'],
                    'no_izin' => $row['no_izin'],
                    'nama_perusahaan' => $row['nama_perusahaan'],
                    'alamat_perusahaan' => $row['alamat_perusahaan'],
                    'retribusi' => $row['pajak'],
                    'pemohon' => $row['pemohon'],
                    'foto' => $row['foto'],
                    'no_hp' => $row['no_hp'],
                    'ket' => $row['ket'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'tgl_pasang' => $row['tgl_pasang'],
                    'jenis_reklame' => $row['jenis_reklame'],
                    'ukuran' => $row['ukuran'],
                    'lokasi' => []
                ];
            }

            $reklame_grouped[$row['id_reklame']]['lokasi'][] = [
                'alamat_pasang' => $row['alamat_pasang'],
                'nama_kecamatan' => $row['nama_kecamatan'],
                'nama_nagari' => $row['nama_nagari'],
                'lat' => $row['lat'],
                'long' => $row['long']
            ];
        }


        $data['reklame_grouped'] = $reklame_grouped;
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();

        $id_kecamatan = $this->input->post('kec_pasang');
        if ($id_kecamatan) {
            $data['nagari'] = $this->Model_reklame->get_nagari_by_kecamatan($id_kecamatan);
        } else {
            $data['nagari'] = [];
        }

        $data['selected_kecamatan'] = $id_kecamatan;

        if ($data['total'] > 0) {
            $data['persen_setor'] = ($data['setor'] > 0) ? ($data['setor'] / $data['total']) * 100 : 0;
            $data['persen_belumsetor'] = ($data['belum_setor'] > 0) ? ($data['belum_setor'] / $data['total']) * 100 : 0;
            $data['persen_berlaku'] = ($data['masih_berlaku'] > 0) ? ($data['masih_berlaku'] / $data['total']) * 100 : 0;
            $data['persen_berlakuhabis'] = ($data['berlaku_habis'] > 0) ? ($data['berlaku_habis'] / $data['total']) * 100 : 0;
        } else {
            $data['persen_setor'] = 0;
            $data['persen_belumsetor'] = 0;
            $data['persen_berlaku'] = 0;
            $data['persen_berlakuhabis'] = 0;
        }
        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('admin/reklame', $data);
        $this->load->view('templates/footer_reklame');
    }

    // Oke
    public function data()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->load->library('email');

        $data_reklame = $this->Model_reklame->tampil_data();

        $reklame_grouped = [];

        foreach ($data_reklame as $row) {

            $masa_berlaku = new DateTime($row['masa_berlaku']);
            $hari_ini = new DateTime();
            $interval = $hari_ini->diff($masa_berlaku)->days;
            $is_future = $masa_berlaku > $hari_ini;

            if ($interval <= 30 && $is_future && !empty($row['email'])) {
                // Setup konfigurasi email
                $config = [
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'kawansprt@gmail.com',
                    'smtp_pass' => 'ujqqbyvkafbykqgm',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'newline'   => "\r\n"
                ];
                $this->email->initialize($config);

                $this->email->from('kawansprt@gmail.com', 'Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu Kabupaten Agam');
                $this->email->to($row['email']);
                $this->email->subject('Peringatan Masa Berlaku Reklame');

                // Ubah string tanggal ke objek DateTime
                $tanggal_berlaku = new DateTime($row['masa_berlaku']);

                // Format tanggal ke 'd F Y' (misal: 31 May 2025)
                $format_english = $tanggal_berlaku->format('d F Y');

                // Kalau mau bulan dalam Bahasa Indonesia, buat mapping bulan manual:
                $bulan_indonesia = [
                    'January' => 'Januari',
                    'February' => 'Februari',
                    'March' => 'Maret',
                    'April' => 'April',
                    'May' => 'Mei',
                    'June' => 'Juni',
                    'July' => 'Juli',
                    'August' => 'Agustus',
                    'September' => 'September',
                    'October' => 'Oktober',
                    'November' => 'November',
                    'December' => 'Desember',
                ];

                // Ganti nama bulan Inggris ke Indonesia
                foreach ($bulan_indonesia as $inggris => $indonesia) {
                    if (strpos($format_english, $inggris) !== false) {
                        $format_indo = str_replace($inggris, $indonesia, $format_english);
                        break;
                    }
                }

                $this->email->message("
                <p>Yth. {$row['nama_perusahaan']} </p>
                <p>di {$row['alamat_perusahaan']}</p>
                <p>Masa berlaku izin reklame dengan No Izin: <strong>{$row['no_izin']}</strong> akan berakhir pada <strong>{$format_indo}</strong>.</p>
                <p>Mohon segera melakukan perpanjangan untuk menghindari sanksi.</p>
                <p>Terima kasih.</p>
            ");

                // Cek apakah email sudah dikirim dalam bulan ini
                $this->db->where('id_reklame', $row['id_reklame']);
                $this->db->where('MONTH(tanggal_kirim)', date('m'));
                $this->db->where('YEAR(tanggal_kirim)', date('Y'));
                $already_sent = $this->db->get('log_email')->num_rows();

                if ($already_sent == 0) {
                    // Kirim email
                    if (@$this->email->send()) {
                        // Simpan log pengiriman email
                        $this->db->insert('log_email', [
                            'id_reklame' => $row['id_reklame'],
                            'email' => $row['email'],
                            'tanggal_kirim' => date('Y-m-d H:i:s')
                        ]);
                        // echo "Email terkirim ke: " . $row['email'] . "<br>";
                    } else {
                        // echo "Gagal mengirim email ke: " . $row['email'] . "<br>";
                    }
                } else {
                    // echo "Email sudah dikirim hari ini ke: " . $row['email'] . "<br>";
                }
            }

            // Pengelompokan data reklame
            if (!isset($reklame_grouped[$row['id_reklame']])) {
                $reklame_grouped[$row['id_reklame']] = [
                    'id_reklame' => $row['id_reklame'],
                    'no_izin' => $row['no_izin'],
                    'nama_perusahaan' => $row['nama_perusahaan'],
                    'alamat_perusahaan' => $row['alamat_perusahaan'],
                    'retribusi' => $row['pajak'],
                    'pemohon' => $row['pemohon'],
                    'email' => $row['email'],
                    'foto' => $row['foto'],
                    'no_hp' => $row['no_hp'],
                    'ket' => $row['ket'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'tgl_pasang' => $row['tgl_pasang'],
                    'jenis_reklame' => $row['jenis_reklame'],
                    'ukuran' => $row['ukuran'],
                    'lokasi' => []
                ];
            }

            $reklame_grouped[$row['id_reklame']]['lokasi'][] = [
                'alamat_pasang' => $row['alamat_pasang'],
                'nama_kecamatan' => $row['nama_kecamatan'],
                'nama_nagari' => $row['nama_nagari'],
                'lat' => $row['lat'],
                'long' => $row['long']
            ];
        }

        $data['reklame_grouped'] = $reklame_grouped;
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();

        $id_kecamatan = $this->input->post('kec_pasang');
        if ($id_kecamatan) {
            $data['nagari'] = $this->Model_reklame->get_nagari_by_kecamatan($id_kecamatan);
        } else {
            $data['nagari'] = [];
        }

        $data['selected_kecamatan'] = $id_kecamatan;

        $data['nagari_per_unit'] = [];
        foreach ($reklame_grouped as $reklame) {
            foreach ($reklame['lokasi'] as $lokasi) {
                $id_kec = $this->Model_reklame->get_id_kecamatan_by_nama($lokasi['nama_kecamatan']);
                if ($id_kec && !isset($data['nagari_per_unit'][$id_kec])) {
                    $data['nagari_per_unit'][$id_kec] = $this->Model_reklame->get_nagari_by_kecamatan($id_kec);
                }
            }
        }

        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('data_reklame', $data);
        $this->load->view('modal/modal_tambah_unit_reklame', $data);
        $this->load->view('edit/modal_edit_unit_reklame', $data);
        $this->load->view('templates/footer_aset');
    }

    // Oke
    public function tambah_multi()
    {
        $this->load->library('upload');

        $config['upload_path'] = './assets/imgupload/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('dashboard');
        }

        $upload_data = $this->upload->data();
        $foto = $upload_data['file_name'];

        $data_reklame = [
            'no_izin'           => $this->input->post('no_izin'),
            'jenis_reklame'     => $this->input->post('jenis_reklame'),
            'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
            'email'             => $this->input->post('email'),
            'ukuran'            => $this->input->post('ukuran'),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
            'pajak'             => $this->input->post('pajak'),
            'pemohon'           => $this->input->post('pemohon'),
            'foto'              => $foto,
            'no_hp'             => $this->input->post('no_hp'),
            'ket'               => $this->input->post('ket'),
            'masa_berlaku'      => $this->input->post('masa_berlaku'),
            'tgl_pasang'        => $this->input->post('tgl_pasang'),
            'tgl_input'         => date('Y-m-d H:i:s'),
        ];

        $id_reklame = $this->Model_reklame->simpanReklame($data_reklame);

        $units = $this->input->post('unit');
        $lokasi = [];

        if (!empty($units)) {
            foreach ($units as $unit) {
                $lokasi[] = [
                    'id_reklame'     => $id_reklame,
                    'kec_pasang'     => $unit['kec_pasang'],
                    'nag_pasang'     => $unit['nagari'],
                    'alamat_pasang'  => $unit['alamat_pasang'],
                    'lat'            => $unit['lat'],
                    'long'           => $unit['long']
                ];
            }
            $this->Model_reklame->simpanBanyakLokasi($lokasi);
        }

        $this->session->set_flashdata('success', 'Data reklame berhasil ditambahkan.');
        redirect('dashboard/data');
    }

    // Oke
    public function update_multi($id_reklame)
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('upload');

        $data = [
            'no_izin'           => $this->input->post('no_izin'),
            'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
            'email'             => $this->input->post('email'),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
            'pemohon'           => $this->input->post('pemohon'),
            'no_hp'             => $this->input->post('no_hp'),
            'jenis_reklame'     => $this->input->post('jenis_reklame'),
            'ukuran'            => $this->input->post('ukuran'),
            'pajak'         => $this->input->post('pajak'),
            'ket'               => $this->input->post('ket'),
            'tgl_pasang'        => $this->input->post('tgl_pasang'),
            'masa_berlaku'      => $this->input->post('masa_berlaku'),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']   = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = time() . '_' . $_FILES['foto']['name'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $uploaded_data = $this->upload->data();
                $data['foto'] = $uploaded_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dashboard');
                return;
            }
        }

        $this->Model_reklame->updateReklame($id_reklame, $data);

        $units = $this->input->post('unit');

        $this->Model_reklame->deleteLokasiByReklameId($id_reklame);

        foreach ($units as $unit) {
            $unitData = [
                'id_reklame'    => $id_reklame,
                'kec_pasang'    => $unit['kec_pasang'],
                'nag_pasang'    => $unit['nagari'],
                'alamat_pasang' => $unit['alamat_pasang'],
                'lat'           => $unit['lat'],
                'long'          => $unit['long'],
            ];
            $this->Model_reklame->insertLokasi($unitData);
        }

        $this->session->set_flashdata('berhasil', 'Data reklame berhasil diperbarui.');
        redirect('dashboard/data');
    }

    // Oke
    public function hapus($id_reklame = null)
    {
        if (!$id_reklame) {
            show_404(); // atau redirect('dashboard/data');
        }

        $this->db->where('id_reklame', $id_reklame);
        $query = $this->db->get('reklame');
        $row = $query->row();

        if ($row && file_exists("./assets/imgupload/$row->foto")) {
            unlink("./assets/imgupload/$row->foto");
        }

        $this->Model_reklame->deleteLokasi($id_reklame);
        $this->Model_reklame->delete($id_reklame);

        $this->session->set_flashdata("berhasil", "Hapus data reklame " . $row->nama_perusahaan . " berhasil !");
        redirect('dashboard/data');
    }


    // Oke
    public function peta()
    {
        $data_reklame = $this->Model_reklame->tampil_data();

        $reklame_grouped = [];

        foreach ($data_reklame as $row) {
            if (!isset($reklame_grouped[$row['id_reklame']])) {
                $reklame_grouped[$row['id_reklame']] = [
                    'id_reklame' => $row['id_reklame'],
                    'no_izin' => $row['no_izin'],
                    'nama_perusahaan' => $row['nama_perusahaan'],
                    'alamat_perusahaan' => $row['alamat_perusahaan'],
                    'retribusi' => $row['pajak'],
                    'pemohon' => $row['pemohon'],
                    'foto' => $row['foto'],
                    'no_hp' => $row['no_hp'],
                    'ket' => $row['ket'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'tgl_pasang' => $row['tgl_pasang'],
                    'jenis_reklame' => $row['jenis_reklame'],
                    'ukuran' => $row['ukuran'],
                    'lokasi' => []
                ];
            }

            $reklame_grouped[$row['id_reklame']]['lokasi'][] = [
                'alamat_pasang' => $row['alamat_pasang'],
                'nama_kecamatan' => $row['nama_kecamatan'],
                'nama_nagari' => $row['nama_nagari'],
                'lat' => $row['lat'],
                'long' => $row['long']
            ];
        }

        $data['reklame_grouped'] = $reklame_grouped;
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();

        $id_kecamatan = $this->input->post('kec_pasang');
        if ($id_kecamatan) {
            $data['nagari'] = $this->Model_reklame->get_nagari_by_kecamatan($id_kecamatan);
        } else {
            $data['nagari'] = [];
        }

        $data['selected_kecamatan'] = $id_kecamatan;
        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('peta_reklame', $data);
    }

    // Oke
    public function laporan()
    {
        $id_kecamatan = $this->input->post('kec_pasang');
        $bulan_awal = $this->input->post('bulan_awal');
        $bulan_akhir = $this->input->post('bulan_akhir');
        $tahun = $this->input->post('tahun');

        // Kirim ke model dengan rentang bulan
        $data_reklame = $this->Model_reklame->tampil_data_filtered($id_kecamatan, $bulan_awal, $bulan_akhir, $tahun);

        $reklame_grouped = [];

        foreach ($data_reklame as $row) {
            if (!isset($reklame_grouped[$row['id_reklame']])) {
                $reklame_grouped[$row['id_reklame']] = [
                    'id_reklame' => $row['id_reklame'],
                    'no_izin' => $row['no_izin'],
                    'nama_perusahaan' => $row['nama_perusahaan'],
                    'alamat_perusahaan' => $row['alamat_perusahaan'],
                    'retribusi' => $row['pajak'],
                    'pemohon' => $row['pemohon'],
                    'foto' => $row['foto'],
                    'no_hp' => $row['no_hp'],
                    'ket' => $row['ket'],
                    'masa_berlaku' => $row['masa_berlaku'],
                    'tgl_pasang' => $row['tgl_pasang'],
                    'jenis_reklame' => $row['jenis_reklame'],
                    'ukuran' => $row['ukuran'],
                    'lokasi' => []
                ];
            }

            $reklame_grouped[$row['id_reklame']]['lokasi'][] = [
                'alamat_pasang' => $row['alamat_pasang'],
                'nama_kecamatan' => $row['nama_kecamatan'],
                'nama_nagari' => $row['nama_nagari'],
                'lat' => $row['lat'],
                'long' => $row['long']
            ];
        }

        $data['reklame_grouped'] = $reklame_grouped;
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();
        $data['selected_kecamatan'] = $id_kecamatan;
        $data['selected_bulan_awal'] = $bulan_awal;
        $data['selected_bulan_akhir'] = $bulan_akhir;
        $data['selected_tahun'] = $tahun;

        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('laporan', $data);
        $this->load->view('templates/footer_aset');
    }
}
