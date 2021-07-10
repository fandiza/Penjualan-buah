-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2021 pada 16.49
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

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
  `stok_rusak` float NOT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `stok_rusak`, `satuan`) VALUES
(14, 'Semangka', '6000', '9000', 63, 15, 'kg'),
(15, 'Melon', '6000', '8000', 11, 0, 'kg'),
(16, 'Jeruk', '8000', '10000', 20, 0, 'kg'),
(17, 'Apel', '20000', '27000', 132, 0, 'kg'),
(18, 'Pear', '15000', '23000', 144, 0, 'kg'),
(23, 'Pepaya', '10000', '12000', 27, 3, 'kg');

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
(17, '2021-04-26', '2021-05-08', 80, 4, 15, 14),
(18, '2021-04-26', '2021-05-08', 70, 4, 16, 14),
(19, '2021-04-26', '2021-06-05', 50, 5, 17, 14),
(20, '2021-04-26', '2021-05-08', 60, 9, 18, 14),
(21, '2021-04-26', '2021-04-28', 12.4, 4, 14, 14),
(23, '2021-06-04', '2021-06-06', 50, 5, 17, 14),
(28, '2021-06-21', '2021-07-10', 100, 8, 14, 14),
(29, '2021-06-21', '2021-07-03', 10, 4, 18, 14),
(30, '2021-06-21', '2021-07-03', 10, 4, 14, 14),
(31, '2021-06-21', '2021-07-03', 100, 4, 18, 14),
(32, '2021-06-21', '2021-07-03', 100, 4, 17, 14),
(33, '2021-06-21', '2021-07-10', 30, 4, 23, 14),
(34, '2021-06-21', '2021-07-10', 30, 4, 23, 14),
(35, '2021-06-21', '2021-07-10', 30, 4, 23, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_toko`
--

CREATE TABLE `data_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(80) DEFAULT NULL,
  `nama_pemilik` varchar(80) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` text NOT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_toko`
--

INSERT INTO `data_toko` (`id`, `nama_toko`, `nama_pemilik`, `no_telepon`, `email`, `alamat`) VALUES
(1, 'Toko Buah Bening Wlingi', 'Fandi Zahiradana', '082134821070', 'noviargr@gmail.com', 'Jl. Raya Bening No.29, Beru, Kec. Wlingi, Blitar, Jawa Timur 66184');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_barang` varchar(20) DEFAULT NULL,
  `jumlah_barang` float DEFAULT NULL,
  `diskon` float NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `sub_total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `no_penjualan`, `nama_barang`, `harga_barang`, `jumlah_barang`, `diskon`, `satuan`, `sub_total`) VALUES
(3, '130142260421', 'Jeruk', '10000', 3, 0, 'kg', '30000'),
(4, '130142260421', 'Apel', '27000', 5, 0, 'kg', '135000'),
(5, '130142260421', 'Pear', '23000', 4, 0, 'kg', '92000'),
(15, '012024020521', 'Melon', '8000', 1, 0, 'kg', '8000'),
(16, '041903020521', 'Melon', '8000', 1, 0, 'kg', '8000'),
(17, '042023020521', 'Semangka', '7000', 10, 0, 'kg', '70000'),
(18, '214521030521', 'Semangka', '7000', 10, 0, 'kg', '70000'),
(19, '213921070521', 'Melon', '8000', 5, 0, 'kg', '40000'),
(20, '213921070521', 'Pear', '23000', 6, 0, 'kg', '138000'),
(21, '213921070521', 'Semangka', '7000', 5, 0, 'kg', '35000'),
(22, '221132070521', 'Semangka', '7000', 0.7, 0, 'kg', '4900'),
(23, '221159070521', 'Semangka', '7000', 1.5, 0, 'kg', '10500'),
(24, '221252070521', 'Semangka', '7000', 1.3, 0, 'kg', '9100'),
(25, '221336070521', 'Semangka', '7000', 0.7, 0, 'kg', '4900'),
(26, '164149250521', 'Semangka', '7000', 19, 0, 'kg', '133000'),
(27, '114927040621', 'Semangka', '7000', 1, 0, 'kg', '7000'),
(28, '114927040621', 'Apel', '27000', 1, 0, 'kg', '27000'),
(29, '115443040621', 'Semangka', '7000', 42, 0, 'kg', '294000'),
(30, '174439040621', 'Melon', '8000', 60, 0, 'kg', '480000'),
(31, '200536040621', 'Apel', '27000', 2, 0, 'kg', '54000'),
(32, '200536040621', 'Pear', '23000', 5, 0, 'kg', '115000'),
(33, '222801090621', 'Semangka', '7000', 1, 10, 'kg', '6300'),
(34, '222801090621', 'Melon', '8000', 1, 0, 'kg', '8000'),
(35, '223056090621', 'Semangka', '7000', 1, 10, 'kg', '6300'),
(36, '234722090621', 'Semangka', '7000', 10, 10, 'kg', '63000'),
(37, '234722090621', 'Jeruk', '10000', 11, 0, 'kg', '110000'),
(38, '002650100621', 'Pare', '11000', 14, 0, 'pak', '154000'),
(39, '002650100621', 'Apel', '27000', 9, 0, 'kg', '243000'),
(40, '220359170621', 'Jeruk', '10000', 1, 0, 'kg', '10000'),
(41, '223416170621', 'Jeruk', '10000', 1, 0, 'kg', '10000'),
(42, '223416170621', 'Apel', '27000', 1, 0, 'kg', '27000'),
(44, '130941180621', 'Jeruk', '10000', 11, 0, 'kg', '110000'),
(45, '010800190621', 'Jeruk', '10000', 11, 0, 'kg', '110000'),
(46, '214545060721', 'Semangka', '9000', 1, 10, 'kg', '8100'),
(47, '214803060721', 'Semangka', '9000', 1, 10, 'kg', '8100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `tgl_penjualan` date NOT NULL,
  `jam_penjualan` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_penjualan`, `nama_kasir`, `tgl_penjualan`, `jam_penjualan`, `total`, `potongan`) VALUES
(29, '012024020521', 'fandizaq', '2021-05-02', '01:20:24', 8000, 0),
(30, '041903020521', 'fandizaq', '2021-05-02', '04:19:03', 8000, 0),
(31, '042023020521', 'fandizaq', '2021-05-02', '04:20:23', 70000, 0),
(32, '214521030521', 'fandizaq', '2021-05-03', '21:45:21', 70000, 0),
(33, '213921070521', 'fandizaq', '2021-05-07', '21:39:21', 213000, 0),
(34, '221132070521', 'fandizaq', '2021-05-07', '22:11:32', 4900, 0),
(35, '221159070521', 'fandizaq', '2021-05-07', '22:11:59', 10500, 0),
(36, '221252070521', 'fandizaq', '2021-05-07', '22:12:52', 9100, 0),
(37, '221336070521', 'fandizaq', '2021-05-07', '22:13:36', 4900, 0),
(38, '164149250521', 'fandizaq', '2021-05-25', '16:41:49', 133000, 0),
(39, '114927040621', 'fandizaq', '2021-06-04', '11:49:27', 34000, 0),
(40, '115443040621', 'fandizaq', '2021-06-04', '11:54:43', 294000, 0),
(41, '174439040621', 'fandizaq', '2021-06-04', '17:44:39', 480000, 0),
(42, '200536040621', 'fandizaq', '2021-06-04', '20:05:36', 169000, 0),
(43, '222801090621', 'fandizaq', '2021-06-09', '22:28:01', 14300, 0),
(44, '223056090621', 'fandizaq', '2021-06-09', '22:30:56', 6300, 0),
(45, '234722090621', 'fandizaq', '2021-06-09', '23:47:22', 164350, 0),
(46, '002650100621', 'fandizaq', '2021-06-10', '00:26:50', 377150, 19850),
(47, '220245170621', 'fandizaq', '2021-06-17', '22:02:45', 0, 0),
(48, '220310170621', 'fandizaq', '2021-06-17', '22:03:10', 0, 0),
(49, '220324170621', 'fandizaq', '2021-06-17', '22:03:24', 0, 0),
(50, '220359170621', 'fandizaq', '2021-06-17', '22:03:59', 10000, 0),
(51, '221357170621', 'fandizaq', '2021-06-17', '22:13:57', 0, 0),
(52, '221902170621', 'fandizaq', '2021-06-17', '22:19:02', 0, 0),
(53, '223416170621', 'fandizaq', '2021-06-17', '22:34:16', 37000, 0),
(55, '130941180621', 'fandizaq', '2021-06-18', '13:09:41', 110000, 0),
(56, '010800190621', 'fandizaq', '2021-06-19', '01:08:00', 104500, 5500),
(57, '214545060721', 'Fandizaq', '2021-07-06', '21:45:45', 8100, 0),
(58, '214803060721', 'Fandizaq', '2021-07-06', '21:48:03', 8100, 0);

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
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `last_login`) VALUES
(14, 'Fandizaq', 'fandi', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2021-07-06 11:13:21'),
(15, 'karyawan', 'karyawan', '827ccb0eea8a706c4c34a16891f84e7b', 'kasir', '2021-07-06 11:51:34'),
(16, 'graha', 'graha', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2021-07-06 11:14:44');

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
  ADD PRIMARY KEY (`id_detail`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `data_toko`
--
ALTER TABLE `data_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `barang_masuk_ibfk_4` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
