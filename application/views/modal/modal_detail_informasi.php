<!-- Modal -->
<?php foreach ($berita->result() as $row) {
    $gambar     = $row->gambar ?? '';
    $imagePath  = FCPATH . 'assets/imgupload/' . $gambar;
    $imageSrc   = (!empty($gambar) && file_exists($imagePath))
        ? base_url('assets/imgupload/' . $gambar)
        : base_url('assets/img/agam.jpg');
?>
    <div class="modal fade" id="DetailInformasi<?= $row->id_berita; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalInformasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan"><?= $row->judul_berita; ?></h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container text-justify">
                        <div class="row modal-informasi">
                            <img class="gambar-berita2 img-responsive img-thumbnail" src="<?= $imageSrc; ?>" alt="<?= $row->judul_berita; ?>">
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