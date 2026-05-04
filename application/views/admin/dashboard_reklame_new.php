<main role="main" class="">
    <div class="container">
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
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-check"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Masih Berlaku</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php echo number_format($masih_berlaku); ?> (<?php echo number_format($persen_berlaku); ?>%)
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span>Total : <?php echo number_format($total); ?></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_berlaku); ?>%" aria-valuenow="<?php echo number_format($masih_berlaku); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_berlaku); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-cherry">
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
                            <div class="col-4 text-right">
                                <span>Total : <?php echo number_format($total); ?></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_berlakuhabis); ?>%" aria-valuenow="<?php echo number_format($berlaku_habis); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_berlakuhabis); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-check"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Sudah Bayar Retibusi</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php echo number_format($setor); ?> (<?php echo number_format($persen_setor); ?>%)
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span>Total : <?php echo number_format($total); ?></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_setor); ?>%" aria-valuenow="<?php echo number_format($setor); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_setor); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-6 col-lg-6">
                <div class="card shadow l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Belum Bayar Retribusi</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <?php echo number_format($belum_setor); ?> (<?php echo number_format($persen_belumsetor); ?>%)
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span>Total : <?php echo number_format($total); ?></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="<?php echo number_format($persen_belumsetor); ?>%" aria-valuenow=" <?php echo number_format($belum_setor); ?>" aria-valuemin="0" aria-valuemax="<?php echo number_format($total); ?>" style="width: <?php echo number_format($persen_belumsetor); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>