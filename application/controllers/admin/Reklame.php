<?php
class Reklame extends CI_controller
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
        $this->load->model('Model_reklame');
        $data['setor'] = $this->Model_reklame->hitung_setor();
        $data['belum_setor'] = $this->Model_reklame->hitung_belumsetor();
        $data['masih_berlaku'] = $this->Model_reklame->hitung_berlaku();
        $data['berlaku_habis'] = $this->Model_reklame->hitung_berlakuhabis();
        $data['total'] = $this->Model_reklame->hitung_total();
        $data['persen_setor'] = $data['setor'] / $data['total'] * 100;
        $data['persen_belumsetor'] = $data['belum_setor'] / $data['total'] * 100;
        $data['persen_berlaku'] = $data['masih_berlaku'] / $data['total'] * 100;
        $data['persen_berlakuhabis'] = $data['berlaku_habis'] / $data['total'] * 100;
        //$data['idmax'] = $this->Model_reklame->idmax();
        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('admin/dashboard_reklame', $data);
        //$this->load->view('modal/modal_tambah_reklame', $data);
        //$this->load->view('edit/edit_reklame', $data);
        $this->load->view('templates/footer_admin');
    }

    public function get_nagari()
    {
        $this->load->model('Model_reklame');
        $id_kecamatan = $this->input->post('id', TRUE);
        $data = $this->Model_reklame->get_nagari($id_kecamatan);
        echo json_encode($data);
    }

    public function data()
    {
        $this->load->model('Model_reklame');
        $data['reklame'] = $this->Model_reklame->tampil_data();
        //$data['idmax'] = $this->Model_reklame->idmax();
        $data['kecamatan'] = $this->Model_reklame->get_kecamatan();
        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('admin/data_reklame', $data);
        $this->load->view('modal/modal_tambah_reklame', $data);
        $this->load->view('modal/modal_export_reklame_tgl');
        $this->load->view('edit/edit_data_reklame', $data);
        $this->load->view('templates/footer_aset');
    }

    public function peta()
    {
        $this->load->model('Model_reklame');
        $data['reklame'] = $this->Model_reklame->tampil_data();
        //$data['idmax'] = $this->Model_reklame->idmax();
        $this->load->view('templates/header_reklame');
        $this->load->view('templates/navbar_reklame');
        $this->load->view('admin/peta_reklame', $data);
        //$this->load->view('templates/footer_aset');
    }

    public function tambah()
    {
        $no_izin = $this->input->post('no_izin', true);
        $nama_perusahaan = $this->input->post('nama_perusahaan', true);
        $alamat_perusahaan = $this->input->post('alamat_perusahaan', true);
        $pemohon = $this->input->post('pemohon', true);
        $alamat_pasang = $this->input->post('alamat_pasang', true);
        $nag_pasang = $this->input->post('nag_pasang', true);
        $kec_pasang = $this->input->post('kec_pasang', true);
        $pajak = $this->input->post('pajak', true);
        $ukuran = $this->input->post('ukuran', true);
        $unit = $this->input->post('unit', true);
        $masa_berlaku = $this->input->post('masa_berlaku', true);
        $jenis_reklame = $this->input->post('jenis_reklame', true);
        $ket = $this->input->post('ket', true);
        $tgl_pasang = $this->input->post('tgl_pasang', true);
        $lat = $this->input->post('lat', true);
        $long = $this->input->post('long', true);
        $no_hp = $this->input->post('no_hp', true);
        $tgl_input = $this->input->post('no_hp', true);
        $foto = $_FILES['foto']['name'];

        if ($foto = '') {
        } else {
            $nmfile = "reklame-" . $nama_perusahaan;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            }
        }
        $data = array(
            'no_izin' => $no_izin,
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perusahaan' => $alamat_perusahaan,
            'pemohon' => $pemohon,
            'alamat_pasang' => $alamat_pasang,
            'nag_pasang' => $nag_pasang,
            'kec_pasang' => $kec_pasang,
            'pajak' => $pajak,
            'ukuran' => $ukuran,
            'unit' => $unit,
            'masa_berlaku' => $masa_berlaku,
            'jenis_reklame' => $jenis_reklame,
            'ket' => $ket,
            'foto' => $foto,
            'tgl_pasang' => $tgl_pasang,
            'lat' => $lat,
            'long' => $long,
            'no_hp' => $no_hp,
            'tgl_input' => $tgl_input
        );
        $this->load->model('Model_reklame');
        $this->Model_reklame->input($data);
        $this->session->set_flashdata("berhasil", "Tambah data Reklame " . $nama_perusahaan . " berhasil !");
        redirect('admin/reklame/data');
    }

    public function ubah()
    {
        $id_reklame = $this->input->post('id', true);
        $no_izin = $this->input->post('no_izin', true);
        $nama_perusahaan = $this->input->post('nama_perusahaan', true);
        $alamat_perusahaan = $this->input->post('alamat_perusahaan', true);
        $pemohon = $this->input->post('pemohon', true);
        $alamat_pasang = $this->input->post('alamat_pasang', true);
        $nag_pasang = $this->input->post('nag_pasang', true);
        $kec_pasang = $this->input->post('kec_pasang', true);
        $pajak = $this->input->post('pajak', true);
        $ukuran = $this->input->post('ukuran', true);
        $unit = $this->input->post('unit', true);
        $masa_berlaku = $this->input->post('masa_berlaku', true);
        $jenis_reklame = $this->input->post('jenis_reklame', true);
        $ket = $this->input->post('ket', true);
        $tgl_pasang = $this->input->post('tgl_pasang', true);
        $lat = $this->input->post('lat', true);
        $long = $this->input->post('long', true);
        $no_hp = $this->input->post('no_hp', true);
        $foto = $_FILES['foto']['name'];

        if (empty($_FILES['foto']['name'])) {
            $foto = $this->input->post('old', true);
        } else {
            $nmfile = "reklame-" . $nama_perusahaan;
            $config['upload_path'] = './assets/imgupload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $nmfile;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto_brg = $this->upload->data('file_name');
                $fotolama = $this->input->post('old', true);
                unlink("./assets/imgupload/" . $fotolama);
            }
        }

        $data = array(
            'id_reklame' => $id_reklame,
            'no_izin' => $no_izin,
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perusahaan' => $alamat_perusahaan,
            'pemohon' => $pemohon,
            'alamat_pasang' => $alamat_pasang,
            'nag_pasang' => $nag_pasang,
            'kec_pasang' => $kec_pasang,
            'pajak' => $pajak,
            'ukuran' => $ukuran,
            'unit' => $unit,
            'masa_berlaku' => $masa_berlaku,
            'jenis_reklame' => $jenis_reklame,
            'ket' => $ket,
            'foto' => $foto,
            'tgl_pasang' => $tgl_pasang,
            'lat' => $lat,
            'long' => $long,
            'no_hp' => $no_hp
        );
        $this->load->model('Model_reklame');
        $this->Model_reklame->update($data, $id_reklame);
        $this->session->set_flashdata("berhasil", "Ubah data reklame" . $nama_perusahaan . " berhasil !");
        redirect('admin/reklame/data');
    }

    public function hapus($id_reklame)
    {
        $this->db->where('id_reklame', $id_reklame);
        $query = $this->db->get('reklame');
        $row = $query->row();

        unlink("./assets/imgupload/$row->foto");

        $this->load->model('Model_reklame');
        $this->Model_reklame->delete($id_reklame);
        $this->session->set_flashdata("gagal", "Hapus data reklame" . $row->nama_perusahaan . " berhasil !");

        redirect('admin/reklame/data');
    }

    public function export_tgl()
    {
        $this->load->model('Model_reklame');
        $tgl_dari = $this->input->post('tgl_dari', true);
        $tgl_sampai = $this->input->post('tgl_sampai', true);
        $ket = $this->input->post('ket', true);

        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('DPMPTSP Kab. Agam')
            ->setLastModifiedBy('DPMPTSP Kab. Agam')
            ->setTitle("Data Reklame")
            ->setSubject("Reklame")
            ->setDescription("Laporan Data Reklame")
            ->setKeywords("Data Reklame");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Reklame Kabupaten Agam ($tgl_dari s/d $tgl_sampai)"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:N1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "No Izin"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Perusahaan"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Alamat Perusahaan"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Penanggungjawab");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "No. HP");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Alamat Pasang");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Nilai Retribusi");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Ukuran / Unit");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Jenis Reklame");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "Titik Koordinat");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "Tanggal Pasang");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "Masa Berlaku");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "Keterangan");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $reklame = $this->Model_reklame->export_tgl($tgl_dari, $tgl_sampai, $ket);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($reklame as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->no_izin);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama_perusahaan);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->alamat_perusahaan);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->pemohon);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->no_hp);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->alamat_pasang . ', ' . $data->kecamatan . ', ' . $data->nama_nagari);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->pajak);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->ukuran . '/' . $data->unit);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->jenis_reklame);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->lat . ', ' . $data->long);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data->tgl_pasang);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->masa_berlaku);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $data->ket);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Reklame");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Reklame Kabupaten Agam.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
