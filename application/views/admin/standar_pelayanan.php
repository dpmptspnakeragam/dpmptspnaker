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

                        <?php if (empty($pdf)) : ?>
                            <div class="d-flex mb-3">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahSP">
                                    <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                    Tambah Data
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- start: Display PDF -->
                        <?php if (!empty($pdf)) : ?>
                            <?php foreach ($pdf as $file) : ?>
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title">Nama File: <?= $file->title; ?></h3>
                                    </div>
                                    <div class="card-body text-center">
                                        <?php if (file_exists('./assets/fileupload/' . $file->file_name)) : ?>
                                            <embed src="<?= base_url('assets/fileupload/' . $file->file_name); ?>" type="application/pdf" width="100%" height="600px">
                                        <?php else : ?>
                                            <p>File PDF tidak tersedia.</p>
                                        <?php endif; ?>
                                        <br>

                                        <button type="button" data-toggle="modal" data-target="#EditSP<?= $file->id_sp; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" data-toggle="modal" data-target="#deleteSP<?= $file->id_sp; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="alert alert-warning" role="alert">
                                PDF Standar Pelayanan tidak ditemukan !!
                            </div>
                        <?php endif; ?>
                        <!--end: Display PDF -->
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

<?php foreach ($pdf as $file) : ?>
    <div class="modal fade" id="deleteSP<?= $file->id_sp; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus file <strong class="font-weight-bold text-maroon"><?= $file->title; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/standar_pelayanan/hapus/' . $file->id_sp); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>