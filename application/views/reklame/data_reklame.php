<main role="main">
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><strong><i class="fa fa-home"></i> Dashboard</strong></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Reklame</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Data Reklame Kabupaten Agam</h3>

            </div>
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
                <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#ModalTambahReklameMulti">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </button>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="DataTables1">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">No Izin</th>
                                <th class="text-center align-middle">Nama Perusahaan</th>
                                <th class="text-center align-middle">Alamat Perusahaan</th>
                                <th class="text-center align-middle">Jenis Reklame</th>
                                <th class="text-center align-middle">Ukuran</th>
                                <th class="text-center align-middle">Pemohon</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">No. HP</th>
                                <th class="text-center align-middle">Foto</th>
                                <th class="text-center align-middle">Pajak</th>
                                <th class="text-center align-middle">Keterangan</th>
                                <th class="text-center align-middle">Tanggal Pasang</th>
                                <th class="text-center align-middle">Masa Berlaku</th>

                                <th class="text-center align-middle">Daftar Lokasi</th>
                                <th class="text-center"><i class="fa fa-cog"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($reklame_grouped as $r): ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $count++; ?></td>
                                    <td class="text-center align-middle"><?= $r['no_izin'] ?></td>
                                    <td class="text-center align-middle"><?= $r['nama_perusahaan'] ?></td>
                                    <td class="text-center align-middle"><?= $r['alamat_perusahaan'] ?></td>
                                    <td class="text-center align-middle"><?= $r['jenis_reklame'] ?></td>
                                    <td class="text-center align-middle"><?= $r['ukuran'] ?></td>
                                    <td class="text-center align-middle"><?= $r['pemohon'] ?></td>
                                    <td class="text-center align-middle"><?= $r['email'] ?></td>
                                    <td class="text-center align-middle"><?= $r['no_hp'] ?></td>
                                    <td class="text-center align-middle">
                                        <a href="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" data-lightbox="photos">
                                            <img src="<?= base_url(); ?>assets/imgupload/<?= $r['foto'] ?>" style="width:100px; height:auto;" class="img-responsive">
                                        </a>
                                    </td>
                                    <td class="text-center align-middle"><?= $r['retribusi'] ?></td>
                                    <td class="text-center align-middle"><?= $r['ket'] ?></td>
                                    <td class="text-center align-middle"><?= $r['tgl_pasang'] ?></td>
                                    <td class="text-center align-middle"><?= $r['masa_berlaku'] ?></td>

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

                                    <td class="text-center align-middle">
                                        <button class="btn btn-outline-warning mb-1 mt-1" data-toggle="modal" data-target="#ModalEditReklameMulti<?= $r['id_reklame'] ?>" title="Edit">
                                            Edit <i class="fa fa-edit"></i>
                                        </button>
                                        <a class="btn btn-outline-danger mb-1 mt-1" href="<?= base_url() ?>dashboard/hapus/<?= $r['id_reklame'] ?>" title="Hapus" onclick="javascript: return confirm('Anda yakin hapus Reklame?')">
                                            Hapus <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>