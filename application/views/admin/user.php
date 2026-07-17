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
						<!-- <button type="button" class="btn btn-sm bg-maroon ml-auto" data-toggle="modal"
							data-target="#ModalTambahUser">
							<i class="fas fa-user-plus mr-1"></i> Tambah User
						</button> -->
					</div>

					<div class="card-body table-responsive">
						<table id="TabelData1" class="table table-bordered table-striped table-hover table-sm">
							<thead class="bg-light">
								<tr>
									<th class="text-center align-middle py-2" style="width: 5%">No.</th>
									<th class="align-middle py-2">Nama Pengguna</th>
									<th class="align-middle py-2">Username</th>
									<th class="text-center align-middle py-2">Peran (Role)</th>
									<th class="text-center align-middle py-2" style="width: 15%">Koneksi</th>
									<th class="text-center align-middle py-2" style="width: 15%">Aksi</th>
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
												<span class="badge bg-purple px-2 py-1.5 font-weight-normal">
													<?= !empty($row->role) ? $row->role : 'User'; ?>
												</span>
											</td>
											<td class="text-center align-middle">
												<?php if ($row->online == 1 || $row->online == 'Y'): ?>
													<span class="badge badge-success px-2 py-1"><i
															class="fas fa-circle mr-1 text-xs"></i> Online</span>
												<?php else: ?>
													<span class="badge badge-secondary px-2 py-1">Offline</span>
												<?php endif; ?>
											</td>
											<td class="text-center align-middle">
												<button type="button" data-toggle="modal"
													data-target="#EditUser<?= $row->id; ?>"
													class="btn btn-outline-warning mt-1 mb-1">
													<i class="fas fa-edit"></i>
												</button>

												<?php if ($row->role !== 'Administrator'): ?>
													<!-- Tombol Hapus Aktif -->
													<button type="button" data-toggle="modal"
														data-target="#DeleteUser<?= $row->id; ?>"
														class="btn btn-outline-danger mt-1 mb-1">
														<i class="fas fa-trash-alt"></i>
													</button>
												<?php else: ?>
													<button type="button" data-toggle="modal"
														data-target="#DeleteUser<?= $row->id; ?>"
														class="btn btn-outline-danger mt-1 mb-1" disabled
														style="cursor: not-allowed; opacity: 0.65;"
														title="Akun Administrator Utama tidak dapat dihapus demi keamanan sistem.">
														<i class="fas fa-ban"></i>
													</button>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="6" class="text-center text-muted py-4">Data pengguna tidak tersedia
											atau kosong.</td>
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
<div class="modal fade" id="ModalTambahUser" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-maroon text-white">
				<h5 class="modal-title font-weight-bold"><i class="fas fa-user-plus mr-2"></i>Tambah Pengguna Baru</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('admin/user/tambah'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="nama" class="font-weight-semibold">Nama Lengkap <span
							class="text-danger">*</span></label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap"
						required minlength="3">
				</div>
				<div class="form-group">
					<label for="username" class="font-weight-semibold">Username <span
							class="text-danger">*</span></label>
					<input type="text" name="username" id="username" class="form-control"
						placeholder="Contoh: agam_admin" required>
				</div>
				<div class="form-group">
					<label for="password" class="font-weight-semibold">Kata Sandi <span
							class="text-danger">*</span></label>
					<input type="password" name="password" id="password" class="form-control"
						placeholder="Minimal 6 karakter" required minlength="6">
				</div>
				<div class="form-group">
					<label for="role" class="font-weight-semibold">Hak Akses (Role) <span
							class="text-danger">*</span></label>
					<select name="role" id="role" class="form-control" required>
						<option value="User">User</option>
						<option value="Petugas Aset">Petugas Aset</option>
						<option value="Admin Reklame">Admin Reklame</option>
						<option value="Administrator">Administrator</option>
					</select>
				</div>
			</div>
			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn bg-maroon">Simpan Data</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<!-- ================= STREAMING_CHUNK: Modal Edit & Hapus Dinamis ================= -->
<?php if (!empty($user)): ?>
	<?php foreach ($user as $row): ?>

		<!-- MODAL EDIT USER -->
		<div class="modal fade" id="EditUser<?= $row->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-warning text-white">
						<h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>Edit Informasi Pengguna</h5>
						<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?= form_open('admin/user/edit/' . $row->id); ?>
					<div class="modal-body">
						<div class="form-group">
							<label class="font-weight-semibold">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" value="<?= $row->nama; ?>" required>
						</div>
						<div class="form-group">
							<label class="font-weight-semibold">Username</label>
							<input type="text" name="username" class="form-control" value="<?= $row->username; ?>" required>
						</div>
						<div class="form-group">
							<label class="font-weight-semibold">Ubah Kata Sandi <span
									class="text-muted font-weight-normal">(Kosongkan jika tidak ingin diubah)</span></label>
							<input type="password" name="password" class="form-control"
								placeholder="Ketik kata sandi baru jika ingin diganti">
						</div>
						<div class="form-group">
							<label class="font-weight-semibold">Hak Akses (Role)</label>
							<select name="role" class="form-control" required>
								<option value="User" <?= ($row->role == 'User') ? 'selected' : ''; ?>>User</option>
								<option value="Petugas Aset" <?= ($row->role == 'Petugas Aset') ? 'selected' : ''; ?>>Petugas
									Aset</option>
								<option value="Admin Reklame" <?= ($row->role == 'Admin Reklame') ? 'selected' : ''; ?>>Admin
									Reklame</option>
								<option value="Administrator" <?= ($row->role == 'Administrator') ? 'selected' : ''; ?>>
									Administrator</option>
							</select>
						</div>
					</div>
					<div class="modal-footer bg-light">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>

		<!-- MODAL HAPUS USER -->
		<div class="modal fade" id="DeleteUser<?= $row->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered text-dark" role="document">
				<div class="modal-content">
					<div class="modal-header bg-danger text-white">
						<h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi
							Penghapusan</h5>
						<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-center py-4">
						<i class="fas fa-user-times text-danger fa-4x mb-3"></i>
						<h4>Apakah Anda yakin?</h4>
						<p class="text-muted">Anda akan menghapus akun milik <strong><?= $row->nama; ?></strong>
							(<?= $row->username; ?>) secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
					</div>
					<div class="modal-footer bg-light justify-content-center">
						<button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Batal</button>
						<a href="<?= base_url('admin/user/hapus/' . $row->id); ?>" class="btn btn-danger px-4">Ya, Hapus
							Akun</a>
					</div>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
<?php endif; ?>