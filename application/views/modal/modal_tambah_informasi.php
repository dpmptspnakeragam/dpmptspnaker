<script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<div class="modal fade" id="ModalTambahBerita" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" action="<?= base_url('admin/informasi/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php foreach ($idmax->result() as $row) {
                    ?>
                        <div hidden class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $row->idmax + 1; ?>">
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label" for="kategori">Kategori</label>
                                <select required name="id_kategori" id="kategori" class="form-control">
                                    <?php foreach ($kategori->result() as $row) {
                                    ?>
                                        <option value="<?= $row->id_kategori; ?>"><?= $row->kategori; ?></option>;}
                                    <?php }    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input class="form-control" id="judul" name="judul_berita" placeholder="Judul Berita" required>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label for="rangkuman">Rangkuman</label>
                                <textarea type="text" id="rangkuman" class="form-control ckeditor" rows="3" name="rangkuman" placeholder="Rangkuman Berita" required></textarea>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="isiberita">Isi</label>
                                <textarea id="isiberita" class="form-control ckeditor" name="isi_berita" placeholder="Isi Berita" required></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" class="form-control" name="tgl_berita" placeholder="Tanggal" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label><br>
                                <input type="file" id="thumbnail" name="gambar" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>