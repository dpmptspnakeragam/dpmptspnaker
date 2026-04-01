<div class="modal fade" id="ModalTambahJenisGrafikRealisasiInvestasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Jenis <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_realisasi_investasi/tambah_jenis'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="tipe" value="jenis">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="parent_id">Pilih Tahun</label>
                        <select name="parent_id" id="parent_id" class="form-control" required>
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($tahun->result() as $t) : ?>
                                <option value="<?= $t->id_grafik; ?>">
                                    <?= $t->tahun; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis_investasi">Jenis Investasi</label>
                        <input type="text" id="jenis_investasi" name="jenis_investasi" class="form-control" placeholder="Contoh: PMDN / PMA" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai2">Realisasi (Rp/M)</label>
                        <input type="number" step="0.0001" id="nilai2" name="nilai2" class="form-control" placeholder="0.0000" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>