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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahPegawai">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nama</th>
                                    <th class="text-center align-middle">Type NIP</th>
                                    <th class="text-center align-middle">NIP</th>
                                    <th class="text-center align-middle">Jabatan</th>
                                    <th class="text-center align-middle">Golongan</th>
                                    <th class="text-center align-middle">Alamat</th>
                                    <th class="text-center align-middle">Gambar</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($pegawai->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $row->no_urut; ?></td>
                                        <td class="text-center align-middle"><?= $row->nama; ?></td>
                                        <td class="text-center align-middle"><?= $row->jenis_nip; ?></td>
                                        <td class="text-center align-middle"><?= $row->nip; ?></td>
                                        <td class="text-center align-middle"><?= $row->jabatan; ?></td>
                                        <td class="text-center align-middle"><?= $row->golongan; ?></td>
                                        <td class="text-center align-middle"><?= $row->alamat; ?></td>
                                        <td class="text-center align-middle">
                                            <img src="<?= base_url(); ?>assets/imgupload/<?= $row->gambar; ?>" class="elevation-2  img-thumbnail" style="max-width: 300px;">
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditPegawai<?= $row->id_pegawai; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#deleteKadis<?= $row->id_pegawai; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

<?php foreach ($pegawai->result() as $row) : ?>
    <div class="modal fade" id="deleteKadis<?= $row->id_pegawai; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->nama; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/pegawai/hapus/' . $row->id_pegawai); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>