</div>
<!-- /.content-wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah ini jika Anda yakin untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="<?= base_url('admin/home/logout'); ?>">
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url('assets/'); ?>plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>

<!-- Tabel Data Custom -->
<script>
    $(function() {
        function DataTable(selectors) {
            selectors.forEach(function(selector) {
                $(selector).DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo($(selector + '_wrapper .col-md-6:eq(0)'));
            });
        }

        DataTable(["#TabelData1", "#TabelData2", "#TabelData3", "#TabelData4"]);
    });

    $(function() {
        function DataTable(selectors) {
            selectors.forEach(function(selector) {
                $(selector).DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo($(selector + '_wrapper .col-md-6:eq(0)'));
            });
        }

        DataTable(["#TabelDataPrint"]);
    });
</script>

<!-- Select 2 -->
<script>
    $(function() {
        // Inisialisasi Select2 secara global untuk semua modal
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this) // Set dropdownParent ke modal yang aktif
            });
        });
    });
</script>

<!-- Sweetalert 2 -->
<script>
    $(document).ready(function() {
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
                title: message
            });
        }

        // Cek flashdata dan tampilkan notifikasi sesuai jenisnya
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var alertKey = alert.getAttribute('data-alert-key');
            setTimeout(function() {
                alert.parentNode.removeChild(alert); // Menghapus elemen alert dari DOM
                // Hapus juga flashdata sesuai dengan kunci alert
                <?php if ($this->session->flashdata('success')) : ?>
                    if (alertKey === 'success') {
                        <?= $this->session->set_flashdata('success', ''); ?>
                    }
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')) : ?>
                    if (alertKey === 'error') {
                        <?= $this->session->set_flashdata('error', ''); ?>
                    }
                <?php endif; ?>
                <?php if ($this->session->flashdata('warning')) : ?>
                    if (alertKey === 'warning') {
                        <?= $this->session->set_flashdata('warning', ''); ?>
                    }
                <?php endif; ?>
            }, 5000); // Menghapus setelah 5 detik (5000 milidetik)
        });
    });
</script>

<!-- Ekko Lightbox -->
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });


        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>

</body>

</html>