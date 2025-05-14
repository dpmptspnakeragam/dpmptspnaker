<body class="bg-dark">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href=""><i class="fa fa-info"></i> Informasi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="content-wrapper informasi mt-5">
        <div class="container-fluid mb-0">
            <div class="row">
                <?php foreach ($berita->result() as $row) {
                    $gambar     = $row->gambar ?? '';
                    $imagePath  = FCPATH . 'assets/imgupload/' . $gambar;
                    $imageSrc   = (!empty($gambar) && file_exists($imagePath))
                        ? base_url('assets/imgupload/' . $gambar)
                        : base_url('assets/img/agam.jpg');
                ?>
                    <div class="col-lg-4 col-6 mt-4">
                        <div class="card kartu-info shadow">
                            <div class="card-header">
                                <h4><?= $row->judul_berita ?></h4>
                            </div>
                            <div class="card-body">
                                <small class="tgl_berita2 text-light mt-3 p-1"><?= date_indo($row->tgl_berita) ?>, Kategori : <?= $row->kategori; ?></small>
                                <img class="gambar-info img-responsive mt-3 mb-3" src="<?= $imageSrc; ?>" alt="<?= $row->judul_berita; ?>">
                                <small class="tgl_berita2 text-light mt-3 p-1">
                                    <a href="#" data-toggle="modal" data-target="#DetailInformasi<?php echo $row->id_berita; ?>">Selengkapnya >></a>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->

        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-lg-12 custom-pagination">
                    <?= $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</body>