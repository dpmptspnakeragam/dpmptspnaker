<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Realisasi Investasi (Rp/M)</h3>
                    </div>
                    <div class="card-body text-center">
                        <h4>Periode</h4>
                        <span>
                            <?php foreach ($periode_grafik_investasi->result() as $graph) : ?>
                                <?= longdate_indo_nohari($graph->tgl_awal); ?> s/d <?= longdate_indo_nohari($graph->tgl_akhir); ?>
                                <br>
                                <a class="btn btn-outline-danger btn-block mt-2" href="#" data-toggle="modal" data-target="#EditPeriodeGrafikRealisasasiInvestasi<?= $graph->id_periode; ?>" title="Edit">
                                    <i class="fa fa-edit"></i> Ubah Periode
                                </a>
                            <?php endforeach; ?>
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

                        </div>

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#ModalTambahGrafikRealisasiInvestasi">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Tahun
                            </button>

                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahJenisGrafikRealisasiInvestasi">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Jenis
                            </button>
                        </div>

                        <table id="TabelDataIzinTerbit" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Investasi</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_investasi->result() as $row) : ?>
                                    <tr <?= ($row->level == 0) ? 'style="background:#f8f9fa;font-weight:bold;"' : ''; ?>>

                                        <td class="text-center">
                                            <?= ($row->level == 0) ? $count++ : ''; ?>
                                        </td>

                                        <td class="text-center">
                                            <?= ($row->level == 0) ? $row->tahun : ''; ?>
                                        </td>

                                        <td class="text-left">
                                            <?php if ($row->level == 0) : ?>
                                                Target: <?= number_format((float)$row->nilai, 2, ',', '.'); ?>
                                            <?php else : ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;└ <?= $row->jenis_investasi; ?> (Realisasi: <?= number_format((float)$row->nilai2, 2, ',', '.'); ?>)
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center align-middle">
                                            <?php if ($row->tipe == 'tahun') : ?>
                                                <button data-toggle="modal" data-target="#EditTahunGrafikRealisasasiInvestasi<?= $row->id_grafik; ?>" class="btn btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            <?php else : ?>
                                                <button data-toggle="modal" data-target="#EditJenisGrafikRealisasasiInvestasi<?= $row->id_grafik; ?>" class="btn btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            <?php endif; ?>

                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikRealisasiInvestasi<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
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
                        <canvas id="myChart"></canvas>

                        <?php
                        // Ambil data dari $grafik_investasi
                        $tahun_investasi = [];
                        $total = [];
                        $total2 = [];

                        foreach ($grafik_investasi->result() as $item) {
                            // 🔥 PENTING: Wajib difilter agar hanya data TAHUN (Level 0) yang masuk chart
                            // Tergantung dari query yang dipanggil di controller adminmu,
                            // bisa menggunakan $item->level == 0 atau $item->tipe == 'tahun'
                            if ((isset($item->level) && $item->level == 0) || (isset($item->tipe) && $item->tipe == 'tahun')) {
                                $tahun_investasi[] = $item->tahun;
                                $total[] = (float) $item->nilai;
                                $total2[] = (float) $item->nilai2;
                            }
                        }

                        // Mengubah array ke JSON dengan JSON_NUMERIC_CHECK memastikan output berupa angka di JS
                        $tahun_json = json_encode($tahun_investasi);
                        $total_json = json_encode($total, JSON_NUMERIC_CHECK);
                        $total2_json = json_encode($total2, JSON_NUMERIC_CHECK);
                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar', // Bisa juga line, pie, dll.
                                    data: {
                                        labels: <?= $tahun_json; ?>,
                                        datasets: [{
                                                label: "Target",
                                                backgroundColor: 'rgba(54, 163, 235, 0.83)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                data: <?= $total_json; ?>
                                            },
                                            {
                                                label: "Realisasi",
                                                backgroundColor: 'rgba(219, 22, 47, 0.7)',
                                                borderColor: 'rgba(219, 22, 47, 1)',
                                                borderWidth: 1,
                                                data: <?= $total2_json; ?>
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,

                                        // 🔥 SETUP TOOLTIP SAMA SEPERTI DI HOME 🔥
                                        tooltips: {
                                            mode: 'index',
                                            intersect: false,
                                            // 1. Menyembunyikan pop-up label untuk 'Target'
                                            filter: function(tooltipItem, data) {
                                                var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                                                return datasetLabel === 'Realisasi';
                                            },
                                            // 2. Menghilangkan judul tahun di atas tooltip
                                            callbacks: {
                                                title: function(tooltipItems, data) {
                                                    return '';
                                                }
                                            }
                                        },

                                        scales: {
                                            // Format sumbu Y untuk Chart.js v2 (Sering dipakai di Template AdminLTE)
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }],
                                            // Format sumbu Y untuk Chart.js v3+ (Jaga-jaga jika menggunakan versi terbaru)
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>