<?php foreach ($qr_survei as $row): ?>
    <div class="modal fade" id="ModalDeleteQR<?= $row->id_survey; ?>" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah Anda yakin ingin menghapus data survey beserta QR Code di bawah ini?</p>
                    <?php if (file_exists('./assets/imgupload/' . $row->qr_code) && !empty($row->qr_code)): ?>
                        <img src="<?= base_url('assets/imgupload/' . $row->qr_code); ?>" class="img-thumbnail mb-2"
                            style="max-width: 120px;">
                    <?php endif; ?>
                    <br>
                    <small class="text-muted d-block text-truncate"><?= $row->link_survey; ?></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/qr_survey/hapus/' . $row->id_survey); ?>"
                        class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>