<!-- Modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $("#btn-tracking").click(function () {
            var no_permohonan = $("#no_permohonan").val();
            $.ajax({
                url: '<?= base_url(); ?>home/tracking_sicantik',
                data: "no_permohonan=" + no_permohonan,
                datatype: "JSON",
                traditional: true,
                beforeSend: function () {
                    $(".spinner").css("display", "block");
                    $("#display").css("display", "none");
                    $("#display").empty();
                },
                success: function (sicantik) {
                    if (sicantik === null) {
                        $(".spinner").css("display", "none");
                        $('#display').html('<p>Maaf, Data tidak ditemukan. Silahkan periksa kembali Nomor Permohonan Anda. Terima Kasih.</p>')
                    } else {
                        var obj = jQuery.parseJSON(sicantik),
                            coba = JSON.parse(obj),
                            last = coba.data.proses;
                        $(".spinner").css("display", "none");
                        $("#display").css("display", "block");
                        $('#display').html('<table><tr><td width="170px">No. Permohonan</td><td width="50px">:</td><td width="350px"><b>' + coba.data.pemohon[0].no_permohonan + '</b></td></tr>');
                        $('#display').append('<tr><td width="170px">Nama</td><td width="50px">:</td><td width="350px"><b>' + coba.data.pemohon[0].nama + '</b></td><tr>');
                        $('#display').append('<tr><td width="170px">Jenis Izin</td><td width="50px">:</td><td width="350px"><b>' + coba.data.pemohon[0].jenis_izin + '</b></td></tr>');
                        $('#display').append('<tr><td width="170px">Proses</td><td width="50px">:</td><td width="350px"><b>' + coba.data.proses[0].nama_proses + '</b></td></tr></table>');
                    }
                },
                error: function (error) {
                    $('#display').html('<p>Maaf, Data tidak ditemukan. Silahkan periksa kembali Nomor Permohonan Anda. Terima Kasih.</p>')
                }
            });
        });
    });
</script>
<div class="modal fade" id="ModalTracking" tabindex="-1" role="dialog" aria-labelledby="ModalPelayanan"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan">Tracking SiCantik</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-lg-12 mb-1">
                            <p>Tracking SiCantik merupakan fitur yang dapat Anda gunakan untuk mengetahui sampai dimana
                                proses izin yang anda ajukan dengan menggunakan No. Permohonan yang didapat dari Petugas
                                Front Office Kami. Silahkan Anda hubungi Petugas Front Office untuk mendapatkan No.
                                Permohonan Anda.</p>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input id="no_permohonan" class="form-control" name="no_permohonan"
                                    placeholder="Masukkan No. Permohonan Anda" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" id="btn-tracking" class="btn-tracking text-center"><i
                                    class="ikon fa fa-search icon-square icon-32"></i> Tracking</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="display" class="bg-light p-3 text-left"></div>
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