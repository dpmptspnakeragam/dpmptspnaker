<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SPKP dan SPAK</title>

    <link rel="shortcut icon" href="<?= base_url('assets/img/vectoragam.png'); ?>">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link media rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .divider {
            border: 0;
            border-style: inset;
            border-top: 3px solid #000;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <img src="<?= base_url('assets/img/agam.png'); ?>" alt="Logo" style="position: absolute; width: 50px; height: auto; margin-left: 30px;">
    <table class="w-100 mb-3">
        <tr>
            <td class="text-center">
                <h5>Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu<br>(DPMPTSP) Kabupaten Agam</h5>
            </td>
        </tr>
    </table>

    <!-- Pembatas -->
    <div class="divider"></div>

    <div class="text-center mt-3">
        <h6></h6>
    </div>

    <?php foreach ($spkp as $row) : ?>
        <table class="table table-sm">
            <tr>
                <td style="border: none;">Nama</td>
                <td style="border: none;">:
                    <?= $row->nama; ?>
                </td>

                <td style="border: none;">Telepon</td>
                <td style="border: none;">:
                    <?php if (is_numeric($row->no_hp) && $row->no_hp != 0) : ?>
                        <?= $row->no_hp; ?>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>

                <td style="border: none;">Jenis Kelamin</td>
                <td style="border: none;">:
                    <?php if ($row->jk == 1) : ?>
                        Laki-Laki
                    <?php elseif ($row->jk == 2) : ?>
                        Perempuan
                    <?php endif ?>
                </td>

                <td style="border: none;">Pekerjaan</td>
                <td style="border: none;">:
                    <?php if ($row->pekerjaan == 1) : ?>
                        PNS
                    <?php elseif ($row->pekerjaan == 2) : ?>
                        TNI
                    <?php elseif ($row->pekerjaan == 3) : ?>
                        POLRI
                    <?php elseif ($row->pekerjaan == 4) : ?>
                        Swasta
                    <?php elseif ($row->pekerjaan == 5) : ?>
                        Wirausaha
                    <?php elseif ($row->pekerjaan == 6) : ?>
                        Lainnya
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td style="border: none;">Umur</td>
                <td style="border: none;">:
                    <?= $row->umur; ?> Tahun</td>

                <td style="border: none;">Layanan</td>
                <td style="border: none;">:
                    <?= $row->layanan; ?>
                </td>
            </tr>
            <tr>
                <td style="border: none;">Pendidikan</td>
                <td style="border: none;">:
                    <?php if ($row->pendidikan == 1) : ?>
                        SD Sederajat
                    <?php elseif ($row->pendidikan == 2) : ?>
                        SLTP Sederajat
                    <?php elseif ($row->pendidikan == 3) : ?>
                        SLTA Sederajat
                    <?php elseif ($row->pendidikan == 4) : ?>
                        D3
                    <?php elseif ($row->pendidikan == 5) : ?>
                        S1
                    <?php elseif ($row->pendidikan == 6) : ?>
                        S2
                    <?php endif; ?>
                </td>

                <td style="border: none;">Tanggal Survei</td>
                <td style="border: none;">:
                    <?= date('d-m-Y / H:i', strtotime($row->date)); ?> WIB
                </td>
            </tr>
        </table>

        <div class="text-center mt-3">
            <h6>Jawaban Responden Tentang Persepsi Kualitas Pelayanan (SPKP)</h6>
        </div>
        <table class="table table-sm" style="border: 0;">
            <tr>
                <td style="border: none;">1. </td>
                <td style="border: none;">Informasi pelayanan pada unit layanan ini tersedia melalui media sosial elektronik maupun non elektronik.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z1">
                    <?php
                    $rating = $row->z1;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">2. </td>
                <td style="border: none;">Persyaratan pelayanan yang diinformasikan sesuai dengan persyaratan yang ditetapkan unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z2">
                    <?php
                    $rating = $row->z2;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">3. </td>
                <td style="border: none;">Prosedur/Alur pelayanan yang ditetapkan unit layanan ini mudah diikuti/dilakukan.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z3">
                    <?php
                    $rating = $row->z3;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">4. </td>
                <td style="border: none;">Jangka waktu penyelesaian pelayanan yang diterima Bapak/Ibu sesuai dengan yang ditetapkan unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z4">
                    <?php
                    $rating = $row->z4;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">5. </td>
                <td style="border: none;">Tarif/Biaya pelayanan yang dibayarkan pada unit layanan ini sesuai dengan tarif/biaya yang ditetapkan.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z5">
                    <?php
                    $rating = $row->z5;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">6. </td>
                <td style="border: none;">Sarana prasarana pendukung pelayanan/sistem pelayanan online yang disediakan unit layanan ini memberikan kenyamanan/mudah digunakan.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z6">
                    <?php
                    $rating = $row->z6;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">7. </td>
                <td style="border: none;">Petugas pelayanan/sistem pelayanan online pada unit layanan ini merespon keperluan Bapak/Ibu dengan cepat.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z7">
                    <?php
                    $rating = $row->z7;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">8. </td>
                <td style="border: none;">Layanan konsultasi dan pengaduan yang disediakan unit layanan ini mudah digunakan/diakses.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_z8">
                    <?php
                    $rating = $row->z8;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
        </table>
        <div class="text-center mt-3">
            <h6>Jawaban Responden Tentang Persepsi Anti Korupsi (SPAK)</h6>
        </div>
        <table class="table table-sm" style="border: 0;">
            <tr>
                <td style="border: none;">1. </td>
                <td style="border: none;">Tidak ada deskriminasi pelayanan pada unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_r1">
                    <?php
                    $rating = $row->r1;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">2. </td>
                <td style="border: none;">Tidak ada pelayanan diluar prosedur/kecurangan pelayanan pada unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_r2">
                    <?php
                    $rating = $row->r2;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">3. </td>
                <td style="border: none;">Tidak ada penerimaan imbalan uang/barang/fasilitas diluar ketentuan yang berlaku pada unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_r3">
                    <?php
                    $rating = $row->r3;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">4. </td>
                <td style="border: none;">Tidak ada pungutan liar (pungli) pada unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_r4">
                    <?php
                    $rating = $row->r4;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
            <tr>
                <td style="border: none;">5. </td>
                <td style="border: none;">Tidak ada percaloan/perantara tidak resmi pada unit layanan ini.</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <div class="stars-cetak ml-1" data-rating="rating_r5">
                    <?php
                    $rating = $row->r5;

                    for ($i = 1; $i <= 6; $i++) {
                        $class = ($i <= $rating) ? 'fas fa-star' : 'far fa-star';
                        $starColor = ($i <= $rating) ? '#ffd700' : '#707070';

                        echo '<i class="' . $class . '" data-value="' . $i . '" style="color: ' . $starColor . '; border-color: #000;"></i>';
                    }
                    ?>
                </div>
            </tr>
        </table>
    <?php endforeach; ?>

    <!-- Bootstrap JS (for optional functionalities) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>