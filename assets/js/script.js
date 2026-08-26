$(".page-scroll").on("click", function (e) {
	var tujuan = $(this).attr("href");

	var elemenTujuan = $(tujuan);

	$("html, body").animate(
		{
			scrollTop: elemenTujuan.offset().top - 55,
		},
		0,
		"easeInOutExpo",
	);

	e.preventDefault();
});

// parallax
$(window).on("load", function () {
	$(".jumbotronimg").addClass("muncul");
	$(".jumbotronteks").addClass("muncul");
});

$(window).scroll(function () {
	var wScroll = $(this).scrollTop();

	if (wScroll > $("#profil").offset().top - 57) {
		$(".pilih-profil, .slogan").each(function (i) {
			setTimeout(
				function () {
					$(".pilih-profil, .slogan").eq(i).addClass("muncul");
				},
				100 * (i + 1),
			);
		});
	}

	if (wScroll > $("#pelayanan").offset().top - 57) {
		$(".pilih-pelayanan, .isi-pelayanan").each(function (i) {
			setTimeout(
				function () {
					$(".pilih-pelayanan, .isi-pelayanan").eq(i).addClass("muncul");
				},
				100 * (i + 1),
			);
		});
	}

	if (wScroll > $("#investasi").offset().top - 57) {
		$(".pilih-investasi, .peta-investasi, .penjelasan-investasi").each(
			function (i) {
				setTimeout(
					function () {
						$(".pilih-investasi, .peta-investasi, .penjelasan-investasi")
							.eq(i)
							.addClass("muncul");
					},
					100 * (i + 1),
				);
			},
		);
	}

	if (wScroll > $("#pengaduan").offset().top - 57) {
		$(".mekanisme-pengaduan, .form-pengaduan, .pilih-pengaduan").each(
			function (i) {
				setTimeout(
					function () {
						$(".mekanisme-pengaduan, .form-pengaduan, .pilih-pengaduan")
							.eq(i)
							.addClass("muncul");
					},
					100 * (i + 1),
				);
			},
		);
	}
});

// close parallax
