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

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Kategori</th>
                                    <th class="text-center align-middle">Judul</th>
                                    <!-- <th class="text-center align-middle">Rangkuman</th> -->
                                    <th class="text-center align-middle">Isi</th>
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Thumbnail</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($informasi->result() as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->kategori; ?></td>
                                        <td class="align-middle"><?= $row->judul_berita; ?></td>
                                        <!-- <td class="text-center align-middle"><?= $row->rangkuman; ?></td> -->
                                        <td class="align-middle"><?= $row->isi_berita; ?></td>
                                        <td class="text-center align-middle"><?= date('d-m-Y', strtotime($row->tgl_berita)); ?></td>
                                        <td class="text-center align-middle">
                                            <?php if (!empty($row->gambar) && file_exists(FCPATH . 'assets/imgupload/' . $row->gambar)) : ?>
                                                <a href="<?= base_url('assets/imgupload/') . $row->gambar; ?>" target="_blank">
                                                    <img src="<?= base_url('assets/imgupload/') . $row->gambar; ?>" class="elevation-2 img-thumbnail" style="max-width: 300px;">
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#EditInformasi<?= $row->id_berita; ?>" class="btn btn-outline-warning mt-1 mb-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#deleteInformasi<?= $row->id_berita; ?>" class="btn btn-outline-danger mt-1 mb-1">
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