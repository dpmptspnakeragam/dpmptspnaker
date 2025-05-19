<div class="modal fade" id="ModalTambahGrafikSKM" tabindex="-1" role="dialog" aria-labelledby="ModalTambahgrafikLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Grafik Survaey Kepuasan Masyarakat</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url(); ?>admin/grafik_skm/tambah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <?php foreach ($idmax->result() as $row) {
                    ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pelatihan">Tahun</label>
                        <input class="form-control" name="tahun" placeholder="Tahun" required>

                    </div>
                    <div class="form-group">
                        <label for="pelatihan">Semester I</label>
                        <input class="form-control" name="nilai" placeholder="Nilai" required>

                    </div>

                    <div class="form-group">
                        <label for="pelatihan">Semester II</label>
                        <input class="form-control" name="nilai2" placeholder="Nilai" required>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>