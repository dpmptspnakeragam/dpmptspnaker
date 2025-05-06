<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 40px;
            margin-bottom: 10px;
        }

        .title {
            font-weight: bold;
            font-size: 14px;
        }

        .title2 {
            font-weight: bold;
            font-size: 14px;
            margin-top: 25px;
        }

        .subtitle {
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?= base_url('assets/img/agam.png') ?>" alt="Logo">
        <div class="title">Dinas Penanaman Modal <br> Pelayanan Terpadu Satu Pintu <br> Kabupaten Agam</div>
        <div class="title2">Rekapitulasi Survey Persepsi Kualitas Pelayanan (SPKP)</div>
        <div class="subtitle">Semester <?= $semester ?> Tahun <?= date('Y') ?></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Indikator</th>
                <th>Nilai Rata-rata</th>
                <th>NRR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $indicators = [
                'Z1' => $z1 ?? 0,
                'Z2' => $z2 ?? 0,
                'Z3' => $z3 ?? 0,
                'Z4' => $z4 ?? 0,
                'Z5' => $z5 ?? 0,
                'Z6' => $z6 ?? 0,
                'Z7' => $z7 ?? 0,
                'Z8' => $z8 ?? 0,
            ];
            $no = 1;
            foreach ($indicators as $key => $value):
                $nrr = $value * 0.1111;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key ?></td>
                    <td><?= number_format($value, 2) ?></td>
                    <td><?= number_format($nrr, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Indeks Kepuasan Masyarakat (IKM)</th>
                <th><?= number_format($spkp_spak, 2) ?></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak pada <?= longdate_indo(date('Y-m-d')); ?>
    </div>
</body>

</html>