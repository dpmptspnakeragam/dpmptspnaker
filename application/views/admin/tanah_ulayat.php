<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- <hr>
                <h3 class="text-center">Kepala Dinas <br> Dari Masa Ke Masa</h3>
                <hr> -->
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-block btn-outline-danger" data-toggle="modal" data-target="#ModalTambahTanahUlayat">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <hr>
                        <div class="d-flex mb-3">
                            <div class="row">
                                <?php foreach ($kecamatan->result() as $row) : ?>
                                    <div class="col-lg-3 col-6 mb-3 text-center">
                                        <form action="<?= base_url('admin/tanah_ulayat/rincian/') ?><?= $row->id_kecamatan; ?>">
                                            <button class="btn btn-block btn-outline-danger p-3">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                <?= $row->kecamatan; ?>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Kecamatan</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($kecamatan->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->kecamatan; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url() ?>admin/tanah_ulayat/rincian/<?= $row->id_kecamatan; ?>" class="btn btn-outline-primary">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->