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

                    <hr class="mt-0 mb-0">

                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahGrafik">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nama Izin</th>
                                    <th class="text-center align-middle">Jumlah Izin</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grafik->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->izin; ?></td>
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
                    <!-- /.card-header -->

                    <div class="card-body">
                        <canvas id="myChart"></canvas>

                        <?php
                        // Pastikan data ada sebelum diproses
                        $nama_izin = [];
                        $total = [];

                        foreach ($grafik->result() as $row) {
                            $nama_izin[] = $row->izin;
                            $total[] = $row->jumlah;
                        }

                        // Ubah menjadi JSON agar bisa digunakan di JavaScript
                        $nama_izin_json = json_encode($nama_izin);
                        $total_json = json_encode($total);
                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    type: 'bar', // Bisa diganti dengan 'line', 'pie', dll.
                                    data: {
                                        labels: <?= $nama_izin_json; ?>,
                                        datasets: [{
                                            // label: "Jumlah " + new Date().getFullYear(),
                                            label: "Jumlah",
                                            backgroundColor: 'rgba(219, 22, 47, 0.7)', // Warna batang
                                            borderColor: 'rgba(219, 22, 47, 1)', // Warna garis tepi
                                            borderWidth: 1,
                                            data: <?= $total_json; ?>
                                        }]
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
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php foreach ($grafik->result() as $row) : ?>
    <div class="modal fade" id="ModalDeleteGrafik<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->izin; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/grafik_izin/hapus/' . $row->id_grafik); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>