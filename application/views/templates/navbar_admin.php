<nav class="navbar header-admin navbar-dark p-0 sticky-top flex-md-nowrap shadow">
    <a class="navbar-brand brand col-sm-3 col-md-2 mr-0" href="<?= base_url(); ?>welcome">
        <img src="<?= base_url(); ?>assets/img/logo_dpmptsp.png" width="75px" alt="Logo Agam">
    </a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?= base_url('logout'); ?>"><i class="fa fa-sign-out-alt"></i> Log Out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <?php if ($this->session->userdata('username') != 'pengaduan'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>welcome">
                                <span data-feather="home"></span>
                                Home <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>manage-aset">
                                <span data-feather="archive"></span>
                                Manajemen Aset
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#profil" role="button" aria-expanded="false" aria-controls="profil">
                                <span data-feather="book"></span>
                                Profil
                            </a>
                            <div class="collapse" id="profil">
                                <ul>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/kadis">Kepala Dinas</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/pegawai">Pegawai</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/regulasi">Regulasi</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/ppid">PPID</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/sarpras">Sarana & Prasana</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/pengaturan">Pengaturan Teks</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>admin/informasi">
                                <span data-feather="info"></span>
                                Informasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                                <span data-feather="book"></span>
                                Layanan
                            </a>
                            <div class="collapse" id="collapse1">
                                <ul>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/standar_pelayanan">Standar Pelayanan</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/perizinan">Perizinan</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/nonperizinan">Non Perizinan</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/perizinan_risiko">Perizinan Berbasis Risiko</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_izin">Grafik Izin Terbit</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse1">
                                <span data-feather="dollar-sign"></span>
                                Investasi
                            </a>
                            <div class="collapse" id="collapse3">
                                <ul>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/investasi">Peluang Investasi</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/potensi_investasi">Potensi Investasi</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/tanah_ulayat">Tanah Ulayat Untuk Investasi</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>admin/pengaduan">
                            <span data-feather="info"></span>
                            Pengaduan
                        </a>
                    </li>
                    <?php if ($this->session->userdata('username') != 'pengaduan'): ?>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse1">
                                <span data-feather="trending-up"></span>
                                Grafik
                            </a>
                            <div class="collapse" id="collapse2">
                                <ul>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_izin">Grafik Izin Terbit</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_izin_tahun">Grafik Izin Terbit (Tahun)</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_investasi">Grafik Realisasi Investasi</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_skm">Grafik SKM</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/grafik_nib">Grafik NIB</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>admin/runningteks">
                                <span data-feather="info"></span>
                                Running Teks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>admin/banner">
                                <span data-feather="image"></span>
                                Banner
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>admin/skm">
                            <span data-feather="file"></span>
                            Survey Kepuasan masyarakat (SKM)
                        </a>
                    </li> -->
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#survey" role="button" aria-expanded="false" aria-controls="collapse1">
                                <span data-feather="trending-up"></span>
                                Survey
                            </a>
                            <div class="collapse" id="survey">
                                <ul>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/skm">Kepuasan masyarakat (SKM)</a></li>
                                    <li><a class="nav-link" href="<?= base_url(); ?>admin/spkp_antikorupsi">SPKP & Anti Korupsi</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>