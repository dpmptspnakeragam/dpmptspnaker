<?php foreach ($grafik as $row) { ?>
    <div class="modal fade" id="modalEdit<?php echo $row->id_grafik; ?>" role="dialog" aria-labelledby="ModalEditGrafikLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Grafik Izin Terbit (Tahun)</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/grafik_izin_tahun/ubah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $row->id_grafik; ?>">
                        </div>
                        <div class="form-group">
                            <label for="izin">Nama Izin</label>
                            <input class="form-control" name="izin" placeholder="Nama Izin" value="<?php echo $row->izin; ?>" required>
                        </div>
                        <?php foreach ($tahun_fields as $field) {
                            $year = str_replace('thn', '', $field->Field);
                        ?>
                            <div class="form-group">
                                <label for="thn<?php echo $year; ?>">Tahun <?php echo $year; ?></label>
                                <input class="form-control" name="thn<?php echo $year; ?>" placeholder="Izin Tahun <?php echo $year; ?>" value="<?php echo $row->{'thn' . $year}; ?>" required>
                            </div>
                        <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>