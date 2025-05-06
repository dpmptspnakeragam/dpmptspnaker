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
                        <form method="GET" action="<?= base_url('admin/spkp_antikorupsi/filter'); ?>">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="bulan_awal">Bulan Awal</label>
                                    <select name="bulan_awal" id="bulan_awal" class="form-control">
                                        <?php
                                        $bulan_awal_selected = $this->input->get('bulan_awal') ?? 1;
                                        for ($i = 1; $i <= 12; $i++): ?>
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
                                        $bulan_akhir_selected = $this->input->get('bulan_akhir') ?? date('n');
                                        for ($i = 1; $i <= 12; $i++) : ?>
                                            <option value="<?= $i;; ?>" <?= ($i == $bulan_akhir_selected) ? 'selected' : ''; ?>>
                                                <?= date('F', mktime(0, 0, 0, $i, 10)); ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php
                                        $tahun_selected = $this->input->get('tahun') ?? date('Y');
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
                                    <th id="toggle-column" class="text-center align-middle" colspan="8" style="cursor: pointer;">SPKP</th>
                                    <th id="toggle-column" class="text-center align-middle" colspan="5" style="cursor: pointer;">SPAK</th>
                                    <th class="text-center align-middle" rowspan="2">Tanggal</th>
                                    <th class="text-center align-middle" rowspan="2">Aksi</th>
                                </tr>

                                <tr id="hidden-rows">
                                    <th class="text-center align-middle">Z1</th>
                                    <th class="text-center align-middle">Z2</th>
                                    <th class="text-center align-middle">Z3</th>
                                    <th class="text-center align-middle">Z4</th>
                                    <th class="text-center align-middle">Z5</th>
                                    <th class="text-center align-middle">Z6</th>
                                    <th class="text-center align-middle">Z7</th>
                                    <th class="text-center align-middle">Z8</th>
                                    <th class="text-center align-middle">R1</th>
                                    <th class="text-center align-middle">R2</th>
                                    <th class="text-center align-middle">R3</th>
                                    <th class="text-center align-middle">R4</th>
                                    <th class="text-center align-middle">R5</th>
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
                                <?php foreach ($rating as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row['z1']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z2']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z3']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z4']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z5']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z6']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z7']; ?></td>
                                        <td class="text-center align-middle"><?= $row['z8']; ?></td>
                                        <td class="text-center align-middle"><?= $row['r1']; ?></td>
                                        <td class="text-center align-middle"><?= $row['r2']; ?></td>
                                        <td class="text-center align-middle"><?= $row['r3']; ?></td>
                                        <td class="text-center align-middle"><?= $row['r4']; ?></td>
                                        <td class="text-center align-middle"><?= $row['r5']; ?></td>
                                        <td class="text-center align-middle"><?= date('d-m-Y / H:i:s', strtotime($row['date'])); ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#deleteBarang<?= $row['id_spkp']; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-info mt-1 mb-1" onclick="printSKM(<?= $row['id_spkp'] ?>)">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <script>
                                                function printSKM(id) {
                                                    // Redirect ke halaman cetak dengan ID kuesioner
                                                    window.open('<?php echo base_url('admin/spkp_antikorupsi/cetak/'); ?>' + id, '_blank');
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

<?php foreach ($rating as $row) : ?>
    <div class="modal fade" id="deleteBarang<?= $row['id_spkp']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/spkp_antikorupsi/delete/' . $row['id_spkp']); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>