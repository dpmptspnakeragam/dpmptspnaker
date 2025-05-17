<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Card Tambah Tahun -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Tahun</h3>
                    </div>
                    <form action="<?php echo base_url('admin/grafik_izin_terbit_tahun/tambah_field_tahun'); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="form-group">
                                <input type="text" name="tahun" class="form-control form-control-sm" placeholder="Masukan Tahun" required>
                            </div>
                            <button type="submit" class="btn btn-outline-danger btn-block">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Tahun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Hapus Tahun -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Hapus Tahun</h3>
                    </div>
                    <form action="<?php echo base_url('admin/grafik_izin_terbit_tahun/hapus_field_tahun'); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="form-group">
                                <select name="tahun" class="form-control form-control-sm" required>
                                    <option selected disabled>Pilih Tahun</option>
                                    <?php foreach ($tahun_fields as $tahun) : ?>
                                        <option value="<?= str_replace('thn', '', $tahun->Field); ?>"><?= str_replace('thn', '', $tahun->Field); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-danger btn-block">
                                <i class="fa fa-trash-alt p-1" aria-hidden="true"></i>
                                Hapus Tahun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Tabel Grafik Izin Terbit (Tahun) -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>

                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalTambahIzinTerbitTahun">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nama Izin</th>
                                    <?php foreach ($tahun_fields as $tahun) : ?>
                                        <th class="text-center align-middle"><?= str_replace('thn', '', $tahun->Field); ?></th>
                                    <?php endforeach; ?>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->izin; ?></td>
                                        <?php foreach ($tahun_fields as $tahun) : ?>
                                            <td class="text-center align-middle"><?= $row->{$tahun->Field}; ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#modalEditIzinTerbitTahun<?= $row->id_grafik; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteGrafikTahun<?= $row->id_grafik; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

            <!-- Chart -->
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Jumlah Izin Terbit per Tahun</h3>
                    </div>

                    <div class="card-body">
                        <canvas id="chartIzinTahun"></canvas>

                        <?php
                        // Ambil tahun dari nama field (tanpa 'thn')
                        $label_tahun = [];
                        foreach ($tahun_fields as $tahun) {
                            $label_tahun[] = str_replace('thn', '', $tahun->Field);
                        }

                        // Bangun data untuk setiap izin
                        $datasets = [];
                        foreach ($grafik as $row) {
                            $data_per_tahun = [];
                            foreach ($tahun_fields as $tahun) {
                                $data_per_tahun[] = (int)$row->{$tahun->Field};
                            }

                            // Random warna tiap izin
                            $warna = sprintf('rgba(%d, %d, %d, 0.7)', rand(100, 255), rand(100, 255), rand(100, 255));

                            $datasets[] = [
                                'label' => $row->izin,
                                'data' => $data_per_tahun,
                                'backgroundColor' => $warna,
                                'borderColor' => str_replace('0.7', '1', $warna),
                                'borderWidth' => 1
                            ];
                        }
                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var ctx = document.getElementById('chartIzinTahun').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar', // Bisa diganti ke 'line'
                                    data: {
                                        labels: <?= json_encode($label_tahun); ?>,
                                        datasets: <?= json_encode($datasets); ?>
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