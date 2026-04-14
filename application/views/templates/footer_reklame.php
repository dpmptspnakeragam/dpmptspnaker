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
                <form action="<?= base_url('login_reklame/logout'); ?>">
                    <button type="submit" class="btn btn-outline-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-1 py-3">
    <div class="container-fluid text-center">
        <span class="text-muted">Copyright 2025 &copy; Hizbul Hamdi Algalib</span>
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url(); ?>assets/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>assets/popper.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

<script>
    new DataTable('#DataTables1', {
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
    });

    function initDataTableIfHasData(selector, title) {
        const table = document.querySelector(selector);
        if (!table) return;

        const tbody = table.querySelector('tbody');
        const hasData = tbody && tbody.querySelectorAll('tr').length > 0;

        if (hasData) {
            new DataTable(table, {
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-earmark-excel"></i> Export ke Excel',
                    title: title,
                    className: 'btn btn-outline-success'
                }]
            });
        } else {
            new DataTable(table); // Tetap inisialisasi agar tabel tetap terformat
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        initDataTableIfHasData('#DataTables', 'Data Semua Reklame');
        initDataTableIfHasData('#DataTablesMasihBerlaku', 'Data Reklame Masih Berlaku');
        initDataTableIfHasData('#DataTablesTidakBerlaku', 'Data Reklame Tidak Berlaku');
        initDataTableIfHasData('#DataTablesSudahBayar', 'Data Reklame Sudah Setor');
        initDataTableIfHasData('#DataTablesBelumBayar', 'Data Reklame Belum Setor');
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#kecamatan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>admin/reklame/get_nagari",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_nagari + '>' + data[i].nama_nagari + '</option>';
                    }
                    $('#nagari').html(html);
                }
            });
            return false;
        });

    });
</script>
</body>

</html>