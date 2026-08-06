<!-- ================= MODAL TAMBAH KONSULTASI ================= -->
<div class="modal fade" id="ModalTambahKonsultasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Class diringkas agar bebas scroll -->
        <div class="modal-content">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="staticBackdropLabel"><i class="fas fa-plus-circle mr-2"></i>Tambah Data Konsultasi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- ACTION MENYESUAIKAN FOLDER CONTROLLER BARU -->
            <?= form_open_multipart('admin/konsultasi/tambah'); ?>
            <div class="modal-body bg-light">

                <h6 class="font-weight-bold text-maroon border-bottom pb-2 mb-3">A. Identitas Pemohon</h6>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nama_pemohon" class="font-weight-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nik" class="font-weight-semibold">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK 16 Digit" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="no_hp"><i class="fas fa-phone-alt text-muted mr-1"></i> Nomor Telepon</label>

                        <input class="form-control" type="text" name="no_hp" id="no_hp"
                            placeholder="081234567890" required
                            value="<?= set_value('no_hp', '08'); ?>"
                            maxlength="13" autocomplete="off">
                        <small class="text-danger" id="error_no_hp" style="display:none;">Nomor wajib diawali 08</small>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const inputHp = document.getElementById('no_hp');
                                const errorText = document.getElementById('error_no_hp');

                                inputHp.addEventListener('input', function(e) {
                                    this.value = this.value.replace(/[^0-9]/g, '');

                                    let val = this.value;

                                    if (val.length > 0) {
                                        if (val.length === 1 && val !== '0') {
                                            this.value = '08';
                                        } else if (val.length >= 2 && !val.startsWith('08')) {
                                            this.value = '08' + val.substring(2);

                                            errorText.style.display = 'block';
                                            setTimeout(() => {
                                                errorText.style.display = 'none';
                                            }, 2000);
                                        } else {
                                            errorText.style.display = 'none';
                                        }
                                    }
                                });

                                inputHp.addEventListener('focus', function() {
                                    if (this.value === '') {
                                        this.value = '08';
                                    }
                                });

                                inputHp.addEventListener('blur', function() {
                                    if (this.value === '0' || this.value === '') {
                                        this.value = '08';
                                    }
                                });
                            });
                        </script>

                    </div>
                    <div class="col-md-6 form-group">
                        <label for="pekerjaan" class="font-weight-semibold">Pekerjaan / Instansi <span class="text-muted font-weight-normal">(Opsional)</span></label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="PNS, Swasta, Mahasiswa, dll">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-semibold">Email <span class="text-muted font-weight-normal">(Opsional)</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@gmail.com">
                </div>

                <div class="form-group">
                    <label for="alamat" class="font-weight-semibold">Alamat Domisili <span class="text-danger">*</span></label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="2" placeholder="Jln. Wilayah, Kota, Provinsi" required></textarea>
                </div>

                <h6 class="font-weight-bold text-maroon border-bottom pb-2 mb-3 mt-4">B. Rincian Konsultasi</h6>

                <div class="form-group">
                    <label for="jenis_izin" class="font-weight-semibold">Jenis Izin Terkait <span class="text-danger">*</span></label>
                    <input type="text" name="jenis_izin" id="jenis_izin" class="form-control" placeholder="Izin Praktik Dokter, NIB, PBG, dll" required>
                </div>

                <div class="form-group">
                    <label for="uraian" class="font-weight-semibold">Uraian Konsultasi <span class="text-danger">*</span></label>
                    <textarea name="uraian" id="uraian" class="form-control" rows="4" placeholder="Jelaskan secara detail permasalahan/pertanyaan..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="lampiran" class="font-weight-semibold">Lampiran Dokumen <span class="text-muted font-weight-normal">(Opsional)</span></label>
                    <input type="file" name="lampiran" id="lampiran" class="form-control-file border p-1 rounded bg-white" accept=".jpg,.jpeg,.png,.pdf">
                    <small class="text-muted">Format: JPG/PNG/PDF. Maksimal 5MB.</small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan Data</button>
            </div>
            <?= form_close(); ?>

        </div>
    </div>
</div>