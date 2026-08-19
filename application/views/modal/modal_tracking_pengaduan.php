<div class="modal fade" id="ModalTrackingPengaduan" tabindex="-1" role="dialog" aria-labelledby="ModalPelayanan"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4 judul-modal" id="LabelModalPelayanan"><i class="ikon fa fa-search" aria-hidden="true"></i> Tracking Pengaduan</h5>
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