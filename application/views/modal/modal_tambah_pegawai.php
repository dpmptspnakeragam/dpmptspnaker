<div class="modal fade" id="ModalTambahPegawai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/pegawai/tambah'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php foreach ($idmax->result() as $row) {
                    ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id_pegawai" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="no_urut">No</label>
                                <input id="no_urut" class="form-control" name="no_urut" placeholder="Nomor Urut" value="<?= isset($no_urut) ? $no_urut : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Nama</label>
                                <input class="form-control" name="nama" placeholder="Nama Pegawai" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenis_nip">Type NIP</label>
                                <select class="form-control" name="jenis_nip" id="jenis_nip" required>
                                    <option value="" disabled selected>Type NIP</option>
                                    <option value="NIP">NIP</option>
                                    <option value="NIPPPK">NIPPPK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="persyaratan">NIP</label>
                                <input type="text" class="form-control" name="nip" placeholder="NIP" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- <div class="form-group">
                                <label class="control-label" for="jabatan">Bidang</label>
                                <select required name="id_kabid" class="form-control">
                                    <?php foreach ($kabid->result() as $row) {
                                    ?>
                                        <option value="<?= $row->id_kabid; ?>"><?= $row->jabatan_kabid; ?></option>;
                                    <?php } ?>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="persyaratan">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label" for="golongan">Golongan</label>
                                <select required name="golongan" class="form-control" onchange="" required>
                                    <option selected disabled>Pilih Golongan</option>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="persyaratan">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gambar">Foto</label><br>
                                <input type="file" name="gambar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>