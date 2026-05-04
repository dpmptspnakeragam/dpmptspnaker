<!-- Modal Tabel ID -->
<div class="modal fade" id="ModalTabelID" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Informasi Dikecualikan</h5>
                <button type="button" class="close text-light" data-toggle="modal" data-target="#ModalDetailPPID" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-hover" id="dataTable4" width="100%" cellspacing="0">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul Informasi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($id->result() as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->judul; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('assets/fileupload/' . $row->file); ?>" class="tombol-aksi" target="_blank">
                                            <i class="fas fa-file-download"></i> Lihat Informasi
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>