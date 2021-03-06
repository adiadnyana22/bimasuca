-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2022 pada 06.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
(1, 'Hanustavira Guru Acarya', 'hanustavira.acarya@binus.ac.id', '$2a$12$RJ3G3vPrOmgk9Hf8Kxl9zOSTMVx3oYPlpQlk.3d6SGLg4VNT/eRQu', 1),
(3, 'Nicolaus Avenito', 'nicolaus.avenito@binus.ac.id', '$2y$10$L9lrkKh2qgjIinIRSilZoukEAKAzG9rvjyWCACnIeDJYZ.mdDsaLy', 1),
(4, 'Lila Nathania', 'lila.nathania@binus.edu', '$2y$10$Km8Ecgaj.j8j0zUOUDJ9YuVeHQXjCwQacvkRuDCb9qNGy.S.UVgN6', 1),
(6, 'Made Adi Adnyana', 'made.adnyana@binus.ac.id', '$2y$10$x2wnB2c4fz/0lIUt/.53ZOCblmgoh85gmCjcfUxcrnOtC/rvCSfcS', 1),
(8, 'Chasandra Puspitasari', 'chasandra.puspitasari@binus.edu', '$2y$10$mQiQPeaC/p.keQZFmXis3.nnUSnE6NG4iVzE2fNLYQgo9PJcd2g2u', 1);

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
(1, 'Kompos Untuk Lingkungan', '2022-05-05', 'Pembuatan pupuk kompos yang ramah lingkungan dan harganya terjangkau', 'kompos.png'),
(2, 'Memilah & Memilih Sampah', '2022-05-05', 'Gerakan pemilahan sampah yang terpadu dan terarah', 'pemilahan.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` int(100) NOT NULL,
  `ident` varchar(300) DEFAULT NULL,
  `nama_event` varchar(300) DEFAULT NULL,
  `tempat` varchar(300) DEFAULT NULL,
  `tanggal_post` date DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `gambar_cover` varchar(300) DEFAULT NULL,
  `kategori` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `ident`, `nama_event`, `tempat`, `tanggal_post`, `tanggal`, `deskripsi`, `gambar_cover`, `kategori`) VALUES
(1, '6bfa8', 'Pameran Karya Barang Daur Ulang', 'Lobby Binus@Malang', '2022-05-05', '2022-05-12', 'Ikuti pameran dan bazaar barang daur ulang yang tentunya sangat bermanfaat bagi masyarakat', 'event1.jpeg', 2),
(2, '87afg', 'Penukaran Sampah', 'Parkir Binus@Malang', '2022-05-05', '2022-05-06', 'Giat penukaran sampah menjadi uang', 'event2.jpg', 2),
(3, 'io901g', 'Pembuatan Pupuk Kompos', 'BBIB Singosari', '2022-05-05', '2022-05-13', 'Ikuti giat pembuatan sumur resapan di Balai Besar Inseminasi Buatan, Singosari, Malang', 'event3.jpg', 3),
(4, 'abf867', 'Pembuatan Sumur Resapan', 'Kantor Kecamatan Pakis', '2022-05-05', '2022-05-17', 'Giat pembuatan sumur resapan bagi kantor kecamatan Pakis, Malang', 'event4.jpg', 3),
(5, 'zgh11', 'Penghijauan Area Candi Singosari', 'Candi Singosari', '2022-05-08', '2022-05-31', 'Kegiatan penghijauan area Candi Singosari', '6277574a4a7d1.png', 1),
(6, '145abf', 'Penghijauan Area Candi Brahu', 'Candi Brahu', '2022-05-08', '2022-05-31', 'Kegiatan penghijauan area Candi Brahu', '6277574a4a7d1.png', 1),
(10, 'E629563648afcf', 'Testing upload carousel 1', 'Sunib Ngalam', '2022-05-31', '2022-05-28', '<p>Hadir semua ya</p>', '629563648afdc.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `image`
--

CREATE TABLE `image` (
  `id` int(100) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `id_event` varchar(300) DEFAULT NULL,
  `urutan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `image`
--

INSERT INTO `image` (`id`, `image`, `id_event`, `urutan`) VALUES
(1, 'event1.jpeg', '6bfa8', '1'),
(2, 'event2.jpg', '87afg', '1'),
(3, 'event3.jpg', 'io901g', '1'),
(4, 'event4.jpg', 'abf867', '1'),
(5, '6277574a4a7d1.png', 'zgh11', '1'),
(7, 'event2.jpg', '6bfa8', '2'),
(8, 'event3.jpg', '6bfa8', '3'),
(18, '629574393caa7.jpg', 'E629563648afcf', '1'),
(19, '62957439435b9.png', 'E629563648afcf', '2'),
(20, '629573ba27474.png', 'E629563648afcf', '3');

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
  `tanggal` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suggestion`
--

INSERT INTO `suggestion` (`id`, `nama`, `email`, `isi`, `tanggal`) VALUES
(1, 'Michelle Angela Guntjoro', 'michelle.guntjoro@binus.ac.id', 'Keren banget', '2022-04-03'),
(2, 'Hanustavira Guru Acarya', 'hanustavira.acarya@binus.ac.id', 'Mantap joss', '2022-04-03'),
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
  ADD UNIQUE KEY `ident` (`ident`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_event` (`id_event`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

--
-- Ketidakleluasaan untuk tabel `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`ident`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;