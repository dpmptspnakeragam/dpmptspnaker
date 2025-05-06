		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light-maroon">
			<!-- Brand Logo -->
			<a href="<?= base_url('admin/home'); ?>" class="brand-link elevation-2">
				<!-- Small logo for minimized sidebar -->
				<img src="<?= base_url('assets/img/agam.png'); ?>" alt="DPMPTSP Logo" class="brand-image">

				<!-- Normal logo for full sidebar -->
				<img src="<?= base_url('assets/img/logo_dpmptspwarna.png'); ?>" alt="DPMPTSP Logo Warna" class="brand-image">
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-2 pb-2 mb-1 d-flex">
					<!-- <div style="margin-left: 10px;">
						<img src="<?= base_url('assets/img/admin-avatar.png'); ?>" class="img-circle elevation-2" alt="User Image">
					</div> -->
					<div class="info d-flex justify-content-between align-items-center w-100">
						<span class="d-block"><?= $this->session->userdata('nama') ?></span>
						<!-- <a href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
							<i class="fas fa-sign-out-alt"></i>
						</a> -->
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
						<?php if ($this->session->userdata('username') != 'pengaduan'): ?>

							<!-- Informasi -->
							<li class="nav-item">
								<a href="<?= base_url('admin/home'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['home'])) echo "active"; ?>">
									<i class="nav-icon fas fa-home"></i>
									<p>Home</p>
								</a>
							</li>

							<!-- Manajemen Aset -->
							<li class="nav-item">
								<a href="<?= base_url('admin/aset'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['aset'])) echo "active"; ?>">
									<i class="nav-icon fas fa-archive"></i>
									<p>Manajemen Aset</p>
								</a>
							</li>

							<!-- Manajemen User -->
							<li class="nav-item">
								<a href="<?= base_url('admin/user'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['user'])) echo "active"; ?>">
									<i class="nav-icon fas fa-user-cog"></i>
									<p>Manajemen User</p>
								</a>
							</li>

							<!-- Profile -->
							<li class="nav-item <?= in_array(
													$this->uri->segment(2),
													[
														'kadis',
														'pegawai',
														'regulasi',
														'ppid',
														'sarpras',
														'pengaturan'
													]
												) ? 'menu-open' : ''; ?>">
								<a href="" class="nav-link <?= in_array(
																$this->uri->segment(2),
																[
																	'kadis',
																	'pegawai',
																	'regulasi',
																	'ppid',
																	'sarpras',
																	'pengaturan'
																]
															) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-address-card"></i>
									<p>
										Profile
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/kadis'); ?>" class="nav-link <?= $this->uri->segment(2) == 'kadis' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'kadis' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'kadis' ? 'text-maroon' : ''; ?>"></i>
											<p>Kepala Dinas</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/pegawai'); ?>" class="nav-link <?= $this->uri->segment(2) == 'pegawai' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'pegawai' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'pegawai' ? 'text-maroon' : ''; ?>"></i>
											<p>Pegawai</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/regulasi'); ?>" class="nav-link <?= $this->uri->segment(2) == 'regulasi' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'regulasi' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'regulasi' ? 'text-maroon' : ''; ?>"></i>
											<p>Regulasi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/ppid'); ?>" class="nav-link <?= $this->uri->segment(2) == 'ppid' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'ppid' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'ppid' ? 'text-maroon' : ''; ?>"></i>
											<p>PPID</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/sarpras'); ?>" class="nav-link <?= $this->uri->segment(2) == 'sarpras' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'sarpras' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'sarpras' ? 'text-maroon' : ''; ?>"></i>
											<p>Sarana & Prasarana</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/pengaturan'); ?>" class="nav-link <?= $this->uri->segment(2) == 'pengaturan' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'pengaturan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'pengaturan' ? 'text-maroon' : ''; ?>"></i>
											<p>Pengaturan Teks</p>
										</a>
									</li>
								</ul>
							</li>

							<!-- Informasi -->
							<li class="nav-item">
								<a href="<?= base_url('admin/informasi'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['informasi'])) echo "active"; ?>">
									<i class="nav-icon fas fa-info"></i>
									<p>Informasi</p>
								</a>
							</li>

							<!-- Layanan -->
							<li class="nav-item <?= in_array(
													$this->uri->segment(2),
													[
														'standar_pelayanan',
														'perizinan',
														'non_perizinan',
														'perizinan_risiko',
													]
												) ? 'menu-open' : ''; ?>">
								<a href="" class="nav-link <?= in_array(
																$this->uri->segment(2),
																[
																	'standar_pelayanan',
																	'perizinan',
																	'non_perizinan',
																	'perizinan_risiko',
																]
															) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-book-open"></i>
									<p>
										Layanan
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/standar_pelayanan'); ?>" class="nav-link <?= $this->uri->segment(2) == 'standar_pelayanan' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'standar_pelayanan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'standar_pelayanan' ? 'text-maroon' : ''; ?>"></i>
											<p>Standar Pelayanan</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/perizinan'); ?>" class="nav-link <?= $this->uri->segment(2) == 'perizinan' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'perizinan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'perizinan' ? 'text-maroon' : ''; ?>"></i>
											<p>Perizinan</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/non_perizinan'); ?>" class="nav-link <?= $this->uri->segment(2) == 'non_perizinan' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'non_perizinan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'non_perizinan' ? 'text-maroon' : ''; ?>"></i>
											<p>Non Perizinan</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/perizinan_risiko'); ?>" class="nav-link <?= $this->uri->segment(2) == 'perizinan_risiko' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'perizinan_risiko' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'perizinan_risiko' ? 'text-maroon' : ''; ?>"></i>
											<p>Perizinan Berbasis Resiko</p>
										</a>
									</li>
								</ul>
							</li>

							<!-- Investasi -->
							<li class="nav-item <?= in_array(
													$this->uri->segment(2),
													[
														'potensi_investasi',
														'peluang_investasi',
														'tanah_ulayat',
													]
												) ? 'menu-open' : ''; ?>">
								<a href="" class="nav-link <?= in_array(
																$this->uri->segment(2),
																[
																	'potensi_investasi',
																	'peluang_investasi',
																	'tanah_ulayat',
																]
															) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-dollar-sign"></i>
									<p>
										Investasi
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/potensi_investasi'); ?>" class="nav-link <?= $this->uri->segment(2) == 'potensi_investasi' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'potensi_investasi' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'potensi_investasi' ? 'text-maroon' : ''; ?>"></i>
											<p>Potensi Investasi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/peluang_investasi'); ?>" class="nav-link <?= $this->uri->segment(2) == 'peluang_investasi' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'peluang_investasi' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'peluang_investasi' ? 'text-maroon' : ''; ?>"></i>
											<p>Peluang Investasi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/tanah_ulayat'); ?>" class="nav-link <?= $this->uri->segment(2) == 'tanah_ulayat' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'tanah_ulayat' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'tanah_ulayat' ? 'text-maroon' : ''; ?>"></i>
											<p>Tanah Ulayat</p>
										</a>
									</li>
								</ul>
							</li>

						<?php endif; ?>

						<!-- Pengaduan -->
						<li class="nav-item">
							<a href="<?= base_url('admin/pengaduan'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['pengaduan'])) echo "active"; ?>">
								<i class="nav-icon fas fa-question"></i>
								<p>Pengaduan</p>
							</a>
						</li>

						<?php if ($this->session->userdata('username') != 'pengaduan'): ?>

							<!-- Grafik -->
							<li class="nav-item <?= in_array(
													$this->uri->segment(2),
													[
														'grafik_izin',
														'grafik_izin_tahun',
														'grafik_investasi',
														'grafik_skm',
														'grafik_nib',
													]
												) ? 'menu-open' : ''; ?>">
								<a href="" class="nav-link <?= in_array(
																$this->uri->segment(2),
																[
																	'grafik_izin',
																	'grafik_izin_tahun',
																	'grafik_investasi',
																	'grafik_skm',
																	'grafik_nib',
																]
															) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-sort-amount-up"></i>
									<p>
										Grafik
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/grafik_izin'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grafik_izin' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'grafik_izin' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'grafik_izin' ? 'text-maroon' : ''; ?>"></i>
											<p>Grafik Izin Terbit</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/grafik_izin_tahun'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grafik_izin_tahun' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'grafik_izin_tahun' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'grafik_izin_tahun' ? 'text-maroon' : ''; ?>"></i>
											<p>Grafik Izin Terbit (Tahun)</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/grafik_investasi'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grafik_investasi' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'grafik_investasi' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'grafik_investasi' ? 'text-maroon' : ''; ?>"></i>
											<p>Grafik Realisasi Investasi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/grafik_skm'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grafik_skm' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'grafik_skm' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'grafik_skm' ? 'text-maroon' : ''; ?>"></i>
											<p>Grafik SKM</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/grafik_nib'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grafik_nib' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'grafik_nib' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'grafik_nib' ? 'text-maroon' : ''; ?>"></i>
											<p>Grafik NIB</p>
										</a>
									</li>
								</ul>
							</li>

							<!-- Running Teks -->
							<li class="nav-item">
								<a href="<?= base_url('admin/running_teks'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['running_teks'])) echo "active"; ?>">
									<i class="nav-icon fas fa-tools"></i>
									<p>Running Teks</p>
								</a>
							</li>

							<!-- Banner -->
							<li class="nav-item">
								<a href="<?= base_url('admin/banner'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['banner'])) echo "active"; ?>">
									<i class="nav-icon fas fa-image"></i>
									<p>Banner</p>
								</a>
							</li>

							<!-- Survey -->
							<li class="nav-item <?= in_array(
													$this->uri->segment(2),
													[
														'skm',
														'spkp_antikorupsi',
														'rekap_survey',
													]
												) ? 'menu-open' : ''; ?>">
								<a href="" class="nav-link <?= in_array(
																$this->uri->segment(2),
																[
																	'skm',
																	'spkp_antikorupsi',
																	'rekap_survey',
																]
															) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-poll"></i>
									<p>
										Survey
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('admin/skm'); ?>" class="nav-link <?= $this->uri->segment(2) == 'skm' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'skm' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'skm' ? 'text-maroon' : ''; ?>"></i>
											<p>SKM</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/spkp_antikorupsi'); ?>" class="nav-link <?= $this->uri->segment(2) == 'spkp_antikorupsi' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'spkp_antikorupsi' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'spkp_antikorupsi' ? 'text-maroon' : ''; ?>"></i>
											<p>SPKP & SPAK</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('admin/rekap_survey'); ?>" class="nav-link <?= $this->uri->segment(2) == 'rekap_survey' ? 'active' : ''; ?>">
											<i class="<?= $this->uri->segment(2) == 'rekap_survey' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(2) == 'rekap_survey' ? 'text-maroon' : ''; ?>"></i>
											<p>Rekap IKM</p>
										</a>
									</li>
								</ul>
							</li>

							<!-- Pesan -->
							<li class="nav-item" hidden>
								<a href="<?= base_url('admin/pesan'); ?>" class="nav-link <?php if (in_array($this->uri->segment(2), ['pesan'])) echo "active"; ?>">
									<i class="nav-icon fas fa-envelope"></i>
									<p>Pesan</p>
								</a>
							</li>

						<?php endif; ?>
						<!-- <div class="user-panel mb-1 d-flex"></div> -->

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="m-0"><?= $title; ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">
									<a class="text-maroon" href="<?= base_url('admin/home'); ?>">
										<i class="fas fa-home"></i> <?= $home; ?>
									</a>
								</li>

								<!-- Breadcrumb untuk Uri Segment 1 atau 2 -->
								<li class="breadcrumb-item active"><?= $title; ?></li>
								<!-- <?php if ($this->uri->segment(1) && !$this->uri->segment(2)) : ?>
                        <?php elseif ($this->uri->segment(1) && $this->uri->segment(2)) : ?>
                            <li class="breadcrumb-item active"><a href="<?= base_url($this->uri->segment(2)); ?>"><?= $title; ?></a></li>
                        <?php endif; ?> -->

								<!-- Breadcrumb untuk Halaman Tambah User, Update User, Hapus User -->
								<?php if ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'update' || $this->uri->segment(2) == 'delete') : ?>
									<li class="breadcrumb-item active"><?= $action; ?></li>
								<?php endif; ?>

							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->