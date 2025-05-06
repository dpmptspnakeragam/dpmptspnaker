<div class="modal fade" id="ModalTambahRegulasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/regulasi/tambah'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php foreach ($idmax->result() as $row) {
                    ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pelatihan">Judul</label>
                        <input class="form-control" name="judul" placeholder="Judul Regulasi" required>

                    </div>
                    <div class="form-group">
                        <label for="pelatihan">Tentang</label>
                        <input class="form-control" name="tentang" placeholder="Tentang Regulasi" required>

                    </div>
                    <div class="form-group">
                        <label for="formulir">Dokumen</label>
                        <input type="file" class="form-control border-0" name="file">
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