<?php foreach ($grafik->result() as $row) : ?>
    <div class="modal fade" id="ModalEditGrafik<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/grafik_izin/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->id_grafik; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Nama Izin</label>
                            <input class="form-control" name="izin" placeholder="Nama Izin" value="<?= $row->izin; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Jumlah Izin</label>
                            <input class="form-control" name="jumlah" placeholder="Jumlah Izin" value="<?= $row->jumlah; ?>" required>
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