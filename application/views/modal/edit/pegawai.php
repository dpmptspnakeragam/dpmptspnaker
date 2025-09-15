<?php foreach ($pegawai->result() as $row) : ?>
    <div class="modal fade" id="EditPegawai<?= $row->id_pegawai; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/pegawai/ubah_pegawai'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id_pegawai" value="<?= $row->id_pegawai; ?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="no_urut">No</label>
                                    <input id="no_urut" class="form-control" name="no_urut" placeholder="Nomor Urut" value="<?= $row->no_urut; ?>" required>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="pelatihan">Nama</label>
                                    <input class="form-control" name="nama" placeholder="Nama Pegawai" value="<?= $row->nama; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="jabatan">Bidang</label>
                                    <select required name="id_kabid" class="form-control">
                                        <option value="<?= $row->id_kabid; ?>"><?= $row->jabatan_kabid; ?></option>
                                        <?php foreach ($kabid->result() as $row2) {
                                        ?>
                                            <option value="<?= $row2->id_kabid; ?>"><?= $row2->jabatan_kabid; ?></option>;
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type_nip">Type NIP</label>
                                    <select class="form-control" name="jenis_nip" id="type_nip" required>
                                        <option value="" disabled <?= empty($row->jenis_nip) ? 'selected' : ''; ?>>Type NIP</option>
                                        <option value="NIP" <?= ($row->jenis_nip == 'NIP') ? 'selected' : ''; ?>>NIP</option>
                                        <option value="NIPPPK" <?= ($row->jenis_nip == 'NIPPPK') ? 'selected' : ''; ?>>NIPPPK</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="type_nip">Type NIP</label>
                                    <input type="text" class="form-control" name="jenis_nip" placeholder="Type NIP" value="<?= $row->jenis_nip; ?>" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">NIP</label>
                                    <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $row->nip; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="<?= $row->jabatan; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="golongan">Golongan</label>
                                    <input class="form-control" id="golongan" name="golongan" placeholder="Golongan" value="<?= $row->golongan; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= $row->alamat; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="gambar">Foto</label>
                                    <br>
                                    <img src="<?= base_url('assets/imgupload/') . $row->gambar; ?>" class="elevation-2 img-size-64 img-thumbnail">
                                    <br>
                                    <input type="file" name="gambar" class="mt-3">
                                    <input type="hidden" name="old" value="<?= $row->gambar; ?>">
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