<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<title>Halaman Tidak Ditemukan</title>
	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		.swal2-confirm.maroon-button {
			background-color: maroon !important;
			color: white !important;
		}
	</style>
</head>

<body>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				icon: 'error',
				title: '404 - Halaman Tidak Ditemukan',
				text: 'Maaf, halaman yang Anda cari tidak tersedia.',
				confirmButtonText: 'Kembali ke Beranda',
				customClass: {
					confirmButton: 'maroon-button'
				}
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "<?= base_url(); ?>";
				}
			});
		});
	</script>
</body>

</html>