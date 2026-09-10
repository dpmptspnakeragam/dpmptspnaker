<section class="content">
    <div class="container-fluid">

        <!-- Information Widget Cards -->
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Responden</span>
                        <span class="info-box-number" style="font-size: 22px;">
                            <?= number_format($total_responden_keseluruhan, 0, ',', '.'); ?> Orang
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Nilai IKM Akhir</span>
                        <span class="info-box-number" style="font-size: 22px;">
                            <?= $nilai_skm_akhir; ?> <small style="font-size: 14px;">(Skala 100)</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 col-12">
                <div class="info-box bg-maroon">
                    <span class="info-box-icon"><i class="fas fa-award"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mutu & Kinerja Pelayanan</span>
                        <span class="info-box-number" style="font-size: 22px;">
                            Mutu <?= $mutu_pelayanan; ?> <small style="font-size: 14px;">(<?= $kinerja; ?>)</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tanggal -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter"></i> Filter Periode SKM</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="<?= base_url('admin/data_skm_panrb'); ?>" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="startDate" class="mr-2">Mulai:</label>
                        <input type="text" name="startDate" id="startDate" class="form-control" value="<?= $startDate; ?>" placeholder="DD-MM-YYYY" required>
                    </div>
                    <div class="form-group mr-2">
                        <label for="endDate" class="mr-2">Selesai:</label>
                        <input type="text" name="endDate" id="endDate" class="form-control" value="<?= $endDate; ?>" placeholder="DD-MM-YYYY" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Tampilkan
                    </button>
                    <a href="<?= base_url('admin/data_skm_panrb'); ?>" class="btn btn-default" title="Kembali ke Default Semester Otomatis">
                        <i class="fas fa-sync-alt"></i> Semester Aktif
                    </a>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card card-outline card-maroon">
            <div class="card-header">
                <h3 class="card-title">Daftar Hasil Survei Integration - <?= $labelSemester; ?></h3>
            </div>
            <div class="card-body">
                <?php if (isset($api_result['code']) && $api_result['code'] == 200): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-maroon text-white">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>Kode Survei</th>
                                    <th>Nama Survei</th>
                                    <th class="text-center">Periode</th>
                                    <th class="text-center">Total Responden</th>
                                    <th class="text-center">Nilai Rata-Rata</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($api_result['data']) && is_array($api_result['data'])): ?>
                                    <?php $no = 1;
                                    foreach ($api_result['data'] as $row): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><code><?= $row['survey_id']; ?></code></td>
                                            <td><strong><?= $row['nama_survey']; ?></strong></td>
                                            <td class="text-center">
                                                <?= date('d/m/Y', strtotime($row['tanggal_mulai'])); ?> - <?= date('d/m/Y', strtotime($row['tanggal_selesai'])); ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info p-2"><?= number_format($row['total_responden'], 0, ',', '.'); ?> Orang</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-warning p-2" style="font-size: 14px;"><?= $row['rata_rata_nilai']; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 'completed'): ?>
                                                    <span class="badge badge-success">Completed</span>
                                                <?php elseif ($row['status'] == 'active'): ?>
                                                    <span class="badge badge-primary">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary"><?= ucfirst($row['status']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data survei pada periode ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        Gagal Koneksi API: <?= $api_result['message'] ?? 'Terjadi kesalahan sistem'; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>