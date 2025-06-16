<div class="modal fade" id="ModalTambahGrafikNIB" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Grafik NIB Diterbitkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_nib/tambah_nib'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label>PMDN/PMA & UMK/Non UMK</label>
                        <select required name="nib" class="form-control">
                            <option>PMDN</option>
                            <option>PMA</option>
                            <option>UMK</option>
                            <option>Non UMK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input class="form-control" name="jumlah" placeholder="jumlah" required>
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