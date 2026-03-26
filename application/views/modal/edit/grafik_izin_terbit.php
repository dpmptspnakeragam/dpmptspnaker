<?php foreach ($grafik->result() as $row) : ?>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEditGrafik<?= $row->id_grafik; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Update <?= ($row->tipe == 'bidang') ? 'Bidang' : 'Jenis Izin'; ?> <?= $title; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('admin/grafik_izin_terbit/edit/' . $row->id_grafik); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="modal-body">

                        <?php if ($row->tipe == 'bidang') : ?>
                            <div class="form-group">
                                <label>Nama Bidang</label>
                                <input type="text" class="form-control" name="izin"
                                    value="<?= html_escape($row->nama_bidang); ?>" required>
                            </div>

                            <div class="form-group mb-0">
                                <label>Total Jumlah Izin</label>
                                <input type="number" class="form-control" value="<?= $row->jumlah; ?>" readonly>
                                <small class="text-muted">Total ini otomatis dari semua jenis izin di bawah bidang.</small>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <label>Pilih Bidang</label>
                                <select class="form-control" name="parent_id" required>
                                    <option value="">-- Pilih Bidang --</option>
                                    <?php foreach ($bidang->result() as $b) : ?>
                                        <option value="<?= $b->id_grafik; ?>"
                                            <?= ($b->id_grafik == $row->parent_id) ? 'selected' : ''; ?>>
                                            <?= $b->izin; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Jenis Izin</label>
                                <input type="text" class="form-control" name="izin"
                                    value="<?= html_escape($row->jenis_izin); ?>" required>
                            </div>

                            <div class="form-group mb-0">
                                <label>Jumlah Izin</label>
                                <input type="number" class="form-control" name="jumlah"
                                    value="<?= $row->jumlah; ?>" min="0" required>
                            </div>
                        <?php endif; ?>

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