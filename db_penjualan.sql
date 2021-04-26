-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2021 pada 08.29
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_beli` varchar(100) DEFAULT NULL,
  `harga_jual` varchar(100) DEFAULT NULL,
  `stok` float DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `satuan`) VALUES
(14, 'Semangka', '5000', '7000', 97.7, 'kg'),
(15, 'Melon', '6000', '8000', 80, 'kg'),
(16, 'Jeruk', '8000', '10000', 66, 'kg'),
(17, 'Apel', '20000', '27000', 45, 'kg'),
(18, 'Pear', '15000', '23000', 56, 'kg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(20) NOT NULL,
  `tanggalmasuk` date NOT NULL,
  `exp` date NOT NULL,
  `jumlah` float NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `tanggalmasuk`, `exp`, `jumlah`, `id_supplier`, `id_barang`, `id_user`) VALUES
(16, '2021-04-26', '2021-05-08', 100, 4, 14, 14),
(17, '2021-04-26', '2021-05-08', 80, 4, 15, 14),
(18, '2021-04-26', '2021-05-08', 70, 4, 16, 14),
(19, '2021-04-26', '2021-06-05', 50, 5, 17, 14),
(20, '2021-04-26', '2021-05-08', 60, 9, 18, 14),
(21, '2021-04-26', '2021-04-28', 12.4, 4, 14, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_toko`
--

CREATE TABLE `data_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(80) DEFAULT NULL,
  `nama_pemilik` varchar(80) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_toko`
--

INSERT INTO `data_toko` (`id`, `nama_toko`, `nama_pemilik`, `no_telepon`, `alamat`) VALUES
(1, 'Toko Buah Bening Wlingi', 'Fandi Zahiradana', '082134821070', 'Jl. Raya Bening No.29, Beru, Kec. Wlingi, Blitar, Jawa Timur 66184');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_barang` varchar(20) DEFAULT NULL,
  `jumlah_barang` float DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `sub_total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`no_penjualan`, `nama_barang`, `harga_barang`, `jumlah_barang`, `satuan`, `sub_total`) VALUES
('130120260421', 'Semangka', '7000', 2, 'kg', '14000'),
('130120260421', 'Jeruk', '10000', 1, 'kg', '10000'),
('130142260421', 'Jeruk', '10000', 3, 'kg', '30000'),
('130142260421', 'Apel', '27000', 5, 'kg', '135000'),
('130142260421', 'Pear', '23000', 4, 'kg', '92000'),
('131633260421', 'Semangka', '7000', 10.4, 'kg', '72800'),
('131747260421', 'Semangka', '7000', 2.3, 'kg', '16099.999999999998');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `tgl_penjualan` varchar(20) DEFAULT NULL,
  `jam_penjualan` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_penjualan`, `nama_kasir`, `tgl_penjualan`, `jam_penjualan`, `total`) VALUES
(19, '130120260421', 'fandizaq', '26/04/2021', '13:01:20', 24000),
(20, '130142260421', 'fandizaq', '26/04/2021', '13:01:42', 257000),
(21, '131633260421', 'fandizaq', '26/04/2021', '13:16:33', 72800),
(22, '131747260421', 'fandizaq', '26/04/2021', '13:17:47', 16099);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_sup` varchar(200) NOT NULL,
  `no_telp` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_sup`, `no_telp`, `alamat`) VALUES
(4, 'erga', '0821373182', 'gurid'),
(5, 'winandri', '08216128272', 'bojonegoro'),
(8, 'breng', '1234', 'blitar'),
(9, 'rijal', '323542', 'wlingi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','kasir') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `last_login`) VALUES
(14, 'fandizaq', 'fandi', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2021-04-25 16:26:57'),
(15, 'winandri', 'winandri', '1234', 'kasir', '2021-04-24 17:07:08'),
(16, 'graha', 'graha', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2021-04-25 18:29:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `data_toko`
--
ALTER TABLE `data_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD KEY `no_penjualan` (`no_penjualan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `data_toko`
--
ALTER TABLE `data_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
