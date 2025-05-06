<?php foreach ($teks->result() as $row) : ?>
    <div class="modal fade" id="EditRunningteks<?= $row->id_teks; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url('admin/running_teks/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row->id_teks; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Teks</label>
                            <textarea rows="5" class="form-control" name="teks" placeholder="Masukan Teks" required><?= $row->teks; ?></textarea>
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