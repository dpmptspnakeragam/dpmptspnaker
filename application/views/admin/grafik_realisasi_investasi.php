<!-- Main content -->
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
                                <!-- Tahun <?= date("Y", strtotime($graph->tgl_awal)); ?> s/d <?= date("Y", strtotime($graph->tgl_akhir)); ?> -->
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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikRealisasiInvestasi">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Target</th>
                                    <th class="text-center align-middle">Realisasi</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_investasi->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->tahun; ?></td>
                                        <td class="text-center align-middle"><?= $row->nilai; ?></td>
                                        <td class="text-center align-middle"><?= $row->nilai2; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditGrafikRealisasasiInvestasi<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
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
                            $tahun_investasi[] = $item->tahun;
                            $total[] = $item->nilai;
                            $total2[] = $item->nilai2;
                        }

                        // Ubah ke format JSON untuk JavaScript
                        $tahun_json = json_encode($tahun_investasi);
                        $total_json = json_encode($total);
                        $total2_json = json_encode($total2);
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
                                        scales: {
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
<!-- /.content -->