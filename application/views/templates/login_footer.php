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

<!-- Sweetalert 2 -->
<script>
    $(document).ready(function () {
        // Fungsi untuk menampilkan SweetAlert Toast
        function showToast(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "center",
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
                html: message // Menggunakan 'html' agar tag <b> atau format text lainnya tetap terbaca
            });
        }

        <?php if ($this->session->flashdata('success')) { ?>
            showToast("success", "<?= $this->session->flashdata('success'); ?>");
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            showToast("error", "<?= $this->session->flashdata('error'); ?>");
        <?php } ?>

        <?php if ($this->session->flashdata('warning')) { ?>
            showToast("warning", "<?= $this->session->flashdata('warning'); ?>");
        <?php } ?>
    });
</script>

</body>

</html>