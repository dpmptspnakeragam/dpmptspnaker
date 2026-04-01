<div class="modal fade" id="ModalTambahGrafikRealisasiInvestasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Tahun <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/grafik_realisasi_investasi/tambah_tahun'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                <input type="hidden" name="tipe" value="tahun">

                <div class="modal-body">
                    <?php foreach ($idmax->result() as $row) : ?>
                        <input type="hidden" name="id_grafik" value="<?= $row->idmax + 1; ?>">
                    <?php endforeach; ?>

                    <div class="form-group">
                        <label for="tahun">Tahun Investasi</label>
                        <input type="number" min="2000" max="2099" class="form-control" id="tahun" name="tahun" placeholder="Contoh: <?= date('Y'); ?>" required>
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