<!-- Modal -->
<div class="modal fade" id="ModalPotensiInvestasi" tabindex="-1" role="dialog" aria-labelledby="ModalInformasi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan">Potensi Investasi Kabupaten</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php
                    $displayed_investments = [];
                    foreach ($potensi_investasi->result() as $row) {
                        if (in_array($row->nama_investasi, $displayed_investments)) {
                            continue;
                        }
                        $displayed_investments[] = $row->nama_investasi;
                    ?>
                        <div class="col-lg-4 display-4 mb-1">
                            <a href="#" class="pilih-investasi-2 text-center" data-toggle="modal" data-target="#ModalDetailPotensiInvestasi<?php echo md5($row->nama_investasi); ?>">
                                <?= $row->nama_investasi; ?>
                            </a>
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