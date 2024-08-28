<?= $this->session->flashdata('notifikasi', TRUE) ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <form action="<?= base_url('peminjam/buku/submit_ulasan') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" value="<?= $buku['judul'] ?>" readonly>
                            <input type="hidden" name="buku_id" class="form-control" value="<?= $buku['buku_id'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="<?= $buku['penerbit'] ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Tahun terbit</label>
                            <input type="date" name="tahun_terbit" class="form-control"
                                value="<?= $buku['tahun_terbit'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Rating</label>
                            <select name="rating" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Ulasan</label>
                            <textarea name="ulasan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Berikan Ulasan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <?php foreach($ulasan as $ul) { ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title text-primary"><?= $ul['nama_lengkap'] ?> (<?= $ul['rating'] ?>) </h5>
                <p class="mb-2">
                    <?= $ul['ulasan'] ?>
                </p>
                <?php if($ul['user_id']==$this->session->userdata('user_id')) { ?>
                    <a onClick="return confirm('Apakah anda yakin menghapus ulasan ini?');" 
                        href="<?= base_url('peminjam/buku/ulasanhapus/'.$ul['buku_id']) ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>