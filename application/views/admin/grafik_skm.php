<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Card Periode -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Periode <?= $title; ?></h3>
                    </div>
                    <div class="card-body text-center">
                        <h4>Periode</h4>
                        <span>
                            <?php foreach ($periode_grafik_skm->result() as $graph) : ?>
                                <!-- Tahun <?= date("Y", strtotime($graph->tgl_awal)); ?> s/d <?= date("Y", strtotime($graph->tgl_akhir)); ?> -->
                                <?= longdate_indo_nohari($graph->tgl_awal); ?> s/d <?= longdate_indo_nohari($graph->tgl_akhir); ?>
                                <a class="btn btn-outline-danger btn-block mt-2" href="#" data-toggle="modal" data-target="#EditPeriodeGrafikSKM<?= $graph->id_periode; ?>" title="Edit">
                                    <i class="fa fa-edit"></i> Ubah Periode
                                </a>
                            <?php endforeach; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Grafik SKM -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafikSKM">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Tahun</th>
                                    <th class="text-center align-middle">Semester I</th>
                                    <th class="text-center align-middle">Semester II</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik_skm->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->tahun; ?></td>
                                        <td class="text-center align-middle"><?= $row->nilai; ?></td>
                                        <td class="text-center align-middle"><?= $row->nilai2; ?></td>

                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditGrafikSKM<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikSKM<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

            <!-- Card Chart Grafik SKM -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Nilai SKM</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartSKM"></canvas>

                        <?php
                        // Siapkan array untuk data chart
                        $tahun = [];
                        $semester1 = [];
                        $semester2 = [];

                        foreach ($grafik_skm->result() as $row) {
                            $tahun[] = $row->tahun;
                            $semester1[] = $row->nilai;
                            $semester2[] = $row->nilai2;
                        }

                        // Konversi ke JSON
                        $tahun_json = json_encode($tahun);
                        $semester1_json = json_encode($semester1);
                        $semester2_json = json_encode($semester2);
                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var ctx = document.getElementById('chartSKM').getContext('2d');
                                var chartSKM = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: <?= $tahun_json ?>,
                                        datasets: [{
                                                label: 'Semester I',
                                                backgroundColor: 'rgba(54, 163, 235, 0.83)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                data: <?= $semester1_json ?>
                                            },
                                            {
                                                label: 'Semester II',
                                                backgroundColor: 'rgba(219, 22, 47, 0.7)',
                                                borderColor: 'rgba(219, 22, 47, 1)',
                                                borderWidth: 1,
                                                data: <?= $semester2_json ?>
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Nilai SKM'
                                                }
                                            },
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Tahun'
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Card IKM -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Indeks Kepuasan Masyarakat (IKM)</h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahIKM">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData2" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <th class="text-center align-middle">Preview</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($skm_gambar as $data) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $data['title']; ?></td>
                                        <td class="text-center align-middle">
                                            <img src="<?= base_url('assets/imgupload/' . $data['file_name']); ?>" style="width:250px;" class="img-responsive">
                                        </td>

                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditIKM<?= $data['id_skm_gambar']; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteIKM<?= $data['id_skm_gambar']; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

        </div>
    </div>
</section>
<!-- /.content -->