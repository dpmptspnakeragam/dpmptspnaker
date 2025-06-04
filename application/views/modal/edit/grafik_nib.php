<?php foreach ($grafik_nib->result() as $row) {
?>
    <div class="modal fade" id="ModalEditGrafikNIB<?php echo $row->id_grafik; ?>" role="dialog" aria-labelledby="ModalTambahGrafikLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/grafik_nib/ubah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_grafik; ?>">
                        </div>
                        <div class="form-group">
                            <label>PMDN/PMA & UMK/Non UMK</label>
                            <select name="nib" class="form-control">
                                <option value="<?php echo $row->nib; ?>" selected><?php echo $row->nib; ?></option>
                                <option>PMDN</option>
                                <option>PMA</option>
                                <option>UMK</option>
                                <option>Non UMK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Jumlah</label>
                            <input class="form-control" name="jumlah" value="<?php echo $row->jumlah; ?>" required>
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