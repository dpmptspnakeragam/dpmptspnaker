<?php foreach ($perizinan->result() as $row) {
?>
    <div class="modal fade" id="EditPerizinan<?php echo $row->id_izin; ?>" role="dialog" aria-labelledby="ModalTambahPerizinanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Perizinan</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/perizinan_risiko/ubah" method="post" enctype="multipart/form-data">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_izin; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Jenis Risiko</label>
                            <input class="form-control" name="jenis" placeholder="Nama Izin" value="<?php echo $row->jenis; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Biaya</label>
                            <input class="form-control" name="biaya" placeholder="Jumlah Biaya" value="<?php echo $row->biaya; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Lama Proses</label>
                            <input class="form-control" name="lamaproses" placeholder="Lama Proses" value="<?php echo $row->lamaproses; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="syarat">Persyaratan</label>
                            <textarea id="ckeditor" class="form-control ckeditor" name="syarat" placeholder="Persyaratan" required><?php echo $row->syarat; ?></textarea>
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
<?php } ?>