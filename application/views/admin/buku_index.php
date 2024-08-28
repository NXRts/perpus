<?= $this->session->flashdata('notifikasi', TRUE) ?>

<!-- modal -->
<div class="mb-3">
    <!-- Button trigger modal -->
    <?php if($this->session->userdata('role')=='Admin') { ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Tambah Buku
        </button>
    <?php } ?>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/buku/simpan') ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Penulis" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Tahun terbit</label>
                                <input type="date" name="tahun_terbit" class="form-control" placeholder="Tahun terbit"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <?php foreach($kategori as $kt) { ?>
                                    <option value="<?= $kt['kategori_id'] ?>"><?= $kt['nama_kategori'] ?></option>
                                    <?php } ?>
                                </select>
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
    <h5 class="card-header">Data Buku</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($buku as $bk) { ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td scope="row"><?= $bk['judul']; ?></td>
                    <td scope="row"><?= $bk['penulis']; ?></td>
                    <td scope="row"><?= $bk['penerbit']; ?></td>
                    <td scope="row"><?= $bk['nama_kategori']; ?></td>
                    <td scope="row"><?= $bk['tahun_terbit']; ?></td>
                    <td scope="row"><?= $bk['status']; ?></td>
                    <td>
                        <?php if($this->session->userdata('role')=='Admin') { ?>
                            <a onClick="return confirm('Apakah anda yakin menghapus data ini');"
                                href="<?= base_url('admin/buku/hapus/'.$bk['buku_id']) ?>" class="btn-sm btn-danger">
                                Hapus
                            </a>
                            <a href="<?= base_url('admin/buku/edit/'.$bk['buku_id']) ?>" class="btn-sm btn-warning">
                                Edit
                            </a>
                        <?php } ?>
                        <a href="<?= base_url('admin/buku/ulasan/'.$bk['buku_id']) ?>" class="btn-sm btn-success">
                            Ulasan
                        </a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>