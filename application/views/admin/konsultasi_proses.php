<!-- Main content -->
<section class="content pt-3">
    <div class="container-fluid">

        <?php if (empty($detail)): ?>
            <div class="alert alert-danger">Detail konsultasi tidak ditemukan.</div>
            <?php return; ?>
        <?php endif; ?>

        <!-- Header Bar -->
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <a href="<?= base_url('admin/konsultasi'); ?>" class="btn btn-outline-secondary font-weight-bold shadow-sm mr-2">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <!-- TOMBOL CETAK -->
                <?php if ($detail->status === 'Selesai'): ?>
                    <!-- Tombol Aktif: Muncul hanya jika status Selesai -->
                    <a href="<?= base_url('admin/konsultasi/cetak/' . $detail->id); ?>" target="_blank" class="btn btn-outline-danger font-weight-bold shadow-sm">
                        <i class="fas fa-print mr-1"></i> Cetak Tanda Bukti
                    </a>
                <?php else: ?>
                    <!-- Tombol Pasif (Disabled): Muncul jika status Menunggu, Diproses, atau Ditolak -->
                    <button type="button" class="btn btn-outline-secondary font-weight-bold shadow-sm" disabled style="cursor: not-allowed; opacity: 0.65;" title="Bukti hanya dapat dicetak setelah status konsultasi Selesai">
                        <i class="fas fa-print mr-1"></i> Cetak Tanda Bukti
                    </button>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center">
                <!-- Judul Tiket -->
                <h4 class="font-weight-bold text-maroon m-0">
                    <i class="fas fa-ticket-alt mr-2"></i> Tiket: <?= $detail->no_tiket; ?>
                </h4>

                <!-- Progress Bar Status di sebelah kanan tiket -->
                <div class="ml-4" style="width: 160px;">
                    <?php if ($detail->status === 'Menunggu'): ?>
                        <div class="text-warning font-weight-bold text-sm mb-1 text-right">
                            <i class="fas fa-inbox mr-1"></i> Menunggu
                        </div>
                        <div class="progress shadow-sm" style="height: 6px; border-radius: 5px;">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 25%"></div>
                        </div>

                    <?php elseif ($detail->status === 'Diproses'): ?>
                        <div class="text-info font-weight-bold text-sm mb-1 text-right">
                            <i class="fas fa-tools mr-1"></i> Diproses
                        </div>
                        <div class="progress shadow-sm" style="height: 6px; border-radius: 5px;">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width: 65%"></div>
                        </div>

                    <?php elseif ($detail->status === 'Selesai'): ?>
                        <div class="text-success font-weight-bold text-sm mb-1 text-right">
                            <i class="fas fa-check-circle mr-1"></i> Selesai
                        </div>
                        <div class="progress shadow-sm" style="height: 6px; border-radius: 5px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>

                    <?php else: ?>
                        <div class="text-secondary font-weight-bold text-sm mb-1 text-right">
                            <i class="fas fa-ban mr-1"></i> Ditolak
                        </div>
                        <div class="progress shadow-sm" style="height: 6px; border-radius: 5px;">
                            <div class="progress-bar bg-secondary" style="width: 100%"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- SISI KIRI: INFORMASI PEMOHON & MASALAH -->
            <div class="col-md-7">
                <div class="card card-outline card-maroon shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold text-dark">
                            <i class="fas fa-user-circle mr-2 text-maroon"></i> Detail Permintaan Konsultasi
                        </h3>
                    </div>
                    <div class="card-body p-0">

                        <!-- ================= PENAMBAHAN FOTO PEMOHON ================= -->
                        <div class="p-3 text-center bg-light border-bottom">
                            <?php if (!empty($detail->foto_pemohon) && file_exists(FCPATH . 'assets/konsultasi/' . $detail->foto_pemohon)): ?>
                                <a href="<?= base_url('assets/konsultasi/' . $detail->foto_pemohon); ?>" target="_blank" title="Klik untuk memperbesar">
                                    <img src="<?= base_url('assets/konsultasi/' . $detail->foto_pemohon); ?>"
                                        alt="Foto Pemohon"
                                        class="img-thumbnail rounded shadow-sm"
                                        style="max-height: 180px; width: auto; object-fit: cover;">
                                </a>
                                <div class="text-muted text-xs mt-1"><i class="fas fa-search-plus mr-1"></i> Klik foto untuk memperbesar</div>
                            <?php else: ?>
                                <div class="d-inline-block p-3 rounded-circle bg-secondary mb-1">
                                    <i class="fas fa-user fa-3x text-white"></i>
                                </div>
                                <div class="text-muted text-xs">Foto pemohon tidak melampirkan foto</div>
                            <?php endif; ?>
                        </div>
                        <!-- ================= END FOTO PEMOHON ================= -->

                        <table class="table table-sm table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;" class="pl-4 py-2">Waktu Masuk</th>
                                    <td class="py-2">: <?= date('d M Y, H:i:s', strtotime($detail->tanggal_masuk)); ?> WIB</td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">Nama Pemohon</th>
                                    <td class="py-2 font-weight-bold text-maroon">: <?= $detail->nama_pemohon; ?></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">NIK</th>
                                    <td class="py-2">: <?= $detail->nik; ?></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">No. HP / WA</th>
                                    <td class="py-2">: <a href="https://wa.me/<?= preg_replace('/^0/', '62', $detail->no_hp); ?>" target="_blank" class="text-success font-weight-bold"><i class="fab fa-whatsapp"></i> <?= $detail->no_hp; ?></a></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">Email</th>
                                    <td class="py-2">: <?= !empty($detail->email) ? $detail->email : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">Pekerjaan</th>
                                    <td class="py-2">: <?= !empty($detail->pekerjaan) ? $detail->pekerjaan : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">Alamat Domisili</th>
                                    <td class="py-2">: <?= $detail->alamat; ?></td>
                                </tr>
                                <tr>
                                    <th class="pl-4 py-2">Jenis Izin</th>
                                    <td class="py-2 font-weight-bold text-dark">: <?= $detail->jenis_izin; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="p-4 border-top">
                            <h6 class="font-weight-bold text-maroon mb-2"><i class="fas fa-comment-dots mr-1"></i> Uraian Konsultasi:</h6>
                            <div class="p-3 bg-light border rounded" style="font-size: 1.05rem;">
                                <?= nl2br(htmlspecialchars($detail->uraian)); ?>
                            </div>
                        </div>

                        <?php if (!empty($detail->lampiran)): ?>
                            <div class="p-4 border-top bg-light">
                                <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-paperclip mr-1"></i> Lampiran Dokumen:</h6>
                                <a href="<?= base_url('assets/konsultasi/' . $detail->lampiran); ?>" target="_blank" class="btn btn-outline-danger shadow-sm">
                                    <i class="fas fa-download mr-1"></i> Unduh / Lihat Lampiran
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: FORM TINDAK LANJUT ADMIN -->
            <div class="col-md-5">
                <div class="card card-outline card-maroon shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold text-dark">
                            <i class="fas fa-edit mr-2 text-maroon"></i> Form Tindak Lanjut Petugas
                        </h3>
                    </div>

                    <?= form_open('admin/konsultasi/simpan_proses'); ?>
                    <div class="card-body">
                        <!-- Hidden ID -->
                        <input type="hidden" name="id_konsultasi" value="<?= $detail->id; ?>">

                        <div class="form-group">
                            <label class="font-weight-semibold">Bidang / Tim Terkait (Disposisi) <span class="text-danger">*</span></label>
                            <select name="bidang_tujuan" class="form-control" required>
                                <option value="" <?= empty($detail->bidang_tujuan) ? 'selected' : ''; ?> disabled>-- Pilih Bidang / FO --</option>
                                <option value="FO 1 (Pramita Guslianti, S.H.)" <?= ($detail->bidang_tujuan == 'FO 1 (Pramita Guslianti, S.H.)') ? 'selected' : ''; ?>>FO 1 (Pramita Guslianti, S.H.)</option>
                                <option value="FO 2 (Hizbul Hamdi Algalib, S.Kom.)" <?= ($detail->bidang_tujuan == 'FO 2 (Hizbul Hamdi Algalib, S.Kom.)') ? 'selected' : ''; ?>>FO 2 (Hizbul Hamdi Algalib, S.Kom.)</option>
                                <option value="FO 3 (Mellysa, S.T.)" <?= ($detail->bidang_tujuan == 'FO 3 (Mellysa, S.T.)') ? 'selected' : ''; ?>>FO 3 (Mellysa, S.T.)</option>
                                <option value="FO 4 (Ade Oktabara)" <?= ($detail->bidang_tujuan == 'FO 4 (Ade Oktabara)') ? 'selected' : ''; ?>>FO 4 (Ade Oktabara)</option>
                                <option value="FO 5 (Tiwi Fitria)" <?= ($detail->bidang_tujuan == 'FO 5 (Tiwi Fitria)') ? 'selected' : ''; ?>>FO 5 (Tiwi Fitria)</option>
                                <option value="FO 6 (Achmad Refvha Alqadrie, S.Tr.I.P.)" <?= ($detail->bidang_tujuan == 'FO 6 (Achmad Refvha Alqadrie, S.Tr.I.P.)') ? 'selected' : ''; ?>>FO 6 (Achmad Refvha Alqadrie, S.Tr.I.P.)</option>
                                <option value="FO 7 (Erina Andika Septia, A.Md.)" <?= ($detail->bidang_tujuan == 'FO 7 (Erina Andika Septia, A.Md.)') ? 'selected' : ''; ?>>FO 7 (Erina Andika Septia, A.Md.)</option>
                                <option value="FO 8 (Deby Sinthia Rahmi, A.Md.T.)" <?= ($detail->bidang_tujuan == 'FO 8 (Deby Sinthia Rahmi, A.Md.T.)') ? 'selected' : ''; ?>>FO 8 (Deby Sinthia Rahmi, A.Md.T.)</option>
                                <option value="FO 9 (Tatia Safitri)" <?= ($detail->bidang_tujuan == 'FO 9 (Tatia Safitri)') ? 'selected' : ''; ?>>FO 9 (Tatia Safitri)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-semibold">Jawaban / Uraian Tindak Lanjut <span class="text-danger">*</span></label>
                            <textarea name="tindak_lanjut" class="form-control" rows="6" placeholder="Ketikkan jawaban, solusi, atau arahan untuk pemohon..." required><?= $detail->tindak_lanjut; ?></textarea>
                            <small class="text-muted">Balasan ini nantinya dapat dicetak atau dikirimkan ke pemohon.</small>
                        </div>

                        <div class="form-group border rounded p-3" style="background-color: #fcfcfc;">
                            <label class="font-weight-semibold mb-1">Status Laporan</label>

                            <p class="text-sm mb-2 text-muted">
                                Status tiket saat ini:
                                <?php if ($detail->status === 'Menunggu'): ?>
                                    <strong class="text-warning">Menunggu</strong>
                                <?php elseif ($detail->status === 'Diproses'): ?>
                                    <strong class="text-info">Sedang Diproses</strong>
                                <?php elseif ($detail->status === 'Selesai'): ?>
                                    <strong class="text-success">Selesai / Ditutup</strong>
                                <?php else: ?>
                                    <strong class="text-secondary">Ditolak / Tidak Valid</strong>
                                <?php endif; ?>
                            </p>

                            <select name="status" class="form-control font-weight-bold border-secondary shadow-sm">
                                <option value="Menunggu" <?= ($detail->status == 'Menunggu') ? 'selected' : ''; ?>>🟠 Ubah ke: Menunggu</option>
                                <option value="Diproses" <?= ($detail->status == 'Diproses') ? 'selected' : ''; ?>>🔵 Ubah ke: Sedang Diproses</option>
                                <option value="Selesai" <?= ($detail->status == 'Selesai') ? 'selected' : ''; ?>>🟢 Ubah ke: Selesai / Ditutup</option>
                                <option value="Ditolak" <?= ($detail->status == 'Ditolak') ? 'selected' : ''; ?>>⚫ Ubah ke: Ditolak / Tidak Valid</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer bg-white border-top text-right">
                        <button type="submit" class="btn btn-outline-danger font-weight-bold shadow-sm px-4 btn-block">
                            <i class="fas fa-save mr-1"></i> Simpan Tindak Lanjut
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>

                <!-- Info Log Petugas -->
                <?php if (!empty($detail->petugas_penerima)): ?>
                    <div class="alert alert-info shadow-sm text-sm">
                        <i class="fas fa-info-circle mr-2"></i> Terakhir kali diproses oleh: <strong><?= $detail->petugas_penerima; ?></strong>
                        <?php if (!empty($detail->tanggal_selesai)): ?>
                            <br>Ditutup/Selesai pada: <?= date('d M Y, H:i', strtotime($detail->tanggal_selesai)); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>