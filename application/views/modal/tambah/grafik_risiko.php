<div class="modal fade" id="ModalTambahGrafikResiko" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Grafik Sebaran Proyek Bedasarkan Risiko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_nib/tambah_risiko'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label>Risiko</label>
                        <select required name="risiko" class="form-control">
                            <option>Rendah</option>
                            <option>Menengah Rendah</option>
                            <option>Menengah Tinggi</option>
                            <option>Tinggi</option>
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