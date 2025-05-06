<?php foreach ($aset->result() as $row) : ?>
    <div class="modal fade" id="EditAset<?php echo $row->id_aset; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/aset/ubah'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_aset; ?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="kode barang">Kode Barang</label>
                                    <input class="form-control" name="kode_brg" value="<?php echo $row->kode_brg; ?>" required>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="asal usul">Asal Usul</label>
                                    <select name="asal_usul" class="form-control" required>
                                        <option value="<?php echo $row->asal_usul; ?>" selected><?php echo $row->asal_usul; ?></option>
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
                                    <input class="form-control" name="kode_rekening" value="<?php echo $row->kode_rekening; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="kondisi barang">Kondisi Barang</label>
                                    <select name="kondisi_brg" class="form-control" required>
                                        <option value="<?php echo $row->kondisi_brg; ?>" selected><?php echo $row->kondisi_brg; ?></option>
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
                                    <input class="form-control" name="nama_brg" value="<?php echo $row->nama_brg; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nilai aset">Nilai Aset</label>
                                    <input class="form-control" name="nilai_aset" value="<?php echo $row->nilai_aset; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="no register">No. Register</label>
                                    <input class="form-control" name="no_register" value="<?php echo $row->no_register; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="pemakai">Pemakai</label>
                                    <select name="pemakai" id="" class="form-control">
                                        <?php
                                        foreach ($pegawai->result() as $r) {
                                            if ($r->nama == $row->pemakai) {
                                                $aktif = "selected";
                                            } else {
                                                $aktif = "";
                                            }
                                        ?>
                                            <option value="<?= $r->nama; ?>" <?= $aktif; ?>><?= $r->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tahun pembelian">Tahun Pembelian</label>
                                    <input class="form-control" name="tahun_beli" value="<?php echo $row->tahun_beli; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="foto barang">Foto Barang</label>
                                    <img src="<?= base_url(); ?>assets/imgupload/<?php echo $row->foto_brg; ?>" width='80' height='60' />
                                    <input name="foto_brg" type="file" id="foto_brg" />
                                    <input name="old" type="hidden" id="old" value="<?php echo $row->foto_brg; ?>" />
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control hidden" id="id" name="qrold" value="<?php echo $row->qrcode; ?>">
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