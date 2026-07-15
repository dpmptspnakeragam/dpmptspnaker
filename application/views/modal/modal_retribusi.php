<!-- Modal -->
<div class="modal fade" id="ModalRetribusi" tabindex="-1" role="dialog" aria-labelledby="ModalRetribusi"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan">Simulasi Retribusi</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header header-retribusi" id="headingOne">
                            <h2 class="mb-0">
                                <a class="btn btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>PBG (Persetujuan Bangunan Gedung)</strong>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Some placeholder content for the first accordion panel. This panel is shown by default,
                                thanks to the <code>.show</code> class.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header header-retribusi" id="headingTwo">
                            <h2 class="mb-0">
                                <a class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    <strong>Izin Pemakaian Alat Berat</strong>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Berdasarkan Peraturan Daerah Kabupaten Agam Nomor 2 Tahun 2019, berikut simulasi tarif
                                Retribusi Izin Pemakaian Alat Berat yang berlaku :
                                <div class="control-group after-add-more">
                                    <div class="form-row">
                                        <div class="form-group col-md-11">
                                            <label for="alat">Alat Berat</label>
                                            <select class="form-control" name="alat" id="alat">
                                                <option value="3384363">Stone Crusher Cap 30 T/H Golden Star (Rp
                                                    3.384.363/hari)</option>
                                                <option value="2024327">Buldozer (Rp 2.024.327/hari)</option>
                                                <option value="1350548">Excavator Kobelco SK 130 L (Rp 1.350.548/hari)
                                                </option>
                                                <option value="1702112">Backhoe Loader CAT 428D (Rp 1.702.112/hari)
                                                </option>
                                                <option value="1534714">Excavator Hitachi Zaxis 210F (Rp 1.534.714/hari)
                                                </option>
                                                <option value="1598660">Wheel Loader Hitachi LX-80 (Rp 1.598.660/hari)
                                                </option>
                                                <option value="2397990">Motor Grader (Rp 2.397.990/hari)</option>
                                                <option value="939928">Tronton Nissan Diesel (Rp 939.928/hari)</option>
                                                <option value="799330">Stone Crusher Mini (Rp 799.330/hari)</option>
                                                <option value="201431">Mesin Gilas 6-8 Ton (Rp 201.431/hari)</option>
                                                <option value="1007156">Vibro Roller (Rp 1.007.156/hari)</option>
                                                <option value="159866">Mesin Gilas 2,5 Ton (Rp 159.866/hari)</option>
                                                <option value="319732">Vibro 1 Ton (Rp 319.732/hari)</option>
                                                <option value="1702112">Stamper (Rp 1.702.112/hari)</option>
                                                <option value="1119062">Aspal Distributor (Rp 1.119.062/hari)</option>
                                                <option value="479598">Air Compressor (Rp 479.598/hari)</option>
                                                <option value="159866">Padle Mixer (Rp 159.866/hari)</option>
                                                <option value="79771">Water Pump (Rp 79.771/hari)</option>
                                                <option value="601416">Aspal Sprayer (Rp 601.416/hari)</option>
                                                <option value="351705">Dump Truk(Rp 351.705/hari)</option>
                                                <option value="879263">Truk Flat Bed (Rp 879.263/hari)</option>
                                                <option value="959196">Mobil Derek (Rp 959.196/tarik)</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn btn-success add-more" type="button" title="tambah alat">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-11">
                                        <label for="waktu">Waktu</label>
                                        <input type="text" class="form-control" id="waktu"
                                            placeholder="Berapa Hari / Berapa Kali">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-1">
                                        <button id="hitung" class="btn btn-success" type="submit">Hitung</button>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="total">Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control" id="total" placeholder="Total"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div hidden class="copy">
                                    <div class="control-group">
                                        <div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="alattambahan">Alat Berat</label>
                                                <select class="form-control" name="alattambahan" id="alattambahan">
                                                    <option value="3384363">Stone Crusher Cap 30 T/H Golden Star (Rp
                                                        3.384.363/hari)</option>
                                                    <option value="2024327">Buldozer (Rp 2.024.327/hari)</option>
                                                    <option value="1350548">Excavator Kobelco SK 130 L (Rp
                                                        1.350.548/hari)</option>
                                                    <option value="1702112">Backhoe Loader CAT 428D (Rp 1.702.112/hari)
                                                    </option>
                                                    <option value="1534714">Excavator Hitachi Zaxis 210F (Rp
                                                        1.534.714/hari)</option>
                                                    <option value="1598660">Wheel Loader Hitachi LX-80 (Rp
                                                        1.598.660/hari)</option>
                                                    <option value="2397990">Motor Grader (Rp 2.397.990/hari)</option>
                                                    <option value="939928">Tronton Nissan Diesel (Rp 939.928/hari)
                                                    </option>
                                                    <option value="799330">Stone Crusher Mini (Rp 799.330/hari)</option>
                                                    <option value="201431">Mesin Gilas 6-8 Ton (Rp 201.431/hari)
                                                    </option>
                                                    <option value="1007156">Vibro Roller (Rp 1.007.156/hari)</option>
                                                    <option value="159866">Mesin Gilas 2,5 Ton (Rp 159.866/hari)
                                                    </option>
                                                    <option value="319732">Vibro 1 Ton (Rp 319.732/hari)</option>
                                                    <option value="1702112">Stamper (Rp 1.702.112/hari)</option>
                                                    <option value="1119062">Aspal Distributor (Rp 1.119.062/hari)
                                                    </option>
                                                    <option value="479598">Air Compressor (Rp 479.598/hari)</option>
                                                    <option value="159866">Padle Mixer (Rp 159.866/hari)</option>
                                                    <option value="79771">Water Pump (Rp 79.771/hari)</option>
                                                    <option value="601416">Aspal Sprayer (Rp 601.416/hari)</option>
                                                    <option value="351705">Dump Truk(Rp 351.705/hari)</option>
                                                    <option value="879263">Truk Flat Bed (Rp 879.263/hari)</option>
                                                    <option value="959196">Mobil Derek (Rp 959.196/tarik)</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <button class="btn btn-danger remove" type="button"
                                                    title="hapus alat"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header header-retribusi" id="headingThree">
                            <h2 class="mb-0">
                                <a class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    <strong>Izin Pemanfaatan Aset Daerah</strong>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel
                                is hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header header-retribusi" id="headingFour">
                            <h2 class="mb-0">
                                <a class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    <strong>Izin Reklame</strong>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel
                                is hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header header-retribusi" id="headingFive">
                            <h2 class="mb-0">
                                <a class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    <strong>Izin Penggunaan Racun Api</strong>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>Berdasarkan Peraturan Daerah Kabupaten Agam Nomor 1 Tahun 2012, berikut tarif
                                    Retribusi Izin Penggunaan Racun Api yang berlaku :
                                    <li>Isi s/d 9 liter ____________ Rp. 10.000</li>
                                    <li>Isi 10 s/d 20 liter _______ Rp. 12.000</li>
                                    <li>Isi sampai 50 liter ______ Rp. 15.000</li>
                                </ul>
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
<script type="text/javascript">
    $(document).ready(function () {
        $(".add-more").click(function () {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#hitung").click(function () {
            var alat = $("#alat").val();
            var alattambahan = $("#alattambahan").val();
            var waktu = $("#waktu").val();

            var total = (parseInt(alat) + parseInt(alattambahan)) * parseInt(waktu);
            $("#total").val(total);
        });
    });
</script>