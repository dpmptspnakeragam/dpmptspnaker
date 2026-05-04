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
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahKadis">
                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                Tambah Data
                            </button>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">No Izin</th>
                                    <th class="text-center align-middle">Nama Perusahaan</th>
                                    <th class="text-center align-middle">Alamat Perusahaan</th>
                                    <th class="text-center align-middle">Jenis Reklame</th>
                                    <th class="text-center align-middle">Ukuran</th>
                                    <th class="text-center align-middle">Pemohon</th>
                                    <th class="text-center align-middle">No. HP</th>
                                    <th class="text-center align-middle">Foto</th>
                                    <th class="text-center align-middle">Pajak</th>
                                    <th class="text-center align-middle">Keterangan</th>
                                    <th class="text-center align-middle">Tanggal Pasang</th>
                                    <th class="text-center align-middle">Masa Berlaku</th>
                                    <th class="text-center align-middle">Daftar Lokasi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_reklame as $row) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $row->no_izin ?></td>
                                        <td class="text-center align-middle"><?= $row->nama_perusahaan ?></td>
                                        <td class="text-center align-middle"><?= $row->alamat_perusahaan ?></td>
                                        <td class="text-center align-middle"><?= $row->jenis_reklame ?></td>
                                        <td class="text-center align-middle"><?= $row->ukuran ?></td>
                                        <td class="text-center align-middle"><?= $row->pemohon ?></td>
                                        <td class="text-center align-middle"><?= $row->no_hp ?></td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url(); ?>assets/imgupload/<?= $row->foto ?>" data-lightbox="photos">
                                                <img src="<?= base_url(); ?>assets/imgupload/<?= $row->foto ?>" style="width:100px; height:auto;" class="img-responsive">
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">Rp. <?= $row->retribusi ?></td>
                                        <td class="text-center align-middle"><?= $row->ket ?></td>
                                        <td class="text-center align-middle"><?= date_indo($row->tgl_pasang) ?></td>
                                        <td class="text-center align-middle">
                                            <?= date_indo($row->masa_berlaku) ?><br>
                                            <?= $status_masa_berlaku ?>
                                        </td>
                                        <td class="align-middle">
                                            <ul>
                                                <?php $no_unit = 1; ?>
                                                <?php foreach ($row->lokasi as $lok): ?>
                                                    <li>
                                                        <b>Unit: <?= $no_unit++; ?></b><br>
                                                        <?= $lok['alamat_pasang'] ?> -
                                                        <?= $lok['nama_kecamatan'] ?> /
                                                        <?= $lok['nama_nagari'] ?><br>
                                                        Koordinat: <?= $lok['lat'] ?>, <?= $lok['long'] ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
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

<!-- <?php foreach ($kadis->result() as $row) : ?>
    <div class="modal fade" id="deleteKadis<?= $row->id_kadis; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <a href="<?= base_url('admin/kadis/hapus/' . $row->id_kadis); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?> -->