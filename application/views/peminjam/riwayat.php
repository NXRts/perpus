<?= $this->session->flashdata('notifikasi', TRUE) ?>

<div class="card">
    <h5 class="card-header">Data Buku</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>No</th>
                    <th>Judul</th>
                    <th>tanggal_peminjaman</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($buku as $bk) { ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td scope="row"><?= $bk['judul']; ?></td>
                    <td scope="row"><?= $bk['tanggal_peminjaman']; ?></td>
                    <td scope="row">
                        <?php if($bk['status_peminjaman']=='Proses'){
                            echo 'menunggu persetujuan';
                        } else {
                            echo $bk['status_peminjaman'];
                        } ?>
                    </td>
                    <td>
                        <?php if($bk['status_peminjaman']=='Proses') { ?>
                            <a onClick="return confirm('Apakah anda yakin membatalkan peminjaman ini');"
                                href="<?= base_url('peminjam/peminjaman/batal/'.$bk['peminjaman_id']) ?>" class="btn-sm btn-danger">Batalkan
                            </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>