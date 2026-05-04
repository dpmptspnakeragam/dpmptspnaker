<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Informasi Tersedia Setiap Saat -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Tersedia Setiap Saat</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahITSS">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <th class="text-center align-middle">Dokumen</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($itss->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->judul; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/fileupload/' . $row->file); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->file; ?>">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditITSS<?= $row->id_ppid; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteITSS<?= $row->id_ppid; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($itss->result() as $row) : ?>
                            <div class="modal fade" id="ModalDeleteITSS<?= $row->id_ppid; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Informasi Tersedia Setiap Saat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->judul; ?></strong> ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                            <a href="<?= base_url('admin/ppid/hapus_data/' . $row->id_ppid); ?>" class="btn btn-outline-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- Informasi Berkala -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Berkala</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahIB">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData2" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <th class="text-center align-middle">Dokumen</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($ib->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->judul; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/fileupload/' . $row->file); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->file; ?>">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditIB<?= $row->id_ppid; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteIB<?= $row->id_ppid; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($ib->result() as $row) : ?>
                            <div class="modal fade" id="ModalDeleteIB<?= $row->id_ppid; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Informasi Berkala</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->judul; ?></strong> ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                            <a href="<?= base_url('admin/ppid/hapus_data/' . $row->id_ppid); ?>" class="btn btn-outline-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- Informasi Serta Merta -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Serta Merta</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahISM">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData3" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <th class="text-center align-middle">Dokumen</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($ism->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->judul; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/fileupload/' . $row->file); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->file; ?>">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditISM<?= $row->id_ppid; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteISM<?= $row->id_ppid; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($ism->result() as $row) : ?>
                            <div class="modal fade" id="ModalDeleteISM<?= $row->id_ppid; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Informasi Serta Merta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->judul; ?></strong> ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                            <a href="<?= base_url('admin/ppid/hapus_data/' . $row->id_ppid); ?>" class="btn btn-outline-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- Informasi Dikecualikan -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Dikecualikan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahID">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData4" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <th class="text-center align-middle">Dokumen</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($id->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->judul; ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/fileupload/' . $row->file); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->file; ?>">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#ModalEditID<?= $row->id_ppid; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#ModalDeleteID<?= $row->id_ppid; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach ($id->result() as $row) : ?>
                            <div class="modal fade" id="ModalDeleteID<?= $row->id_ppid; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Informasi Dikecualikan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->judul; ?></strong> ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                            <a href="<?= base_url('admin/ppid/hapus_data/' . $row->id_ppid); ?>" class="btn btn-outline-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

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