<div class="modal fade" id="ModalExportReklameTgl" tabindex="-1" role="dialog" aria-labelledby="ModalFilterPendidikan" aria-hidden="true">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">
            <div class="modal-header text-light" style=" background-color: #600574;">
                <h5 class="modal-title" id="exampleModalLabel">Export Data Reklame Berdasarkan Tanggal</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url() ?>dashboard/export_tgl" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="umur">Tanggal</label>
                            <div class="form-group">
                                <label>Dari</label>
                                <input class="form-control" type="date" name="tgl_dari" id="tgl_dari">
                                <label>Sampai</label>
                                <input class="form-control" type="date" name="tgl_sampai" id="tgl_sampai">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Retirbusi</label>
                            <select required name="ket" class="form-control">
                                <option value="Sudah Setor">Sudah Setor</option>
                                <option value="Belum Setor">Belum Setor</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Export</button>
            </div>
            </form>
        </div>
    </div>
</div>