-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Apr 2017 pada 14.23
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_text_mining_sara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id_tweet` int(11) NOT NULL,
  `id_kata_sara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail`
--

INSERT INTO `tb_detail` (`id_tweet`, `id_kata_sara`) VALUES
(27, 2),
(28, 5),
(28, 5),
(29, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kata_sara`
--

CREATE TABLE `tb_kata_sara` (
  `id_kata_sara` int(11) NOT NULL,
  `kata_sara` tinytext NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `IDF` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kata_sara`
--

INSERT INTO `tb_kata_sara` (`id_kata_sara`, `kata_sara`, `status`, `IDF`) VALUES
(1, 'arab', 'Y', 0),
(2, 'cina', 'Y', 0.477121),
(3, 'nista', 'Y', 0),
(4, 'kafir', 'Y', 0),
(5, 'muslim', 'Y', 0.176091);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tweet`
--

CREATE TABLE `tb_tweet` (
  `id_tweet` int(11) NOT NULL,
  `tweet` tinytext NOT NULL,
  `after_preprocessing` tinytext NOT NULL,
  `kata_SARA` tinytext NOT NULL,
  `W` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tweet`
--

INSERT INTO `tb_tweet` (`id_tweet`, `tweet`, `after_preprocessing`, `kata_SARA`, `W`) VALUES
(27, 'Katanya di Indonesia ini, sudah ada Kasta Premium. Etnis Cina Katanya sih', 'kata indonesia kasta premium etnis cina kata', 'cina ', 0.477121),
(28, 'Memilih Pemimpin Muslim Bagian dari Taqwa Muslim', 'pilih pimpin muslim bagi taqwa muslim', 'muslim ', 0.352183),
(29, 'Mungkinkah Banjir di Cipinang ini berkat Doa orang Muslim ?', 'mungkin banjir cipinang berkat doa orang muslim', 'muslim ', 0.176091);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD KEY `id_kata_sara` (`id_tweet`),
  ADD KEY `id_preprocessing` (`id_kata_sara`);

--
-- Indexes for table `tb_kata_sara`
--
ALTER TABLE `tb_kata_sara`
  ADD PRIMARY KEY (`id_kata_sara`);

--
-- Indexes for table `tb_tweet`
--
ALTER TABLE `tb_tweet`
  ADD PRIMARY KEY (`id_tweet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kata_sara`
--
ALTER TABLE `tb_kata_sara`
  MODIFY `id_kata_sara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_tweet`
--
ALTER TABLE `tb_tweet`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD CONSTRAINT `tb_detail_ibfk_1` FOREIGN KEY (`id_kata_sara`) REFERENCES `tb_kata_sara` (`id_kata_sara`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_ibfk_2` FOREIGN KEY (`id_tweet`) REFERENCES `tb_tweet` (`id_tweet`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
