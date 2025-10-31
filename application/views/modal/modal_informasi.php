<!-- Modal -->
<?php foreach ($berita->result() as $row) {
?>
    <div class="modal fade" id="DetailInformasi<?= $row->id_berita; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalInformasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan"></h5>
                    <a href="<?= base_url(); ?>informasi" class="text-light">Berita Lainnnya >></a>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container text-justify">
                        <div class="row">
                            <img class="gambar-berita" src="<?= base_url() ?>assets/imgupload/<?= $row->gambar; ?>" alt="<?= $row->judul_berita; ?>">
                            <div class="container">
                                <p class="judul-informasi2 mb-0"><?= $row->judul_berita; ?></p><br>
                                <small class="tgl_berita2 text-light"><?= date_indo($row->tgl_berita) ?>, Kategori : <?= $row->kategori; ?></small>
                                <p class="ringkasan"><?= $row->isi_berita; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>