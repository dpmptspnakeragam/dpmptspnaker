<?php foreach ($grafik_investasi->result() as $row) {
?>
    <div class="modal fade" id="EditGrafikInvestasi<?php echo $row->id_grafik; ?>" role="dialog" aria-labelledby="ModalTambahGrafikLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Grafik Realisasi Investasi</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?= base_url(); ?>admin/grafik_investasi/ubah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_grafik; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tahun Investasi</label>
                            <input class="form-control" name="tahun" placeholder="Nama Izin" value="<?php echo $row->tahun; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Nilai Target</label>
                            <input class="form-control" name="nilai" placeholder="Jumlah Izin" value="<?php echo $row->nilai; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Nilai Realisasi</label>
                            <input class="form-control" name="nilai2" placeholder="Jumlah Izin" value="<?php echo $row->nilai2; ?>" required>
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