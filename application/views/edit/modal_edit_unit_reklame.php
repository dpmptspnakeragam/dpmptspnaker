<?php foreach ($reklame_grouped as $r): ?>
    <div class="modal fade" id="ModalEditReklameMulti<?= $r['id_reklame'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-light" style="background-color: #600574;">
                    <h5 class="modal-title">Update Data Reklame - Multi Unit</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?= base_url('dashboard/update_multi/' . $r['id_reklame']) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Data Induk -->
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>No. Izin</label>
                                    <input type="text" name="no_izin" class="form-control" value="<?= $r['no_izin'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control" value="<?= $r['nama_perusahaan'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $r['email'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Alamat Perusahaan</label>
                                    <input type="text" name="alamat_perusahaan" class="form-control" value="<?= $r['alamat_perusahaan'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" name="pemohon" class="form-control" value="<?= $r['pemohon'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?= $r['no_hp'] ?>" required>
                                </div>
                            </div>

                            <!-- Data Induk Lanjutan -->
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Jenis Reklame</label>
                                    <input type="text" name="jenis_reklame" class="form-control" value="<?= $r['jenis_reklame'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Ukuran</label>
                                    <input type="text" name="ukuran" class="form-control" value="<?= $r['ukuran'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nilai Pajak</label>
                                    <input type="text" name="pajak" class="form-control" value="<?= $r['retribusi'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group text-center">
                                            <label>Desain Reklame</label><br>
                                            <?php if (!empty($r['foto'])): ?>
                                                <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                                    <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" class="img-responsive mb-2" style="max-width: 100px;">
                                                </a>
                                            <?php else: ?>
                                                <p class="text-muted">Belum ada desain</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Ganti Desain Reklame</label><br>
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <select name="ket" class="form-control" required>
                                        <option value="Sudah Setor" <?= $r['ket'] == 'Sudah Setor' ? 'selected' : '' ?>>Sudah Setor</option>
                                        <option value="Belum Setor" <?= $r['ket'] == 'Belum Setor' ? 'selected' : '' ?>>Belum Setor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Tanggal Pasang</label>
                                    <input type="date" name="tgl_pasang" class="form-control" value="<?= $r['tgl_pasang'] ?>" required>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Masa Berlaku</label>
                                    <input type="date" name="masa_berlaku" class="form-control" value="<?= $r['masa_berlaku'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5>Detail Lokasi Unit Reklame</h5>
                        <div id="unit-container-edit<?= $r['id_reklame'] ?>">
                            <?php foreach ($r['lokasi'] as $i => $lok): ?>
                                <div class="card p-3 mb-3">
                                    <h6>Unit ke-<?= $i + 1 ?></h6>

                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select name="unit[<?= $i ?>][kec_pasang]" class="form-control" required>
                                            <option value="">Pilih Kecamatan</option>
                                            <?php foreach ($kecamatan as $kec): ?>
                                                <option value="<?= $kec->id ?>" <?= ($kec->nama_kecamatan == $lok['nama_kecamatan']) ? 'selected' : '' ?>>
                                                    <?= $kec->nama_kecamatan ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Nagari</label>
                                        <?php
                                        $id_kec = $this->Model_reklame->get_id_kecamatan_by_nama($lok['nama_kecamatan']);
                                        $nagari_list = isset($nagari_per_unit[$id_kec]) ? $nagari_per_unit[$id_kec] : [];
                                        ?>
                                        <select name="unit[<?= $i ?>][nagari]" class="form-control nagari-dropdown" required>
                                            <option value="">Pilih Nagari</option>
                                            <?php foreach ($nagari_list as $nag): ?>
                                                <option value="<?= $nag->id ?>" <?= ($nag->nama_nagari == $lok['nama_nagari']) ? 'selected' : '' ?>>
                                                    <?= $nag->nama_nagari ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat Pasang</label>
                                        <input type="text" name="unit[<?= $i ?>][alamat_pasang]" class="form-control" value="<?= $lok['alamat_pasang'] ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" name="unit[<?= $i ?>][lat]" class="form-control" value="<?= $lok['lat'] ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" name="unit[<?= $i ?>][long]" class="form-control" value="<?= $lok['long'] ?>" required>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-sm remove-unit float-right"><i class="fa fa-trash"></i> Hapus Unit</button>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="btn btn-sm btn-primary mt-2 add-unit-btn-edit" data-target="#unit-container-edit<?= $r['id_reklame'] ?>">+ Tambah Lokasi Unit</button>
                    </div>

                    <div class="modal-footer" style="background-color: #600574;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<script>
    var kecamatanOptions = `<?php foreach ($kecamatan as $kec): ?>
        <option value="<?= $kec->id ?>"><?= $kec->nama_kecamatan ?></option>
    <?php endforeach; ?>`;
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.kecamatan-dropdown', function() {
            var kecamatanId = $(this).val();
            var nagariDropdown = $(this).closest('.card').find('.nagari-dropdown');

            if (kecamatanId) {
                $.ajax({
                    url: '<?= base_url('dashboard/get_nagari_ajax') ?>',
                    method: 'POST',
                    data: {
                        id_kecamatan: kecamatanId
                    },
                    success: function(response) {
                        var nagariOptions = '<option value="">Pilih Nagari</option>';
                        var nagariData = JSON.parse(response);

                        if (nagariData.length > 0) {
                            $.each(nagariData, function(index, nagari) {
                                nagariOptions += `<option value="${nagari.id}">${nagari.nama_nagari}</option>`;
                            });
                        }
                        nagariDropdown.html(nagariOptions);
                    }
                });
            } else {
                nagariDropdown.html('<option value="">Pilih Nagari</option>');
            }
        });

        $('.add-unit-btn-edit').on('click', function() {
            var targetContainer = $(this).data('target');
            var $container = $(targetContainer);
            var index = $container.children('.card').length;

            var newUnit = `
<div class="card p-3 mb-3">
    <h6>Unit ke-${index + 1}</h6>

    <div class="form-group">
        <label>Kecamatan</label>
        <select name="unit[${index}][kec_pasang]" class="form-control kecamatan-dropdown" required>
            <option value="">Pilih Kecamatan</option>
            ${kecamatanOptions}
        </select>
    </div>

    <div class="form-group">
        <label>Nagari</label>
        <select name="unit[${index}][id]" class="form-control nagari-dropdown" required>
            <option value="">Pilih Nagari</option>
        </select>
    </div>

    <div class="form-group">
        <label>Alamat Pasang</label>
        <input type="text" name="unit[${index}][alamat_pasang]" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Latitude</label>
        <input type="text" name="unit[${index}][lat]" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Longitude</label>
        <input type="text" name="unit[${index}][long]" class="form-control" required>
    </div>

    <button type="button" class="btn btn-danger btn-sm remove-unit float-right"><i class="fa fa-trash"></i> Hapus Unit</button>
</div>`;

            $container.append(newUnit);
        });

        // Handler hapus unit
        $(document).on('click', '.remove-unit', function() {
            $(this).closest('.card').remove();
        });
    });
</script>