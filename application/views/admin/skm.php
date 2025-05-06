<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Filter Data</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form untuk filter data -->
                        <form method="GET" action="<?= base_url('admin/skm/filter'); ?>">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="bulan_awal">Bulan Awal</label>
                                    <select name="bulan_awal" id="bulan_awal" class="form-control">
                                        <?php
                                        $bulan_awal_selected = $this->input->get('bulan_awal') ?? 1; // Ambil nilai dari GET atau default ke 1
                                        for ($i = 1; $i <= 12; $i++) : ?>
                                            <option value="<?= $i; ?>" <?= ($i == $bulan_awal_selected) ? 'selected' : ''; ?>>
                                                <?= date('F', mktime(0, 0, 0, $i, 10)); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="bulan_akhir">Bulan Akhir</label>
                                    <select name="bulan_akhir" id="bulan_akhir" class="form-control">
                                        <?php
                                        $bulan_akhir_selected = $this->input->get('bulan_akhir') ?? date('n'); // Default ke bulan saat ini
                                        for ($i = 1; $i <= 12; $i++) : ?>
                                            <option value="<?= $i; ?>" <?= ($i == $bulan_akhir_selected) ? 'selected' : ''; ?>>
                                                <?= date('F', mktime(0, 0, 0, $i, 10)); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php
                                        $tahun_selected = $this->input->get('tahun') ?? date('Y'); // Default ke tahun saat ini
                                        for ($i = date('Y') - 5; $i <= date('Y'); $i++) : ?>
                                            <option value="<?= $i; ?>" <?= ($i == $tahun_selected) ? 'selected' : ''; ?>>
                                                <?= $i; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2 mt-2 align-self-end">
                                    <button type="submit" class="btn btn-block btn-outline-danger">Tampilkan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="TabelDataPrint" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" rowspan="2">No.</th>
                                    <th class="text-center align-middle" rowspan="2">Nama</th>
                                    <th class="text-center align-middle" rowspan="2">Telepon</th>
                                    <th class="text-center align-middle" rowspan="2">Jenis Kelamin</th>
                                    <th class="text-center align-middle" rowspan="2">Umur</th>
                                    <th class="text-center align-middle" rowspan="2">Pendidikan</th>
                                    <th class="text-center align-middle" rowspan="2">Pekerjaan</th>
                                    <th class="text-center align-middle" rowspan="2">Layanan</th>
                                    <th class="text-center align-middle" rowspan="2">Tanggal</th>
                                    <th id="toggle-column" class="text-center align-middle" colspan="9" style="cursor: pointer;">Pendapat Responden</th>
                                    <th class="text-center align-middle" rowspan="2">Aksi</th>
                                </tr>

                                <tr id="hidden-rows">
                                    <th class="text-center align-middle">U1</th>
                                    <th class="text-center align-middle">U2</th>
                                    <th class="text-center align-middle">U3</th>
                                    <th class="text-center align-middle">U4</th>
                                    <th class="text-center align-middle">U5</th>
                                    <th class="text-center align-middle">U6</th>
                                    <th class="text-center align-middle">U7</th>
                                    <th class="text-center align-middle">U8</th>
                                    <th class="text-center align-middle">U9</th>
                                </tr>
                            </thead>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var toggleColumn = document.getElementById('toggle-column');
                                    var hiddenRows = document.getElementById('hidden-rows');

                                    toggleColumn.addEventListener('click', function() {
                                        if (hiddenRows.style.display === 'none') {
                                            hiddenRows.style.display = '';
                                        } else {
                                            hiddenRows.style.display = 'none';
                                        }
                                    });
                                });
                            </script>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($skm as $row): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= !empty($row['nama']) ? $row['nama'] : '-'; ?></td>
                                        <td class="text-center align-middle"><?= $row['no_hp']; ?></td>
                                        <td class="text-center align-middle">
                                            <?php if ($row['jk'] == 1) : ?>
                                                Laki-Laki
                                            <?php elseif ($row['jk'] == 2) : ?>
                                                Perempuan
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= $row['umur']; ?></td>
                                        <td class="text-center align-middle">
                                            <?php if ($row['pendidikan'] == 1) : ?>
                                                SD
                                            <?php elseif ($row['pendidikan'] == 2) : ?>
                                                SMP
                                            <?php elseif ($row['pendidikan'] == 3) : ?>
                                                SMA
                                            <?php elseif ($row['pendidikan'] == 4) : ?>
                                                DI/DII/DIII
                                            <?php elseif ($row['pendidikan'] == 5) : ?>
                                                DIV/S1
                                            <?php elseif ($row['pendidikan'] == 6) : ?>
                                                S2
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php if ($row['pekerjaan'] == 1) : ?>
                                                PNS
                                            <?php elseif ($row['pekerjaan'] == 2) : ?>
                                                TNI
                                            <?php elseif ($row['pekerjaan'] == 3) : ?>
                                                POLRI
                                            <?php elseif ($row['pekerjaan'] == 4) : ?>
                                                Swasta
                                            <?php elseif ($row['pekerjaan'] == 5) : ?>
                                                Wirausaha
                                            <?php elseif ($row['pekerjaan'] == 6) : ?>
                                                Lainnya
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle"><?= $row['layanan']; ?></td>
                                        <td class="text-center align-middle"><?= date('d-m-Y / H:i:s', strtotime($row['date'])); ?></td>
                                        <td class="text-center align-middle"><?= $row['u1']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u2']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u3']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u4']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u5']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u6']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u7']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u8']; ?></td>
                                        <td class="text-center align-middle"><?= $row['u9']; ?></td>

                                        <td class="text-center align-middle">
                                            <!-- <button type="button" data-toggle="modal" data-target="#detailSKM<?= $row['id_skm']; ?>" class="btn btn-outline-primary mt-1 mb-1">
                                                <i class="fas fa-search"></i>
                                            </button> -->
                                            <button type="button" data-toggle="modal" data-target="#deleteSKM<?= $row['id_skm']; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-info mt-1 mb-1" onclick="printSKM(<?= $row['id_skm'] ?>)">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <script>
                                                function printSKM(id) {
                                                    // Redirect ke halaman cetak dengan ID kuesioner
                                                    window.open('<?php echo base_url('admin/skm/cetak/'); ?>' + id, '_blank');
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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

<?php foreach ($skm as $row): ?>
    <div class="modal fade" id="deleteSKM<?= $row['id_skm']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang <strong class="text-maroon"><?= $row['nama']; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/skm/delete/' . $row['id_skm']); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($skm as $row): ?>
    <div class="modal fade" id="detailSKM<?= $row['id_skm']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4 mb-0 mt-0">Telepon</dt>
                        <dd class="col-sm-8 mb-0 mt-0">: <?= !empty($row['no_hp']) ? $row['no_hp'] : '-'; ?></dd>

                        <dt class="col-sm-4 mb-0 mt-0">Jenis Kelamin</dt>
                        <dd class="col-sm-8 mb-0 mt-0">:
                            <?php if ($row['jk'] == 1) : ?>
                                Laki-Laki
                            <?php elseif ($row['jk'] == 2) : ?>
                                Perempuan
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4 mb-0 mt-0">Umur</dt>
                        <dd class="col-sm-8 mb-0 mt-0">: <?= $row['umur']; ?> Tahun</dd>

                        <dt class="col-sm-4 mb-0 mt-0">Pendidikan</dt>
                        <dd class="col-sm-8 mb-0 mt-0">:
                            <?php if ($row['pendidikan'] == 1) : ?>
                                SD
                            <?php elseif ($row['pendidikan'] == 2) : ?>
                                SMP
                            <?php elseif ($row['pendidikan'] == 3) : ?>
                                SMA
                            <?php elseif ($row['pendidikan'] == 4) : ?>
                                DI/DII/DIII
                            <?php elseif ($row['pendidikan'] == 5) : ?>
                                DIV/S1
                            <?php elseif ($row['pendidikan'] == 6) : ?>
                                S2
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4 mb-0 mt-0">Pekerjaan</dt>
                        <dd class="col-sm-8 mb-0 mt-0">:
                            <?php if ($row['pekerjaan'] == 1) : ?>
                                PNS
                            <?php elseif ($row['pekerjaan'] == 2) : ?>
                                TNI
                            <?php elseif ($row['pekerjaan'] == 3) : ?>
                                POLRI
                            <?php elseif ($row['pekerjaan'] == 4) : ?>
                                Swasta
                            <?php elseif ($row['pekerjaan'] == 5) : ?>
                                Wirausaha
                            <?php elseif ($row['pekerjaan'] == 6) : ?>
                                Lainnya
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4 mb-0 mt-0">Layanan</dt>
                        <dd class="col-sm-8 mb-0 mt-0">: <?= $row['layanan']; ?></dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>