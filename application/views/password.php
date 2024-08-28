<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
    <form action="<?= base_url('auth/updatePassword') ?>" method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" class="form-control" name="passwordBaru" placeholder="Masukkan password baru"
                        required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="passwordKonf"
                    placeholder="Masukkan password Konfirmasi" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?= base_url('home') ?>" type="button" class="btn btn-outline-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>