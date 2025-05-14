<div class="modal fade" id="modalTambahIzinTerbitTahun" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_izin_terbit_tahun/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>