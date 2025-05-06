<?php foreach ($perizinan->result() as $row) : ?>
    <div class="modal fade" id="EditPerizinan<?= $row->id_izin; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/perizinan_risiko/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group" hidden>
                                <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row->id_izin; ?>">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pelatihan">Jenis Risiko</label>
                                    <input class="form-control" name="jenis" placeholder="Jenis Risiko" value="<?= $row->jenis; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pelatihan">Biaya</label>
                                    <input class="form-control" name="biaya" placeholder="Jumlah Biaya" value="<?= $row->biaya; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pelatihan">Lama Proses</label>
                                    <input class="form-control" name="lamaproses" placeholder="Lama Proses" value="<?= $row->lamaproses; ?>" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="syarat">Persyaratan</label>
                                    <textarea id="ckeditor" class="form-control ckeditor" name="syarat" placeholder="Persyaratan" required><?= $row->syarat; ?></textarea>
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