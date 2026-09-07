<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - DPMPTSP KABUPATEN AGAM</title>

    <link href="<?= base_url('assets/'); ?>img/vectoragam.png" rel="shortcut icon">

    <!-- Font Awesome untuk icon tombol print di layar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* 1. ATUR MARGIN KERTAS FISIK SAAT DICETAK */
        @page {
            size: A4 landscape;
            /* Margin atas-bawah 15mm memberi jarak aman agar tidak menempel ke tepi kertas */
            margin: 15mm 15mm 15mm 15mm;
        }

        body {
            margin: 0;
            padding: 0;
            background: #e0e5ec;
            font-family: 'Bookman Old Style', 'Times New Roman', serif;
            color: #000;
        }

        /* TAMPILAN KERTAS DI LAYAR MONITOR */
        .sheet {
            background: white;
            width: 297mm;
            min-height: 210mm;
            margin: 10mm auto;
            padding: 15mm 20mm;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            box-sizing: border-box;
            position: relative;
        }

        /* BAGIAN KOP SURAT */
        .kop-surat {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .kop-logo {
            display: table-cell;
            vertical-align: middle;
            width: 100px;
        }

        .kop-logo img {
            width: 85px;
            height: auto;
            margin-left: 10px;
        }

        .kop-teks {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .kop-teks .pemerintah {
            font-size: 15pt;
            letter-spacing: 1px;
            margin-bottom: 2px;
            font-weight: bold;
        }

        .kop-teks .dinas {
            font-size: 17pt;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .kop-teks .dinas,
        .kop-teks .pemerintah {
            font-family: 'Times New Roman', Times, serif;
        }

        .kop-teks .alamat {
            font-size: 8pt;
            margin-top: 4px;
        }

        .kop-teks .kontak {
            font-size: 8pt;
        }

        /* GARIS TEBAL TIPIS KOP SURAT */
        .garis-kop {
            border-top: 4px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-bottom: 15px;
        }

        /* JUDUL SURAT & FILTER */
        .header-dokumen {
            text-align: center;
            margin-bottom: 15px;
        }

        .judul-utama {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            margin: 0 0 5px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sub-judul {
            font-size: 10pt;
            font-weight: normal;
            margin-top: 2px;
        }

        /* TABEL REKAPITULASI & CEGAH TERPOTONG */
        .tabel-laporan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .tabel-laporan th,
        .tabel-laporan td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 9pt;
            vertical-align: top;
        }

        .tabel-laporan th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Mencegah 1 baris terbelah horizontal di antara 2 halaman */
        .tabel-laporan tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        /* Header tabel muncul kembali otomatis di halaman kedua dst */
        .tabel-laporan thead {
            display: table-header-group;
        }

        .tabel-laporan tbody {
            display: table-row-group;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        /* AREA TANDA TANGAN */
        .area-ttd {
            width: 100%;
            margin-top: 20px;
            display: table;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .ttd-kiri,
        .ttd-kanan {
            display: table-cell;
            width: 50%;
            text-align: center;
            font-size: 10pt;
            vertical-align: top;
        }

        .ttd-nama {
            margin-top: 65px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* FOOTER SISTEM */
        .footer-sistem {
            margin-top: 25px;
            border-top: 1px dashed #999;
            padding-top: 8px;
            font-size: 8pt;
            color: #555;
            text-align: justify;
            font-style: italic;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        /* TOMBOL (HANYA DI LAYAR) */
        .layar-kontrol {
            text-align: center;
            padding: 12px 0;
            background: #333;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .btn {
            padding: 8px 18px;
            font-size: 11pt;
            cursor: pointer;
            border: none;
            color: white;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            margin: 0 5px;
            font-weight: bold;
        }

        .btn-print {
            background: #28a745;
        }

        .btn-print:hover {
            background: #218838;
        }

        .btn-close {
            background: #dc3545;
        }

        .btn-close:hover {
            background: #c82333;
        }

        /* PENGATURAN SPESIFIK CETAK (PRINT) */
        @media print {
            body {
                background: transparent;
            }

            /* Hapus batasan tinggi, margin, dan padding sheet agar mengikuti aturan @page */
            .sheet {
                width: 100% !important;
                min-height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }

            .layar-kontrol {
                display: none !important;
            }

            .tabel-laporan th {
                background-color: #eee !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <!-- KONTROL LAYAR (Akan hilang otomatis saat dicetak) -->
    <div class="layar-kontrol">
        <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Cetak Laporan</button>
        <button onclick="window.close()" class="btn btn-close"><i class="fas fa-times"></i> Tutup</button>
    </div>

    <!-- KERTAS A4 LANDSCAPE -->
    <div class="sheet">

        <!-- KOP SURAT PRESISI -->
        <div class="kop-surat">
            <div class="kop-logo">
                <img src="<?= base_url('assets/img/vectoragam.png'); ?>" alt="Logo Agam">
            </div>
            <div class="kop-teks">
                <div class="pemerintah">PEMERINTAH KABUPATEN AGAM</div>
                <div class="dinas">DINAS PENANAMAN MODAL</div>
                <div class="dinas">PELAYANAN TERPADU SATU PINTU</div>
                <div class="alamat">Jl. Veteran No.1 Padang Baru, Lubuk Basung, Kode Pos: 26415</div>
                <div class="kontak">Website: www.dpmptsp.agamkab.go.id, E-mail: dpmptspagam@gmail.com, Whatsapp: 0813-7479-5952</div>
            </div>
        </div>
        <div class="garis-kop"></div>

        <!-- JUDUL & INFORMASI FILTER -->
        <div class="header-dokumen">
            <h2 class="judul-utama">LAPORAN REKAPITULASI PELAYANAN KONSULTASI</h2>
            <div class="sub-judul">
                Periode Tanggal: <b><?= date('d/m/Y', strtotime($tgl_mulai)); ?></b> s/d <b><?= date('d/m/Y', strtotime($tgl_selesai)); ?></b>
                <?php if (!empty($unit_filter) && $unit_filter !== 'ALL'): ?>
                    | Unit: <b><?= $unit_filter; ?></b>
                <?php endif; ?>
                <?php if (!empty($status) && $status !== 'semua'): ?>
                    | Status: <b><?= ucfirst($status); ?></b>
                <?php endif; ?>
            </div>
        </div>

        <!-- TABEL DATA KONSULTASI -->
        <table class="tabel-laporan">
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th width="11%">No. Tiket</th>
                    <th width="9%">Tgl Masuk</th>
                    <th width="15%">Pemohon / Kontak</th>
                    <th width="13%">Jenis Izin</th>
                    <th>Uraian Permasalahan</th>
                    <th width="18%">Tindak Lanjut / Solusi</th>
                    <th width="7%">Status</th>
                    <th width="10%">Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($laporan)): ?>
                    <?php $no = 1;
                    foreach ($laporan as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center text-bold"><?= $row->no_tiket; ?></td>
                            <td class="text-center"><?= date('d/m/Y H:i', strtotime($row->tanggal_masuk)); ?></td>
                            <td>
                                <b><?= htmlspecialchars($row->nama_pemohon); ?></b><br>
                                <small>NIK: <?= $row->nik ?? '-'; ?></small><br>
                                <small>HP: <?= $row->no_hp ?? '-'; ?></small>
                            </td>
                            <td><?= htmlspecialchars($row->jenis_izin); ?></td>
                            <td><?= nl2br(htmlspecialchars($row->uraian)); ?></td>
                            <td><?= !empty($row->tindak_lanjut) ? nl2br(htmlspecialchars($row->tindak_lanjut)) : '<i style="color:#777;">- Belum Ditindaklanjuti -</i>'; ?></td>
                            <td class="text-center text-bold"><?= $row->status; ?></td>
                            <td><small><?= htmlspecialchars($row->petugas_penerima ?? '-'); ?></small></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center" style="padding: 20px;">
                            <i>Tidak ada data layanan konsultasi ditemukan untuk kriteria periode ini.</i>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- AREA TANDA TANGAN -->
        <div class="area-ttd">
            <div class="ttd-kiri">
                <!-- Sisi Kiri Opsional/Kosong -->
            </div>
            <div class="ttd-kanan">
                <span>Lubuk Basung, <?= date('d F Y'); ?><br>Petugas Penanggung Jawab,</span>
                <div class="ttd-nama">
                    <!-- <?= strtoupper($this->session->userdata('nama') ?? $this->session->userdata('username')); ?> -->
                    <br>
                    ___________________________________
                </div>
            </div>
        </div>

        <!-- FOOTER CATATAN SISTEM -->
        <div class="footer-sistem">
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            <b>Catatan:</b> Laporan ini dicetak secara otomatis melalui Sistem Konsultasi Perizinan dan Pengaduan (SIZIDAN) DPMPTSP Kabupaten Agam pada tanggal <?= date('d/m/Y H:i:s'); ?> WIB. Dokumen ini merupakan rekapitulasi data resmi yang tersimpan di dalam sistem.
        </div>

    </div>

    <!-- Script auto-print dengan delay aman -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 600);
        }
    </script>
</body>

</html>