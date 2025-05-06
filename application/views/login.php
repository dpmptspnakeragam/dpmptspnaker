<div class="login-box">
    <div class="card card-outline card-maroon">
        <div class="card-header text-center">
            <img src="<?= base_url('assets/'); ?>img/vectoragam.png" alt="Logo Agam">
        </div>
        <div class="card-header text-center">
            <h4 class="text-center">DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU KABUPATEN AGAM</h4>
            <h5 class="text-center">Login</h5>
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login_now'); ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="mb-3">
                    <input type="text" name="usrname" class="form-control" placeholder="Username" required>
                    <small class="form-text text-danger"><?= form_error('usrname'); ?></small>
                </div>
                <div class="mb-3">
                    <input type="password" name="pssword" class="form-control" placeholder="Password" required>
                    <small class="form-text text-danger"><?= form_error('pssword'); ?></small>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-danger btn-block">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>