<!-- Modal -->
<div class="modal fade" id="ModalKabid" tabindex="-1" role="dialog" aria-labelledby="ModalPelayanan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalKabid">Pegawai DPMPTSP Agam</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="row modal-pelayanan">
                        <?php foreach ($pegawai->result() as $row) {
                        ?>
                            <div class="col-sm-12 col-md-3 col-6 col-lg-3 mb-3">
                                <div class="card-body shadow bg-light card-kabid">
                                    <img class="shadow img-responsive img-kabid" src="<?= base_url() ?>assets/imgupload/<?= $row->gambar; ?>" alt="<?= $row->nama; ?>">
                                    <p class="display-4 nama-kabid mt-3"><b><?= $row->nama; ?></b></p>
                                    <p class="ket-kabid"><?= $row->jenis_nip; ?>. <?= $row->nip; ?><br><?= $row->golongan; ?><br><b><?= $row->jabatan; ?></b></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>