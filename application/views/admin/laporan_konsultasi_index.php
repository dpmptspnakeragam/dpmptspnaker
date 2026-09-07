<section class="content">
    <div class="container-fluid">

        <!-- Card Filter Data -->
        <div class="card card-outline card-maroon shadow-sm">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Filter Laporan</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/laporan_konsultasi'); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status Konsultasi</label>
                                <select name="status" class="form-control">
                                    <option value="semua" <?= $status == 'semua' ? 'selected' : ''; ?>>-- Semua Status --</option>
                                    <option value="Menunggu" <?= $status == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                    <option value="Diproses" <?= $status == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Selesai" <?= $status == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                    <option value="Ditolak" <?= $status == 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <?php if ($user_unit === 'ALL'): ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Filter Unit/Layanan</label>
                                    <select name="unit" class="form-control">
                                        <option value="ALL" <?= $unit_filter == 'ALL' ? 'selected' : ''; ?>>-- Semua Unit --</option>
                                        <option value="PTSP" <?= $unit_filter == 'PTSP' ? 'selected' : ''; ?>>PTSP</option>
                                        <option value="BLK" <?= $unit_filter == 'BLK' ? 'selected' : ''; ?>>BLK</option>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-search mr-1"></i> Tampilkan</button>
                            <a href="<?= base_url('admin/laporan_konsultasi'); ?>" class="btn btn-outline-secondary"><i class="fas fa-sync-alt mr-1"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- CARD TABEL & TOMBOL CETAK HANYA MUNCUL JIKA SUDAH DI-SUBMIT -->
        <?php if ($is_filtered): ?>
            <div class="card card-outline card-maroon shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title"><i class="fas fa-list mr-1"></i> Hasil Laporan</h3>
                    <a href="<?= base_url('admin/laporan_konsultasi/cetak?tgl_mulai=' . $tgl_mulai . '&tgl_selesai=' . $tgl_selesai . '&status=' . $status . '&unit=' . $unit_filter); ?>" target="_blank" class="btn btn-outline-danger btn-sm ml-auto">
                        <i class="fas fa-print mr-1"></i> Cetak Laporan / PDF
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover text-sm">
                        <thead class="bg-maroon text-white text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">No. Tiket</th>
                                <th width="12%">Tgl Masuk</th>
                                <th width="15%">Pemohon / NIK</th>
                                <th width="15%">Jenis Izin / Layanan</th>
                                <th>Uraian Konsultasi</th>
                                <th width="12%">Status</th>
                                <th width="12%">Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($laporan)): ?>
                                <?php $no = 1;
                                foreach ($laporan as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class="text-center"><strong><?= $row->no_tiket; ?></strong></td>
                                        <td class="text-center"><?= date('d/m/Y H:i', strtotime($row->tanggal_masuk)); ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($row->nama_pemohon); ?></strong><br>
                                            <small class="text-muted">NIK: <?= $row->nik ?? '-'; ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($row->jenis_izin); ?></td>
                                        <td><?= nl2br(htmlspecialchars($row->uraian)); ?></td>
                                        <td class="text-center">
                                            <?php
                                            $badge = [
                                                'Menunggu' => 'badge-warning',
                                                'Diproses' => 'badge-info',
                                                'Selesai'  => 'badge-success',
                                                'Ditolak'  => 'badge-danger'
                                            ][$row->status] ?? 'badge-secondary';
                                            ?>
                                            <span class="badge <?= $badge; ?> p-2"><?= $row->status; ?></span>
                                        </td>
                                        <td><small><?= htmlspecialchars($row->petugas_penerima ?? '-'); ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle mr-1"></i> Tidak ada data laporan konsultasi pada periode ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>