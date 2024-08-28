<?= $this->session->flashdata('notifikasi', TRUE) ?>

<div class="row">
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
        <?php }
            if($ulasan==NULL){ echo "Belum Ada Ulasan"; }
        ?>
    </div>
</div>