<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<?php foreach ($pengaturan->result() as $row) : ?>
    <div class="modal fade" id="EditPengaturan<?php echo $row->id_setting; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/pengaturan/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_setting; ?>">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Sejarah</h3>
                                    </div>
                                    <textarea id="editsejarah" type="text" class="form-control" rows="5" name="sejarah" placeholder="Sejarah" required><?php echo $row->sejarah; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editsejarah');
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Visi</h3>
                                    </div>
                                    <textarea id="editvisi" type="text" class="form-control" rows="5" name="visi" placeholder="Visi" required><?php echo $row->visi; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editvisi');
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Misi</h3>
                                    </div>
                                    <textarea id="editmisi" type="text" class="form-control" rows="5" name="misi" placeholder="Misi" required><?php echo $row->misi; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editmisi');
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Tugas</h3>
                                    </div>
                                    <textarea id="edittugas" type="text" class="form-control" rows="5" name="tugas" placeholder="Tugas" required><?php echo $row->tugas; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('edittugas');
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Fungsi</h3>
                                    </div>
                                    <textarea id="editfungsi" type="text" class="form-control" rows="5" name="fungsi" placeholder="Fungsi" required><?php echo $row->fungsi; ?></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editfungsi');
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Struktur Organisasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <img src="<?= base_url('assets/imgupload/') . $row->struktur; ?>" class="elevation-2 img-size-64 img-thumbnail">
                                        <br>
                                        <input type="file" name="struktur" class="mt-3">
                                        <input type="hidden" name="old1" value="<?= $row->struktur; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
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