<div class="card">
    <form action="<?= base_url('peminjam/buku/pinjam') ?>" method="post">
        <input type="hidden" name="buku_id" value="<?= $buku['buku_id'] ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" value="<?= $buku['judul'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" value="<?= $buku['penulis'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" value="<?= $buku['penerbit'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Tahun terbit</label>
                    <input type="date" class="form-control" value="<?= $buku['tahun_terbit'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" class="form-control" value="<?= $buku['nama_kategori'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman"  class="form-control" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
        </div>
    </form>
</div>
