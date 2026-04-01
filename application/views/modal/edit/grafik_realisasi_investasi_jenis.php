<?php foreach ($grafik_investasi->result() as $row) : ?>
    <div class="modal fade" id="EditJenisGrafikRealisasasiInvestasi<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Jenis <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_realisasi_investasi/edit_jenis'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id_grafik" value="<?= $row->id_grafik; ?>">

                        <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="parent_id" class="form-control" required>
                                <?php foreach ($tahun->result() as $t) : ?>
                                    <option value="<?= $t->id_grafik; ?>" <?= ($row->parent_id == $t->id_grafik) ? 'selected' : ''; ?>>
                                        <?= $t->tahun; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Investasi</label>
                            <input type="text" name="jenis_investasi" class="form-control" value="<?= $row->jenis_investasi; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Target (Rp/M)</label>
                            <input type="number" step="0.0001" name="nilai" class="form-control" value="<?= (float)$row->nilai; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Realisasi (Rp/M)</label>
                            <input type="number" step="0.0001" name="nilai2" class="form-control" value="<?= (float)$row->nilai2; ?>" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>