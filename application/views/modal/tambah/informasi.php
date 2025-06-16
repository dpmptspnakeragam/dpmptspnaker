<script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- <hr>
                <h3 class="text-center">Kepala Dinas <br> Dari Masa Ke Masa</h3>
                <hr> -->
                <div class="card card-outline card-maroon">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form role="form" action="<?= base_url('admin/informasi/tambah'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">
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
                                <button type="submit" class="btn btn-outline-danger btn-block"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->