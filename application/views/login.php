<div class="login-box">
    <div class="card card-outline card-maroon">
        <div class="card-header text-center">
            <img src="<?= base_url('assets/'); ?>img/vectoragam.png" alt="Logo Agam"
                style="max-height: 90px; width: auto; margin-bottom: 10px;">
        </div>
        <div class="card-header text-center">
            <h4 class="text-center font-weight-bold" style="font-size: 1.1rem; line-height: 1.4;">DINAS PENANAMAN MODAL
                PELAYANAN TERPADU SATU PINTU KABUPATEN AGAM</h4>
            <h5 class="text-center text-muted">Aplikasi Portal Login</h5>
        </div>
        <div class="card-body">
            <?= form_open('login_now'); ?>
            <div class="mb-3">
                <label for="usrname" class="font-weight-semibold text-sm">Username</label>
                <div class="input-group">
                    <input type="text" name="usrname" id="usrname" class="form-control" placeholder="Masukkan username"
                        value="<?= set_value('usrname'); ?>" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <small class="form-text text-danger"><?= form_error('usrname'); ?></small>
            </div>
            <div class="mb-3">
                <label for="pssword" class="font-weight-semibold text-sm">Password</label>
                <div class="input-group">
                    <input type="password" name="pssword" id="pssword" class="form-control"
                        placeholder="Masukkan password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small class="form-text text-danger"><?= form_error('pssword'); ?></small>
            </div>
            <div class="row pt-2">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-danger btn-block font-weight-bold shadow-sm">
                        <i class="fas fa-sign-in-alt mr-1"></i> SIGN IN
                    </button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>