-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2020 pada 23.24
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
-- Database: `dbaplikasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(3) NOT NULL,
  `nip` int(50) NOT NULL,
  `nama_guru` varchar(250) NOT NULL,
  `jk_guru` enum('L','P') NOT NULL,
  `almt_guru` text NOT NULL,
  `tlpn_guru` char(20) NOT NULL,
  `foto_guru` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `jk_guru`, `almt_guru`, `tlpn_guru`, `foto_guru`) VALUES
(5, 222, 'koko', 'P', 'add', '04', ''),
(6, 222, 'Luthfi Nurul Huda', 'L', 'Pakuniran', '0892', 'dd3e62d894c4cfc837cbd9a1354b251d.jpg'),
(7, 222, 'robit', 'L', 'sl', '08', '68630eb9dac44a3413d3588a41a40cb6.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(3) NOT NULL,
  `kode_kelas` varchar(40) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`) VALUES
(1, '001', 'X RPL 1'),
(2, '002', 'X RPL 10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(3) NOT NULL,
  `id_tahun_pelajaran` int(10) NOT NULL,
  `nisn` int(20) NOT NULL,
  `nama_siswa` varchar(250) NOT NULL,
  `jk_siswa` enum('L','P') NOT NULL,
  `almt_siswa` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_tahun_pelajaran`, `nisn`, `nama_siswa`, `jk_siswa`, `almt_siswa`, `foto`) VALUES
(2, 2, 1111, 'Luthfi Nurul Huda', 'P', 'Paiton', 'd20ab9230682e9a1cbbe547ef3606512.png'),
(3, 2, 2222, 'Zuhria Ulfa', 'P', 'Kraksaan', '7d23ffd04d0e7e81cb6459c21657e76c.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id_tahun_pelajaran` int(3) NOT NULL,
  `tahun_pelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id_tahun_pelajaran`, `tahun_pelajaran`) VALUES
(1, '2019-2020'),
(2, '2018-2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama_lengkap` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `level` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nama_lengkap`, `username`, `password`, `email`, `level`) VALUES
(4, 'Zuhria Ulfa', 'ulfaz', 'ccdc220a6d3306d64554779628b8518d', 'zuhriaulfa@gmail.com', 'user'),
(5, 'Luthfi Nurul Huda', 'luthfi', '7caa10591bb72fd099f4b367d7e14473', 'luthfirobit@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  ADD PRIMARY KEY (`id_tahun_pelajaran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id_tahun_pelajaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
