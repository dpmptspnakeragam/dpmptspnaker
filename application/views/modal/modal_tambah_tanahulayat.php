<div class="modal fade" id="ModalTambahTanahUlayat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/tanah_ulayat/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control" required>
                                    <option value="" selected disabled>Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan->result() as $kec) {
                                    ?>
                                        <option value="<?= $kec->id_kecamatan; ?>">
                                            <?= $kec->kecamatan; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Tanah Ulayat" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Luas</label>
                                <input type="text" class="form-control" name="luas" placeholder="Luas Tanah Ulayat" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Status Kepemilikan</label>
                                <input type="text" class="form-control" name="status" placeholder="Status Kepemilikan Tanah Ulayat" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Jenis Investasi</label>
                                <input type="text" class="form-control" name="jenis" placeholder="Jenis Investasi Tanah Ulayat" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelatihan">Bentuk Kerjasama</label>
                                <input type="text" class="form-control" name="bentuk" placeholder="Bentuk Kerjasama Investasi Tanah Ulayat" required>
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