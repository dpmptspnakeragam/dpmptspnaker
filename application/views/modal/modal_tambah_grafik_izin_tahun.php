<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambahgrafikLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Grafik Izin Terbit (Tahun)</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url(); ?>admin/grafik_izin_tahun/tambah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <?php foreach ($idmax->result() as $row) { ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="izin">Nama Izin</label>
                        <input class="form-control" name="izin" placeholder="Nama Izin" required>
                    </div>
                    <?php foreach ($tahun_fields as $field) {
                        $year = str_replace('thn', '', $field->Field); ?>
                        <div class="form-group">
                            <label for="thn<?= $year; ?>">Tahun <?= $year; ?></label>
                            <input class="form-control" name="thn<?= $year; ?>" placeholder="Izin Tahun <?= $year; ?>" required>
                        </div>
                    <?php } ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>