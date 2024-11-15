<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaduan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">Pengaduan</h3>
                <hr>
                <div class="panel-heading">
                    <?php if ($this->session->flashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('gagal'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('berhasil')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('berhasil'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <button href="" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#ModalTambahPengaduan"><i class="fa fa-plus fa-fw"></i>Tambah Data</button>
                </div><br>
                <!-- start: Accordion -->
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-hover" id="dataTables-example">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nomor Pengaduan</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No. HP</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Jenis Pengaduan</th>
                                <th class="text-center">Lokasi Kejadian</th>
                                <th class="text-center">Waktu Kejadian</th>
                                <th class="text-center">Materi Pengaduan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center"><i class="fa fa-cog"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pengaduan->result() as $row) {
                            ?>
                                <tr class="odd gradeX">
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->no_pengaduan; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $row->alamat; ?></td>
                                    <td><?= $row->hp; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td><?= $row->jenis_pengaduan; ?></td>
                                    <td><?= $row->lokasi_kejadian; ?></td>
                                    <td><?= $row->waktu_kejadian; ?></td>
                                    <td><?= $row->materi_pengaduan; ?></td>
                                    <td><?= $row->status; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a class="btn btn-outline-warning btn-sm btn-circle" href="#" data-toggle="modal" data-target="#EditPengaduan<?php echo $row->id_pengaduan; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm btn-circle" href="<?php echo base_url() ?>admin/pengaduan/hapus/<?php echo $row->id_pengaduan; ?>" title="Hapus" onclick="javascript: return confirm('Anda yakin hapus <?= $row->no_pengaduan; ?>?')"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--end: Accordion -->
            </div>
        </div>
    </div>
    </div>
    </div>
</main>