<div class="modal fade" id="ModalTambahQR" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/qr_survey/simpan'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Link Survey</label>
                    <input type="url" name="link_survey" class="form-control" placeholder="https://skm.go.id/..."
                        required>
                </div>
                <div class="form-group">
                    <label>Upload Gambar QR Code</label>
                    <input type="file" name="qr_code" class="form-control-file" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-outline-danger">Simpan Data</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>