<!DOCTYPE html>
<html lang="id">
<?php
if (!isset($detail) || $detail === null) {
    $detail = (object)[
        'no_tiket' => '-',
        'tanggal_masuk' => date('Y-m-d'),
        'nama_pemohon' => '-',
        'nik' => '-',
        'pekerjaan' => '',
        'no_hp' => '-',
        'alamat' => '-',
        'jenis_izin' => '-',
        'uraian' => '-',
        'tindak_lanjut' => '',
        'petugas_penerima' => ''
    ];
} elseif (is_array($detail)) {
    $detail = (object)$detail;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Bukti Konsultasi - <?= $detail->no_tiket; ?></title>

    <link href="<?= base_url('assets/'); ?>img/vectoragam.png" rel="shortcut icon">

    <!-- Font Awesome untuk icon tombol print (hanya di layar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* PENGATURAN DASAR */
        @page {
            size: A4;
            margin: 0;
            /* Margin diatur di elemen .sheet */
        }

        body {
            margin: 0;
            padding: 0;
            background: #e0e5ec;
            font-family: 'Bookman Old Style', 'Times New Roman', serif;
            color: #000;
        }

        /* EFEK KERTAS DI LAYAR KOMPUTER */
        .sheet {
            background: white;
            width: 210mm;
            min-height: 297mm;
            margin: 15mm auto;
            padding: 20mm 20mm;
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
            width: 110px;
        }

        .kop-logo img {
            width: 80px;
            height: auto;
            margin-left: 25px;
        }

        .kop-teks {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .kop-teks .pemerintah {
            font-size: 14pt;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .kop-teks .dinas {
            font-size: 16pt;
            margin-bottom: 2px;
        }

        .kop-teks .dinas,
        .kop-teks .pemerintah {
            font-family: 'Times New Roman', Times, serif;
        }

        .kop-teks .alamat {
            font-size: 7pt;
            margin-top: 4px;
        }

        .kop-teks .kontak {
            font-size: 7pt;
        }

        /* GARIS TEBAL TIPIS */
        .garis-kop {
            border-top: 4px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-bottom: 10px;
        }

        /* JUDUL SURAT & TIKET */
        .header-dokumen {
            text-align: center;
            margin-bottom: 15px;
            position: relative;
        }

        .judul-utama {
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
            margin: 0 0 5px 0;
            letter-spacing: 0.5px;
        }

        .box-tiket {
            display: inline-block;
            border: 1px dashed #333;
            padding: 4px 15px;
            font-weight: bold;
            font-size: 10pt;
            margin-top: 5px;
            background-color: #fafafa;
        }

        /* ISI KONTEN */
        .isi-surat {
            font-size: 10pt;
            line-height: 1.6;
            text-align: justify;
        }

        /* TABEL DATA */
        .tabel-data {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .tabel-data th,
        .tabel-data td {
            vertical-align: top;
            padding: 1px 1px;
            font-size: 10pt;
        }

        .tabel-data th {
            width: 32%;
            font-weight: normal;
            text-align: left;
        }

        .tabel-data .titik-dua {
            width: 3%;
            text-align: center;
        }

        .tabel-data .isi-data {
            width: 65%;
            font-weight: bold;
        }

        .tabel-data .isi-data.normal {
            font-weight: normal;
        }

        /* BLOK URAIAN & BALASAN */
        .blok-teks {
            border: 1px solid #ddd;
            padding: 12px;
            margin-bottom: 15px;
            background-color: #fdfdfd;
            border-left: 4px solid #800000;
            /* Aksen warna dinas */
        }

        .blok-judul {
            font-weight: bold;
            font-size: 10pt;
            margin-bottom: 5px;
            text-transform: uppercase;
            color: #555;
        }

        /* TANDA TANGAN */
        .area-ttd {
            width: 100%;
            margin-top: 15px;
            display: table;
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
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* FOOTER SISTEM */
        .footer-sistem {
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            border-top: 1px dashed #999;
            padding-top: 10px;
            font-size: 8pt;
            color: #555;
            text-align: justify;
            font-style: italic;
        }

        /* TOMBOL (HANYA DI LAYAR) */
        .layar-kontrol {
            text-align: center;
            padding: 15px 0;
            background: #333;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .btn {
            padding: 10px 20px;
            font-size: 12pt;
            cursor: pointer;
            border: none;
            color: white;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            margin: 0 10px;
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

        /* PENGATURAN SAAT MENCETAK KE KERTAS */
        @media print {
            body {
                background: transparent;
            }

            .sheet {
                margin: 0;
                box-shadow: none;
                padding: 15mm;
            }

            .layar-kontrol {
                display: none !important;
            }

            .blok-teks {
                border: none;
                padding: 0;
                border-left: none;
                background: transparent;
            }

            .blok-judul {
                margin-top: 15px;
                color: #000;
                text-decoration: underline;
            }

            .footer-sistem {
                bottom: 15mm;
                left: 15mm;
                right: 15mm;
            }
        }
    </style>
</head>

<body>

    <!-- KONTROL LAYAR (Akan hilang otomatis saat dicetak) -->
    <div class="layar-kontrol">
        <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Cetak Dokumen</button>
        <button onclick="window.close()" class="btn btn-close"><i class="fas fa-times"></i> Tutup</button>
    </div>

    <!-- KERTAS A4 -->
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

        <!-- JUDUL -->
        <div class="header-dokumen">
            <h2 class="judul-utama">TANDA BUKTI LAYANAN KONSULTASI</h2>
            <div class="box-tiket">No. Registrasi: <?= $detail->no_tiket; ?></div>
        </div>

        <!-- ISI DOKUMEN -->
        <div class="isi-surat">
            <p>Pada hari ini tanggal <b><?= date('d F Y', strtotime($detail->tanggal_masuk)); ?></b>, telah dilakukan layanan konsultasi perizinan/non-perizinan melalui Sistem Informasi DPMPTSP Kabupaten Agam, dengan rincian identitas sebagai berikut:</p>

            <table class="tabel-data">
                <tr>
                    <th>Nama Pemohon</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data"><?= $detail->nama_pemohon; ?></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data normal"><?= $detail->nik; ?></td>
                </tr>
                <tr>
                    <th>Pekerjaan / Instansi</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data normal"><?= !empty($detail->pekerjaan) ? $detail->pekerjaan : '-'; ?></td>
                </tr>
                <tr>
                    <th>Kontak / Nomor HP</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data normal"><?= $detail->no_hp; ?></td>
                </tr>
                <tr>
                    <th>Alamat Domisili</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data normal"><?= $detail->alamat; ?></td>
                </tr>
                <tr>
                    <th>Jenis Izin Terkait</th>
                    <td class="titik-dua">:</td>
                    <td class="isi-data"><?= $detail->jenis_izin; ?></td>
                </tr>
            </table>

            <div class="blok-teks">
                <div class="blok-judul">Uraian / Permasalahan Konsultasi:</div>
                <div class="isi-data normal" style="text-align: justify;">
                    <?= nl2br(htmlspecialchars($detail->uraian)); ?>
                </div>
            </div>

            <?php if (!empty($detail->tindak_lanjut)): ?>
                <div class="blok-teks">
                    <div class="blok-judul">Tindak Lanjut / Jawaban Petugas:</div>
                    <div class="isi-data normal" style="text-align: justify;">
                        <?= nl2br(htmlspecialchars($detail->tindak_lanjut)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <p style="margin-top: 20px;">Demikian tanda bukti layanan konsultasi ini diterbitkan untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <!-- AREA TANDA TANGAN -->
        <div class="area-ttd">
            <div class="ttd-kiri">
                <p>Pemohon Konsultasi,</p>
                <div class="ttd-nama"><?= strtoupper($detail->nama_pemohon); ?></div>
            </div>
            <div class="ttd-kanan">
                <span>Lubuk Basung, <?= date('d F Y'); ?><br>Petugas DPMPTSP,</span>
                <div class="ttd-nama">
                    (.......................................)
                </div>
            </div>
        </div>

        <!-- FOOTER CATATAN SISTEM -->
        <div class="footer-sistem">
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            <b>Catatan:</b> Dokumen ini dicetak secara otomatis melalui Sistem Informasi Pelayanan Terpadu DPMPTSP Kabupaten Agam. Dokumen ini sah dan valid sesuai dengan data yang diinputkan ke dalam sistem pada tanggal <?= date('d/m/Y H:i:s', strtotime($detail->tanggal_masuk)); ?> WIB.
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