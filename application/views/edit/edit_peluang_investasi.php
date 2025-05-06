<?php foreach ($investasi->result() as $row) : ?>
    <div class="modal fade" id="EditPeluangInvestasi<?= $row->id_investasi; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/peluang_investasi/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_investasi; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Peluang Investasi</label>
                            <input class="form-control" name="nama_investasi" placeholder="Peluang investasi" value="<?php echo $row->nama_investasi; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control ckeditor" name="deskripsi" placeholder="Deskripsi" required><?php echo $row->deskripsi; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <br>
                            <img src="<?= base_url('assets/imgupload/') . $row->gambar; ?>" class="elevation-2 img-size-64 img-thumbnail">
                            <br>
                            <input type="file" id="Gambar" name="gambar" class="mt-3">
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