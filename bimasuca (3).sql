-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2022 pada 10.58
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimasuca`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `super` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `super`) VALUES
(1, 'Hanustavira Guru Acarya', 'hanustavira.acarya@binus.ac.id', '$2a$12$RJ3G3vPrOmgk9Hf8Kxl9zOSTMVx3oYPlpQlk.3d6SGLg4VNT/eRQu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaign`
--

CREATE TABLE `campaign` (
  `id` int(100) NOT NULL,
  `nama_campaign` varchar(300) DEFAULT NULL,
  `tanggal_post` date DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `gambar` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `campaign`
--

INSERT INTO `campaign` (`id`, `nama_campaign`, `tanggal_post`, `deskripsi`, `gambar`) VALUES
(1, 'Bersih Hijau', '2022-05-05', 'Bersih hijau merupakan gerakan seribu sampah, seribu penanaman pohon', 'gogreen.png'),
(2, 'Kompos Untuk Lingkungan', '2022-05-05', 'Pembuatan pupuk kompos yang ramah lingkungan dan harganya terjangkau', 'kompos.png'),
(3, 'Memilah & Memilih Sampah', '2022-05-05', 'Gerakan pemilahan sampah yang terpadu dan terarah', 'pemilahan.png'),
(4, 'Kertas Daur Ulang', '2022-05-05', 'Pembuatan kertas daur ulang yang juga multipurpose', 'kertas.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` int(100) NOT NULL,
  `nama_event` varchar(300) DEFAULT NULL,
  `tempat` varchar(300) DEFAULT NULL,
  `tanggal_post` date DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `gambar` varchar(300) DEFAULT NULL,
  `kategori` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `nama_event`, `tempat`, `tanggal_post`, `tanggal`, `deskripsi`, `gambar`, `kategori`) VALUES
(1, 'Pameran Karya Barang Daur Ulang', 'Lobby Binus@Malang', '2022-05-05', '2022-05-12', 'Ikuti pameran dan bazaar barang daur ulang yang tentunya sangat bermanfaat bagi masyarakat', 'event1.jpeg', 2),
(2, 'Penukaran Sampah', 'Parkir Binus@Malang', '2022-05-05', '2022-05-06', 'Giat penukaran sampah menjadi uang', 'event2.jpg', 2),
(3, 'Pembuatan Pupuk Kompos', 'BBIB Singosari', '2022-05-05', '2022-05-13', 'Ikuti giat pembuatan sumur resapan di Balai Besar Inseminasi Buatan, Singosari, Malang', 'event3.jpg', 3),
(4, 'Pembuatan Sumur Resapan', 'Kantor Kecamatan Pakis', '2022-05-05', '2022-05-17', 'Giat pembuatan sumur resapan bagi kantor kecamatan Pakis, Malang', 'event4.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(100) NOT NULL,
  `kategori` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Kreativitas'),
(2, 'Bisnis'),
(3, 'Sosial');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(100) NOT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `isi` varchar(300) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suggestion`
--

INSERT INTO `suggestion` (`id`, `nama`, `email`, `isi`, `tanggal`) VALUES
(1, 'Michelle Angela Guntjoro', 'michelle.guntjoro@binus.ac.id', 'Keren banget', '2022-04-03'),
(2, 'Hanustavira Guru Acarya', 'hanustavira.acarya@binus.ac.id', 'Mantap joss', '2022-04-03'),
(3, 'Andru Baskara', 'andru.putra@binus.ac.id', 'Juoss', '2022-05-04'),
(4, 'Fangandro Dodo Ndruru', 'fangandro@gmail.com', 'Mantap gaes', '2022-05-04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
