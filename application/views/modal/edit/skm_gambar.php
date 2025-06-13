<?php foreach ($skm_gambar as $row) : ?>
    <div class="modal fade" id="ModalEditIKM<?= $row['id_skm_gambar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Gambar IKM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_skm/ubah_skm_gambar'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row['id_skm_gambar']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" class="form-control" name="title" placeholder="Masukan Judul" value="<?= $row['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="file_upload">Change Gambar</label>
                            <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>