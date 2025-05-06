<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->