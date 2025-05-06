<?php foreach ($informasi->result() as $row) : ?>
    <div class="modal fade" id="EditInformasi<?php echo $row->id_berita; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/informasi/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?= $row->id_berita; ?>">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="id_jenis">Kategori</label>
                                    <select required name="id_kategori" class="form-control">
                                        <!-- Opsi Default -->
                                        <option value="<?= $row->id_kategori; ?>"><?= $row->kategori; ?></option>
                                        <!-- Iterasi Kategori Lain -->
                                        <?php foreach ($kategori->result() as $kategori_row) {
                                            // Hanya tampilkan kategori yang berbeda dari opsi default
                                            if ($kategori_row->id_kategori != $row->id_kategori) { ?>
                                                <option value="<?= $kategori_row->id_kategori; ?>"><?= $kategori_row->kategori; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pelatihan">Judul</label>
                                    <input class="form-control" name="judul_berita" placeholder="Judul Berita" value="<?= $row->judul_berita; ?>" required>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                <div class="form-group">
                                    <label for="rangkuman">Rangkuman</label>
                                    <textarea type="text" id="rangkuman<?= $row->id_berita; ?>" class="form-control ckeditor" name="rangkuman" placeholder="Rangkuman Berita" required><?= $row->rangkuman; ?></textarea>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="isiberita">Isi</label>
                                    <textarea id="isiberita<?= $row->id_berita; ?>" class="form-control ckeditor" name="isi_berita" placeholder="Isi Berita" required><?= $row->isi_berita; ?></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" id="tanggal" class="form-control" name="tgl_berita" placeholder="Tanggal" value="<?= $row->tgl_berita; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="foto">Gambar</label>
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