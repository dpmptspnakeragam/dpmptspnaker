<?php
// 1. Data User dari Session
$current_username = strtolower($this->session->userdata('username') ?? '');
$current_role     = $this->session->userdata('role');

// 2. Tentukan Jenis Role User (Admin, Input, atau Proses)
$is_admin  = ($current_role === 'Administrator');
$is_input  = (strpos($current_username, 'input') !== false);   // ID 6 & 8
$is_proses = (strpos($current_username, 'proses') !== false);  // ID 7 & 9

// 3. Tentukan Unit/Divisi User yang Sedang Login (PTSP atau BLK)
$user_unit = 'ALL';
if (strpos($current_username, 'ptsp') !== false) {
    $user_unit = 'PTSP';
} elseif (strpos($current_username, 'blk') !== false) {
    $user_unit = 'BLK';
}
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-maroon shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title font-weight-bold my-auto">
                            <i class="fas fa-comments mr-2 text-maroon"></i> Tabel
                            <?= isset($title) ? $title : 'Data Konsultasi'; ?>
                        </h3>
                    </div>

                    <div class="card-body">

                        <!-- Tombol Tambah: Hanya Operator Input (ID 6, 8) dan Administrator -->
                        <?php if ($is_input || $is_admin): ?>
                            <div class="d-flex mb-3">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalTambahKonsultasi">
                                    <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                    Tambah Konsultasi
                                </button>
                            </div>
                        <?php endif; ?>

                        <table id="TabelData1" class="table table-bordered table-striped table-hover table-sm">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center align-middle py-2" style="width: 5%">No.</th>
                                    <th class="align-middle py-2" style="width: 20%">No Tiket & Waktu</th>
                                    <th class="align-middle py-2">Identitas Pemohon</th>
                                    <th class="align-middle py-2">Jenis Izin</th>
                                    <th class="text-center align-middle py-2" style="width: 12%">Unit Penginput</th>
                                    <th class="text-center align-middle py-2" style="width: 12%">Status</th>
                                    <th class="text-center align-middle py-2" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($konsultasi)): ?>
                                    <?php $count = 1; ?>
                                    <?php foreach ($konsultasi as $row): ?>
                                        <?php
                                        // -------------------------------------------------------------
                                        // 1. DETEKSI TIPE UNIT PENGINPUT PER BARIS DATA
                                        // -------------------------------------------------------------
                                        $penerima = strtolower($row->petugas_penerima ?? '');
                                        $row_unit = 'LAINNYA';

                                        if (strpos($penerima, 'ptsp') !== false) {
                                            $row_unit = 'PTSP';
                                        } elseif (strpos($penerima, 'blk') !== false) {
                                            $row_unit = 'BLK';
                                        }

                                        // -------------------------------------------------------------
                                        // 2. VALIDASI UNIT AKSES (APAKAH USER BERHAK MENGELOLA DATA INI)
                                        // -------------------------------------------------------------
                                        $can_manage_this_row = false;
                                        if ($is_admin) {
                                            $can_manage_this_row = true;
                                        } elseif ($user_unit === $row_unit) {
                                            $can_manage_this_row = true;
                                        }
                                        ?>
                                        <tr class="<?= (!$can_manage_this_row && !$is_admin) ? 'bg-light text-muted' : ''; ?>">
                                            <td class="text-center align-middle"><?= $count++; ?></td>

                                            <td class="align-middle font-weight-bold text-maroon">
                                                <?= $row->no_tiket; ?><br>
                                                <small class="text-muted font-weight-normal text-xs">
                                                    <i class="far fa-calendar-alt mr-1"></i><?= date('d/m/Y H:i', strtotime($row->tanggal_masuk)); ?>
                                                </small>
                                            </td>

                                            <td class="align-middle font-weight-bold text-dark">
                                                <?= $row->nama_pemohon; ?><br>
                                                <small class="text-muted font-weight-normal">
                                                    <i class="fas fa-phone-alt mr-1"></i><?= $row->no_hp; ?>
                                                </small>
                                            </td>

                                            <td class="align-middle"><?= $row->jenis_izin; ?></td>

                                            <!-- KOLOM TAMBAHAN: TIPE UNIT & NAMA PENGINPUT -->
                                            <td class="text-center align-middle">
                                                <?php if ($row_unit === 'PTSP'): ?>
                                                    <span class="badge badge-primary px-2 py-1"><i class="fas fa-building mr-1"></i>PTSP</span>
                                                <?php elseif ($row_unit === 'BLK'): ?>
                                                    <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-tools mr-1"></i>BLK</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary px-2 py-1"><?= $row_unit; ?></span>
                                                <?php endif; ?>

                                                <br>
                                                <small class="text-muted text-xs" title="Petugas Input">
                                                    <i class="fas fa-user-edit mr-1"></i><?= $row->petugas_penerima ?? '-'; ?>
                                                </small>
                                            </td>

                                            <td class="text-center align-middle">
                                                <?php if ($row->status === 'Menunggu'): ?>
                                                    <div class="text-warning font-weight-bold text-sm mb-1">
                                                        <i class="fas fa-inbox mr-1"></i> Menunggu
                                                    </div>
                                                    <div class="progress shadow-sm" style="height: 8px; border-radius: 5px;">
                                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 25%"></div>
                                                    </div>

                                                <?php elseif ($row->status === 'Diproses'): ?>
                                                    <div class="text-info font-weight-bold text-sm mb-1">
                                                        <i class="fas fa-tools mr-1"></i> Diproses
                                                    </div>
                                                    <div class="progress shadow-sm" style="height: 8px; border-radius: 5px;">
                                                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width: 65%"></div>
                                                    </div>

                                                <?php elseif ($row->status === 'Selesai'): ?>
                                                    <div class="text-success font-weight-bold text-sm mb-1">
                                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                                    </div>
                                                    <div class="progress shadow-sm" style="height: 8px; border-radius: 5px;">
                                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                                    </div>

                                                <?php else: ?>
                                                    <div class="text-secondary font-weight-bold text-sm mb-1">
                                                        <i class="fas fa-ban mr-1"></i> Ditolak
                                                    </div>
                                                    <div class="progress shadow-sm" style="height: 8px; border-radius: 5px;">
                                                        <div class="progress-bar bg-secondary" style="width: 100%"></div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center align-middle">
                                                <!-- TOMBOL AKSI: Hanya jika User bertipe PROSES/ADMIN DAN berasal dari unit yang sama -->
                                                <?php if (($is_proses || $is_admin) && $can_manage_this_row): ?>

                                                    <a href="<?= base_url('admin/konsultasi/proses/' . $row->id); ?>"
                                                        class="btn btn-outline-info mt-1 mb-1" title="Tindak Lanjut / Detail">
                                                        <i class="fas fa-edit"></i> Proses
                                                    </a>

                                                    <button type="button" data-toggle="modal"
                                                        data-target="#DeleteKonsultasi<?= $row->id; ?>"
                                                        class="btn btn-outline-danger mt-1 mb-1" title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                <?php elseif ($is_input): ?>
                                                    <!-- Jika user bertipe Operator Input -->
                                                    <span class="badge badge-light text-muted border" title="Operator Input hanya dapat menambahkan data">
                                                        <i class="fas fa-lock mr-1"></i> Akses Terbatas
                                                    </span>
                                                <?php else: ?>
                                                    <!-- Jika user Proses PTSP melihat data milik BLK (atau sebaliknya) -->
                                                    <span class="badge badge-light text-muted border" title="Bukan wewenang unit <?= $user_unit; ?>">
                                                        <i class="fas fa-lock mr-1"></i>Milik <?= $row_unit; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Data konsultasi tidak tersedia atau kosong.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- MODAL HAPUS DINAMIS -->
<?php if (!empty($konsultasi)): ?>
    <?php foreach ($konsultasi as $row): ?>
        <?php
        $penerima = strtolower($row->petugas_penerima ?? '');
        $can_manage_this_row = false;

        if ($is_admin) {
            $can_manage_this_row = true;
        } elseif ($user_unit === 'PTSP' && strpos($penerima, 'ptsp') !== false) {
            $can_manage_this_row = true;
        } elseif ($user_unit === 'BLK' && strpos($penerima, 'blk') !== false) {
            $can_manage_this_row = true;
        }
        ?>

        <!-- Render modal HANYA untuk baris yang berhak dikelola -->
        <?php if (($is_proses || $is_admin) && $can_manage_this_row): ?>
            <div class="modal fade" id="DeleteKonsultasi<?= $row->id; ?>" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Konsultasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Anda akan menghapus data konsultasi dari <strong class="font-weight-bold text-maroon"><?= $row->nama_pemohon; ?></strong>
                            <p class="text-muted">(Tiket: <?= $row->no_tiket; ?>) secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('admin/konsultasi/hapus/' . $row->id); ?>" class="btn btn-outline-danger">Ya, Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endforeach; ?>
<?php endif; ?>