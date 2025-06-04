<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>
                    <div class="card-body text-center">
                        <h4>Periode</h4>
                        <span>
                            <?php
                            $no = 1;
                            foreach ($periode_grafik->result() as $graph) {
                            ?>
                                <?= longdate_indo_nohari($graph->tgl_awal); ?> s/d <?= longdate_indo_nohari($graph->tgl_akhir); ?> <br> <a class="btn btn-outline-danger btn-block mt-2" href="#" data-toggle="modal" data-target="#EditPeriodeGrafikNIB<?= $graph->id_periode; ?>" title="Edit"><i class="fa fa-edit"></i> Ubah Periode</a>

                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ------------------------------Grafik NIB------------------------------ -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Grafik NIB Diterbitkan</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikNIB">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>
                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">PMDN/PMA & UMK/Non UMK</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_nib->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->nib; ?></td>
                                        <td class="text-center align-middle"><?= $row->jumlah; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafikNIB<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikNIB<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik NIB Diterbitkan</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($grafik_nib->num_rows() > 0): ?>
                            <canvas id="grafikNIB"></canvas>

                            <?php
                            $nib_label = [];
                            $nib_total = [];

                            foreach ($grafik_nib->result() as $row) {
                                $nib_label[] = $row->nib;
                                $nib_total[] = $row->jumlah;
                            }

                            $nib_label_json = json_encode($nib_label, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            $nib_total_json = json_encode($nib_total, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('grafikNIB').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= $nib_label_json; ?>,
                                            datasets: [{
                                                label: "Jumlah",
                                                backgroundColor: 'rgba(219, 22, 47, 0.7)',
                                                borderColor: 'rgba(219, 22, 47, 1)',
                                                borderWidth: 1,
                                                data: <?= $nib_total_json; ?>
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    title: {
                                                        display: true,
                                                        text: 'Jumlah'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        <?php else: ?>
                            <p class="text-center text-muted"><b>Data grafik belum tersedia.</b></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ------------------------------Grafik NIB------------------------------ -->

            <!-- ------------------------------Grafik Risiko------------------------------ -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Grafik Sebaran Proyek Bedasarkan Risiko</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikResiko">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>
                        <table id="TabelData2" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Risiko</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_risiko->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->risiko; ?></td>
                                        <td class="text-center align-middle"><?= $row->jumlah; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafikResiko<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikResiko<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Sebaran Proyek Bedasarkan Risiko</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($grafik_risiko->num_rows() > 0): ?>
                            <canvas id="grafikRisiko"></canvas>

                            <?php
                            $risiko_label = [];
                            $risiko_total = [];

                            foreach ($grafik_risiko->result() as $row) {
                                $risiko_label[] = $row->risiko;
                                $risiko_total[] = $row->jumlah;
                            }

                            $risiko_label_json = json_encode($risiko_label, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            $risiko_total_json = json_encode($risiko_total, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('grafikRisiko').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: <?= $risiko_label_json; ?>,
                                            datasets: [{
                                                label: "Jumlah Risiko",
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8E44AD',
                                                    '#2ECC71', '#E67E22', '#1ABC9C', '#34495E'
                                                ],
                                                data: <?= $risiko_total_json; ?>
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    position: 'bottom'
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        <?php else: ?>
                            <p class="text-center text-muted"><b>Data grafik belum tersedia.</b></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ------------------------------Grafik Risiko------------------------------ -->

            <!-- ------------------------------Grafik Kecamatan------------------------------ -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Grafik Sebaran Proyek Per Kecamatan Usaha</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikKecamatan">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>
                        <table id="TabelData3" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Kecamatan</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_kecamatan->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->kecamatan; ?></td>
                                        <td class="text-center align-middle"><?= $row->jumlah; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafikPerKecamatan<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikPerKecamatan<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Grafik Sebaran Proyek Per Kecamatan Usaha</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($grafik_kecamatan->num_rows() > 0): ?>
                            <canvas id="grafikKecamatan"></canvas>

                            <?php
                            $kecamatan_label = [];
                            $kecamatan_total = [];

                            foreach ($grafik_kecamatan->result() as $row) {
                                $kecamatan_label[] = $row->kecamatan;
                                $kecamatan_total[] = $row->jumlah;
                            }

                            $kecamatan_label_json = json_encode($kecamatan_label, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            $kecamatan_total_json = json_encode($kecamatan_total, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('grafikKecamatan');
                                    ctx.height = 460; // atur tinggi canvas agar lebih tinggi dan bar lebih longgar
                                    var chart = new Chart(ctx.getContext('2d'), {
                                        type: 'horizontalBar',
                                        data: {
                                            labels: <?= $kecamatan_label_json; ?>,
                                            datasets: [{
                                                label: "Jumlah",
                                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                data: <?= $kecamatan_total_json; ?>,
                                                barThickness: 25,
                                                maxBarThickness: 40
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                xAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Jumlah'
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        padding: 10,
                                                        fontSize: 12
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'KBLI'
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                });
                            </script>
                        <?php else: ?>
                            <p class="text-center text-muted"><b>Data grafik belum tersedia.</b></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ------------------------------Grafik Kecamatan------------------------------ -->

            <!-- ------------------------------Grafik KBLI------------------------------ -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Grafik Top 5 KBLI</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikKBLI">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>
                        <table id="TabelData4" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">KBLI</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_kbli->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->kbli; ?></td>
                                        <td class="text-center align-middle"><?= $row->jumlah; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafikKBLI<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikKBLI<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Grafik Top 5 KBLI</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($grafik_kbli->num_rows() > 0): ?>
                            <canvas id="grafikKBLI"></canvas>

                            <?php
                            $kbli_label = [];
                            $kbli_total = [];

                            foreach ($grafik_kbli->result() as $row) {
                                $kbli_label[] = $row->kbli;
                                $kbli_total[] = (int)$row->jumlah;
                            }

                            $kbli_label_json = json_encode($kbli_label, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            $kbli_total_json = json_encode($kbli_total, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('grafikKBLI').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'horizontalBar',
                                        data: {
                                            labels: <?= $kbli_label_json; ?>,
                                            datasets: [{
                                                label: "Jumlah",
                                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                data: <?= $kbli_total_json; ?>
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                xAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Jumlah'
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        padding: 10,
                                                        fontSize: 12
                                                    },
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Kecamatan'
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                });
                            </script>
                        <?php else: ?>
                            <p class="text-center text-muted"><b>Data grafik belum tersedia.</b></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ------------------------------Grafik KBLI------------------------------ -->
        </div>
    </div>
</section>
<!-- /.content -->