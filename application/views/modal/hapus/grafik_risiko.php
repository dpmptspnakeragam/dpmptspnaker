<?php foreach ($grafik_risiko->result() as $row) : ?>
    <div class="modal fade" id="ModalDeleteGrafikResiko<?= $row->id_grafik ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Grafik Sebaran Proyek Bedasarkan Risiko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nib" id="nib" value="<?= $row->risiko; ?>" hidden>
                    Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->risiko ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/grafik_nib/hapus_risiko/' . $row->id_grafik); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>