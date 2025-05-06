<?php foreach ($regulasi->result() as $row) : ?>
    <div class="modal fade" id="EditRegulasi<?php echo $row->id_regulasi; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/regulasi/ubah'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_regulasi; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Judul</label>
                            <input class="form-control" name="judul" placeholder="Nama Izin" value="<?php echo $row->judul; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tentang</label>
                            <input class="form-control" name="tentang" placeholder="Nama Izin" value="<?php echo $row->tentang; ?>" required>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="gambar">Dokumen</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="file" type="file" id="form" /><?php echo $row->file; ?>
                                    <input name="old" type="hidden" id="old" value="<?php echo $row->file; ?>" />
                                </div>
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