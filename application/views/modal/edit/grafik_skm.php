<?php foreach ($grafik_skm->result() as $row) : ?>
    <div class="modal fade" id="ModalEditGrafikSKM<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_skm/edit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_grafik; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tahun</label>
                            <input class="form-control" name="tahun" placeholder="Nama Izin" value="<?php echo $row->tahun; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Semester I</label>
                            <input class="form-control" name="nilai" placeholder="Jumlah Izin" value="<?php echo $row->nilai; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Semester II</label>
                            <input class="form-control" name="nilai2" placeholder="Jumlah Izin" value="<?php echo $row->nilai2; ?>" required>
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