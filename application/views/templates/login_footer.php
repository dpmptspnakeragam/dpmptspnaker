<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

<!-- Tambahkan script ini di bagian bawah sebelum tag penutup body/footer -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#pssword');
    const icon = document.querySelector('#iconPassword');

    togglePassword.addEventListener('click', function(e) {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle ikon lock ke mata (eye)
        icon.classList.toggle('fa-eye-slash');
        icon.classList.toggle('fa-eye');
    });
</script>

<!-- Script Notifikasi SweetAlert -->
<script>
    $(document).ready(function() {
        function showToast(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: icon,
                title: message,
            });
        }

        <?php if ($this->session->flashdata('success')) { ?>
            showToast("success", '<?= $this->session->flashdata('success'); ?>');
            <?php $this->session->unset_userdata('success');
            ?>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            showToast("error", '<?= $this->session->flashdata('error'); ?>');
            <?php $this->session->unset_userdata('error');
            ?>
        <?php } ?>

        <?php if ($this->session->flashdata('warning')) { ?>
            showToast("warning", '<?= $this->session->flashdata('warning'); ?>');
            <?php $this->session->unset_userdata('warning');
            ?>
        <?php } ?>
    });
</script>

</body>

</html>