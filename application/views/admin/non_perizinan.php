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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahNonPerizinan">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nama</th>
                                    <th class="text-center align-middle">Dasar Hukum</th>
                                    <th class="text-center align-middle">Biaya</th>
                                    <th class="text-center align-middle">Lama Proses</th>
                                    <th class="text-center align-middle">Formulir</th>
                                    <th class="text-center align-middle">Persyaratan</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($nonperizinan->result() as $row) : ?>
                                    <?php
                                    // path file di folder assets/fileupload/
                                    $file_path = FCPATH . 'assets/fileupload/' . $row->form;
                                    $file_exists = (!empty($row->form) && file_exists($file_path));
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->nama_izin; ?></td>
                                        <td class="text-center align-middle"><?= $row->hukum; ?></td>
                                        <td class="text-center align-middle"><?= $row->biaya; ?></td>
                                        <td class="text-center align-middle"><?= $row->lamaproses; ?></td>
                                        <td class="text-center align-middle">
                                            <?php if ($file_exists): ?>
                                                <a href="<?= base_url('assets/fileupload/' . $row->form); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->form; ?>">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            <?php else: ?>
                                                <span class="text-danger">File tidak ditemukan</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle"><?= $row->syarat; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditNonPerizinan<?= $row->id_izin; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#HapusNonPerizinan<?= $row->id_izin; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

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