<?php foreach ($reklame->result() as $row) {
?>
    <div class="modal fade" id="EditReklame<?php echo $row->id_reklame; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTambahReklame" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light" style="background-color: #600574;">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Reklame</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/reklame/ubah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_reklame; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kode barang">No. Izin</label>
                                        <input class="form-control" name="no_izin" value="<?php echo $row->no_izin; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode rekening">Nama Perusahaan</label>
                                        <input class="form-control" name="nama_perusahaan" value="<?php echo $row->nama_perusahaan; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama barang">Alamat Perusahaan</label>
                                        <input class="form-control" name="alamat_perusahaan" value="<?php echo $row->alamat_perusahaan; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no register">Penanggungjawab</label>
                                        <input class="form-control" name="pemohon" value="<?php echo $row->pemohon; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun pembelian">No. HP</label>
                                        <input class="form-control" name="no_hp" value="<?php echo $row->no_hp; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun pembelian">Alamat Pasang</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan<?php echo $row->id_reklame; ?>">
                                            <option value="<?php echo $row->kec_pasang; ?>" selected><?php echo $row->kecamatan; ?></option>
                                            <option value="">Pilih kecamatan</option>
                                            <?php foreach ($kecamatan as $kec) { ?>
                                                <option value="<?php echo $kec->id_kecamatan ?>"><?php echo $kec->kecamatan ?></option>
                                            <?php }    ?>
                                        </select>
                                        <select class="form-control" name="nagari" id="nagari<?php echo $row->id_reklame; ?>">
                                            <option value="<?php echo $row->nag_pasang; ?>" selected><?php echo $row->nama_nagari; ?></option>
                                        </select>
                                        <input class="form-control" name="kec_pasang" value="<?php echo $row->kec_pasang; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun pembelian">Titik Koordinat</label>
                                        <input class="form-control" name="lat" value="<?php echo $row->lat; ?>" required>
                                        <input class="form-control" name="long" value="<?php echo $row->long; ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="asal usul">Nilai Retribusi</label>
                                        <input class="form-control" name="pajak" value="<?php echo $row->pajak; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asal usul">Ukuran</label>
                                        <input class="form-control" name="ukuran" value="<?php echo $row->ukuran; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asal usul">Unit</label>
                                        <input class="form-control" name="unit" value="<?php echo $row->unit; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="asal usul">Jenis</label>
                                        <input class="form-control" name="jenis_reklame" value="<?php echo $row->jenis_reklame; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto barang">Desain Reklame</label>
                                        <img src="<?= base_url(); ?>assets/imgupload/<?php echo $row->foto; ?>" width='80' height='60' />
                                        <input name="foto" type="file" id="foto" />
                                        <input name="old" type="hidden" id="old" value="<?php echo $row->foto; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="foto barang">Tanggal Pasang</label>
                                        <input type="date" class="form-control" name="tgl_pasang" value="<?php echo $row->tgl_pasang; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto barang">Masa Berlaku</label>
                                        <input type="date" class="form-control" name="masa_berlaku" value="<?php echo $row->masa_berlaku; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto barang">Keterangan</label>
                                        <select name="ket" class="form-control" required>
                                            <option value="<?php echo $row->ket; ?>" selected><?php echo $row->ket; ?></option>
                                            <option value="Sudah Setor">Sudah Setor</option>
                                            <option value="Belum Setor">Belum Setor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class=" modal-footer" style="background-color: #600574;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#kecamatan<?php echo $row->id_reklame; ?>').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/reklame/get_nagari",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value=' + data[i].id_nagari + '>' + data[i].nama_nagari + '</option>';
                        }
                        $('#nagari<?php echo $row->id_reklame; ?>').html(html);
                    }
                });
                return false;
            });

        });
    </script>
<?php } ?>