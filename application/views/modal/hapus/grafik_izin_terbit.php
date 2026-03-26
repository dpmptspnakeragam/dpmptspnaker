<?php foreach ($grafik->result() as $row) : ?>

    <!-- Modal Hapus -->
    <div class="modal fade" id="ModalDeleteGrafik<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus <?= ($row->tipe == 'bidang') ? 'Bidang' : 'Jenis Izin'; ?> <?= $title; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('admin/grafik_izin_terbit/hapus/' . $row->id_grafik); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="modal-body">
                        <?php if ($row->tipe == 'bidang') : ?>
                            <p class="mb-0">
                                Yakin ingin menghapus <b>Bidang <?= html_escape($row->nama_bidang); ?></b>?
                                <br>
                                <small class="text-danger">Semua jenis izin di bawah bidang ini juga akan ikut terhapus.</small>
                            </p>
                        <?php else : ?>
                            <p class="mb-0">
                                Yakin ingin menghapus <b><?= html_escape($row->jenis_izin); ?></b>?
                            </p>
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