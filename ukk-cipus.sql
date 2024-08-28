-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Agu 2024 pada 02.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk-cipus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `buku_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `sinopsis` text NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`buku_id`, `judul`, `sinopsis`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `cover`, `kategori_id`) VALUES
(26, 'Rumus Kebenaran Musim Panas: A Midsummer`s Equation (Manatsu no Hoteishiki)', 'Dalam kunjungannya ke Harigaura untuk menghadiri diskusi rencana proyek penggalian sumber daya bawah laut, Profesor Yukawa Manabu menyaksikan panasnya perdebatan di antara warga lokal. Sementara sebagian pihak mendukung rencana itu demi menghidupkan kembali perekonomian, pihak lain mati-matian menentang karena ingin menjaga kelestarian alam. Namun, bukan hanya proyek tersebut yang meresahkan kota itu. Keesokan paginya, salah satu tamu penginapan yang ditempati Yukawa ditemukan tewas di pantai berbatu-batu. Saat diketahui sang korban merupakan mantan polisi Tokyo dan tewas keracunan karbon monoksida, timbul kecurigaan bahwa ia dibunuh. Apa yang dilakukan mantan polisi itu di Harigaura? Apakah ada yang ingin membungkamnya? Kenapa? Sekali lagi, Yukawa mendapati dirinya berada di tengah misteri yang harus dipecahkan. Profil Penulis Buku Rumus Kebenaran Musim Panas: A Midsummer`s Equation (Manatsu no Hoteishiki): KEIGO HIGASHINO adalah salah satu penulis paling populer dan terlaris di Jepang dan beberapa negara Asia dengan lebih dari tiga puluh bestseller. Ratusan juta eksemplar bukunya terjual di seluruh dunia dan hampir dua puluh film dan serial televisi diadaptasi dari karyanya. Lahir di Osaka, dia mulai menulis novel saat masih bekerja di sebuah perusahaan sebelum memulai karier sebagai penulis profesional. Dia memenangkan Edogawa Rampo Prize untuk Hōkago (After School) dan Naoki Prize ke-134 untuk Yōgisha X no Kenshin (The Devotion of Suspect X). ', 'Keigo Higashino', 'Gramedia Pustaka Utama', '2023', 200, 'tu6gd96votouhgkspqtekw.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`) VALUES
(1, 'Manga'),
(2, 'Novel'),
(3, 'Kamus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksi`
--

CREATE TABLE `koleksi` (
  `koleksi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku_dipinjam` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int(11) NOT NULL,
  `status_peminjaman` enum('dipinjam','dikembalikan','dalam_proses') NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku_dipinjam`, `tanggal_peminjaman`, `tanggal_pengembalian`, `denda`, `status_peminjaman`, `petugas_id`) VALUES
(20, 10, 1, '2024-08-22', '2024-08-31', 0, 'dipinjam', 7),
(23, 16, 3, '2024-08-25', '2024-09-01', 0, 'dipinjam', 7),
(24, 12, 1, '2024-08-25', '2024-09-01', 0, 'dipinjam', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `ulasan_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `ulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('Admin','peminjam','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama`, `alamat`, `role`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin@gmail.com', 'Admin', 'Admin', 'Admin'),
(7, 'mbh candra', '$2y$10$E8ph5Bqx09LwqlteMrjPveJmxC6vlMsHwiIwku78xhf4TaFAfEPRW', 'candra29@gmail.com', 'V Candra K', 'mojogedang', 'petugas'),
(12, 'Giiooo', '$2y$10$756E7SKkKoWVum4C1fKWMuy0yt/6zWdEPuuZ2AHC7jJ.JLz4HIf2.', 'Giiooo@gmail.com', 'Giiooo36', '---', 'peminjam'),
(13, 'Petugas', '01d7ea7d5292dd951429a450d8eeb09d', 'Petugas@gmail.com', 'Petugas', 'Petugas', 'petugas'),
(17, 'Peminjam', 'c2095dfbc6af73974da22d5a0a772459', 'Peminjam@gmail.com', 'Peminjam', 'Peminjam', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`koleksi_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`ulasan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `koleksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `ulasan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
