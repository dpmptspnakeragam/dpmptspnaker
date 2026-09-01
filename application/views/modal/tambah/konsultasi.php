<!-- ================= MODAL TAMBAH KONSULTASI ================= -->
<div class="modal fade" id="ModalTambahKonsultasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

                <!-- ================= TAMBAHAN FITUR FOTO PEMOHON ================= -->
                <div class="form-group">
                    <label class="font-weight-semibold">Foto Pemohon <span class="text-muted font-weight-normal">(Opsional)</span></label>

                    <div class="border p-3 rounded bg-white">
                        <div class="btn-group btn-group-toggle mb-3 d-flex" data-toggle="buttons">
                            <label class="btn btn-outline-secondary active w-50" id="btn-mode-webcam">
                                <input type="radio" name="mode_foto" value="webcam" checked> <i class="fas fa-camera mr-1"></i> Ambil Kamera
                            </label>
                            <label class="btn btn-outline-secondary w-50" id="btn-mode-file">
                                <input type="radio" name="mode_foto" value="file"> <i class="fas fa-upload mr-1"></i> Upload File
                            </label>
                        </div>

                        <!-- Area Kamera Webcam -->
                        <div id="area-webcam" class="text-center">
                            <div class="embed-responsive embed-responsive-4by3 bg-dark rounded mb-2 mx-auto" style="max-width: 360px;">
                                <video id="webcam-view" autoplay playsinline class="embed-responsive-item rounded" style="transform: scaleX(-1);"></video>
                                <canvas id="webcam-canvas" style="display:none;"></canvas>
                            </div>

                            <!-- Preview Hasil Foto Kamera -->
                            <div id="preview-webcam-box" class="mb-2" style="display: none;">
                                <img id="preview-webcam-img" src="" class="img-thumbnail rounded" style="max-width: 250px;">
                            </div>

                            <button type="button" class="btn btn-sm btn-maroon" id="btn-capture"><i class="fas fa-camera mr-1"></i> Ambil Foto</button>
                            <button type="button" class="btn btn-sm btn-warning" id="btn-retake" style="display: none;"><i class="fas fa-redo mr-1"></i> Foto Ulang</button>

                            <!-- Hidden Input untuk Menyimpan Base64 Data Foto -->
                            <input type="hidden" name="foto_webcam" id="foto_webcam">
                        </div>

                        <!-- Area Upload File Foto Biasa -->
                        <div id="area-file" style="display: none;">
                            <input type="file" name="foto_pemohon" id="foto_pemohon" class="form-control-file border p-1 rounded bg-white" accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Format: JPG/PNG. Maksimal 2MB.</small>
                        </div>
                    </div>
                </div>
                <!-- ================= END FITUR FOTO PEMOHON ================= -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan Data</button>
            </div>
            <?= form_close(); ?>

        </div>
    </div>
</div>

<!-- SCRIPT UNTUK KONTROL KAMERA -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('webcam-view');
        const canvas = document.getElementById('webcam-canvas');
        const captureBtn = document.getElementById('btn-capture');
        const retakeBtn = document.getElementById('btn-retake');
        const previewBox = document.getElementById('preview-webcam-box');
        const previewImg = document.getElementById('preview-webcam-img');
        const fotoWebcamInput = document.getElementById('foto_webcam');

        const areaWebcam = document.getElementById('area-webcam');
        const areaFile = document.getElementById('area-file');
        const btnModeWebcam = document.getElementById('btn-mode-webcam');
        const btnModeFile = document.getElementById('btn-mode-file');

        let mediaStream = null;

        // Fungsi Mulai Kamera
        function startCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true,
                        audio: false
                    })
                    .then(function(stream) {
                        mediaStream = stream;
                        video.srcObject = stream;
                        video.play();
                    })
                    .catch(function(err) {
                        console.log("Akses kamera ditolak/tidak tersedia: ", err);
                        alert("Kamera tidak dapat diakses atau diizinkan. Silakan gunakan opsi Upload File.");
                    });
            }
        }

        // Fungsi Hentikan Kamera
        function stopCamera() {
            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
        }

        // Toggle Mode Webcam vs File Upload
        btnModeWebcam.addEventListener('click', function() {
            areaWebcam.style.display = 'block';
            areaFile.style.display = 'none';
            document.getElementById('foto_pemohon').value = '';
            startCamera();
        });

        btnModeFile.addEventListener('click', function() {
            areaWebcam.style.display = 'none';
            areaFile.style.display = 'block';
            fotoWebcamInput.value = '';
            stopCamera();
        });

        // Jalankan kamera saat Modal Dibuka
        $('#ModalTambahKonsultasi').on('shown.bs.modal', function() {
            if (btnModeWebcam.classList.contains('active')) {
                startCamera();
            }
        });

        // Matikan kamera saat Modal Ditutup
        $('#ModalTambahKonsultasi').on('hidden.bs.modal', function() {
            stopCamera();
            resetWebcamView();
        });

        // Ambil Gambar
        captureBtn.addEventListener('click', function() {
            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;
            const context = canvas.getContext('2d');

            // OPTIONAL: Aktifkan 2 baris di bawah ini HANYA JIKA ingin hasil foto akhir JUGA TERBALIK (Mirror)
            // context.translate(canvas.width, 0);
            // context.scale(-1, 1);

            // Tanpa 2 baris di atas, hasil foto yang disimpan adalah TAMPILAN ASLI (Teks KTP tidak terbalik)
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas ke Data URL Base64
            const dataUrl = canvas.toDataURL('image/jpeg');
            fotoWebcamInput.value = dataUrl;
            previewImg.src = dataUrl;

            // Tampilan UI setelah capture
            video.parentElement.style.display = 'none';
            previewBox.style.display = 'block';
            captureBtn.style.display = 'none';
            retakeBtn.style.display = 'inline-block';

            stopCamera();
        });

        // Foto Ulang (Retake)
        retakeBtn.addEventListener('click', function() {
            resetWebcamView();
            startCamera();
        });

        function resetWebcamView() {
            fotoWebcamInput.value = '';
            previewImg.src = '';
            previewBox.style.display = 'none';
            video.parentElement.style.display = 'block';
            captureBtn.style.display = 'inline-block';
            retakeBtn.style.display = 'none';
        }
    });
</script>