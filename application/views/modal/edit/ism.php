<?php foreach ($ism->result() as $row) : ?>
    <div class="modal fade" id="ModalEditISM<?= $row->id_ppid; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Informasi Serta Merta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/ppid/ubah_ism'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <label>Id</label>
                            <input type="text" class="form-control" name="id" placeholder="ID ISM" value="<?= $row->id_ppid; ?>">
                        </div>
                        <div class="form-group" hidden>
                            <label>Kategori</label>
                            <input type="text" class="form-control" name="kategori" placeholder="Kategori" value="<?= $row->kategori; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Judul Informasi</label>
                            <input type="text" class="form-control" name="judul" placeholder="Judul Informasi" value="<?= $row->judul; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="formulir">Update Dokumen</label><br>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="file" type="file" id="form"><?= $row->file; ?>
                                <input name="old" type="hidden" id="old" value="<?= $row->file; ?>">
                            </div>
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