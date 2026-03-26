<div class="modal fade" id="ModalTambahGrafikJenisIzin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Izin <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('admin/grafik_izin_terbit/tambah_jenis'); ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="parent_id">Pilih Bidang</label>
                        <select class="form-control" id="parent_id" name="parent_id" required>
                            <option value="" disabled selected>-- Pilih Bidang --</option>
                            <?php foreach ($bidang->result() as $b) : ?>
                                <option value="<?= $b->id_grafik; ?>"><?= $b->izin; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="izin_jenis">Nama Jenis Izin</label>
                        <input type="text" class="form-control" id="izin_jenis" name="izin" placeholder="Contoh: Izin Dokter" required>
                    </div>

                    <div class="form-group mb-0">
                        <label for="jumlah">Jumlah Izin</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" placeholder="Contoh: 10" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>