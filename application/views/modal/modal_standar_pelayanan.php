<!-- Modal -->
<div class="modal fade" id="StandarPelayanan" tabindex="-1" role="dialog" aria-labelledby="LabelSTDPelayanan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelSTDPelayanan">Standar Pelayanan</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (!empty($pdf)) : ?>
                    <?php foreach ($pdf as $file) : ?>
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $file->title; ?></h5>
                                <?php if (file_exists('./assets/fileupload/' . $file->file_name)) : ?>
                                    <embed src="<?= base_url('assets/fileupload/' . $file->file_name); ?>" type="application/pdf" width="100%" height="500px" />
                                <?php else : ?>
                                    <p>File PDF tidak tersedia.</p>
                                <?php endif; ?>
                            </div>
                            <?php if (file_exists('./assets/fileupload/' . $file->file_name)) : ?>
                                <div class="card-footer text-center">
                                    <a href="<?= base_url('assets/fileupload/' . $file->file_name); ?>" class="tombol-pengaduan" target="_blank" download> <i class="fa fa-download" aria-hidden="true"></i> Download File</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        Data PDF tidak ditemukan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>