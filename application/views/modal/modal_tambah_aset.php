<div class="modal fade" id="ModalTambahAset" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/aset/tambah'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <?php foreach ($idmax->result() as $row) {
                            ?>
                                <div hidden class="form-group">
                                    <label>Id</label>
                                    <input type="text" class="form-control" id="id" name="id_aset" value="<?= $row->idmax + 1; ?>">
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="kode barang">Kode Barang</label>
                                <input class="form-control" name="kode_brg" placeholder="Kode Barang" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="asal usul">Asal Usul</label>
                                <select name="asal_usul" class="form-control" required>
                                    <option value="APBD">APBD</option>
                                    <option value="Hibah">Hibah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="kode rekening">Kode rekening</label>
                                <input class="form-control" name="kode_rekening" placeholder="Kode Rekening" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="kondisi barang">Kondisi Barang</label>
                                <select name="kondisi_brg" class="form-control" required>
                                    <option value="Baik">Baik</option>
                                    <option value="RR">RR</option>
                                    <option value="RB">RB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="nama barang">Nama Barang</label>
                                <input class="form-control" name="nama_brg" placeholder="Nama Barang" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="nilai aset">Nilai Aset</label>
                                <input class="form-control" name="nilai_aset" placeholder="Nilai Aset" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="no register">No. Register</label>
                                <input class="form-control" name="no_register" placeholder="Nomor Register" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="pemakai">Pemakai</label>
                                <select name="pemakai" id="" class="form-control" required>
                                    <?php foreach ($pegawai->result() as $r) { ?>
                                        <option value="" selected disabled>Pilih Nama Pemakai</option>
                                        <option value="<?= $r->nama; ?>"><?= $r->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="tahun pembelian">Tahun Pembelian</label>
                                <input class="form-control" name="tahun_beli" placeholder="Tahun Pembelian" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="foto barang">Foto Barang</label><br>
                                <input type="file" class="form-control border-0" name="foto_brg" placeholder="Foto Barang" required>
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