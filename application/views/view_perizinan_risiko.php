<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href=""><i class="fa fa-file"></i> Standar Pelayanan Perizinan Berbasis Risiko</a>
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
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->

            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Prosedur
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators carousel-risiko">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="gambar-risiko img-thumbnail" src="<?= base_url() ?>assets/img/risiko_rendah.jpg?>" alt="Risiko Rendah">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="gambar-risiko img-thumbnail" src="<?= base_url() ?>assets/img/risiko_menengah_rendah.jpg?>" alt="Risiko Menengah Rendah">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="gambar-risiko img-thumbnail" src="<?= base_url() ?>assets/img/risiko_menengah_tinggi.jpg?>" alt="Risiko Menengah Tinggi">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="gambar-risiko img-thumbnail" src="<?= base_url() ?>assets/img/risiko_tinggi.jpg?>" alt="Risiko Tinggi">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon kontrol-risiko" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon kontrol-risiko" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Persyaratan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-dark text-light">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Jenis Risiko</th>
                                            <th class="text-center align-middle">Biaya</th>
                                            <th class="text-center align-middle">Lama Proses</th>
                                            <th class="text-center align-middle">Persyaratan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($perizinan->result() as $row) {
                                        ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $count++; ?></td>
                                                <td class="text-center align-middle"><?= $row->jenis; ?></td>
                                                <td class="text-center align-middle"><?= $row->biaya; ?></td>
                                                <td class="text-center align-middle"><?= $row->lamaproses; ?></td>
                                                <td class="text-center align-middle"><?= $row->syarat; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->

    </div>
</body>