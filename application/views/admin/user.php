<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-12">
				<div class="card card-outline card-maroon shadow-sm">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h3 class="card-title font-weight-bold my-auto">
							<i class="fas fa-users-cog mr-2 text-maroon"></i> Tabel
							<?= isset($title) ? $title : 'Pengguna'; ?>
						</h3>
					</div>

					<div class="card-body">

						<div class="d-flex mb-3">
							<button type="button" class="btn btn-outline-danger shadow-sm" data-toggle="modal" data-target="#ModalTambahUser">
								<i class="fa fa-plus p-1" aria-hidden="true"></i> Tambah User
							</button>
						</div>

						<table id="TabelData1" class="table table-bordered table-striped table-hover table-sm">
							<thead class="bg-light">
								<tr>
									<th class="text-center align-middle py-2" style="width: 5%">No.</th>
									<th class="align-middle py-2">Nama Pengguna</th>
									<th class="align-middle py-2">Username</th>
									<th class="text-center align-middle py-2">Peran</th>
									<th class="text-center align-middle py-2">Divisi</th>
									<th class="text-center align-middle py-2" style="width: 12%">Koneksi</th>
									<th class="text-center align-middle py-2" style="width: 12%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($user)): ?>
									<?php $count = 1; ?>
									<?php foreach ($user as $row): ?>
										<tr>
											<td class="text-center align-middle"><?= $count++; ?></td>
											<td class="align-middle font-weight-bold text-dark"><?= $row->nama; ?></td>
											<td class="align-middle"><?= $row->username; ?></td>
											<td class="text-center align-middle">
												<!-- Logika Tampilan Role dan Divisi -->
												<?php if ($row->role === 'Administrator'): ?>
													<span class="badge bg-maroon px-2 py-1.5 font-weight-normal shadow-sm">
														<i class="fas fa-user-shield mr-1"></i> Administrator
													</span>
												<?php else: ?>
													<span class="badge bg-primary px-2 py-1 font-weight-normal shadow-sm mb-1">
														<i class="fas fa-user mr-1"></i> User
													</span>
												<?php endif; ?>
											</td>
											<td class="text-center align-middle">
												<?php if (!empty($row->divisi)): ?>
													<span class="badge bg-info px-2 py-1 font-weight-normal shadow-sm">
														<i class="fas fa-briefcase mr-1"></i> <?= $row->divisi; ?>
													</span>
												<?php else: ?>
													<span class="badge bg-secondary px-2 py-1 font-weight-normal shadow-sm">
														<i class="fas fa-times-circle mr-1"></i> Belum ada divisi
													</span>
												<?php endif; ?>
											</td>
											<td class="text-center align-middle">
												<?php if ($row->online == 1 || $row->online == 'Y'): ?>
													<span class="badge badge-success px-2 py-1"><i class="fas fa-circle mr-1 text-xs"></i> Online</span>
												<?php else: ?>
													<span class="badge badge-secondary px-2 py-1">Offline</span>
												<?php endif; ?>
											</td>
											<td class="text-center align-middle">
												<button type="button" data-toggle="modal" data-target="#EditUser<?= $row->id; ?>" class="btn btn-outline-warning btn-sm mt-1 mb-1">
													<i class="fas fa-edit"></i>
												</button>

												<?php if ($row->role !== 'Administrator'): ?>
													<button type="button" data-toggle="modal" data-target="#DeleteUser<?= $row->id; ?>" class="btn btn-outline-danger btn-sm mt-1 mb-1">
														<i class="fas fa-trash-alt"></i>
													</button>
												<?php else: ?>
													<button type="button" class="btn btn-outline-danger btn-sm mt-1 mb-1" disabled style="cursor: not-allowed; opacity: 0.65;" title="Akun Administrator tidak dapat dihapus demi keamanan sistem.">
														<i class="fas fa-ban"></i>
													</button>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="6" class="text-center text-muted py-4">Data pengguna tidak tersedia atau kosong.</td>
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

<!-- ================= STREAMING_CHUNK: Modal Tambah User ================= -->
<div class="modal fade" id="ModalTambahUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<?= form_open('admin/user/tambah'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="nama" class="font-weight-semibold">Nama Lengkap <span class="text-danger">*</span></label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required minlength="3">
				</div>
				<div class="form-group">
					<label for="username" class="font-weight-semibold">Username <span class="text-danger">*</span></label>
					<input type="text" name="username" id="username" class="form-control" placeholder="Contoh: agam_admin" required>
				</div>
				<div class="form-group">
					<label for="password" class="font-weight-semibold">Kata Sandi <span class="text-danger">*</span></label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
				</div>

				<!-- Dropdown Role -->
				<div class="form-group">
					<label for="role_tambah" class="font-weight-semibold">Hak Akses (Role) <span class="text-danger">*</span></label>
					<select name="role" id="role_tambah" class="form-control" required onchange="toggleDivisi('tambah')">
						<option value="" disabled selected>-- Pilih Aktor Utama --</option>
						<!-- <option value="Administrator">Administrator</option> -->
						<option value="User">User</option>
					</select>
				</div>

				<!-- Dropdown Divisi (Awalnya Disembunyikan) -->
				<div class="form-group" id="grup_divisi_tambah" style="display: none;">
					<label for="divisi_tambah" class="font-weight-semibold">Divisi / Penempatan <small class="text-muted">(Khusus User)</small> <span class="text-danger">*</span></label>
					<select name="divisi" id="divisi_tambah" class="form-control">
						<option value="">-- Pilih Spesialisasi Divisi --</option>
						<option value="Konsultasi">Petugas Konsultasi</option>
						<option value="Pengaduan">Petugas Pengaduan</option>
						<option value="Aset">Petugas Aset</option>
					</select>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
				<button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<!-- ================= STREAMING_CHUNK: Modal Edit & Hapus Dinamis ================= -->
<?php if (!empty($user)): ?>
	<?php foreach ($user as $row): ?>

		<!-- Modal Edit -->
		<div class="modal fade" id="EditUser<?= $row->id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Update <?= $title; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<?= form_open('admin/user/edit/' . $row->id); ?>
					<div class="modal-body">
						<div class="form-group">
							<label class="font-weight-semibold">Nama Lengkap <span class="text-danger">*</span></label>
							<input type="text" name="nama" class="form-control" value="<?= $row->nama; ?>" required>
						</div>
						<div class="form-group">
							<label class="font-weight-semibold">Username <span class="text-danger">*</span></label>
							<input type="text" name="username" class="form-control" value="<?= $row->username; ?>" required>
						</div>
						<div class="form-group">
							<label class="font-weight-semibold">Ubah Kata Sandi <span class="text-muted font-weight-normal">(Opsional)</span></label>
							<input type="password" name="password" class="form-control" placeholder="Ketik kata sandi baru jika ingin diganti">
						</div>

						<!-- Dropdown Role Edit -->
						<div class="form-group">
							<label class="font-weight-semibold">Hak Akses (Role) <span class="text-danger">*</span></label>
							<?php if ($row->role === 'Administrator'): ?>
								<input type="text" class="form-control" value="Administrator" readonly>
								<input type="hidden" name="role" id="role_edit_<?= $row->id; ?>" value="Administrator">
								<small class="form-text text-muted">Hak akses 'Administrator' dikunci dan tidak dapat diubah.</small>
							<?php else: ?>
								<select name="role" id="role_edit_<?= $row->id; ?>" class="form-control" required onchange="toggleDivisiEdit(<?= $row->id; ?>)">
									<option value="User" selected>User</option>
									<option value="Administrator" disabled>Administrator (Tidak Diizinkan)</option>
								</select>
							<?php endif; ?>
						</div>

						<!-- Dropdown Divisi Edit -->
						<div class="form-group" id="grup_divisi_edit_<?= $row->id; ?>" style="<?= ($row->role === 'Administrator') ? 'display: none;' : ''; ?>">
							<label class="font-weight-semibold">Divisi / Penempatan <span class="text-danger">*</span></label>
							<select name="divisi" id="divisi_edit_<?= $row->id; ?>" class="form-control" <?= ($row->role === 'User') ? 'required' : ''; ?>>
								<option value="">-- Pilih Spesialisasi Divisi --</option>
								<option value="Konsultasi" <?= ($row->divisi == 'Konsultasi') ? 'selected' : ''; ?>>Petugas Konsultasi</option>
								<option value="Pengaduan" <?= ($row->divisi == 'Pengaduan') ? 'selected' : ''; ?>>Petugas Pengaduan</option>
								<option value="Aset" <?= ($row->divisi == 'Aset') ? 'selected' : ''; ?>>Petugas Aset</option>
							</select>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
						<button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Update</button>
					</div>
					<?= form_close(); ?>

				</div>
			</div>
		</div>

		<?php if ($row->role === 'User'): ?>
			<!-- Modal Hapus User -->
			<div class="modal fade" id="DeleteUser<?= $row->id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus <?= $title; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Anda akan menghapus akun milik <strong class="font-weight-bold text-maroon"><?= $row->nama; ?></strong>
							<p class="text-muted">(<?= $row->username; ?>) secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
							<a href="<?= base_url('admin/user/hapus/' . $row->id); ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt mr-1"></i> Hapus Akun</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

	<?php endforeach; ?>
<?php endif; ?>

<!-- SCRIPT UNTUK LOGIKA DROPDOWN DINAMIS -->
<script>
	// Fungsi untuk Form Tambah User
	function toggleDivisi(jenis) {
		var role = document.getElementById('role_' + jenis).value;
		var grupDivisi = document.getElementById('grup_divisi_' + jenis);
		var selectDivisi = document.getElementById('divisi_' + jenis);

		if (role === 'Administrator') {
			grupDivisi.style.display = 'none'; // Sembunyikan
			selectDivisi.removeAttribute('required'); // Lepas validasi required
			selectDivisi.value = ''; // Kosongkan nilai
		} else if (role === 'User') {
			grupDivisi.style.display = 'block'; // Tampilkan
			selectDivisi.setAttribute('required', 'required'); // Wajib diisi
		}
	}

	// Fungsi untuk Form Edit User (butuh ID karena modalnya ada banyak)
	function toggleDivisiEdit(id) {
		var role = document.getElementById('role_edit_' + id).value;
		var grupDivisi = document.getElementById('grup_divisi_edit_' + id);
		var selectDivisi = document.getElementById('divisi_edit_' + id);

		if (role === 'Administrator') {
			grupDivisi.style.display = 'none';
			selectDivisi.removeAttribute('required');
			selectDivisi.value = '';
		} else {
			grupDivisi.style.display = 'block';
			selectDivisi.setAttribute('required', 'required');
		}
	}
</script>