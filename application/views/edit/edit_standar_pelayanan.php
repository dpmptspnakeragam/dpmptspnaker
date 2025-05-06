<?php foreach ($pdf as $file) : ?>
    <div class="modal fade" id="EditSP<?= $file->id_sp; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('admin/standar_pelayanan/update/' . $file->id_sp); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $file->id_sp; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Nama</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nama File" value="<?= $file->title; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="file_name">Upload File</label>
                            <input type="file" class="form-control border-0" id="file_name" name="file_name">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file</small>
                        </div>
                        <div class="form-group">
                            <label>File saat ini</label>
                            <p><?= $file->file_name; ?></p>
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