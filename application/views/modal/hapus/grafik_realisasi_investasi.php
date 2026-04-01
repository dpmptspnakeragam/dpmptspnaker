<?php foreach ($grafik_investasi->result() as $row) : ?>
    <div class="modal fade" id="ModalDeleteGrafikRealisasiInvestasi<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Hapus <?= ($row->tipe == 'tahun') ? 'Tahun' : 'Jenis'; ?> Investasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('admin/grafik_realisasi_investasi/hapus/' . $row->id_grafik); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="modal-body">
                        <?php if ($row->tipe == 'tahun') : ?>
                            <p class="mb-1">Apakah Anda yakin ingin menghapus data tahun <strong class="font-weight-bold text-maroon"><?= $row->tahun; ?></strong> ini?</p>
                            <small class="text-danger font-italic"><b>Peringatan:</b> Menghapus tahun ini juga akan menghapus semua data Jenis Investasi di dalamnya secara permanen.</small>
                        <?php else : ?>
                            <p class="mb-0">Apakah Anda yakin ingin menghapus Jenis Investasi <strong class="font-weight-bold text-maroon"><?= html_escape($row->jenis_investasi); ?></strong> pada tahun <?= $row->tahun; ?>?</p>
                        <?php endif; ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>