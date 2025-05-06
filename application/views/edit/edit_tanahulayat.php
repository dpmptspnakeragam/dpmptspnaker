<?php foreach ($tanah_ulayat->result() as $row) : ?>
    <div class="modal fade" id="EditTanahUlayat<?= $row->id_ulayat; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" action="<?= base_url('admin/tanah_ulayat/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" hidden>
                            <input type="text" class="form-control" name="id" value="<?= $row->id_ulayat; ?>">
                        </div>
                        <div class="form-group" hidden>
                            <input type="text" class="form-control" name="kecamatan" value="<?= $row->kecamatan; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="pelatihan">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Tanah Ulayat" value="<?= $row->lokasi; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pelatihan">Luas</label>
                            <input type="text" class="form-control" name="luas" placeholder="Luas Tanah Ulayat" value="<?= $row->luas; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="pelatihan">Status Kepemilikan</label>
                            <input type="text" class="form-control" name="status" placeholder="Status Kepemilikan Tanah Ulayat" value="<?= $row->status; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="pelatihan">Jenis Investasi</label>
                            <input type="text" class="form-control" name="jenis" placeholder="Jenis Investasi Tanah Ulayat" value="<?= $row->jenis; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="pelatihan">Bentuk Kerjasama</label>
                            <input type="text" class="form-control" name="bentuk" placeholder="Bentuk Kerjasama Investasi Tanah Ulayat" value="<?= $row->bentuk; ?>">
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