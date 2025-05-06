<?php foreach ($periode_grafik->result() as $row) {
?>
    <div class="modal fade" id="EditPeriodeGrafikOss<?php echo $row->id_periode; ?>" role="dialog" aria-labelledby="ModalTambahGrafikLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Periode Grafik</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/grafik_nib/ubah_periode" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_periode; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tgl_awal" placeholder="Nama Izin" value="<?php echo $row->tgl_awal; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tgl_akhir" placeholder="Jumlah Izin" value="<?php echo $row->tgl_akhir; ?>" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>