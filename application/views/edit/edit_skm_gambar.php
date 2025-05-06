<?php foreach ($skm_gambar as $row) { ?>
    <div class="modal fade" id="EditIKM<?= $row['id_skm_gambar']; ?>" role="dialog" aria-labelledby="ModalTambahGrafikLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Gambar</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>admin/grafik_skm/ubah_skm_gambar" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>