<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<style type="text/css">
    #mapreklame {
        height: 80vh;
        width: 100%;
        min-height: 500px;
        z-index: 1;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
    }
</style>

<main role="main">
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><strong><i class="fa fa-home"></i> Dashboard</strong></li>
                        <li class="breadcrumb-item active" aria-current="page">Peta Reklame</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div id="mapreklame"></div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Siapkan mesin Peta Leaflet
        // Koordinat tengah diset ke daerah Anda (Agam/Sumbar)
        var mymap = L.map('mapreklame').setView([-0.2499547, 100.159555], 10);

        // 2. Panggil gambar peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(mymap);

        // 3. Looping data reklame dari PHP ke JavaScript
        <?php if (!empty($reklame_grouped)): ?>
            <?php foreach ($reklame_grouped as $reklame): ?>
                <?php foreach ($reklame['lokasi'] as $lok): ?>

                    // Cek: Hanya proses jika Latitude dan Longitude tidak kosong
                    <?php if (!empty($lok['lat']) && !empty($lok['long'])): ?>

                        <?php
                        // Amankan data PHP sebelum masuk ke JS (Mencegah error karena tanda kutip)
                        $lat = str_replace(',', '.', $lok['lat']);
                        $long = str_replace(',', '.', $lok['long']);

                        $nama_pt = addslashes($reklame['nama_perusahaan']);
                        $no_hp = addslashes($reklame['no_hp']);
                        $ket = addslashes($reklame['ket']);
                        $masa = addslashes($reklame['masa_berlaku']);
                        $foto = base_url("assets/imgupload/" . $reklame['foto']);
                        ?>

                        // Buat variabel JS untuk koordinat
                        var titikLat = <?= (float)$lat ?>;
                        var titikLong = <?= (float)$long ?>;

                        // Buat isi desain Popup (Gunakan kutip dua dan plus agar sangat aman)
                        var isiPopup = "<div style='min-width:250px;'>" +
                            "<h6 class='border-bottom pb-2 mb-2'><strong><?= $nama_pt ?></strong></h6>" +
                            "<table class='table table-sm table-borderless mb-0'>" +
                            "<tr><td style='padding:0; width:40%;'>No. HP</td><td style='padding:0;'>: <?= $no_hp ?></td></tr>" +
                            "<tr><td style='padding:0;'>Masa Berlaku</td><td style='padding:0;'>: <?= $masa ?></td></tr>" +
                            "<tr><td style='padding:0;'>Status Pajak</td><td style='padding:0;'>: <?= $ket ?></td></tr>" +
                            "<tr><td colspan='2' class='text-center pt-2'><img src='<?= $foto ?>' class='img-fluid rounded' style='max-height:100px;'></td></tr>" +
                            "</table>" +
                            "</div>";

                        // Pasang Marker ke Peta
                        L.marker([titikLat, titikLong])
                            .addTo(mymap)
                            .bindPopup(isiPopup)
                            .bindTooltip("<?= $nama_pt ?>", {
                                direction: 'top'
                            }); // Nama muncul saat di-hover

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    });
</script>