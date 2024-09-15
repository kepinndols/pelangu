-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Sep 2024 pada 10.51
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelangu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sandi` varchar(400) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `nama`, `email`, `sandi`, `tanggal_dibuat`) VALUES
(10, 'kepin', 'kevin sinatra', 'kepin@gmail.com', '$2y$10$FjNsh2ZZKIHJR37HKwKYDOIVtquXI8xW7jrz6rCH5f7KoF8LqiCjy', '2024-09-14 08:23:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `bulan_tahun` date NOT NULL,
  `total_pemasukan` decimal(10,2) DEFAULT 0.00,
  `total_pengeluaran` decimal(10,2) DEFAULT 0.00,
  `keseimbangan` decimal(10,2) DEFAULT 0.00,
  `tanggal_diperbarui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_pengguna`, `bulan_tahun`, `total_pemasukan`, `total_pengeluaran`, `keseimbangan`, `tanggal_diperbarui`) VALUES
(1, 10, '2024-09-01', '12000.00', '0.00', '12000.00', '2024-09-14 08:43:33'),
(2, 10, '2024-09-01', '12000.00', '6000.00', '6000.00', '2024-09-14 08:43:46'),
(3, 10, '2024-09-01', '46000.00', '6000.00', '40000.00', '2024-09-14 10:03:03'),
(4, 10, '2024-09-01', '58500.00', '6000.00', '52500.00', '2024-09-14 10:03:13'),
(5, 10, '2024-09-01', '58500.00', '46000.00', '12500.00', '2024-09-14 10:03:22'),
(6, 10, '2024-09-01', '89500.00', '46000.00', '43500.00', '2024-09-14 10:03:40'),
(7, 10, '2024-09-01', '99500.00', '46000.00', '53500.00', '2024-09-14 10:08:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tipe` enum('pemasukan','pengeluaran') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pengguna`, `jumlah`, `tipe`, `catatan`, `tanggal_transaksi`, `tanggal_dibuat`) VALUES
(1, 10, '12000.00', 'pemasukan', '1', '2024-09-14', '2024-09-14 08:43:33'),
(2, 10, '6000.00', 'pengeluaran', '2', '2024-09-14', '2024-09-14 08:43:46'),
(3, 10, '34000.00', 'pemasukan', 'a', '2024-09-14', '2024-09-14 10:03:03'),
(4, 10, '12500.00', 'pemasukan', 'mantap', '2024-09-14', '2024-09-14 10:03:13'),
(5, 10, '40000.00', 'pengeluaran', 'a', '2024-09-14', '2024-09-14 10:03:22'),
(6, 10, '31000.00', 'pemasukan', 'wewe', '2024-09-14', '2024-09-14 10:03:40'),
(7, 10, '10000.00', 'pemasukan', 'sdfgh', '2024-09-14', '2024-09-14 10:08:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
