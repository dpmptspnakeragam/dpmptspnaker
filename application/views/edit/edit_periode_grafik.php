<?php foreach ($periode_grafik->result() as $row) : ?>
    <div class="modal fade" id="EditPeriodeGrafik<?= $row->id_periode; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Periode <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_izin/edit_periode'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $row->id_periode; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tgl_awal" placeholder="Nama Izin" value="<?php echo $row->tgl_awal; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tgl_akhir" placeholder="Jumlah Izin" value="<?php echo $row->tgl_akhir; ?>" required>
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