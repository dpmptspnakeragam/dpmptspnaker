<body class="bg-dark">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href=""><i class="fa fa-users"></i> Pegawai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="tutup" href="<?= base_url(); ?>home"><i class="fa fa-arrow-left"></i> Kembali</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-wrapper informasi mt-5 pt-4">
        <div class="container mb-0">
            <div class="row modal-pelayanan">
                <?php foreach ($view_pegawai->result() as $row2) {
                    ?>
                    <div class="col-sm-12 col-md-4 col-lg-4 col-6 mb-3">
                        <div class="card-body shadow bg-light card-kabid">
                            <img class="img-responsive img-kabid"
                                src="<?= base_url() ?>assets/imgupload/<?= $row2->gambar; ?>" alt="<?= $row2->nama; ?>">
                            <p class="display-4 nama-kabid mt-3"><b>
                                    <?= $row2->nama; ?>
                                </b></p>
                            <p>NIP.
                                <?= $row2->nip; ?><br><b>
                                    <?= $row2->jabatan; ?>
                                </b><br>
                                <?= $row2->alamat; ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
</body>