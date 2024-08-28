    <?= $this->session->flashdata('notifikasi', TRUE) ?>
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#smallModal">
        Laporan Peminjaman
    </button>

    <div class="card">
        <h5 class="card-header">Daftar Pengajuan Peminjaman Buku</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Peminjam</th>
                        <th>tanggal_peminjaman</th>
                        <th>tanggal_pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td>
                            <?php if($bk['status_peminjaman']=='Proses') { ?>
                            <a onClick="return confirm('Apakah anda yakin menyetujui peminjaman ini');"
                                href="<?= base_url('admin/peminjaman/terima/'.$bk['peminjaman_id'].'/'.$bk['buku_id']) ?>"
                                class="btn-sm btn-success">Terima</a>
                            <a onClick="return confirm('Apakah anda yakin menolak peminjaman ini');"
                                href="<?= base_url('admin/peminjaman/tolak/'.$bk['peminjaman_id']) ?>"
                                class="btn-sm btn-danger">Tolak</a>
                            <?php } ?>
                            <?php if($bk['status_peminjaman']=='Dipinjam') { ?>
                            <a onClick="return confirm('Apakah peminjam sudah mengembalikan buku ini');"
                                href="<?= base_url('admin/peminjaman/kembali/'.$bk['peminjaman_id'].'/'.$bk['buku_id']) ?>"
                                class="btn-sm btn-success">Kembalikan</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Small Modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="<?= base_url('admin/peminjaman/laporan') ?>" method="get" target="_blank">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Laporan Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal1" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tanggal Berakhir</label>
                                <input type="date" class="form-control" name="tanggal2" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="-">Semua</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Proses">Menunggu Persetujuan</option>
                                    <option value="Sudah Kembali">Sudah Dikembalikan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>