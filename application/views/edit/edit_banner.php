<?php foreach ($banner->result() as $row) : ?>
    <div class="modal fade" id="EditBanner<?= $row->id_banner; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/banner/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_banner" value="<?= $row->id_banner; ?>">

                        <div class="form-group">
                            <label for="tahun">Teks</label>
                            <textarea class="form-control" name="teks" placeholder="Masukan Teks"><?= $row->teks; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Gambar</label>
                            <br>
                            <img src="<?= base_url('assets/imgupload/') . $row->gambar; ?>" class="elevation-2 img-size-64 img-thumbnail">
                            <br>
                            <input type="file" name="gambar" class="mt-3">
                            <input type="hidden" name="old" value="<?= $row->gambar; ?>">
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