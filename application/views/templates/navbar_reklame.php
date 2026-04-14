<nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #600574;">
    <div class="container d-flex flex-wrap">
        <a class="navbar-brand" href="<?= base_url(); ?>dashboard" style="color: #F2CB05;">
            <img src="<?= base_url(); ?>assets/img/agam.png" alt="Logo agam" style="width:20px;">
            <strong></i> SIREKAM</strong>
        </a>
        <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav navbar-reklame mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url(); ?>dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <?php if ($this->session->userdata('role_reklame') == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url(); ?>dashboard/data"><i class="bi bi-bar-chart-line"></i> Data</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url(); ?>dashboard/peta"><i class="bi bi-pin-map"></i> Peta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url(); ?>dashboard/laporan"><i class="bi bi-file-earmark-arrow-down-fill"></i> Laporan</a>
                </li>
            </ul>
        </div>
        <span class="text-white mr-3">
            <?= $this->session->userdata('nama_reklame'); ?>
        </span>
        <div class="btn btn-sm border-white" style="border-style:solid;">
            <a href="<?= base_url(); ?>login/logout">
                <i class="bi bi-door-closed icon-logout"></i>
            </a>
        </div>
    </div>
</nav>