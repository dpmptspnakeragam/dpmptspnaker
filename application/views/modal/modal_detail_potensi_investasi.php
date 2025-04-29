<?php
// Mengelompokkan data berdasarkan nama_investasi
$grouped_data = [];
foreach ($potensi_investasi->result() as $row) {
    $grouped_data[$row->nama_investasi][] = $row;
}

// Iterasi untuk menampilkan modal
foreach ($grouped_data as $nama_investasi => $items) {
?>
    <div class="modal fade" id="ModalDetailPotensiInvestasi<?php echo md5($nama_investasi); ?>" tabindex="-1" role="dialog" aria-labelledby="ModalInformasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan"><?php echo $nama_investasi; ?></h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <?php foreach ($items as $item) { ?>
                            <div class="row mb-4">
                                <div class="col-sm-12 col-lg-6">
                                    <img class="img-responsive img-investasi" src="<?= base_url() ?>assets/imgupload/<?= $item->gambar; ?>" alt="<?= $item->nama_investasi; ?>">
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="container-fluid">
                                        <p><?= $item->deskripsi; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>