<body class="layout-top-nav layout-navbar-fixed bg-dark" style="height: auto;" id="page-top">
    <nav class="main-header navbar navbar-expand-md navbar-dark fixed-top navbar-white" style="background-color: maroon;">
        <div class="container-fluid">
            <a href="<?= base_url('skm/form'); ?>" class="navbar-brand">
                <span class="brand-text font-weight-light font-weight-bold"><i class="fas fa-file"></i> Form Survey Kepuasan Masyarakat (SKM)</span>
            </a>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link mt-2" data-widget="control-sidebar" data-slide="true" href="<?= base_url('skm'); ?>" role="button">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper mb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="margin-top: 33px;">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header text-center">
                                <p class="h5">
                                    <strong>
                                        Kuesioner Survey Kepuasan Masyarakat (SKM)
                                        <br>
                                        Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu
                                        <br>
                                        Kabupaten Agam
                                    </strong>
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form role="form" action="<?= base_url('skm/tambah_skm'); ?>" method="post">

                                            <?php foreach ($idmax_skm->result() as $row) : ?>
                                                <div class="form-group" hidden>
                                                    <label class=" control-label">Id</label>
                                                    <input type="text" class="form-control" id="id" name="id_skm" value="<?= $row->idmax_skm + 1; ?>">
                                                </div>
                                            <?php endforeach; ?>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama">Nama Lengkap</label>
                                                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama'); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="no_hp">Nomor Telepon</label>
                                                        <input class="form-control" type="number" name="no_hp" id="no_hp" placeholder="Masukan Nomor Telepon" value="<?= set_value('no_hp'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jk">
                                                            Jenis Kelamin
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <select id="jk" name="jk" class="form-control">
                                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                            <option value="1" <?= set_select('jk', '1', ($this->input->post('jk') == '1')); ?>>Laki-Laki</option>
                                                            <option value="2" <?= set_select('jk', '2', ($this->input->post('jk') == '2')); ?>>Perempuan</option>
                                                        </select>
                                                        <small class="text-danger"><?= form_error('jk'); ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="persyaratan">
                                                            Usia
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="umur" placeholder="Masukan Usia" aria-label="Username" aria-describedby="basic-addon1" value="<?= set_value('umur'); ?>">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Tahun</span>
                                                            </div>
                                                        </div>
                                                        <small class="text-danger"><?= form_error('umur'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pendidikan">
                                                            Pendidikan
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <select id="pendidikan" name="pendidikan" class="form-control">
                                                            <option value="" selected disabled>Pilih Pendidikan</option>
                                                            <option value="1" <?= set_select('pendidikan', '1', ($this->input->post('pendidikan') == '1')); ?>>SD</option>
                                                            <option value="2" <?= set_select('pendidikan', '2', ($this->input->post('pendidikan') == '2')); ?>>SMP</option>
                                                            <option value="3" <?= set_select('pendidikan', '3', ($this->input->post('pendidikan') == '3')); ?>>SMA</option>
                                                            <option value="4" <?= set_select('pendidikan', '4', ($this->input->post('pendidikan') == '4')); ?>>DI/DII/DIII</option>
                                                            <option value="5" <?= set_select('pendidikan', '5', ($this->input->post('pendidikan') == '5')); ?>>DIV/S1</option>
                                                            <option value="6" <?= set_select('pendidikan', '6', ($this->input->post('pendidikan') == '6')); ?>>S2</option>
                                                        </select>
                                                        <small class="text-danger"><?= form_error('pendidikan'); ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pekerjaan">
                                                            Pekerjaan
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <select id="pekerjaan" name="pekerjaan" class="form-control">
                                                            <option value="" selected disabled>Pilih Pekerjaan</option>
                                                            <option value="1" <?= set_select('pekerjaan', '1', ($this->input->post('pekerjaan') == '1')); ?>>PNS</option>
                                                            <option value="2" <?= set_select('pekerjaan', '2', ($this->input->post('pekerjaan') == '2')); ?>>TNI</option>
                                                            <option value="3" <?= set_select('pekerjaan', '3', ($this->input->post('pekerjaan') == '3')); ?>>POLRI</option>
                                                            <option value="4" <?= set_select('pekerjaan', '4', ($this->input->post('pekerjaan') == '4')); ?>>Swasta</option>
                                                            <option value="5" <?= set_select('pekerjaan', '5', ($this->input->post('pekerjaan') == '5')); ?>>Wirausaha</option>
                                                            <option value="6" <?= set_select('pekerjaan', '6', ($this->input->post('pekerjaan') == '6')); ?>>Lainnya</option>
                                                        </select>
                                                        <small class="text-danger"><?= form_error('pekerjaan'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_layanan">
                                                    Jenis Layanan yang diterima
                                                    <small class="text-danger">*</small>
                                                </label>
                                                <input type="text" class="form-control" name="layanan" placeholder="Masukan Jenis layanan yang diterima" value="<?= set_value('layanan'); ?>">
                                                <small class="text-danger mb-0"><?= form_error('layanan'); ?></small>
                                                <small>Contoh: <span class="font-italic font-weight-bold">PBG, SIP Bidan, Izin Penelitian, dll.</span></small>
                                            </div>

                                            <hr>
                                            <p class="text-center"> PENDAPAT ANDA TENTANG PELAYANAN PUBLIK </P>
                                            <hr>

                                            <div class="form-group">
                                                <label for="U1">1. Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya ?</label>
                                                <select id="U1" name="u1" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u1', '4', ($this->input->post('u1') == '4')); ?>>Sangat Sesuai</option>
                                                    <option value="3" <?= set_select('u1', '3', ($this->input->post('u1') == '3')); ?>>Sesuai</option>
                                                    <option value="2" <?= set_select('u1', '2', ($this->input->post('u1') == '2')); ?>>Kurang Sesuai</option>
                                                    <option value="1" <?= set_select('u1', '1', ($this->input->post('u1') == '1')); ?>>Tidak Sesuai</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u1'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U2">2. Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini ?</label>
                                                <select id="U2" name="u2" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u2', '4', ($this->input->post('u2') == '4')); ?>>Sangat Mudah</option>
                                                    <option value="3" <?= set_select('u2', '3', ($this->input->post('u2') == '3')); ?>>Mudah</option>
                                                    <option value="2" <?= set_select('u2', '2', ($this->input->post('u2') == '2')); ?>>Kurang Mudah</option>
                                                    <option value="1" <?= set_select('u2', '1', ($this->input->post('u2') == '1')); ?>>Tidak Mudah</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u2'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U3">3. Bagaimana pemahaman Saudara tentang kecepatan waktu dalam memberikan pelayanan ?</label>
                                                <select id="U3" name="u3" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u3', '4', ($this->input->post('u3') == '4')); ?>>Sangat Cepat</option>
                                                    <option value="3" <?= set_select('u3', '3', ($this->input->post('u3') == '3')); ?>>Cepat</option>
                                                    <option value="2" <?= set_select('u3', '2', ($this->input->post('u3') == '2')); ?>>Kurang Cepat</option>
                                                    <option value="1" <?= set_select('u3', '1', ($this->input->post('u3') == '1')); ?>>Tidak Cepat</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u3'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U4">4. Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan ?</label>
                                                <select id="U4" name="u4" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u4', '4', ($this->input->post('u4') == '4')); ?>>Gratis</option>
                                                    <option value="3" <?= set_select('u4', '3', ($this->input->post('u4') == '3')); ?>>Murah</option>
                                                    <option value="2" <?= set_select('u4', '2', ($this->input->post('u4') == '2')); ?>>Cukup Mahal</option>
                                                    <option value="1" <?= set_select('u4', '1', ($this->input->post('u4') == '1')); ?>>Sangat Mahal</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u4'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U5">5. Bagaimana pendapat Saudara tentang kesesuaian pelayanan yang tercantum dalam standar pelayanan dengan hasil yang diberikan ?</label>
                                                <select id="U5" name="u5" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u5', '4', ($this->input->post('u5') == '4')); ?>>Sangat Sesuai</option>
                                                    <option value="3" <?= set_select('u5', '3', ($this->input->post('u5') == '3')); ?>>Sesuai</option>
                                                    <option value="2" <?= set_select('u5', '2', ($this->input->post('u5') == '2')); ?>>Kurang Sesuai</option>
                                                    <option value="1" <?= set_select('u5', '1', ($this->input->post('u5') == '1')); ?>>Tidak Sesuai</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u5'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U6">6. Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan ?</label>
                                                <select id="U6" name="u6" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u6', '4', ($this->input->post('u6') == '4')); ?>>Sangat Kompeten</option>
                                                    <option value="3" <?= set_select('u6', '3', ($this->input->post('u6') == '3')); ?>>Kompeten</option>
                                                    <option value="2" <?= set_select('u6', '2', ($this->input->post('u6') == '2')); ?>>Kurang Kompeten</option>
                                                    <option value="1" <?= set_select('u6', '1', ($this->input->post('u6') == '1')); ?>>Tidak Kompeten</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u6'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U7">7. Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan ?</label>
                                                <select id="U7" name="u7" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u7', '4', ($this->input->post('u7') == '4')); ?>>Sangat Sopan & Ramah</option>
                                                    <option value="3" <?= set_select('u7', '3', ($this->input->post('u7') == '3')); ?>>Sopan & Ramah</option>
                                                    <option value="2" <?= set_select('u7', '2', ($this->input->post('u7') == '2')); ?>>Kurang Sopan & Ramah</option>
                                                    <option value="1" <?= set_select('u7', '1', ($this->input->post('u7') == '1')); ?>>Tidak Sopan & Ramah</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u7'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U8">8. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan ?</label>
                                                <select id="U8" name="u8" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u8', '4', ($this->input->post('u8') == '4')); ?>>Dikelola Dengan Baik</option>
                                                    <option value="3" <?= set_select('u8', '3', ($this->input->post('u8') == '3')); ?>>Berfungsi Kurang Maksimal</option>
                                                    <option value="2" <?= set_select('u8', '2', ($this->input->post('u8') == '2')); ?>>Ada Tetapi Tidak Berfungsi</option>
                                                    <option value="1" <?= set_select('u8', '1', ($this->input->post('u8') == '1')); ?>>Tidak Ada</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u8'); ?></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="U9">9. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana ?</label>
                                                <select id="U9" name="u9" class="form-control">
                                                    <option value="" selected disabled>Pilih Pendapat</option>
                                                    <option value="4" <?= set_select('u9', '4', ($this->input->post('u9') == '4')); ?>>Sangat Baik</option>
                                                    <option value="3" <?= set_select('u9', '3', ($this->input->post('u9') == '3')); ?>>Baik</option>
                                                    <option value="2" <?= set_select('u9', '2', ($this->input->post('u9') == '2')); ?>>Cukup Baik</option>
                                                    <option value="1" <?= set_select('u9', '1', ($this->input->post('u9') == '1')); ?>>Kurang Baik</option>
                                                </select>
                                                <small class="text-danger"><?= form_error('u9'); ?></small>
                                            </div>

                                            <div class="form-group" hidden>
                                                <input type="hidden" class="form-control" name="date" value="<?= date("Y-m-d H:i:s"); ?>">
                                            </div>

                                            <hr>
                                            <p class="text-center"> PENDAPAT ANDA TENTANG PERSEPSI KUALITAS PELAYANAN (SPKP) </p>
                                            <hr>

                                            <?php foreach ($idmax_rating->result() as $row) : ?>
                                                <div class="form-group" hidden>
                                                    <label class="control-label">Id</label>
                                                    <input type="text" class="form-control" id="id" name="id_spkp" value="<?= $row->idmax_rating + 1; ?>">
                                                </div>
                                            <?php endforeach; ?>

                                            <small class="font-italic font-weight-bold">Berikan nilai bintang antara 1-6 pada setiap pernyataan, dimana semakin banyak bintang menunjukan bahwa Bapak/Ibu semakin setuju bahwa kualitas pelayanan pada unit layanan ini semakin baik:</small>
                                            <div class="form-group mt-2">
                                                <span>1. Informasi pelayanan pada unit layanan ini tersedia melalui media sosial elektronik maupun non elektronik.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z1">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z1'); ?></small>
                                                <input type="hidden" name="rating_z1" value="<?= set_value('rating_z1'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>2. Persyaratan pelayanan yang diinformasikan sesuai dengan persyaratan yang ditetapkan unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z2">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z2'); ?></small>
                                                <input type="hidden" name="rating_z2" value="<?= set_value('rating_z2'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>3. Prosedur/Alur pelayanan yang ditetapkan unit layanan ini mudah diikuti/dilakukan.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z3">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z3'); ?></small>
                                                <input type="hidden" name="rating_z3" value="<?= set_value('rating_z3'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>4. Jangka waktu penyelesaian pelayanan yang diterima Bapak/Ibu sesuai dengan yang ditetapkan unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z4">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z4'); ?></small>
                                                <input type="hidden" name="rating_z4" value="<?= set_value('rating_z4'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>5. Tarif/Biaya pelayanan yang dibayarkan pada unit layanan ini sesuai dengan tarif/biaya yang ditetapkan.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z5">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z5'); ?></small>
                                                <input type="hidden" name="rating_z5" value="<?= set_value('rating_z5'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>6. Sarana prasarana pendukung pelayanan/sistem pelayanan online yang disediakan unit layanan ini memberikan kenyamanan/mudah digunakan.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z6">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z6'); ?></small>
                                                <input type="hidden" name="rating_z6" value="<?= set_value('rating_z6'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>7. Petugas pelayanan/sistem pelayanan online pada unit layanan ini merespon keperluan Bapak/Ibu dengan cepat.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z7">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z7'); ?></small>
                                                <input type="hidden" name="rating_z7" value="<?= set_value('rating_z7'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>8. Layanan konsultasi dan pengaduan yang disediakan unit layanan ini mudah digunakan/diakses.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_z8">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_z8'); ?></small>
                                                <input type="hidden" name="rating_z8" value="<?= set_value('rating_z8'); ?>">
                                            </div>

                                            <hr>
                                            <p class="text-center"> PENDAPAT ANDA TENTANG PERSEPSI ANTI KORUPSI </p>
                                            <hr>

                                            <?php foreach ($idmax_spak->result() as $row) : ?>
                                                <div class="form-group" hidden>
                                                    <label class="control-label">Id</label>
                                                    <input type="text" class="form-control" id="id" name="id_spak" value="<?= $row->idmax_spak + 1; ?>">
                                                </div>
                                            <?php endforeach; ?>

                                            <small class="font-italic font-weight-bold">Berikan nilai bintang antara 1 - 6 pada setiap pernyataan, dimana semakin banyak bintang menunjukan bahwa Bapak/Ibu semakin setuju bahwa kualitas pelayanan pada unit layanan ini semakin baik:</small>
                                            <div class="form-group mt-2">
                                                <span>1. Tidak ada deskriminasi pelayanan pada unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_r1">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_r1'); ?></small>
                                                <input type="hidden" name="rating_r1" value="<?= set_value('rating_r1'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>2. Tidak ada pelayanan diluar prosedur/kecurangan pelayanan pada unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_r2">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_r2'); ?></small>
                                                <input type="hidden" name="rating_r2" value="<?= set_value('rating_r2'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>3. Tidak ada penerimaan imbalan uang/barang/fasilitas diluar ketentuan yang berlaku pada unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_r3">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_r3'); ?></small>
                                                <input type="hidden" name="rating_r3" value="<?= set_value('rating_r3'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span class="overflow-auto">4. Tidak ada pungutan liar (pungli) pada unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_r4">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_r4'); ?></small>
                                                <input type="hidden" name="rating_r4" value="<?= set_value('rating_r4'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <span>5. Tidak ada percaloan/perantara tidak resmi pada unit layanan ini.</span>
                                                <br>
                                                <div class="stars" data-rating="rating_r5">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                    <i class="far fa-star" data-value="6"></i>
                                                </div>
                                                <small class="text-danger"><?= form_error('rating_r5'); ?></small>
                                                <input type="hidden" name="rating_r5" value="<?= set_value('rating_r5'); ?>">
                                            </div>
                                            <!-- <a href="<?= base_url('skm'); ?>" class="btn btn-secondary">Batal</a> -->
                                            <button type="submit" class="btn-survey mt-2">
                                                Kirim Survey
                                                <i class="fa fa-file-import"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>