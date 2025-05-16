<?php
foreach ($get_kecamatan as $kec) {
}
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href=""><i class="fa fa-file"></i> Rincian Tanah Ulayat Untuk Investasi</a>
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
                    <?php $kec = $get_kecamatan; ?>
                    <div class="card-header">
                        <i class="fa fa-table"></i> Kecamatan <?= $kec->kecamatan; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-hover" id="dataTables-example">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Lokasi</th>
                                        <th class="text-center">Luas Tanah</th>
                                        <th class="text-center">Status Kepemilikan</th>
                                        <th class="text-center">Jenis Investasi</th>
                                        <th class="text-center">Bentuk Kerjasama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tanah_ulayat->result() as $row) {
                                    ?>
                                        <tr class="odd gradeX">
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $row->lokasi; ?></td>
                                            <td class="text-center"><?= $row->luas; ?></td>
                                            <td class="text-center"><?= $row->status; ?></td>
                                            <td class="text-center"><?= $row->jenis; ?></td>
                                            <td class="text-center"><?= $row->bentuk; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->

    </div>
</body>