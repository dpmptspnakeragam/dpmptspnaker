<div class="col-12 footer text-center mb-4 p-2">
  <!-- <p class="mb-0">Version: 1.0.2</p> -->
  <span>Copyright &copy; 2020 - <?= date("Y"); ?> Powered by Web Programmer DPMPTSP Kabupaten Agam</span>
</div>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jquery.easing.1.3.js"></script>
<script src="<?= base_url('assets/'); ?>js/script.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
  crossorigin="anonymous"></script>

<!-- Tracking Pengaduan -->
<script type="text/javascript" language="javascript">
  $(document).ready(function() {
    $("#btn-tracking-pengaduan").click(function() {
      var no_pengaduan = $("#no_pengaduan").val();

      // TAMBAHAN 1: Cek jika input kosong
      if (no_pengaduan.trim() === "") {
        $("#display-pengaduan").css("display", "block");
        $('#display-pengaduan').html('<div class="alert alert-warning text-center m-0"><b>Perhatian!</b> Nomor Pengaduan tidak boleh kosong.</div>');
        return false;
      }

      $.ajax({
        url: '<?= base_url(); ?>home/tracking_pengaduan',
        data: "no_pengaduan=" + no_pengaduan,
        datatype: "JSON",
        traditional: true,
        beforeSend: function() {
          $(".spinner").css("display", "block");
          $("#display-pengaduan").css("display", "none");
          $("#display-pengaduan").empty();
        },
        success: function(data) {
          // TAMBAHAN 2: Menampilkan pesan jika data null atau tidak ada
          if (data === null || data === "null" || data === "") {
            $(".spinner").css("display", "none");
            $("#display-pengaduan").css("display", "block");
            $('#display-pengaduan').html('<div class="alert alert-danger text-center m-0"><b>Maaf, Data tidak ditemukan.</b><br>Silahkan periksa kembali Nomor Pengaduan Anda. Terima Kasih.</div>');
          } else {
            var obj = jQuery.parseJSON(data)
            $(".spinner").css("display", "none");
            $("#display-pengaduan").css("display", "block");
            $('#display-pengaduan').html('<table><tr><td width="170px">No. Pengaduan</td><td width="10px">:</td><td width="350px"><b>' + obj[0].no_pengaduan + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Nama</td><td width="10px">:</td><td width="350px"><b>' + obj[0].nama + '</b></td><tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Alamat</td><td width="10px">:</td><td width="350px"><b>' + obj[0].alamat + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">No. HP</td><td width="10px">:</td><td width="350px"><b>' + obj[0].hp + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Email</td><td width="10px">:</td><td width="350px"><b>' + obj[0].email + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Jenis Pengaduan</td><td width="10px">:</td><td width="350px"><b>' + obj[0].jenis_pengaduan + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Lokasi Kejadian</td><td width="10px">:</td><td width="350px"><b>' + obj[0].lokasi_kejadian + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Waktu Kejadian</td><td width="10px">:</td><td width="350px"><b>' + obj[0].waktu_kejadian + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Materi Pengaduan</td><td width="10px">:</td><td width="350px"><b>' + obj[0].materi_pengaduan + '</b></td></tr>');
            $('#display-pengaduan').append('<tr><td width="170px">Status Pengaduan</td><td width="10px">:</td><td width="350px"><b>' + obj[0].status + '</b></td></tr></table>');
          }
        },
        error: function(error) {
          // TAMBAHAN 3: Pesan jika server error
          $(".spinner").css("display", "none");
          $("#display-pengaduan").css("display", "block");
          $('#display-pengaduan').html('<div class="alert alert-danger text-center m-0"><b>Terjadi Kesalahan Server.</b><br>Silahkan periksa kembali Nomor Pengaduan Anda. Terima Kasih.</div>');
        }
      });
    });
  });
</script>

<!-- Lihat Informasi -->
<script>
  function eksekusiKlik(idBerita) {
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    var sendData = {
      id: idBerita
    };
    sendData[csrfName] = csrfHash;

    $.ajax({
      url: "<?= base_url('home/klik_berita'); ?>",
      type: "POST",
      data: sendData,
      dataType: "JSON",
      success: function(response) {
        if (response.status === 'success') {
          var elemenView = $('#total-views-' + idBerita);
          var angkaSekarang = parseInt(elemenView.text()) || 0;

          elemenView.text(angkaSekarang + 1);
        } else {
          console.log("Server merespon 'failed'. Periksa query database.");
        }
      },
      error: function(xhr, status, error) {
        console.log("AJAX Gagal. Status: " + status + " | Error: " + error);
      }
    });
  }
</script>

<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
  $(document).ready(function() {
    $('#dataTable').dataTable({});
  });

  $(document).ready(function() {
    // Inisialisasi semua tabel
    $('#dataTable1, #dataTable2, #dataTable3, #dataTable4').DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "search": "Cari Informasi:",
        "lengthMenu": "Tampilkan _MENU_ data",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Data tidak tersedia",
        "paginate": {
          "next": "Berikutnya",
          "previous": "Sebelumnya"
        }
      }
    });

    // Perbaikan agar kolom tidak berantakan saat modal terbuka
    $('.modal').on('shown.bs.modal', function() {
      $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
  });
</script>

<script>
  function init() {
    var imgDefer = document.getElementsByTagName('img');
    for (var i = 0; i < imgDefer.length; i++) {
      if (imgDefer[i].getAttribute('data-src')) {
        imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
      }
    }
  }

  window.onload = init;
</script>

<!-- Script untuk menghapus alert setelah ditampilkan -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {

      // SOLUSI: Jika alert memiliki class 'no-auto-hide', jangan hapus otomatis!
      if (alert.classList.contains('no-auto-hide')) {
        return; // Skip dan lanjut ke alert berikutnya (jika ada)
      }

      var alertKey = alert.getAttribute('data-alert-key');
      setTimeout(function() {
        alert.parentNode.removeChild(alert); // Menghapus elemen alert dari DOM

        <?php if ($this->session->flashdata('berhasil')): ?>
          if (alertKey === 'berhasil') {
            <?= $this->session->set_flashdata('berhasil', ''); ?>
          }
        <?php endif; ?>
        <?php if ($this->session->flashdata('gagal')): ?>
          if (alertKey === 'gagal') {
            <?= $this->session->set_flashdata('gagal', ''); ?>
          }
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
          if (alertKey === 'warning') {
            <?= $this->session->set_flashdata('warning', ''); ?>
          }
        <?php endif; ?>
      }, 5000); // Menghapus setelah 5 detik
    });
  });
</script>

</body>

</html>