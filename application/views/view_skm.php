<body class="layout-top-nav layout-navbar-fixed bg-light" id="page-top">
    <!-- Navigation-->
    <nav class="main-header navbar navbar-expand-md navbar-dark fixed-top shadow-sm" style="background-color: maroon;">
        <div class="container-fluid">
            <a href="<?= base_url('skm'); ?>" class="navbar-brand">
                <span class="brand-text font-weight-bold"><i class="fas fa-chart-pie mr-2"></i>Survei</span>
            </a>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="<?= base_url('home'); ?>" role="button">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper mb-5 pt-5">

        <!-- Main content -->
        <div class="content mt-4">
            <div class="container-fluid px-lg-5">

                <!-- Notifikasi -->
                <?php if ($this->session->flashdata('gagal')): ?>
                    <div class="alert alert-danger alert-dismissible shadow-sm fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('gagal'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('berhasil')): ?>
                    <div class="alert alert-success alert-dismissible shadow-sm fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('berhasil'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif; ?>

                <!-- CARD TAHAP 1 DAN 2 -->
                <div class="card card-outline card-danger shadow-sm mb-4" style="border-top-width: 3px;">
                    <div class="card-header text-center bg-white">
                        <h4 class="font-weight-bold text-maroon mb-0">SURVEI</h4>
                        <!-- <small class="text-muted">Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu Kabupaten Agam</small> -->
                    </div>
                    <div class="card-body bg-light">
                        <div class="row justify-content-center">
                            <!-- TAHAP 2 -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="card h-100 shadow border-0" style="border-radius: 10px;">
                                    <div class="card-header text-white text-center font-weight-bold bg-maroon" style="border-radius: 10px 10px 0 0;">
                                        Survei Kepuasan Masyarakat (SKM)
                                    </div>
                                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                                        <img src="https://skm.go.id/images/skm-logo.png" alt="Logo SKM" class="img-fluid mb-3" style="max-height: 55px; object-fit: contain;">
                                        <p class="mb-3 text-muted">Silahkan isi Survei Kepuasan Masyarakat (SKM) dengan mengklik Link berikut:</p>

                                        <?php if (!empty($survei_skm_aktif)): ?>
                                            <a href="<?= $survei_skm_aktif->link_survei; ?>" target="_blank" class="btn-outline-maroon btn-lg px-4 mb-3">
                                                <i class="fa fa-external-link-alt mr-2"></i> Link SKM
                                            </a>
                                            <p class="mb-2 font-italic text-muted"><small>atau Scan QR Code di bawah ini:</small></p>
                                            <img src="<?= base_url('assets/imgupload/' . $survei_skm_aktif->qr_code); ?>" alt="QR Code Survei SKM" class="img-fluid shadow-sm" style="max-width: 140px; border-radius: 8px;">
                                        <?php else: ?>
                                            <div class="no-auto-hide alert alert-warning mt-auto mb-auto w-100" role="alert">
                                                <i class="fa fa-exclamation-triangle"></i> Layanan survei SKM sedang tidak tersedia.
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- TAHAP 1 -->
                            <div class="col-12 col-md-6 mb-3">
                                <div class="card h-100 shadow border-0" style="border-radius: 10px;">
                                    <div class="card-header text-white text-center font-weight-bold bg-maroon" style="border-radius: 10px 10px 0 0;">
                                        Survei Persepsi Kualitas Pelayanan (SPKP) <br> dan Survei Persepsi Anti Korupsi (SPAK)
                                    </div>
                                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                                        <i class="fas fa-file-signature fa-3x text-maroon mb-3"></i>
                                        <p class="mb-3 text-muted">Silakan isi Survei Persepsi Kualitas Pelayanan (SPKP) dan Survei Persepsi Anti Korupsi (SPAK) dengan klik link berikut:.</p>
                                        <a href="<?= base_url('skm/form'); ?>" class="btn-outline-maroon btn-lg px-4">
                                            <i class="fa fa-list-ol mr-2"></i> Link SPKP & SPAK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INDEKS KEPUASAN MASYARAKAT (IKM) -->
                <div class="card card-outline card-primary shadow-sm mb-4" style="border-top-width: 3px;">
                    <div class="card-header text-center">
                        <h4 class="font-weight-bold text-primary mb-0">INDEKS KEPUASAN MASYARAKAT (IKM)</h4>
                        <!-- Menampilkan teks periode kustom dari Admin -->
                        <h6 class="text-muted mt-1"><?= isset($teks_periode) && $teks_periode != '' ? $teks_periode : 'Semester ' . $semester . ' Tahun ' . date('Y'); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Sisi Kiri: Nilai IKM -->
                            <div class="col-lg-5 col-md-12 text-center border-right">
                                <?php
                                // Memastikan nilai $ikm tersedia
                                $nilai_mutu = isset($ikm) ? round($ikm, 2) : 0;
                                $warna_mutu = 'text-info';

                                if ($nilai_mutu >= 88.31) {
                                    $kategori_mutu = "Sangat Baik";
                                    $grade = "A";
                                    $warna_mutu = 'text-primary';
                                } elseif ($nilai_mutu >= 76.61) {
                                    $kategori_mutu = "Baik";
                                    $grade = "B";
                                    $warna_mutu = 'text-success';
                                } elseif ($nilai_mutu >= 65.00) {
                                    $kategori_mutu = "Kurang Baik";
                                    $grade = "C";
                                    $warna_mutu = 'text-warning';
                                } else {
                                    $kategori_mutu = "Kurang Baik";
                                    $grade = "D";
                                    $warna_mutu = 'text-danger';
                                }

                                // Jika nilai 0 (belum diinput admin)
                                if ($nilai_mutu == 0) {
                                    $grade = "-";
                                    $kategori_mutu = "Belum Ada Data";
                                }
                                ?>
                                <h5 class="font-weight-bold text-muted mb-2">MUTU PELAYANAN</h5>
                                <div class="score-circle bg-white">
                                    <h1 class="display-3 font-weight-bold <?= $warna_mutu ?> mb-0"><?= $grade ?></h1>
                                    <h4 class="font-weight-bold text-dark mt-1"><?= number_format($nilai_mutu, 2, ',', '.') ?></h4>
                                </div>
                                <h4 class="font-weight-bold <?= $warna_mutu ?> mt-3"><?= $kategori_mutu ?></h4>
                            </div>

                            <!-- Sisi Kanan: Demografi Responden -->
                            <div class="col-lg-7 col-md-12 px-4">
                                <?php
                                $jumlah = $jumlah ?? 0;
                                $jmlh_lk = $jmlh_lk ?? 0;
                                $jmlh_pr = $jmlh_pr ?? 0;
                                $jmlh_sd = $jmlh_sd ?? 0;
                                $jmlh_smp = $jmlh_smp ?? 0;
                                $jmlh_sma = $jmlh_sma ?? 0;
                                $jmlh_d1 = $jmlh_d1 ?? 0;
                                $jmlh_s1 = $jmlh_s1 ?? 0;
                                $jmlh_s2 = $jmlh_s2 ?? 0;
                                $jmlh_pns = $jmlh_pns ?? 0;
                                $jmlh_tni = $jmlh_tni ?? 0;
                                $jmlh_polri = $jmlh_polri ?? 0;
                                $jmlh_swasta = $jmlh_swasta ?? 0;
                                $jmlh_wirausaha = $jmlh_wirausaha ?? 0;
                                $jmlh_lainnya = $jmlh_lainnya ?? 0;
                                ?>
                                <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="fas fa-users mr-2 text-primary"></i> Data Responden (Total: <span class="text-primary"><?= number_format($jumlah); ?></span> Orang)
                                </h5>

                                <div class="row">
                                    <!-- Gender -->
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-center bg-light rounded p-2 border">
                                            <span class="mr-4"><i class="fas fa-male text-primary fa-lg mr-2"></i> Laki-laki: <strong><?= number_format($jmlh_lk); ?></strong></span>
                                            <span><i class="fas fa-female text-danger fa-lg mr-2"></i> Perempuan: <strong><?= number_format($jmlh_pr); ?></strong></span>
                                        </div>
                                    </div>

                                    <!-- Pendidikan -->
                                    <div class="col-md-6 mb-3">
                                        <h6 class="font-weight-bold text-secondary"><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</h6>
                                        <div class="demo-list"><span>SD</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_sd); ?></span></div>
                                        <div class="demo-list"><span>SMP</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_smp); ?></span></div>
                                        <div class="demo-list"><span>SMA</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_sma); ?></span></div>
                                        <div class="demo-list"><span>DI/DII/DIII</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_d1); ?></span></div>
                                        <div class="demo-list"><span>DIV/S1</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_s1); ?></span></div>
                                        <div class="demo-list"><span>S2</span> <span class="badge badge-primary badge-pill"><?= number_format($jmlh_s2); ?></span></div>
                                    </div>

                                    <!-- Pekerjaan -->
                                    <div class="col-md-6 mb-3">
                                        <h6 class="font-weight-bold text-secondary"><i class="fas fa-briefcase mr-1"></i> Pekerjaan</h6>
                                        <div class="demo-list"><span>PNS</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_pns); ?></span></div>
                                        <div class="demo-list"><span>TNI</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_tni); ?></span></div>
                                        <div class="demo-list"><span>POLRI</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_polri); ?></span></div>
                                        <div class="demo-list"><span>SWASTA</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_swasta); ?></span></div>
                                        <div class="demo-list"><span>WIRAUSAHA</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_wirausaha); ?></span></div>
                                        <div class="demo-list"><span>LAINNYA</span> <span class="badge badge-success badge-pill"><?= number_format($jmlh_lainnya); ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Mutu -->
                        <div class="no-auto-hide alert alert-light border shadow-sm mt-3 text-center mb-0">
                            <h6 class="font-weight-bold mb-2">Keterangan Interval Mutu Pelayanan:</h6>
                            <span class="badge badge-primary px-3 py-2 m-1">A (Sangat Baik): 88.31 - 100.00</span>
                            <span class="badge badge-success px-3 py-2 m-1">B (Baik): 76.61 - 88.30</span>
                            <span class="badge badge-warning text-dark px-3 py-2 m-1">C (Kurang Baik): 65.00 - 76.00</span>
                            <span class="badge badge-danger px-3 py-2 m-1">D (Tidak Baik): 25.00 - 64.99</span>
                        </div>
                    </div>
                </div>

                <!-- GRAFIK TREN IKM PER SEMESTER -->
                <!-- <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white border-bottom-0 pt-4 text-center">
                        <h5 class="font-weight-bold text-dark"><i class="fas fa-chart-line text-primary mr-2"></i> Grafik Perkembangan Nilai IKM</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative" style="height: 350px;">
                            <canvas id="barChartPerUnsur"></canvas>
                        </div>
                        <script>
                            // Pastikan Chart.js sudah di-load di template header Anda
                            var kanvasunsur = document.getElementById("barChartPerUnsur").getContext("2d");
                            Chart.defaults.global.defaultFontFamily = "Lato";
                            Chart.defaults.global.defaultFontSize = 14;

                            // Ambil data asli dari PHP ke dalam variabel Javascript
                            var labelsIKM = [
                                <?php if (isset($tren_ikm) && !empty($tren_ikm)): ?>
                                    <?php foreach ($tren_ikm as $t): ?> "Smstr <?= $t->semester; ?> (<?= $t->tahun; ?>)",
                                    <?php endforeach; ?>
                                <?php else: ?> "Semester <?= $semester ?> (<?= date('Y') ?>)"
                                <?php endif; ?>
                            ];

                            var dataIKM = [
                                <?php if (isset($tren_ikm) && !empty($tren_ikm)): ?>
                                    <?php foreach ($tren_ikm as $t): ?>
                                        <?= $t->nilai_ikm; ?>,
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?= isset($ikm) ? $ikm : 0; ?>
                                <?php endif; ?>
                            ];

                            var chartData = {
                                labels: labelsIKM,
                                datasets: [{
                                    label: "Nilai Total IKM",
                                    data: dataIKM,
                                    backgroundColor: 'rgba(54, 162, 235, 0.7)', // Warna isi batang biru muda
                                    borderColor: 'rgba(54, 162, 235, 1)', // Warna garis tepi batang biru tua
                                    borderWidth: 1,
                                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)', // Warna saat disentuh mouse
                                    hoverBorderColor: 'rgba(54, 162, 235, 1)'
                                }]
                            };

                            var chartOptions = {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            max: 100, // Karena IKM maksimal 100
                                            fontColor: 'black',
                                            fontSize: 12
                                        },
                                        gridLines: {
                                            color: 'rgba(0, 0, 0, 0.1)'
                                        }
                                    }],
                                    xAxes: [{
                                        // Mengatur lebar batang agar proporsional
                                        barPercentage: 0.4,
                                        categoryPercentage: 0.8,
                                        ticks: {
                                            fontColor: 'black',
                                            fontSize: 12,
                                            fontStyle: 'bold'
                                        },
                                        gridLines: {
                                            display: false, // Menghilangkan garis vertikal agar grafik bersih
                                        }
                                    }]
                                },
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        boxWidth: 20, // Ikon legenda kotak, bukan garis
                                        fontColor: 'black'
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        // Menambahkan teks "Nilai IKM:" saat kotak di hover
                                        label: function(tooltipItem, data) {
                                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                            return 'Nilai IKM: ' + value;
                                        }
                                    }
                                }
                            };

                            // UBAH TYPE MENJADI 'bar' UNTUK GRAFIK BATANG / PETAK TINGGI
                            new Chart(kanvasunsur, {
                                type: 'bar',
                                data: chartData,
                                options: chartOptions
                            });
                        </script>
                    </div>
                </div> -->

                <!-- SPKP & SPAK SECTION -->
                <div class="card card-outline card-success shadow-sm mb-4" style="border-top-width: 3px;">
                    <div class="card-header text-center">
                        <h4 class="font-weight-bold text-success mb-0">NILAI SURVEI PERSEPSI KUALITAS PELAYANAN (SPKP) <br>& SURVEI PERSEPSI ANTI KORUPSI (SPAK)</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 text-center border-right">
                                <?php
                                // Ensure $spkp_spak is defined to avoid undefined variable error
                                $nilai_spkp = round(isset($spkp_spak) ? $spkp_spak : 0, 2);
                                $warna_spkp = 'text-info';
                                if ($nilai_spkp >= 88.31) {
                                    $kategori_spkp = "Sangat Baik";
                                    $grade_spkp = "A";
                                    $warna_spkp = 'text-primary';
                                } elseif ($nilai_spkp >= 76.61) {
                                    $kategori_spkp = "Baik";
                                    $grade_spkp = "B";
                                    $warna_spkp = 'text-success';
                                } elseif ($nilai_spkp >= 65.00) {
                                    $kategori_spkp = "Kurang Baik";
                                    $grade_spkp = "C";
                                    $warna_spkp = 'text-warning';
                                } else {
                                    $kategori_spkp = "Kurang Baik.";
                                    $grade_spkp = "D";
                                    $warna_spkp = 'text-danger';
                                }

                                // Jika nilai 0 (belum diinput admin)
                                if ($nilai_spkp == 0) {
                                    $grade_spkp = "-";
                                    $kategori_spkp = "Belum Ada Data";
                                }
                                ?>
                                <div class="score-circle bg-light mt-2 mb-3">
                                    <h1 class="display-3 font-weight-bold <?= $warna_spkp ?> mb-0"><?= $grade_spkp ?></h1>
                                    <h4 class="font-weight-bold text-dark mt-1"><?= number_format($nilai_spkp, 2, ',', '.') ?></h4>
                                </div>
                                <h4 class="font-weight-bold <?= $warna_spkp ?>"><?= $kategori_spkp ?></h4>
                            </div>

                            <div class="col-lg-6 text-center">
                                <h5 class="text-secondary font-weight-bold mb-3"><i class="fas fa-clipboard-check mr-2"></i> Laporan SPKP & SPAK</h5>
                                <div class="p-3 bg-light rounded border">
                                    <p class="mb-1"><strong>LAYANAN:</strong> PERIZINAN & NON PERIZINAN</p>
                                    <p class="mb-0"><strong>TOTAL RESPONDEN:</strong> <span class="badge badge-success text-lg"><?= number_format(isset($total_responden) ? $total_responden : 0); ?> Orang</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- GRAFIK GABUNGAN SPKP & SPAK -->
                        <div class="mt-5 border-top pt-4">
                            <h5 class="text-center font-weight-bold text-dark mb-4">Grafik Gabungan SPKP & SPAK Per-Unsur</h5>
                            <div class="position-relative" style="height: 350px;">
                                <canvas id="barChartUnsurCombined"></canvas>

                                <script>
                                    $(function() {
                                        var $combinedChart = $('#barChartUnsurCombined');
                                        var combinedChart = new Chart($combinedChart, {
                                            type: 'line',
                                            data: {
                                                labels: ['Medsos', 'Persyaratan', 'Alur', 'Waktu', 'Tarif', 'Sarana', 'Petugas', 'Konsultasi', 'Deskriminasi', 'Prosedur', 'Imbalan', 'Pungli', 'Calo'],
                                                datasets: [{
                                                    label: 'Rata-rata SPKP',
                                                    data: [<?= isset($z1) ? $z1 : 0; ?>, <?= isset($z2) ? $z2 : 0; ?>, <?= isset($z3) ? $z3 : 0; ?>, <?= isset($z4) ? $z4 : 0; ?>, <?= isset($z5) ? $z5 : 0; ?>, <?= isset($z6) ? $z6 : 0; ?>, <?= isset($z7) ? $z7 : 0; ?>, <?= isset($z8) ? $z8 : 0; ?>, null, null, null, null, null],
                                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    borderWidth: 2,
                                                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                                                    pointBorderColor: '#fff',
                                                    pointRadius: 5
                                                }, {
                                                    label: 'Rata-rata SPAK',
                                                    data: [null, null, null, null, null, null, null, null, <?= isset($r1) ? $r1 : 0; ?>, <?= isset($r2) ? $r2 : 0; ?>, <?= isset($r3) ? $r3 : 0; ?>, <?= isset($r4) ? $r4 : 0; ?>, <?= isset($r5) ? $r5 : 0; ?>],
                                                    backgroundColor: 'rgba(253, 126, 20, 0.1)',
                                                    borderColor: 'rgba(255, 159, 64, 1)',
                                                    borderWidth: 2,
                                                    pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                                                    pointBorderColor: '#fff',
                                                    pointRadius: 5
                                                }]
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRAFIK PER-BINTANG -->
                <div class="row">
                    <!-- SPKP BAR CHART -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white pt-4 text-center border-bottom-0">
                                <h6 class="font-weight-bold text-dark"><i class="fas fa-star text-warning mr-2"></i> Rating Per-Bintang (SPKP)</h6>
                            </div>
                            <div class="card-body">
                                <div class="position-relative" style="height: 275px;">
                                    <canvas id="barChartSPKP"></canvas>
                                    <script>
                                        var avg_spkp = <?= json_encode(isset($rating_spkp) ? $rating_spkp : array_fill(1, 6, ['total' => 0, 'percentage' => 0])) ?>;
                                        var data_spkp = [],
                                            pct_spkp = [];
                                        for (var i = 1; i <= 6; i++) {
                                            data_spkp.push(avg_spkp[i]['total']);
                                            pct_spkp.push(avg_spkp[i]['percentage']);
                                        }
                                        new Chart(document.getElementById('barChartSPKP').getContext('2d'), {
                                            type: 'bar',
                                            data: {
                                                labels: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5', 'Bintang 6'],
                                                datasets: [{
                                                        label: 'Total Bintang',
                                                        backgroundColor: '#FFD700',
                                                        data: data_spkp
                                                    },
                                                    {
                                                        label: 'Persentase',
                                                        backgroundColor: '#007bff',
                                                        data: pct_spkp
                                                    }
                                                ]
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SPAK BAR CHART -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white pt-4 text-center border-bottom-0">
                                <h6 class="font-weight-bold text-dark"><i class="fas fa-star text-warning mr-2"></i> Rating Per-Bintang (SPAK)</h6>
                            </div>
                            <div class="card-body">
                                <div class="position-relative" style="height: 275px;">
                                    <canvas id="barChartSPAK"></canvas>
                                    <script>
                                        var avg_spak = <?= json_encode(isset($rating_antikorupsi) ? $rating_antikorupsi : array_fill(1, 6, ['total' => 0, 'percentage' => 0])) ?>;
                                        var data_spak = [],
                                            pct_spak = [];
                                        for (var i = 1; i <= 6; i++) {
                                            data_spak.push(avg_spak[i]['total']);
                                            pct_spak.push(avg_spak[i]['percentage']);
                                        }
                                        new Chart(document.getElementById('barChartSPAK').getContext('2d'), {
                                            type: 'bar',
                                            data: {
                                                labels: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5', 'Bintang 6'],
                                                datasets: [{
                                                        label: 'Total Bintang',
                                                        backgroundColor: '#FFD700',
                                                        data: data_spak
                                                    },
                                                    {
                                                        label: 'Persentase',
                                                        backgroundColor: '#e9724d',
                                                        data: pct_spak
                                                    }
                                                ]
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PESAN TERIMA KASIH -->
                <div class="no-auto-hide alert alert-info shadow-sm text-center border-0 p-4 mb-4" style="border-radius: 10px;">
                    <h5 class="font-weight-bold mb-2">TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN</h5>
                    <p class="mb-0 text-dark">
                        Masukan Anda sangat bermanfaat bagi kemajuan dinas kami agar terus memperbaiki dan meningkatkan kualitas pelayanan bagi masyarakat.
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>