<script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<?php foreach ($pengaturan->result() as $row) : ?>
    <div class="modal fade" id="EditLayanan<?= $row->id_setting; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/layanan_publik/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row->id_setting; ?>">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Layanan Publik</h3>
                                    </div>
                                    <textarea id="editlayanan" type="text" class="form-control" rows="5" name="layanan" placeholder="layanan" required><?= $row->layanan; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editlayanan');
                                    </script>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Maklumat Pelayanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <img src="<?= base_url('assets/imgupload/') . $row->maklumat; ?>" class="elevation-2 img-size-64 img-thumbnail">
                                        <br>
                                        <input type="file" name="maklumat" class="mt-3">
                                        <input type="hidden" name="old2" value="<?= $row->maklumat; ?>">
                                    </div>
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