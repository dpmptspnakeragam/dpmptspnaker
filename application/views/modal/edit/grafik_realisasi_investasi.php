<?php foreach ($grafik_investasi->result() as $row) : ?>
    <div class="modal fade" id="EditGrafikRealisasasiInvestasi<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_realisasi_investasi/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="modal-body">
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
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>