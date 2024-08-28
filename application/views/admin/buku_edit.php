<?= $this->session->flashdata('notifikasi', TRUE) ?>

<div class="card">
    <form action="<?= base_url('admin/buku/update') ?>" method="post">
        <input type="hidden" name="buku_id" value="<?= $buku['buku_id'] ?>"> <!-- Tambahkan ini untuk mengirimkan ID buku -->
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $buku['judul'] ?>">
                    <input type="hidden" name="buku_id" class="form-control" value="<?= $buku['buku_id'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= $buku['penulis'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $buku['penerbit'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Tahun terbit</label>
                    <input type="date" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <?php foreach($kategori as $kt) { ?>
                            <option value="<?= $kt['kategori_id'] ?>" <?= $buku['kategori_id'] == $kt['kategori_id'] ? 'selected' : '' ?>><?= $kt['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
