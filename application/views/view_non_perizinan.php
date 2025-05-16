<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href=""><i class="fa fa-file"></i> Standar Pelayanan Non Perizinan</a>
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
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Formulir dan Persyaratan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Jenis Izin</th>
                                    <th class="text-center align-middle">Dasar Hukum</th>
                                    <th class="text-center align-middle">Biaya</th>
                                    <th class="text-center align-middle">Lama Proses</th>
                                    <th class="text-center align-middle">Formulir</th>
                                    <th class="text-center align-middle">Persyaratan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($nonperizinan->result() as $row) {
                                ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->nama_izin; ?></td>
                                        <td class="text-center align-middle"><?= $row->hukum; ?></td>
                                        <td class="text-center align-middle"><?= $row->biaya; ?></td>
                                        <td class="text-center align-middle"><?= $row->lamaproses; ?></td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="<?= base_url(); ?>assets/fileupload/<?= $row->form; ?>" class="tombol-aksi" target="_blank">
                                                    <i class="fa fa-download "></i> Download
                                                </a>
                                            </div>
                                        </td>
                                        <td><?= $row->syarat; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
</body>