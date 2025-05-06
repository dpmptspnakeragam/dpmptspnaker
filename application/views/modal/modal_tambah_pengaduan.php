<div class="modal fade" id="ModalTambahPengaduan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/pengaduan/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php
                    $unique_id = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
                    ?>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="no_pengaduan">Nomor</label>
                                <input id="no_pengaduan" name="no_pengaduan" type="text" class="form-control" placeholder="Masukan Nomor Pengaduan" value="<?= $unique_id; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input name="nama" type="text" class="form-control" placeholder="Masukan Nama" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input name="alamat" type="text" class="form-control" placeholder="Masukan Alamat" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="hp">WhatsApp</label>
                                <input name="hp" type="text" class="form-control" placeholder="Masukan Nomor Whatsapp" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Masukan Email" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="jenis_pengaduan">Jenis</label>
                                <input name="jenis_pengaduan" type="text" class="form-control" placeholder="Masukan Jenis Pengaduan" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="lokasi_kejadian">Lokasi</label>
                                <input name="lokasi_kejadian" type="text" class="form-control" placeholder="Masukan Lokasi Kejadian" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="waktu_kejadian">Waktu</label>
                                <input name="waktu_kejadian" type="date" class="form-control" placeholder="Masukan Waktu Kejadian" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input name="status" type="text" class="form-control" placeholder="Masukan Status Pengaduan" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-">
                            <div class="form-group">
                                <label for="materi_pengaduan">Uraian</label>
                                <textarea name="materi_pengaduan" id="materi_pengaduan" class="form-control" required></textarea>
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