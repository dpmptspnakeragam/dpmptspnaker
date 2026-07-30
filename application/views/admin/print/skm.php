<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surver Kepuasan Masyarakat (SKM)</title>

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
        <h6>Survei Kepuasan Masyarakat (SKM)</h6>
    </div>

    <?php foreach ($skm as $row) : ?>
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
            <h6>Jawaban Responden Tentang Pelayanan Publik</h6>
        </div>
        <table class="table table-sm">
            <tr>
                <td style="border: none;">1. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u1 == 4) : ?>
                            Sangat Sesuai
                        <?php elseif ($row->u1 == 3) : ?>
                            Sesuai
                        <?php elseif ($row->u1 == 2) : ?>
                            Kurang Sesuai
                        <?php elseif ($row->u1 == 1) : ?>
                            Tidak Sesuai
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">2. </td>
                <td style="border: none;">Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u2 == 4) : ?>
                            Sangat Mudah
                        <?php elseif ($row->u2 == 3) : ?>
                            Mudah
                        <?php elseif ($row->u2 == 2) : ?>
                            Kurang Mudah
                        <?php elseif ($row->u2 == 1) : ?>
                            Tidak Mudah
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">3. </td>
                <td style="border: none;">Bagaimana pemahaman Saudara tentang kecepatan waktu dalam memberikan pelayanan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u3 == 4) : ?>
                            Sangat Cepat
                        <?php elseif ($row->u3 == 3) : ?>
                            Cepat
                        <?php elseif ($row->u3 == 2) : ?>
                            Kurang Cepat
                        <?php elseif ($row->u3 == 1) : ?>
                            Tidak Cepat
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">4. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u4 == 4) : ?>
                            Gratis
                        <?php elseif ($row->u4 == 3) : ?>
                            Murah
                        <?php elseif ($row->u4 == 2) : ?>
                            Cukup Mahal
                        <?php elseif ($row->u4 == 1) : ?>
                            Sangat Mahal
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">5. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang kesesuaian pelayanan yang tercantum dalam standar pelayanan dengan hasil yang diberikan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u5 == 4) : ?>
                            Sangat Sesuai
                        <?php elseif ($row->u5 == 3) : ?>
                            Sesuai
                        <?php elseif ($row->u5 == 2) : ?>
                            Kurang Sesuai
                        <?php elseif ($row->u5 == 1) : ?>
                            Tidak Sesuai
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">6. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u6 == 4) : ?>
                            Sangat Kompeten
                        <?php elseif ($row->u6 == 3) : ?>
                            Kompeten
                        <?php elseif ($row->u6 == 2) : ?>
                            Kurang Kompeten
                        <?php elseif ($row->u6 == 1) : ?>
                            Tidak Kompeten
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">7. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u7 == 4) : ?>
                            Sangat Sopan & Ramah
                        <?php elseif ($row->u7 == 3) : ?>
                            Sopan & Ramah
                        <?php elseif ($row->u7 == 2) : ?>
                            Kurang Sopan & Ramah
                        <?php elseif ($row->u7 == 1) : ?>
                            Tidak Sopan & Ramah
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">8. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u8 == 4) : ?>
                            Dikelola Dengan Baik
                        <?php elseif ($row->u8 == 3) : ?>
                            Berfungsi Kurang Maksimal
                        <?php elseif ($row->u8 == 2) : ?>
                            Ada Tetapi Tidak Berfungsi
                        <?php elseif ($row->u8 == 1) : ?>
                            Tidak Ada
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td style="border: none;">9. </td>
                <td style="border: none;">Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;">Jawaban:
                    <span class="font-weight-bold">
                        <?php if ($row->u9 == 4) : ?>
                            Sangat Baik
                        <?php elseif ($row->u9 == 3) : ?>
                            Baik
                        <?php elseif ($row->u9 == 2) : ?>
                            Cukup Baik
                        <?php elseif ($row->u9 == 1) : ?>
                            Kurang Baik
                        <?php endif; ?>
                    </span>
                </td>
            </tr>

        </table>
    <?php endforeach; ?>

    <!-- Bootstrap JS (for optional functionalities) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>