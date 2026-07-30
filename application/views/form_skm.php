<!-- ... existing code ... -->

<body class="layout-top-nav layout-navbar-fixed bg-light" style="height: auto;" id="page-top">
    <!-- Navigation-->
    <nav class="main-header navbar navbar-expand-md navbar-dark fixed-top shadow-sm" style="background-color: maroon;">
        <div class="container-fluid">
            <a href="<?= base_url('skm/form'); ?>" class="navbar-brand">
                <span class="brand-text font-weight-bold"><i class="fas fa-file-signature mr-2"></i> Form Survei SPKP & SPAK</span>
            </a>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="<?= base_url('skm'); ?>" role="button">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <style>
        .question-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .stars i {
            cursor: pointer;
            color: #ccc;
            font-size: 1.5rem;
            margin-right: 5px;
            transition: color 0.2s;
        }

        .stars i:hover,
        .stars i.active {
            color: #ffc107;
        }
    </style>

    <div class="content-wrapper pt-5">

        <!-- Main content -->
        <div class="content mt-4">
            <div class="container-fluid px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-12 mb-4">

                        <div class="card card-outline card-danger shadow-sm border-maroon" style="border-top-width: 3px;">
                            <div class="card-header text-center bg-white pt-4 pb-3">
                                <h4 class="font-weight-bold text-maroon mb-1 text-uppercase">Kuesioner SPKP & SPAK</h4>
                                <!-- <h6 class="text-muted mb-0">Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu Kabupaten Agam</h6> -->
                            </div>

                            <div class="card-body bg-light">
                                <?= form_open('skm/tambah_skm'); ?>
                                <input type="hidden" class="form-control" name="date" value="<?= date("Y-m-d H:i:s"); ?>">

                                <!-- BAGIAN 1: DATA RESPONDEN -->
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-maroon text-white">
                                        <h5 class="mb-0 font-weight-bold"><i class="fas fa-user-edit mr-2"></i> Data Responden</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama"><i class="fas fa-user text-muted mr-1"></i> Nama Lengkap</label>
                                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_hp"><i class="fas fa-phone-alt text-muted mr-1"></i> Nomor Telepon</label>

                                                    <input class="form-control" type="text" name="no_hp" id="no_hp"
                                                        placeholder="Contoh: 0812..."
                                                        value="<?= set_value('no_hp', '08'); ?>"
                                                        maxlength="13" autocomplete="off">

                                                    <small class="text-danger" id="error_no_hp" style="display:none;">Nomor wajib diawali 08</small>
                                                </div>
                                            </div>

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

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="jk"><i class="fas fa-venus-mars text-muted mr-1"></i> Jenis Kelamin <small class="text-danger">*</small></label>
                                                    <select id="jk" name="jk" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                        <option value="1" <?= set_select('jk', '1'); ?>>Laki-Laki</option>
                                                        <option value="2" <?= set_select('jk', '2'); ?>>Perempuan</option>
                                                    </select>
                                                    <small class="text-danger font-weight-bold"><?= form_error('jk'); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="umur"><i class="fas fa-calendar-alt text-muted mr-1"></i> Usia <small class="text-danger">*</small></label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="umur" placeholder="Masukan Usia" value="<?= set_value('umur'); ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-white">Tahun</span>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger font-weight-bold"><?= form_error('umur'); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pendidikan"><i class="fas fa-graduation-cap text-muted mr-1"></i> Pendidikan <small class="text-danger">*</small></label>
                                                    <select id="pendidikan" name="pendidikan" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Pendidikan</option>
                                                        <option value="1" <?= set_select('pendidikan', '1'); ?>>SD</option>
                                                        <option value="2" <?= set_select('pendidikan', '2'); ?>>SMP</option>
                                                        <option value="3" <?= set_select('pendidikan', '3'); ?>>SMA</option>
                                                        <option value="4" <?= set_select('pendidikan', '4'); ?>>DI/DII/DIII</option>
                                                        <option value="5" <?= set_select('pendidikan', '5'); ?>>DIV/S1</option>
                                                        <option value="6" <?= set_select('pendidikan', '6'); ?>>S2</option>
                                                    </select>
                                                    <small class="text-danger font-weight-bold"><?= form_error('pendidikan'); ?></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pekerjaan"><i class="fas fa-briefcase text-muted mr-1"></i> Pekerjaan <small class="text-danger">*</small></label>
                                                    <select id="pekerjaan" name="pekerjaan" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Pekerjaan</option>
                                                        <option value="1" <?= set_select('pekerjaan', '1'); ?>>PNS</option>
                                                        <option value="2" <?= set_select('pekerjaan', '2'); ?>>TNI</option>
                                                        <option value="3" <?= set_select('pekerjaan', '3'); ?>>POLRI</option>
                                                        <option value="4" <?= set_select('pekerjaan', '4'); ?>>Swasta</option>
                                                        <option value="5" <?= set_select('pekerjaan', '5'); ?>>Wirausaha</option>
                                                        <option value="6" <?= set_select('pekerjaan', '6'); ?>>Lainnya</option>
                                                    </select>
                                                    <small class="text-danger font-weight-bold"><?= form_error('pekerjaan'); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="layanan"><i class="fas fa-concierge-bell text-muted mr-1"></i> Jenis Layanan Diterima <small class="text-danger">*</small></label>
                                                    <input type="text" class="form-control" name="layanan" placeholder="Masukan Jenis Layanan" value="<?= set_value('layanan'); ?>">
                                                    <small class="text-danger font-weight-bold d-block mb-1"><?= form_error('layanan'); ?></small>
                                                    <small class="text-muted">Contoh: <span class="font-italic">PBG, SIP Bidan, Izin Penelitian, dll.</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BAGIAN 2: SPKP -->
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-maroon text-white">
                                        <h5 class="mb-0 font-weight-bold"><i class="fas fa-star mr-2 text-white"></i> Survei Persepsi Kualitas Pelayanan (SPKP)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert no-auto-hide alert-light border border-maroon text-maroon mb-4">
                                            <i class="fas fa-info-circle mr-2"></i> <small class="font-weight-bold">Berikan nilai bintang (1-6). Semakin banyak bintang, menunjukan Bapak/Ibu semakin setuju pelayanan semakin baik.</small>
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">1. Informasi pelayanan pada unit layanan ini tersedia melalui media sosial elektronik maupun non elektronik.</p>
                                            <div class="stars" data-rating="rating_z1">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z1'); ?></small>
                                            <input type="hidden" name="rating_z1" value="<?= set_value('rating_z1'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">2. Persyaratan pelayanan yang diinformasikan sesuai dengan persyaratan yang ditetapkan unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_z2">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z2'); ?></small>
                                            <input type="hidden" name="rating_z2" value="<?= set_value('rating_z2'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">3. Prosedur/Alur pelayanan yang ditetapkan unit layanan ini mudah diikuti/dilakukan.</p>
                                            <div class="stars" data-rating="rating_z3">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z3'); ?></small>
                                            <input type="hidden" name="rating_z3" value="<?= set_value('rating_z3'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">4. Jangka waktu penyelesaian pelayanan yang diterima Bapak/Ibu sesuai dengan yang ditetapkan unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_z4">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z4'); ?></small>
                                            <input type="hidden" name="rating_z4" value="<?= set_value('rating_z4'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">5. Tarif/Biaya pelayanan yang dibayarkan pada unit layanan ini sesuai dengan tarif/biaya yang ditetapkan.</p>
                                            <div class="stars" data-rating="rating_z5">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z5'); ?></small>
                                            <input type="hidden" name="rating_z5" value="<?= set_value('rating_z5'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">6. Sarana prasarana pendukung pelayanan/sistem pelayanan online yang disediakan memberikan kenyamanan/mudah digunakan.</p>
                                            <div class="stars" data-rating="rating_z6">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z6'); ?></small>
                                            <input type="hidden" name="rating_z6" value="<?= set_value('rating_z6'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">7. Petugas pelayanan/sistem pelayanan online merespon keperluan Bapak/Ibu dengan cepat.</p>
                                            <div class="stars" data-rating="rating_z7">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z7'); ?></small>
                                            <input type="hidden" name="rating_z7" value="<?= set_value('rating_z7'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">8. Layanan konsultasi dan pengaduan yang disediakan unit layanan ini mudah digunakan/diakses.</p>
                                            <div class="stars" data-rating="rating_z8">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_z8'); ?></small>
                                            <input type="hidden" name="rating_z8" value="<?= set_value('rating_z8'); ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- BAGIAN 3: SPAK -->
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-maroon text-white">
                                        <h5 class="mb-0 font-weight-bold"><i class="fas fa-shield-alt mr-2"></i> Survei Persepsi Anti Korupsi (SPAK)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert no-auto-hide alert-light border border-maroon text-maroon mb-4">
                                            <i class="fas fa-info-circle mr-2"></i> <small class="font-weight-bold">Berikan nilai bintang (1-6). Semakin banyak bintang, menunjukan Bapak/Ibu semakin setuju pelayanan terbebas dari korupsi.</small>
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">1. Tidak ada deskriminasi pelayanan pada unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_r1">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_r1'); ?></small>
                                            <input type="hidden" name="rating_r1" value="<?= set_value('rating_r1'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">2. Tidak ada pelayanan diluar prosedur/kecurangan pelayanan pada unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_r2">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_r2'); ?></small>
                                            <input type="hidden" name="rating_r2" value="<?= set_value('rating_r2'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">3. Tidak ada penerimaan imbalan uang/barang/fasilitas diluar ketentuan yang berlaku pada unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_r3">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_r3'); ?></small>
                                            <input type="hidden" name="rating_r3" value="<?= set_value('rating_r3'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">4. Tidak ada pungutan liar (pungli) pada unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_r4">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_r4'); ?></small>
                                            <input type="hidden" name="rating_r4" value="<?= set_value('rating_r4'); ?>">
                                        </div>

                                        <div class="question-box">
                                            <p class="font-weight-bold mb-2">5. Tidak ada percaloan/perantara tidak resmi pada unit layanan ini.</p>
                                            <div class="stars" data-rating="rating_r5">
                                                <i class="far fa-star" data-value="1"></i> <i class="far fa-star" data-value="2"></i> <i class="far fa-star" data-value="3"></i> <i class="far fa-star" data-value="4"></i> <i class="far fa-star" data-value="5"></i> <i class="far fa-star" data-value="6"></i>
                                            </div>
                                            <small class="text-danger font-weight-bold"><?= form_error('rating_r5'); ?></small>
                                            <input type="hidden" name="rating_r5" value="<?= set_value('rating_r5'); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="<?= base_url('skm'); ?>" class="btn-outline-secondary btn-lg px-4">
                                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn-outline-maroon btn-lg px-4">
                                        <i class="fas fa-paper-plane mr-1"></i> Kirim Survei
                                    </button>
                                </div>
                                </form>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- ... existing code ... -->