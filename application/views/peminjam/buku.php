<?= $this->session->flashdata('notifikasi', TRUE) ?>

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
                        <a onClick="return confirm('Apakah anda yakin memasukan ini ke koleksi?');" 
                            href="<?= base_url('peminjam/buku/add_koleksi/'.$bk['buku_id']) ?>" class="btn-sm btn-danger">
                            Add favorite
                        </a>
                        <?php if($bk['status']=='Tersedia') { ?>
                            <a href="<?= base_url('peminjam/buku/ajukan/'.$bk['buku_id']) ?>" class="btn-sm btn-warning">
                                Pinjam
                            </a>
                        <?php } ?>
                        <a href="<?= base_url('peminjam/buku/ulasan/'.$bk['buku_id']) ?>" class="btn-sm btn-success">
                            Ulasan
                        </a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>