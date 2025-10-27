<body class="bg-dark">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="">
                <i class="fa fa-info mr-2"></i> Informasi
            </a>

            <!-- 🔍 Search di Navbar -->
            <form class="form-inline my-2 my-lg-0 ml-3">
                <input class="form-control form-control-sm mr-sm-2"
                    id="searchInput"
                    type="search"
                    placeholder="Cari Nama / Tanggal Berita"
                    aria-label="Search"
                    style="width: 250px;">
            </form>

            <!-- Tombol toggle -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu kanan -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="tutup" href="<?= base_url(); ?>home">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="content-wrapper informasi mt-5">
        <div class="container-fluid mb-0">

            <!-- 🔲 Daftar Berita -->
            <div class="row" id="beritaContainer">
                <?php foreach ($berita->result() as $row) {
                    $gambar     = $row->gambar ?? '';
                    $imagePath  = FCPATH . 'assets/imgupload/' . $gambar;
                    $imageSrc   = (!empty($gambar) && file_exists($imagePath))
                        ? base_url('assets/imgupload/' . $gambar)
                        : base_url('assets/img/agam.jpg');
                ?>
                    <div class="col-lg-4 col-6 mt-4 berita-item"
                        data-judul="<?= strtolower($row->judul_berita); ?>"
                        data-tanggal="<?= strtolower(date_indo($row->tgl_berita)); ?>">

                        <div class="card kartu-info shadow h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><?= $row->judul_berita ?></h5>
                            </div>

                            <div class="card-body">
                                <small class="d-block mb-3 tgl_berita2">
                                    <?= date_indo($row->tgl_berita) ?>, Kategori: <?= $row->kategori; ?>
                                </small>

                                <!-- 🔧 Gambar rapi (baik portrait maupun landscape) -->
                                <div class="img-container">
                                    <img class="gambar-info" src="<?= $imageSrc; ?>" alt="<?= $row->judul_berita; ?>">
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="#" class="tgl_berita2 text-light"
                                    data-toggle="modal"
                                    data-target="#DetailInformasi<?= $row->id_berita; ?>">Selengkapnya >></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- ⚠️ Pesan jika tidak ditemukan -->
            <div id="noResults" class="text-center text-light mt-5" style="display: none;">
                <h5><i class="fa fa-exclamation-circle text-warning"></i> Berita tidak ditemukan.</h5>
            </div>
        </div>

        <!-- Pagination -->
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-lg-12 custom-pagination">
                    <?= $pagination; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ✨ CSS Khusus Gambar -->
    <style>
        .img-container {
            width: 100%;
            height: 250px;
            /* tinggi seragam */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-container img.gambar-info {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* potong agar proporsional */
            object-position: center;
            transition: transform 0.3s ease;
        }

        /* efek zoom saat hover */
        .img-container:hover img.gambar-info {
            transform: scale(1.05);
        }
    </style>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // 🔍 Fungsi Pencarian
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                var visibleCount = 0;

                $('.berita-item').each(function() {
                    var isMatch =
                        $(this).data('judul').includes(value) ||
                        $(this).data('tanggal').includes(value);

                    $(this).toggle(isMatch);
                    if (isMatch) visibleCount++;
                });

                // Tampilkan / sembunyikan pesan jika tidak ada hasil
                if (visibleCount === 0) {
                    $('#noResults').show();
                } else {
                    $('#noResults').hide();
                }
            });
        });
    </script>
</body>