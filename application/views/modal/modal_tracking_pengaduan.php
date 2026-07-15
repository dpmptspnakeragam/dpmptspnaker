<!-- Modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $("#btn-tracking-pengaduan").click(function () {
            var no_pengaduan = $("#no_pengaduan").val();
            $.ajax({
                url: '<?= base_url(); ?>home/tracking_pengaduan',
                data: "no_pengaduan=" + no_pengaduan,
                datatype: "JSON",
                traditional: true,
                beforeSend: function () {
                    $(".spinner").css("display", "block");
                    $("#display-pengaduan").css("display", "none");
                    $("#display-pengaduan").empty();
                },
                success: function (data) {
                    if (data === null) {
                        $(".spinner").css("display", "none");
                        $('#display-pengaduan').html('<p>Maaf, Data tidak ditemukan. Silahkan periksa kembali Nomor Pengaduan Anda. Terima Kasih.</p>')
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
                error: function (error) {
                    $('#display-pengaduan').html('<p>Maaf, Data tidak ditemukan. Silahkan periksa kembali Nomor Pengaduan Anda. Terima Kasih.</p>')
                }
            });
        });
    });
</script>
<div class="modal fade" id="ModalTrackingPengaduan" tabindex="-1" role="dialog" aria-labelledby="ModalPelayanan"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan">Tracking Pengaduan</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-lg-12 mb-1">
                            <p>Tracking Pengaduan merupakan fitur yang dapat Anda gunakan untuk mengetahui sampai dimana
                                proses pengaduan yang anda laporkan dengan menggunakan No. Pengaduan yang didapat dari
                                Petugas Pengaduan Kami. Silahkan cek No. Pengaduan di formulir pengaduan Anda atau
                                hubungi Petugas Pengaduan untuk mendapatkan No. Pengaduan Anda.</p>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input id="no_pengaduan" class="form-control" name="no_pengaduan"
                                    placeholder="Masukkan No. Pengaduan Anda" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btn-tracking-pengaduan" class="btn-tracking text-center"><i
                                    class="ikon fa fa-search icon-square icon-32"></i> Tracking</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="display-pengaduan" class="bg-light p-3 text-left"></div>
                        </div>
                        <div class="d-flex justify-content-center col-lg-12">
                            <div class="spinner-grow spinner text-danger" role="status" style="display:none">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>