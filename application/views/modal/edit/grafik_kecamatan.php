<?php foreach ($grafik_kecamatan->result() as $row) : ?>
    <div class="modal fade" id="ModalEditGrafikPerKecamatan<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Data Grafik Sebaran Proyek Per Kecamatan Usaha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_nib/ubah_kecamatan'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_grafik; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input class="form-control" name="kecamatan" value="<?php echo $row->kecamatan; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Jumlah</label>
                            <input class="form-control" name="jumlah" value="<?php echo $row->jumlah; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>