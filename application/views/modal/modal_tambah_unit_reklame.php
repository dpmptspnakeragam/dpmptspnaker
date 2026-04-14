<!-- Modal Tambah Reklame -->
<div class="modal fade" id="ModalTambahReklameMulti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #600574;">
                <h5 class="modal-title">Tambah Data Reklame - Multi Unit</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="<?= base_url('dashboard/tambah_multi') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Data Induk -->
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>No. Izin</label>
                                <input type="text" name="no_izin" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Alamat Perusahaan</label>
                                <input type="text" name="alamat_perusahaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Penanggung Jawab</label>
                                <input type="text" name="pemohon" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>No. HP</label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                        </div>

                        <!-- Data Induk Lanjutan -->
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Jenis Reklame</label>
                                <input type="text" name="jenis_reklame" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Ukuran</label>
                                <input type="text" name="ukuran" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nilai Pajak</label>
                                <input type="text" name="pajak" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Desain Reklame</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <select name="ket" class="form-control" required>
                                    <option value="Sudah Setor">Sudah Setor</option>
                                    <option value="Belum Setor">Belum Setor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Pasang</label>
                                <input type="date" name="tgl_pasang" class="form-control" required>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Masa Berlaku</label>
                                <input type="date" name="masa_berlaku" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Form Unit Reklame -->
                    <h5>Detail Lokasi Unit Reklame</h5>
                    <div id="unit-container">
                        <!-- Unit akan ditambahkan di sini via JS -->
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-unit-btn">+ Tambah Lokasi Unit</button>
                </div>

                <div class="modal-footer" style="background-color: #600574;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#ModalTambahReklameMulti').on('hidden.bs.modal', function() {
        $('#unit-container').html('');
        unitCount = 0;
    });
</script>

<script>
    let unitCount = 0;

    document.getElementById('add-unit-btn').addEventListener('click', function() {
        unitCount++;
        const container = document.getElementById('unit-container');
        const unitHTML = `
    <div class="card p-3 mb-3" style="border: 1px solid #ccc;">
        <h6>Unit ke-${unitCount}</h6>
            <div class="form-group">
                <label>Kecamatan</label>
                    <select name="unit[${unitCount}][kec_pasang]" class="form-control kecamatan-dropdown" required>
                        <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan as $kec): ?>
                                <option value="<?= $kec->id ?>"><?= $kec->nama_kecamatan ?></option>
                            <?php endforeach; ?>
                    </select>
            </div>
            <div class="form-group">
                <label>Nagari</label>
                    <select name="unit[${unitCount}][nagari]" class="form-control nagari-dropdown" required>
                        <option value="">Pilih Nagari</option>
                    </select>
            </div>
            <div class="form-group">
                <label>Alamat Pasang</label>
                    <input type="text" name="unit[${unitCount}][alamat_pasang]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Latitude</label>
                    <input type="text" name="unit[${unitCount}][lat]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                    <input type="text" name="unit[${unitCount}][long]" class="form-control" required>
            </div>
            <button type="button" class="btn btn-sm btn-danger float-right remove-unit mt-2 mb-2">
                <i class="fa fa-trash"></i> Hapus Unit
            </button>
    </div>`;
        container.insertAdjacentHTML('beforeend', unitHTML);
    });
</script>

<script>
    $(document).on('change', '.kecamatan-dropdown', function() {
        const kecSelect = $(this);
        const selectedKecamatanId = kecSelect.val();
        const unitCard = kecSelect.closest('.card');
        const nagariDropdown = unitCard.find('.nagari-dropdown');

        if (!selectedKecamatanId) {
            nagariDropdown.html('<option value="">Pilih Nagari</option>');
            return;
        }

        nagariDropdown.html('<option value="">Memuat...</option>');

        $.ajax({
            url: "<?= base_url('dashboard/get_nagari_ajax') ?>",
            type: "GET",
            data: {
                id_kecamatan: selectedKecamatanId
            },
            dataType: "json",
            success: function(data) {
                let options = '<option value="">Pilih Nagari</option>';
                $.each(data, function(i, nagari) {
                    options += `<option value="${nagari.id}">${nagari.nama_nagari}</option>`;
                });
                nagariDropdown.html(options);
            },
            error: function(xhr, status, error) {
                nagariDropdown.html('<option value="">Pilih Nagari</option>');
                console.error('AJAX get_nagari_ajax error:', status, error);
            }
        });
    });
    $(document).on('click', '.remove-unit', function() {
        $(this).closest('.card').remove();
    });
</script>