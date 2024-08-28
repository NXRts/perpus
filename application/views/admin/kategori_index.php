<?= $this->session->flashdata('notifikasi', TRUE) ?>

<!-- modal -->
<div class="mb-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
        Tambah Kategori
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/kategori/simpan') ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Kategori buku</label>
                                <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori buku" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">Data Kategori</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($kategori as $kt) { ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td scope="row"><?= $kt['nama_kategori']; ?></td>
                    <td>
                        <a onClick="return confirm('Apakah anda yakin menghapus data ini');"
                            href="<?= base_url('admin/kategori/hapus/'.$kt['kategori_id']) ?>" class="btn-sm btn-danger">Hapus
                        </a>
                        <a href="<?= base_url('admin/kategori/edit/'.$kt['kategori_id']) ?>" class="btn-sm btn-warning">Edit
                        </a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>