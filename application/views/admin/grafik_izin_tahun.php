<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grafik Izin Terbit (Tahun)</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">Grafik Izin Terbit (Tahun)</h3>
                <hr>
                <div class="panel-heading">
                    <?php if ($this->session->flashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('gagal'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('berhasil')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('berhasil'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <button href="" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus fa-fw"></i>Tambah Data</button>

                    <form class="form-inline mt-3" action="<?php echo base_url('admin/grafik_izin_tahun/tambah_field_tahun'); ?>" method="post">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <input type="text" name="tahun" class="form-control form-control-sm mr-2" placeholder="Tahun" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                    </form>

                    <form class="form-inline mt-3" action="<?php echo base_url('admin/grafik_izin_tahun/hapus_field_tahun'); ?>" method="post">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <select name="tahun" class="form-control form-control-sm mr-2" required>
                                <option selected disabled>Pilih Tahun</option>
                                <?php foreach ($tahun_fields as $tahun) : ?>
                                    <option value="<?= str_replace('thn', '', $tahun->Field); ?>"><?= str_replace('thn', '', $tahun->Field); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>

                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped table-hover" id="TabelData1">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Izin</th>
                                <?php foreach ($tahun_fields as $tahun) : ?>
                                    <th class="text-center"><?= str_replace('thn', '', $tahun->Field); ?></th>
                                <?php endforeach; ?>
                                <th class="text-center"><i class="fa fa-cog"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($grafik as $row) {
                            ?>
                                <tr class="odd gradeX">
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->izin; ?></td>
                                    <?php foreach ($tahun_fields as $tahun) : ?>
                                        <td><?= $row->{$tahun->Field}; ?></td>
                                    <?php endforeach; ?>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning btn-sm" href="#" data-toggle="modal" data-target="#modalEdit<?php echo $row->id_grafik; ?>" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm" href="<?= base_url() ?>admin/grafik_izin_tahun/hapus/<?php echo $row->id_grafik; ?>" title="Hapus" onclick="javascript: return confirm('Anda yakin hapus <?= $row->izin; ?>?')"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <br>

        <div class="col-lg-12 bg-dark text-light">
            <canvas id="myChart"></canvas>
            <?php
            // Inisialisasi nilai variabel awal
            $nama_izin = "";
            $datasets = [];
            foreach ($grafik as $item) {
                $nama = $item->izin;
                $nama_izin .= "'$nama'" . ", ";
            }
            foreach ($tahun_fields as $field) {
                $year = str_replace('thn', '', $field->Field);
                $data_values = [];
                foreach ($grafik as $item) {
                    $data_values[] = $item->{$field->Field};
                }
                $datasets[] = [
                    'label' => "Tahun " . $year,
                    'backgroundColor' => '#' . substr(md5(rand()), 0, 6),
                    'data' => $data_values
                ];
            }
            ?>
        </div>
    </div>
    </div>
    </div>
    </div>
</main>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var data = {
        labels: [<?php echo $nama_izin; ?>],
        datasets: <?php echo json_encode($datasets); ?>
    };
    var chart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            legend: {
                labels: {
                    fontColor: 'white'
                }
            },
            "hover": {
                "animationDuration": 0
            },
            "animation": {
                "duration": 1,
                "onComplete": function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: 'white'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: 'white'
                    }
                }]
            }
        }
    });
</script>