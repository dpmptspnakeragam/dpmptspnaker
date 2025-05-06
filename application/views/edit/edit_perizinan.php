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

                <form role="form" action="<?= base_url('admin/perizinan/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group" hidden>
                                <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row->id_izin; ?>">
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_izin">Nama Izin</label>
                                    <textarea name="nama_izin" id="nama_izin" class="form-control" placeholder="Nama Izin" rows="2" required><?= $row->nama_izin; ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hukum">Dasar Hukum</label>
                                    <input class="form-control" id="hukum" name="hukum" placeholder="Dasar Hukum" value="<?= $row->hukum; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input class="form-control" id="biaya" name="biaya" placeholder="Jumlah Biaya" value="<?= $row->biaya; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lamaproses">Lama Proses</label>
                                    <input class="form-control" id="lamaproses" name="lamaproses" placeholder="Lama Proses" value="<?= $row->lamaproses; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="form">Formulir</label>
                                    <input type="file" id="form" name="form" class="form-control border-0"><?= $row->form; ?>
                                    <input name="old" type="hidden" id="old" value="<?= $row->form; ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="syarat">Persyaratan</label>
                                    <textarea id="syarat" class="form-control ckeditor" name="syarat" placeholder="Persyaratan" required><?= $row->syarat; ?></textarea>
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