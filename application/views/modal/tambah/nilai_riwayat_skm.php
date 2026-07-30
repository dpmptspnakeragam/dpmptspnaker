<div class="modal fade" id="ModalTambahNilaiRiwayatIKM" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Nilai Indeks Kepuasan Masyarakat (IKM)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= form_open('admin/skm/simpan_ikm_manual'); ?>
            <div class="modal-body">

                <h5 class="text-maroon font-weight-bold border-bottom pb-2">1. Periode & Nilai IKM</h5>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control" required>
                            <?php
                            $tahun_sekarang = date('Y');
                            for ($i = $tahun_sekarang - 1; $i <= $tahun_sekarang + 2; $i++) {
                                $selected = ($i == $tahun_sekarang) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="1" <?= (date('n') <= 6) ? 'selected' : ''; ?>>Semester 1 (Jan-Jun)</option>
                            <option value="2" <?= (date('n') > 6) ? 'selected' : ''; ?>>Semester 2 (Jul-Des)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>Teks Periode Survei</label>
                        <input type="text" name="periode" class="form-control" placeholder="Contoh: Januari s.d. Juni 2026" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>Nilai IKM Final</label>
                        <input type="number" step="0.01" min="0" max="100" name="nilai_ikm" class="form-control" placeholder="Contoh: 93.65" required>
                    </div>
                </div>

                <h5 class="text-maroon font-weight-bold border-bottom pb-2 mt-4">2. Data Demografi Responden</h5>

                <label class="text-muted mt-2">Total & Jenis Kelamin</label>
                <div class="row mb-2">
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Total</span></div><input type="number" name="jumlah_responden" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Laki-laki</span></div><input type="number" name="jmlh_lk" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Perempuan</span></div><input type="number" name="jmlh_pr" class="form-control" required>
                        </div>
                    </div>
                </div>

                <label class="text-muted">Pendidikan</label>
                <div class="row mb-2">
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">SD</span></div><input type="number" name="jmlh_sd" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">SMP</span></div><input type="number" name="jmlh_smp" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">SMA</span></div><input type="number" name="jmlh_sma" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">DI-DIII</span></div><input type="number" name="jmlh_d1" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">DIV/S1</span></div><input type="number" name="jmlh_s1" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">S2</span></div><input type="number" name="jmlh_s2" class="form-control" value="0">
                        </div>
                    </div>
                </div>

                <label class="text-muted">Pekerjaan</label>
                <div class="row mb-2">
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">PNS</span></div><input type="number" name="jmlh_pns" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">TNI</span></div><input type="number" name="jmlh_tni" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">POLRI</span></div><input type="number" name="jmlh_polri" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">Swasta</span></div><input type="number" name="jmlh_swasta" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">Wirausaha</span></div><input type="number" name="jmlh_wirausaha" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">Lainnya</span></div><input type="number" name="jmlh_lainnya" class="form-control" value="0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>