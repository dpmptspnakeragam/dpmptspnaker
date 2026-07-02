<?php foreach ($qr_survei as $row): ?>
    <div class="modal fade" id="ModalEditQR<?= $row->id_survey; ?>" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit
                        <?= $title; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('admin/qr_survey/ubah/' . $row->id_survey); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Link Survey</label>
                        <input type="url" name="link_survey" class="form-control" value="<?= $row->link_survey; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label>QR Code Saat Ini</label><br>
                        <?php if (file_exists('./assets/imgupload/' . $row->qr_code) && !empty($row->qr_code)): ?>
                            <img src="<?= base_url('assets/imgupload/' . $row->qr_code); ?>" class="img-thumbnail mb-2"
                                style="max-width: 100px;">
                        <?php endif; ?>
                        <input type="file" name="qr_code" class="form-control-file" accept="image/*">
                        <small class="text-muted">*Kosongkan jika tidak ingin mengganti gambar QR Code</small>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif" <?= ($row->status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="tidak aktif" <?= ($row->status == 'tidak aktif') ? 'selected' : ''; ?>>Tidak Aktif
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-warning">Update Data</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>