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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahPengaduan">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelDataPrint" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Nomor</th>
                                    <th class="text-center align-middle">Nama</th>
                                    <th class="text-center align-middle">Alamat</th>
                                    <th class="text-center align-middle">WhatsApp</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Jenis</th>
                                    <th class="text-center align-middle">Lokasi</th>
                                    <th class="text-center align-middle">Waktu</th>
                                    <th class="text-center align-middle">Uraian</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">File</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($pengaduan->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle "><?= $row->no_pengaduan; ?></td>
                                        <td class="text-center align-middle "><?= $row->nama; ?></td>
                                        <td class="text-center align-middle "><?= $row->alamat; ?></td>
                                        <td class="text-center align-middle "><?= $row->hp; ?></td>
                                        <td class="text-center align-middle "><?= $row->email; ?></td>
                                        <td class="text-center align-middle "><?= $row->jenis_pengaduan; ?></td>
                                        <td class="text-center align-middle "><?= $row->lokasi_kejadian; ?></td>
                                        <td class="text-center align-middle"><?= date('d-m-Y', strtotime($row->waktu_kejadian)); ?></td>
                                        <td class="text-center align-middle "><?= $row->materi_pengaduan; ?></td>
                                        <td class="text-center align-middle "><?= $row->status; ?></td>
                                        <td class="text-center align-middle ">
                                            <?php
                                            $file_path = base_url('assets/imgupload/') . $row->file_pengaduan;
                                            $server_file_path = FCPATH . 'assets/imgupload/' . $row->file_pengaduan; // Path file di server
                                            $file_extension = strtolower(pathinfo($row->file_pengaduan, PATHINFO_EXTENSION));
                                            $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']; // Daftar ekstensi file gambar

                                            // Periksa apakah file ada
                                            if (file_exists($server_file_path) && !empty($row->file_pengaduan)) {
                                                if (in_array($file_extension, $image_extensions)) : ?>
                                                    <a href="<?= $file_path; ?>" target="_blank">
                                                        <img src="<?= $file_path; ?>" alt="File_Pengaduan" class="elevation-2 img-thumbnail" style="max-width: 50px;">
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?= $file_path; ?>" class="btn btn-sm btn-outline-success" target="_blank">
                                                        <i class="fas fa-download"></i> Unduh
                                                    </a>
                                                <?php endif;
                                            } else { ?>
                                                <p class="text-muted">Tidak ada gambar atau file</p>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditPengaduan<?= $row->id_pengaduan; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#deletePengaduan<?= $row->id_pengaduan; ?>" class="btn btn-outline-danger mt-1 mb-1">
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

<?php foreach ($pengaduan->result() as $row) : ?>
    <div class="modal fade" id="deletePengaduan<?= $row->id_pengaduan; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <a href="<?= base_url('admin/pengaduan/hapus/' . $row->id_pengaduan); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>