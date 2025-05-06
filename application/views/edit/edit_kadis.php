<?php foreach ($kadis->result() as $row) : ?>
    <div class="modal fade" id="EditKadis<?= $row->id_kadis; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/kadis/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_kadis" value="<?= $row->id_kadis; ?>">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input class="form-control" name="nama" placeholder="Nama Kadis" value="<?= $row->nama; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="text" class="form-control" name="periode" placeholder="Masa Periode" value="<?= $row->periode; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <br>
                            <img src="<?= base_url('assets/imgupload/') . $row->foto; ?>" class="elevation-2 img-size-64 img-thumbnail">
                            <br>
                            <input type="file" name="foto" class="mt-3">
                            <input type="hidden" name="old" value="<?= $row->foto; ?>">
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