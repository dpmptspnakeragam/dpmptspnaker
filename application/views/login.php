<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login DPMPTSP Kab. Agam</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
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

    <!-- jQuery -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.remove();
                }, 3000);
            });
        });
    </script>

</body>

</html>