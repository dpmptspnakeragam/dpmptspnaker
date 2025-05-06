<div class="modal fade" id="ModalTambahReklame" tabindex="-1" role="dialog" aria-labelledby="ModalTambahAset" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #600574;">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Reklame</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url(); ?>admin/reklame/tambah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kode barang">No. Izin</label>
                                    <input class="form-control" name="no_izin" placeholder="No. Izin" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode rekening">Nama Perusahaan</label>
                                    <input class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama barang">Alamat Perusahaan</label>
                                    <input class="form-control" name="alamat_perusahaan" placeholder="Alamat Perusahaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="no register">Penanggungjawab</label>
                                    <input class="form-control" name="pemohon" placeholder="Penanggungjawab" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun pembelian">No. HP</label>
                                    <input class="form-control" name="no_hp" placeholder="No. HP" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun pembelian">Alamat Pasang</label>
                                    <select class="form-control" name="kec_pasang" id="kecamatan">
                                        <option value="">Pilih kecamatan</option>
                                        <?php foreach ($kecamatan as $kec) { ?>
                                            <option value="<?php echo $kec->id_kecamatan ?>"><?php echo $kec->kecamatan ?></option>
                                        <?php }    ?>
                                    </select>
                                    <select class="form-control" name="nag_pasang" id="nagari">
                                        <option value="">Pilih Nagari</option>
                                    </select>
                                    <input class="form-control" name="alamat_pasang" placeholder="Nama Jalan" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun pembelian">Titik Koordinat</label>
                                    <input class="form-control" name="lat" placeholder="Nilai Latitude" required>
                                    <input class="form-control" name="long" placeholder="Nilai Longitude" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="asal usul">Nilai Retribusi</label>
                                    <input class="form-control" name="pajak" placeholder="Nilai Pajak" required>
                                </div>
                                <div class="form-group">
                                    <label for="asal usul">Ukuran</label>
                                    <input class="form-control" name="ukuran" placeholder="Ukuran Reklame" required>
                                </div>
                                <div class="form-group">
                                    <label for="asal usul">Unit</label>
                                    <input class="form-control" name="unit" placeholder="Jumlah unit" required>
                                </div>
                                <div class="form-group">
                                    <label for="asal usul">Jenis</label>
                                    <input class="form-control" name="jenis_reklame" placeholder="Jenis Reklame" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto barang">Desain Reklame</label>
                                    <input type="file" class="form-control" name="foto" placeholder="Foto Reklame" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto barang">Tanggal Pasang</label>
                                    <input type="date" class="form-control" name="tgl_pasang" placeholder="Tanggal Pasang" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto barang">Masa Berlaku</label>
                                    <input type="date" class="form-control" name="masa_berlaku" placeholder="Masa Berlaku" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto barang">Keterangan</label>
                                    <select name="ket" class="form-control" required>
                                        <option value="Sudah Setor">Sudah Setor</option>
                                        <option value="Belum Setor">Belum Setor</option>
                                    </select>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="hidden" class="form-control" name="tgl_input" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="background-color: #600574;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>