<table border="1">
    <thead>
        <tr class="text-nowrap">
            <th>No</th>
            <th>Judul</th>
            <th>Peminjam</th>
            <th>tanggal_peminjaman</th>
            <th>tanggal_pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($buku as $bk) { ?>
        <tr>
            <td scope="row"><?= $no; ?></td>
            <td scope="row"><?= $bk['judul']; ?></td>
            <td scope="row"><?= $bk['nama_lengkap']; ?></td>
            <td scope="row"><?= $bk['tanggal_peminjaman']; ?></td>
            <td scope="row"><?= $bk['tanggal_pengembalian']; ?></td>
            <td scope="row">
                <?php if($bk['status_peminjaman']=='Proses'){
                            echo 'menunggu persetujuan';
                        } else {
                            echo $bk['status_peminjaman'];
                        } ?>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
<script>
windows.print();
</script>