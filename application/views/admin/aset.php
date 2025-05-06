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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahAset">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Kode Barang</th>
                                    <th class="text-center align-middle">Kode Rekening</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">No. Register</th>
                                    <th class="text-center align-middle">Tahun Pembelian</th>
                                    <th class="text-center align-middle">Asal Usul</th>
                                    <th class="text-center align-middle">Kondisi Barang</th>
                                    <th class="text-center align-middle">Nilai Aset</th>
                                    <th class="text-center align-middle">Pemakai</th>
                                    <th class="text-center align-middle">Foto Barang</th>
                                    <th class="text-center align-middle">QRCODE</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($aset->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->kode_brg; ?></td>
                                        <td class="text-center align-middle"><?= $row->kode_rekening; ?></td>
                                        <td class="text-center align-middle"><?= $row->nama_brg; ?></td>
                                        <td class="text-center align-middle"><?= $row->no_register; ?></td>
                                        <td class="text-center align-middle"><?= $row->tahun_beli; ?></td>
                                        <td class="text-center align-middle"><?= $row->asal_usul; ?></td>
                                        <td class="text-center align-middle"><?= $row->kondisi_brg; ?></td>
                                        <td class="text-center align-middle"><?= $row->nilai_aset; ?></td>
                                        <td class="text-center align-middle"><?= $row->pemakai; ?></td>

                                        <td class="text-center align-middle">
                                            <img src="<?= base_url('assets/imgupload/') . $row->foto_brg; ?>" class="elevation-2 img-size-64 img-thumbnail">
                                        </td>
                                        <td class="text-center align-middle">
                                            <img src="<?= base_url('assets/qr/') . $row->qrcode; ?>" class="elevation-2 img-size-64 img-thumbnail">
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditAset<?= $row->id_aset; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#deleteAset<?= $row->id_aset; ?>" class="btn btn-outline-danger mt-1 mb-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <a href="<?= base_url('assets/qr/' . $row->qrcode); ?>" class="btn btn-outline-success mt-1 mb-1" download="<?= $row->qrcode; ?>">
                                                <i class="fas fa-qrcode"></i> Download
                                            </a>
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

<?php foreach ($aset->result() as $row) : ?>
    <div class="modal fade" id="deleteAset<?= $row->id_aset; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <strong class="font-weight-bold text-maroon"><?= $row->nama_brg; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('admin/aset/hapus/' . $row->id_aset); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>