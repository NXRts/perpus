<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
    <form action="<?= base_url('auth/update') ?>" method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $user->username; ?>" readonly>
                    <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama"
                        placeholder="Nama Lengkap" value="<?= $user->nama_lengkap; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $user->email; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $user->alamat; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="Admin" <?php if($user->role=="Admin"){ echo "selected"; } ?>>Admin</option>
                        <option value="Petugas" <?php if($user->role=="Petugas"){ echo "selected"; } ?>>Petugas</option>
                        <option value="Peminjam" <?php if($user->role=="Peminjam"){ echo "selected"; } ?>>Peminjam
                        </option>
                    </select>
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