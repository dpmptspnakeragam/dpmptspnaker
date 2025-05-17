<div class="modal fade" id="ModalTambahGrafikRealisasiInvestasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_realisasi_investasi/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <?php foreach ($idmax->result() as $row) : ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label for="pelatihan">Tahun Investasi</label>
                        <input class="form-control" name="tahun" placeholder="Tahun Investasi" required>
                    </div>
                    <div class="form-group">
                        <label for="pelatihan">Nilai Target</label>
                        <input class="form-control" name="nilai" placeholder="Nilai Investasi" required>
                    </div>
                    <div class="form-group">
                        <label for="pelatihan">Nilai Realisasi</label>
                        <input class="form-control" name="nilai2" placeholder="Nilai Investasi" required>
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