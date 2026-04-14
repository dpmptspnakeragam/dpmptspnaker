<main role="main" class="">
    <div class="container mt-5">

        <div class="card-body">
            <?php if ($this->session->flashdata('gagal')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('gagal'); ?>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('berhasil')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('berhasil'); ?>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

        </div>

        <div class="row pt-4">
            <div class="col-12 mt-5">
                <div class="card shadow" style="border-style:solid; border-color:#600574">
                    <div class="card-body">
                        <h5 class="card-title judul-admin" style="color: #600574;">Selamat Datang</h5>
                        <p class="card-text judul-admin" style="color: #600574;">Sistem Informasi Reklame Agam (SIREKAM)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Kartu Statistik Masih Berlaku -->
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-green-dark" data-toggle="modal" data-target="#modalMasihBerlaku" style="cursor: pointer;">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-check"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Masih Berlaku</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-12">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php echo number_format($masih_berlaku); ?> (<?php echo number_format($persen_berlaku); ?>%)
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_berlaku); ?>%" aria-valuenow="<?php echo number_format($masih_berlaku); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_berlaku); ?>%;"></div>
                        </div>
                        <div class="mt-2">
                            <?php if ($masih_berlaku > 0): ?>
                                <span>Total: <?php echo number_format($total); ?></span>
                            <?php else: ?>
                                <span>Total: 0</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Modal Masih Berlaku -->
                <div class="modal fade" id="modalMasihBerlaku" tabindex="-1" role="dialog" aria-labelledby="modalMasihBerlakuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header l-bg-green-dark text-white">
                                <h5 class="modal-title" id="modalMasihBerlakuLabel">Daftar Data Masih Berlaku</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Tabel Data -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover" id="DataTablesMasihBerlaku">
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
                                            <?php foreach ($reklame_grouped as $r): ?>
                                                <?php
                                                $sekarang = date('Y-m-d');
                                                if (strtotime($r['masa_berlaku']) >= strtotime($sekarang)) :
                                                    $status_masa_berlaku = '<span class="badge badge-success">Berlaku</span>';
                                                ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                                        <td class="text-center align-middle"><?= $r['no_izin'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['nama_perusahaan'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['alamat_perusahaan'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['jenis_reklame'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['ukuran'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['pemohon'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['no_hp'] ?></td>
                                                        <td class="text-center align-middle">
                                                            <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                                                <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" style="width:100px; height:auto;" class="img-responsive">
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle">Rp. <?= $r['retribusi'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['ket'] ?></td>
                                                        <td class="text-center align-middle"><?= date_indo($r['tgl_pasang']) ?></td>
                                                        <td class="text-center align-middle">
                                                            <?= date_indo($r['masa_berlaku']) ?><br>
                                                            <?= $status_masa_berlaku ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <ul>
                                                                <?php $no_unit = 1; ?>
                                                                <?php foreach ($r['lokasi'] as $lok): ?>
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
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kartu Statistik Habis Masa Berlaku -->
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-cherry" data-toggle="modal" data-target="#modalBerlakuHabis" style="cursor: pointer;">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-times-circle"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Habis Masa Berlaku</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php echo number_format($berlaku_habis); ?> (<?php echo number_format($persen_berlakuhabis); ?>%)
                                </h2>
                            </div>
                        </div>
                        <div class="progress mt-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_berlakuhabis); ?>%" aria-valuenow="<?php echo number_format($berlaku_habis); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_berlakuhabis); ?>%;"></div>
                        </div>
                        <div class="mt-2">
                            <?php if ($berlaku_habis > 0): ?>
                                <span>Total: <?php echo number_format($total); ?></span>
                            <?php else: ?>
                                <span>Total: 0</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Modal Habis Masa Berlaku -->
                <div class="modal fade" id="modalBerlakuHabis" tabindex="-1" role="dialog" aria-labelledby="modalBerlakuHabisLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header l-bg-cherry text-white">
                                <h5 class="modal-title" id="modalBerlakuHabisLabel">Daftar Data Habis Masa Berlaku</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Tabel Data -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless table-hover" id="DataTablesTidakBerlaku">
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
                                            <?php foreach ($reklame_grouped as $r): ?>
                                                <?php
                                                $sekarang = date('Y-m-d');
                                                if (strtotime($r['masa_berlaku']) < strtotime($sekarang)) :
                                                    $status_masa_berlaku = '<span class="badge badge-danger">Berlaku Habis</span>';
                                                ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                                        <td class="text-center align-middle"><?= $r['no_izin'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['nama_perusahaan'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['alamat_perusahaan'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['jenis_reklame'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['ukuran'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['pemohon'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['no_hp'] ?></td>
                                                        <td class="text-center align-middle">
                                                            <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                                                <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" style="width:100px; height:auto;" class="img-responsive">
                                                            </a>
                                                        </td>
                                                        <td class="text-center align-middle">Rp. <?= $r['retribusi'] ?></td>
                                                        <td class="text-center align-middle"><?= $r['ket'] ?></td>
                                                        <td class="text-center align-middle"><?= date_indo($r['tgl_pasang']) ?></td>
                                                        <td class="text-center align-middle">
                                                            <?= date_indo($r['masa_berlaku']) ?><br>
                                                            <?= $status_masa_berlaku ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <ul>
                                                                <?php $no_unit = 1; ?>
                                                                <?php foreach ($r['lokasi'] as $lok): ?>
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
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($this->session->userdata('username') == 'admin' && 'bapenda'): ?>

            <?php endif; ?>

            <?php if ($this->session->userdata('username') != 'satpolpp'): ?>
                <!-- Kartu Statistik Sudah Bayar Pajak -->
                <div class="col-6 col-xl-6 col-lg-6">
                    <div class="card shadow l-bg-green-dark" data-toggle="modal" data-target="#modalSudahBayar" style="cursor: pointer;">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-check"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Sudah Bayar Pajak</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <?php echo number_format($setor); ?> (<?php echo number_format($persen_setor); ?>%)
                                    </h2>
                                </div>
                            </div>
                            <div class="progress mt-1" data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_setor); ?>%" aria-valuenow="<?php echo number_format($setor); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_setor); ?>%;"></div>
                            </div>
                            <div class="mt-2">
                                <?php if ($setor > 0): ?>
                                    <span>Total: <?php echo number_format($total); ?></span>
                                <?php else: ?>
                                    <span>Total: 0</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Sudah Bayar Pajak -->
                    <div class="modal fade" id="modalSudahBayar" tabindex="-1" role="dialog" aria-labelledby="modalSudahBayarLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header l-bg-green-dark text-white">
                                    <h5 class="modal-title" id="modalSudahBayarLabel">Daftar Data Sudah Bayar Pajak</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tabel Data -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless table-hover" id="DataTablesSudahBayar">
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
                                                <?php foreach ($reklame_grouped as $r): ?>
                                                    <?php
                                                    $sekarang = date('Y-m-d');
                                                    if ($r['ket'] == "Sudah Setor") :
                                                        $status_masa_berlaku = '<span class="badge badge-success">Sudah Bayar</span>';
                                                    ?>
                                                        <tr>
                                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                                            <td class="text-center align-middle"><?= $r['no_izin'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['nama_perusahaan'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['alamat_perusahaan'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['jenis_reklame'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['ukuran'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['pemohon'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['no_hp'] ?></td>
                                                            <td class="text-center align-middle">
                                                                <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                                                    <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" style="width:100px; height:auto;" class="img-responsive">
                                                                </a>
                                                            </td>

                                                            <td class="text-center align-middle">Rp. <?= $r['retribusi'] ?> <br> <?= $status_masa_berlaku ?></td>
                                                            <td class="text-center align-middle"><?= $r['ket'] ?></td>
                                                            <td class="text-center align-middle"><?= date_indo($r['tgl_pasang']) ?></td>
                                                            <td class="text-center align-middle">
                                                                <?= date_indo($r['masa_berlaku']) ?><br>
                                                            </td>
                                                            <td class="align-middle">
                                                                <ul>
                                                                    <?php $no_unit = 1; ?>
                                                                    <?php foreach ($r['lokasi'] as $lok): ?>
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
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kartu Statistik Belum Bayar Pajak -->
                <div class="col-6 col-xl-6 col-lg-6">
                    <div class="card shadow l-bg-orange-dark" data-toggle="modal" data-target="#modalBelumBayar" style="cursor: pointer;">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Belum Bayar Pajak</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <?php echo number_format($belum_setor); ?> (<?php echo number_format($persen_belumsetor); ?>%)
                                    </h2>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_belumsetor); ?>%" aria-valuenow=" <?php echo number_format($belum_setor); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_belumsetor); ?>%;"></div>
                            </div>
                            <div class="mt-2">
                                <?php if ($belum_setor > 0): ?>
                                    <span>Total: <?php echo number_format($total); ?></span>
                                <?php else: ?>
                                    <span>Total: 0</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Sudah Bayar Pajak -->
                    <div class="modal fade" id="modalBelumBayar" tabindex="-1" role="dialog" aria-labelledby="modalBelumBayarLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header l-bg-orange-dark text-white">
                                    <h5 class="modal-title" id="modalBelumBayarLabel">Daftar Data Belum Bayar Pajak</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tabel Data -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless table-hover" id="DataTablesBelumBayar">
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
                                                <?php foreach ($reklame_grouped as $r): ?>
                                                    <?php
                                                    $sekarang = date('Y-m-d');
                                                    if ($r['ket'] == "Belum Setor") :
                                                        $status_masa_berlaku = '<span class="badge badge-danger">Belum Bayar</span>';
                                                    ?>
                                                        <tr>
                                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                                            <td class="text-center align-middle"><?= $r['no_izin'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['nama_perusahaan'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['alamat_perusahaan'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['jenis_reklame'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['ukuran'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['pemohon'] ?></td>
                                                            <td class="text-center align-middle"><?= $r['no_hp'] ?></td>
                                                            <td class="text-center align-middle">
                                                                <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                                                    <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" style="width:100px; height:auto;" class="img-responsive">
                                                                </a>
                                                            </td>

                                                            <td class="text-center align-middle">Rp. <?= $r['retribusi'] ?> <br> <?= $status_masa_berlaku ?></td>
                                                            <td class="text-center align-middle"><?= $r['ket'] ?></td>
                                                            <td class="text-center align-middle"><?= date_indo($r['tgl_pasang']) ?></td>
                                                            <td class="text-center align-middle">
                                                                <?= date_indo($r['masa_berlaku']) ?><br>
                                                            </td>
                                                            <td class="align-middle">
                                                                <ul>
                                                                    <?php $no_unit = 1; ?>
                                                                    <?php foreach ($r['lokasi'] as $lok): ?>
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
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>