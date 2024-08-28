<div class="card">
    <form action="<?= base_url('admin/kategori/update') ?>" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?= $kategori->nama_kategori ?>">
                    <input type="hidden" name="kategori_id" class="form-control" value="<?= $kategori->kategori_id ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?= base_url('admin/kategori') ?>" type="button" class="btn btn-outline-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
