<?php foreach ($pengaturan->result() as $row) {
}
?>
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
                            <button type="button" class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#EditPengaturan<?= $row->id_setting; ?>">
                                <i class="fa fa-edit p-1" aria-hidden="true"></i>
                                Edit Data
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Sejarah</h3>
                                    </div>
                                    <div class="card-body">
                                        <span><?= $row->sejarah; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Visi</h3>
                                    </div>
                                    <div class="card-body">
                                        <span><?= $row->visi; ?></span>
                                    </div>
                                </div>
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Misi</h3>
                                    </div>
                                    <div class="card-body">
                                        <span><?= $row->misi; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Tugas</h3>
                                    </div>
                                    <div class="card-body">
                                        <span><?= $row->tugas; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">fungsi</h3>
                                    </div>
                                    <div class="card-body">
                                        <span><?= $row->fungsi; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Struktur Organisasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?= base_url('assets/imgupload/') . $row->struktur; ?>" target="_blank">
                                            <img src="<?= base_url('assets/imgupload/') . $row->struktur; ?>" style="width:100%;" class="elevation-1 img-thumbnail">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Maklumat Pelayanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?= base_url('assets/imgupload/') . $row->maklumat; ?>" target="_blank">
                                            <img src="<?= base_url('assets/imgupload/') . $row->maklumat; ?>" style="width:100%;" class="elevation-1 img-thumbnail">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->