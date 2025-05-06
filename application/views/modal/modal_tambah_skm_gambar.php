<div class="modal fade" id="TambahIKM" role="dialog" aria-labelledby="ModalTambahGrafikLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= base_url(); ?>admin/grafik_skm/tambah_skm_gambar" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <?php foreach ($idmaxx->result() as $row) { ?>
                        <div class="form-group" hidden>
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input id="title" class="form-control" name="title" placeholder="Masukan Judul" required>
                    </div>
                    <div class="form-group">
                        <label for="file_upload">Upload Gambar</label>
                        <input type="file" class="form-control-file" id="file_upload" name="file_upload" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>