<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-danger">
            <div class="card-header">
                <h5 class="card-title">📘 Penjelasan Perhitungan Nilai</h5>
            </div>
            <div class="card-body">
                <h6><strong>1. Indeks Kepuasan Masyarakat (IKM)</strong></h6>
                <p>
                    Nilai IKM dihitung berdasarkan 9 unsur layanan (U1 hingga U9). Setiap unsur memiliki bobot yang sama yaitu <strong>11,11%</strong>.
                    Rumus perhitungan sebagai berikut:
                </p>
                <pre><code>
IKM = (Rata-rata U1 s.d U9) × 0.1111 × 25
        </code></pre>
                <p>
                    Hasil dikali 25 agar skor berada dalam rentang 0–100.
                </p>

                <h6><strong>2. Survei Persepsi Kepuasan Pelayanan (SPKP) & Survei Persepsi Anti Korupsi (SPAK)</strong></h6>
                <p>
                    Nilai SPKP & SPAK diambil dari 13 indikator:
                    <br> - <strong>Z1 s.d Z8</strong> (indikator pelayanan)
                    <br> - <strong>R1 s.d R5</strong> (indikator persepsi korupsi)
                </p>
                <p>Rumus perhitungannya:</p>
                <pre><code>
NRR_Z = (Z1 + Z2 + ... + Z8) × 0.1111
NRR_R = (R1 + R2 + ... + R5) × 0.1111
Nilai SPKP & SPAK = (NRR_Z - NRR_R) × 50
        </code></pre>
                <p>
                    Dikalikan 50 agar skala maksimal tetap 100. Nilai akan dibatasi antara 0 hingga 100.
                </p>

                <h6><strong>3. Kategori Mutu</strong></h6>
                <table class="table table-sm table-bordered mt-2" style="max-width: 500px;">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Nilai</th>
                            <th>Kategori Mutu</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>88.31 – 100.00</td>
                            <td>A (Sangat Baik)</td>
                        </tr>
                        <tr>
                            <td>76.61 – 88.30</td>
                            <td>B (Baik)</td>
                        </tr>
                        <tr>
                            <td>65.00 – 76.60</td>
                            <td>C (Kurang Baik)</td>
                        </tr>
                        <tr>
                            <td>25.00 – 64.99</td>
                            <td>D (Tidak Baik)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Filter Data</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="<?= base_url('admin/dataikm'); ?>">
                            <div class="input-group mb-3">
                                <select name="tahun" class="form-control">
                                    <?php
                                    $currentYear = date('Y');
                                    $tahunDipilih = $this->input->get('tahun') ?? $currentYear;
                                    for ($i = $currentYear - 5; $i <= $currentYear; $i++) : ?>
                                        <option value="<?= $i; ?>" <?= ($i == $tahunDipilih) ? 'selected' : ''; ?>><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger" type="submit">Tampilkan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php foreach (['s1' => 'Semester 1 (Jan - Jun)', 's2' => 'Semester 2 (Jul - Dec)'] as $key => $label): ?>
                <?php $skm = $$key; ?>
                <div class="col-md-6">
                    <div class="card card-outline card-danger">
                        <div class="card-header text-center">
                            <strong><?= $label; ?></strong>
                        </div>
                        <div class="card-body text-center">
                            <h3>Nilai IKM</h3>
                            <h4 class="text-maroon"><?= kategori_mutu($skm['ikm']); ?> <br> <?= $skm['ikm']; ?></h4>
                            <p>Total Responden: <?= number_format($skm['jumlah']); ?></p>
                            <p>Laki-laki: <?= number_format($skm['lk']); ?> / Perempuan: <?= number_format($skm['pr']); ?></p>

                            <hr>
                            <strong>Pendidikan:</strong>
                            <div class="row mt-1 mb-1">
                                <div class="col-6">
                                    <div class="text-right">
                                        <span>SD</span><br>
                                        <span>SMP</span><br>
                                        <span>SMA</span><br>
                                        <span>D1-D3</span><br>
                                        <span>S1</span><br>
                                        <span>S2</span><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-left">
                                        <span>: <?= $skm['sd']; ?> ORANG</span><br>
                                        <span>: <?= $skm['smp']; ?> ORANG</span><br>
                                        <span>: <?= $skm['sma']; ?> ORANG</span><br>
                                        <span>: <?= $skm['d1']; ?> ORANG</span><br>
                                        <span>: <?= $skm['s1']; ?> ORANG</span><br>
                                        <span>: <?= $skm['s2']; ?> ORANG</span><br>
                                    </div>
                                </div>
                            </div>

                            <strong>Pekerjaan:</strong>
                            <div class="row mt-1 mb-1">
                                <div class="col-6">
                                    <div class="text-right">
                                        <span>PNS</span><br>
                                        <span>TNI</span><br>
                                        <span>POLRI</span><br>
                                        <span>Swasta</span><br>
                                        <span>Wirausaha</span><br>
                                        <span>Lainnya</span><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-left">
                                        <span>: <?= $skm['pns']; ?> ORANG</span><br>
                                        <span>: <?= $skm['tni']; ?> ORANG</span><br>
                                        <span>: <?= $skm['polri']; ?> ORANG</span><br>
                                        <span>: <?= $skm['swasta']; ?> ORANG</span><br>
                                        <span>: <?= $skm['wirausaha']; ?> ORANG</span><br>
                                        <span>: <?= $skm['lainnya']; ?> ORANG</span><br>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <strong>Nilai SKM (U1 - U9) :</strong><br>
                            <?php foreach ($skm['u'] as $i => $nilai): ?>
                                U<?= $i; ?>: <?= round($nilai, 2); ?><br>
                            <?php endforeach; ?>

                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h3>Nilai Survey</h3>
                                    <h4 class="text-maroon">
                                        <?= kategori_mutu($skm['spkp_spak']); ?><br>
                                        <?= $skm['spkp_spak']; ?>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <strong>Nilai SPKP (Z1 - Z8) :</strong><br>
                                    <?php foreach ($skm['z'] as $i => $nilai): ?>
                                        Z<?= $i; ?>: <?= round($nilai, 2); ?><br>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-6">
                                    <strong>Nilai SPAK (R1 - R5) :</strong><br>
                                    <?php foreach ($skm['r'] as $i => $nilai): ?>
                                        R<?= $i; ?>: <?= round($nilai, 2); ?><br>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- <div class="row">
    <div class="col-12">
        <div class="card card-outline card-maroon">
            <div class="card-header">
                <h3 class="card-title">Tabel <?= $title; ?></h3>
            </div>
            <div class="card-body">
                <h4 class="text-center">
                    Indeks Kepuasan Masyarakat (IKM)
                    <br>
                    Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu
                    <br>
                    Kabupaten Agam
                </h4>

                <hr>

                <h5 class="text-center">
                    Semester <?= ($semester == 1) ? '1 <br> Januari s.d Juni' : '2 <br> Juli s.d Desember'; ?>
                    <br>
                    Tahun <?= date('Y'); ?>
                </h5>

                <hr>

                <div class="row">
                    <div class="col-lg-4 mt-1 mb-1">
                        <button type="button" class="btn btn-block btn-outline-danger" onclick="printSKM()">
                            <i class="fas fa-print"></i> Print SKM
                        </button>
                    </div>
                    <div class="col-lg-4 mt-1 mb-1">
                        <button type="button" class="btn btn-block btn-outline-danger" onclick="printSPKP()">
                            <i class="fas fa-print"></i> Print SPKP
                        </button>
                    </div>
                    <div class="col-lg-4 mt-1 mb-1">
                        <button type="button" class="btn btn-block btn-outline-danger" onclick="printSPAK()">
                            <i class="fas fa-print"></i> Print SPAK
                        </button>
                    </div>
                </div>

                <script>
                    function printSKM() {
                        window.open('<?= base_url('admin/rekap_survey/skm/'); ?>', '_blank');
                    }

                    function printSPKP() {
                        window.open('<?= base_url('admin/rekap_survey/spkp') ?>', '_blank');
                    }

                    function printSPAK() {
                        window.open('<?= base_url('admin/rekap_survey/spak') ?>', '_blank');
                    }
                </script>

                <div class="row">

                    <div class="col-sm-12 col-lg-6 text-center">
                        <hr>

                        <?php
                        $nilai_mutu = round($ikm, 2);

                        if ($nilai_mutu >= 88.31 && $nilai_mutu <= 100.00) {
                            $kategori_mutu = "A (Sangat Baik)";
                        } elseif ($nilai_mutu >= 76.61 && $nilai_mutu <= 88.30) {
                            $kategori_mutu = "B (Baik)";
                        } elseif ($nilai_mutu >= 65.00 && $nilai_mutu <= 76.00) {
                            $kategori_mutu = "C (Kurang Baik)";
                        } elseif ($nilai_mutu >= 25.00 && $nilai_mutu <= 64.99) {
                            $kategori_mutu = "D (Tidak Baik)";
                        } else {
                            $kategori_mutu = "Tidak Diketahui";
                        }
                        ?>

                        <h4>NILAI IKM</h4>
                        <h3 class="text-maroon">
                            <strong>
                                <?= $kategori_mutu; ?>
                                <br>
                                <?= round($ikm, 2); ?>
                            </strong>
                        </h3>
                    </div>

                    <div class="col-sm-12 col-lg-6 text-center">
                        <hr>
                        <?php
                        $nilai_mutu = round($spkp_spak, 2);

                        if ($nilai_mutu >= 88.31 && $nilai_mutu <= 100.00) {
                            $kategori_mutu2 = "A (Sangat Baik)";
                        } elseif ($nilai_mutu >= 76.61 && $nilai_mutu <= 88.30) {
                            $kategori_mutu2 = "B (Baik)";
                        } elseif ($nilai_mutu >= 65.00 && $nilai_mutu <= 76.00) {
                            $kategori_mutu2 = "C (Kurang Baik)";
                        } elseif ($nilai_mutu >= 25.00 && $nilai_mutu <= 64.99) {
                            $kategori_mutu2 = "D (Tidak Baik)";
                        } else {
                            $kategori_mutu2 = "Tidak Diketahui";
                        }
                        ?>

                        <h4>NILAI SURVER SPKP & SPAK</h4>
                        <h3 class="text-maroon">
                            <strong>
                                <?= $kategori_mutu2; ?>
                                <br>
                                <?= round($spkp_spak, 2); ?>
                            </strong>
                        </h3>
                    </div>
                </div>

                <hr>

                <div class="text-center">
                    <span>
                        NAMA LAYANAN: PERIZINAN & NON PERIZINAN
                    </span>
                    <hr>
                    <span>
                        <strong>RESPONDEN</strong>
                    </span>
                    <br>
                    <span>
                        JUMLAH: <strong><?= number_format($jumlah); ?></strong>
                    </span>
                    <br>
                    <span>
                        LAKI-LAKI: <strong><?= number_format($jmlh_lk); ?></strong>
                        / PEREMPUAN: <strong><?= number_format($jmlh_pr); ?></strong>
                    </span>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6 mt-3 text-center">
                        <span>
                            <strong>PENDIDIKAN</strong>
                        </span>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-right">
                                    <span>SD</span><br>
                                    <span>SMP</span><br>
                                    <span>SMA</span><br>
                                    <span>DI/DII/DIII</span><br>
                                    <span>DIV/S1</span><br>
                                    <span>S2</span><br>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-left">
                                    <span>: <?= number_format($jmlh_sd); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_smp); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_sma); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_d1); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_s1); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_s2); ?> ORANG</span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 mt-3 text-center">
                        <span>
                            <strong>PEKERJAAN</strong>
                        </span>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-right">
                                    <span>PNS</span><br>
                                    <span>TNI</span><br>
                                    <span>POLRI</span><br>
                                    <span>SWASTA</span><br>
                                    <span>WIRAUSAHA</span><br>
                                    <span>LAINNYA</span><br>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-left">
                                    <span>: <?= number_format($jmlh_pns); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_tni); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_polri); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_swasta); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_wirausaha); ?> ORANG</span><br>
                                    <span>: <?= number_format($jmlh_lainnya); ?> ORANG</span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->