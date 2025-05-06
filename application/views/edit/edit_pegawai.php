<?php foreach ($pegawai->result() as $row) : ?>
    <div class="modal fade" id="EditPegawai<?php echo $row->id_pegawai; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/pegawai/ubah_pegawai'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id_pegawai" value="<?php echo $row->id_pegawai; ?>">
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
                                    <input class="form-control" name="nama" placeholder="Nama Pegawai" value="<?php echo $row->nama; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <!-- <div class="form-group">
                                    <label class="control-label" for="jabatan">Bidang</label>
                                    <select required name="id_kabid" class="form-control">
                                        <option value="<?php echo $row->id_kabid; ?>"><?php echo $row->jabatan_kabid; ?></option>
                                        <?php foreach ($kabid->result() as $row2) {
                                        ?>
                                            <option value="<?= $row2->id_kabid; ?>"><?= $row2->jabatan_kabid; ?></option>;
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="type_nip">Type NIP</label>
                                    <select class="form-control" name="jenis_nip" id="type_nip" required>
                                        <option value="" disabled <?php echo empty($row->jenis_nip) ? 'selected' : ''; ?>>Type NIP</option>
                                        <option value="NIP" <?php echo ($row->jenis_nip == 'NIP') ? 'selected' : ''; ?>>NIP</option>
                                        <option value="NIPPPK" <?php echo ($row->jenis_nip == 'NIPPPK') ? 'selected' : ''; ?>>NIPPPK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">NIP</label>
                                    <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?php echo $row->nip; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="<?php echo $row->jabatan; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="golongan">Golongan</label>
                                    <select required name="golongan" class="form-control" onchange="" required>
                                        <option value="<?php echo $row->golongan; ?>" selected><?php echo $row->golongan; ?></option>
                                        <option>IV/e</option>
                                        <option>IV/d</option>
                                        <option>IV/c</option>
                                        <option>IV/b</option>
                                        <option>IV/a</option>
                                        <option>III/d</option>
                                        <option>III/c</option>
                                        <option>III/b</option>
                                        <option>III/a</option>
                                        <option>II/d</option>
                                        <option>II/c</option>
                                        <option>II/b</option>
                                        <option>II/a</option>
                                        <option>I/d</option>
                                        <option>I/c</option>
                                        <option>I/b</option>
                                        <option>I/a</option>
                                        <option>CPNS</option>
                                        <option>PPPK</option>
                                        <option>PTT</option>
                                        <option>Tenaga Kontrak</option>
                                        <option>THL</option>
                                        <option>Tenaga Outsourcing</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="persyaratan">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $row->alamat; ?>" required>
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