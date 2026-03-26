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
                                <?= longdate_indo_nohari($graph->tgl_awal); ?> s/d <?= longdate_indo_nohari($graph->tgl_akhir); ?> <br> <a class="btn btn-outline-danger btn-block mt-2" href="#" data-toggle="modal" data-target="#EditPeriodeGrafik<?php echo $graph->id_periode; ?>" title="Edit"><i class="fa fa-edit"></i> Ubah Periode</a>

                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#ModalTambahGrafik">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Bidang
                            </button>

                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikJenisIzin">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Jenis Izin
                            </button>
                        </div>

                        <table id="TabelDataIzinTerbit" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nama Bidang</th>
                                    <th class="text-center align-middle">Jenis Izin</th>
                                    <th class="text-center align-middle">Jumlah Izin</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik->result() as $row) : ?>
                                    <tr <?= ($row->level == 0) ? 'style="background-color:#f8f9fa; font-weight:bold;"' : ''; ?>>
                                        <td class="text-center align-middle">
                                            <?= ($row->level == 0) ? $count++ : ''; ?>
                                        </td>

                                        <td class="align-middle">
                                            <?= ($row->level == 0) ? $row->nama_bidang : ''; ?>
                                        </td>

                                        <td class="align-middle">
                                            <?= ($row->level == 0) ? '-' : '&nbsp;&nbsp;&nbsp;&nbsp;└ ' . $row->jenis_izin; ?>
                                        </td>

                                        <td class="text-center align-middle"><?= $row->jumlah; ?></td>

                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafik<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafik<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>

                    <div class="card-body">
                        <?php if ($chart_bidang->num_rows() > 0): ?>
                            <div class="chart-container" style="position: relative; height:400px;">
                                <canvas id="myChart"></canvas>
                            </div>

                            <?php
                            $nama_bidang = [];
                            $total_bidang = [];
                            $detail_jenis = [];

                            foreach ($chart_bidang->result() as $row) {
                                $nama_bidang[] = $row->izin;
                                $total_bidang[] = (int)$row->jumlah;
                                $detail_jenis[$row->izin] = [];
                            }

                            if ($chart_jenis->num_rows() > 0) {
                                foreach ($chart_jenis->result() as $row) {
                                    $detail_jenis[$row->bidang][] = array(
                                        'jenis_izin' => $row->jenis_izin,
                                        'jumlah'     => (int)$row->jumlah
                                    );
                                }
                            }
                            ?>

                            <!-- <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('myChart').getContext('2d');

                                    var detailJenis = <?= json_encode($detail_jenis, JSON_UNESCAPED_UNICODE); ?>;

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= json_encode($nama_bidang, JSON_UNESCAPED_UNICODE); ?>,
                                            datasets: [{
                                                label: 'Total Izin per Bidang',
                                                data: <?= json_encode($total_bidang); ?>,
                                                backgroundColor: 'rgba(219, 22, 47, 0.7)',
                                                borderColor: 'rgba(219, 22, 47, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            legend: {
                                                display: true
                                            },
                                            title: {
                                                display: true,
                                                text: 'Grafik Total Izin per Bidang'
                                            },
                                            tooltips: {
                                                callbacks: {
                                                    title: function(tooltipItems, data) {
                                                        return tooltipItems[0].label;
                                                    },
                                                    // label: function(tooltipItem, data) {
                                                    //     return 'Jumlah Bidang: ' + tooltipItem.yLabel;
                                                    // },
                                                    afterBody: function(tooltipItems, data) {
                                                        var bidang = tooltipItems[0].label;
                                                        var detail = detailJenis[bidang] || [];

                                                        if (detail.length === 0) {
                                                            return ['', 'Tidak ada jenis izin'];
                                                        }

                                                        var lines = ['', 'Rincian Jenis Izin:'];
                                                        detail.forEach(function(item) {
                                                            lines.push('- ' + item.jenis_izin + ': ' + item.jumlah);
                                                        });

                                                        return lines;
                                                    },
                                                    // footer: function(tooltipItems, data) {
                                                    //     return 'Total: ' + tooltipItems[0].yLabel;
                                                    // }
                                                }
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true,
                                                        precision: 0
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                });
                            </script> -->

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('myChart').getContext('2d');

                                    var detailJenis = <?= json_encode($detail_jenis, JSON_UNESCAPED_UNICODE); ?>;

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= json_encode($nama_bidang, JSON_UNESCAPED_UNICODE); ?>,
                                            datasets: [{
                                                label: '',
                                                data: <?= json_encode($total_bidang); ?>,
                                                backgroundColor: 'rgba(219, 22, 47, 0.7)',
                                                borderColor: 'rgba(219, 22, 47, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            legend: {
                                                display: false
                                            },
                                            title: {
                                                display: true,
                                                text: 'Grafik Total Izin per Bidang'
                                            },
                                            tooltips: {
                                                callbacks: {
                                                    title: function(tooltipItems, data) {
                                                        return tooltipItems[0].label;
                                                    },
                                                    label: function(tooltipItem, data) {
                                                        return null;
                                                    },
                                                    afterBody: function(tooltipItems, data) {
                                                        var bidang = tooltipItems[0].label;
                                                        var detail = detailJenis[bidang] || [];

                                                        if (detail.length === 0) {
                                                            return ['- Tidak ada jenis izin'];
                                                        }

                                                        var lines = [];
                                                        detail.forEach(function(item) {
                                                            lines.push('- ' + item.jenis_izin + ': ' + item.jumlah);
                                                        });

                                                        return lines;
                                                    },
                                                    footer: function(tooltipItems, data) {
                                                        return '';
                                                    }
                                                }
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true,
                                                        precision: 0
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

        </div>
    </div>
</section>
<!-- /.content -->