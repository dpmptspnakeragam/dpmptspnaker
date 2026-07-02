<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $title; ?>
                        </h3>
                    </div>
                    <div class="card-body">

                        <?php if (empty($qr_survei)): ?>
                            <div class="d-flex mb-3">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                    data-target="#ModalTambahQR">
                                    <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                    Tambah Data
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($qr_survei)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="bg-maroon">
                                        <tr class="text-center">
                                            <th style="width: 5%">No</th>
                                            <th style="width: 20%">QR Code</th>
                                            <th>Link Survey</th>
                                            <th style="width: 15%">Status</th>
                                            <th style="width: 20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($qr_survei as $row): ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $no++; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php if (file_exists('./assets/imgupload/' . $row->qr_code) && !empty($row->qr_code)): ?>
                                                        <img src="<?= base_url('assets/imgupload/' . $row->qr_code); ?>"
                                                            alt="QR Code" class="img-thumbnail"
                                                            style="max-width: 100px; height: auto;">
                                                    <?php else: ?>
                                                        <span class="text-muted"><i class="fas fa-image"></i> File tidak ada</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="<?= $row->link_survey; ?>" target="_blank" class="text-break">
                                                        <?= $row->link_survey; ?> <i class="fas fa-external-link-alt fa-xs"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php if ($row->status == 'aktif'): ?>
                                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary px-3 py-2">Tidak Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEditQR<?= $row->id_survey; ?>"
                                                        class="btn btn-sm btn-outline-warning my-1">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalDeleteQR<?= $row->id_survey; ?>"
                                                        class="btn btn-sm btn-outline-danger my-1">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Data QR Survey belum ditemukan atau kosong!
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->