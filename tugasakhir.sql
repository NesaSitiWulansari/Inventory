-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Sep 2023 pada 00.28
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_menu`
--

CREATE TABLE `access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `access_menu`
--

INSERT INTO `access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(17, 1, 2),
(25, 2, 2),
(36, 2, 61),
(39, 1, 62),
(45, 2, 68),
(46, 2, 69),
(47, 1, 3),
(48, 6, 2),
(49, 6, 70),
(60, 1, 63),
(63, 1, 66),
(65, 1, 67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id_bk` int(11) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `tgl_bk` date DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barangkeluar`
--

INSERT INTO `barangkeluar` (`id_bk`, `id_barang`, `id_kategori`, `nama`, `tgl_bk`, `status`, `jumlah`, `keterangan`) VALUES
(3, 6, 1, 'Ita Anggraeni', '2023-07-20', '1', 2, 'Untuk Kegiatan Belajar Mengajar'),
(5, 9, 5, 'Dini', '2023-08-02', '2', 2, 'Untuk Perlengkapan Kelas'),
(12, 8, 1, 'Irfan Nurdiansyah', '2023-08-02', '1', 1, 'Untuk Kegiatan Belajar Mengajar'),
(13, 11, 8, 'Nesa', '2023-09-14', '2', 1, 'di musnahkan'),
(14, 1, 1, 'Siti', '2023-09-08', '1', 3, 'Untuk Kegiatan Belajar Mengajar'),
(15, 1, 1, 'Wulan', '2023-09-18', '1', 3, 'Untuk Perlengkapan Kelas');

--
-- Trigger `barangkeluar`
--
DELIMITER $$
CREATE TRIGGER `Ambilbarkel` AFTER INSERT ON `barangkeluar` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Ulangbarkel` AFTER UPDATE ON `barangkeluar` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok + OLD.jumlah - NEW.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `nama_satuan` varchar(10) DEFAULT NULL,
  `harga_satuan` varchar(20) DEFAULT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `id_kategori`, `nama_barang`, `stok`, `nama_satuan`, `harga_satuan`, `tgl`) VALUES
(1, 1, 'Pensil', 21, 'Pack', '20000', '2023-07-04'),
(2, 1, 'Penghapus', 34, 'Pack', '15000', '2023-07-03'),
(6, 1, 'Penggaris', 23, 'Pack', '10000', '2023-07-07'),
(7, 1, 'Printer', 5, 'Unit', '3500000', '2023-07-11'),
(8, 1, 'Buku Pendidikan Agama Islam', 144, 'Eksemplar', '17000', '2023-07-12'),
(9, 5, 'Sapu', 33, 'Buah', '10000', '2023-07-13'),
(10, 8, 'Tempat Penyimpanan Berkas', 5, 'Unit', '2500000', '2023-07-01'),
(11, 8, 'Meja', 52, 'Unit', '200000', '2023-07-18'),
(14, 8, 'Kursi', 65, 'Unit', '150000', '2023-07-18'),
(15, 3, 'Buku Siswa Kelas 1', 32, 'Eksemplar', '17500', '2023-07-18'),
(16, 3, 'Buku Siswa Kelas 2', 32, 'Eksemplar', '18000', '2023-07-18'),
(17, 3, 'Buku Siswa Kelas 3', 20, 'Eksemplar', '15000', '2023-07-18'),
(18, 3, 'Buku Siswa Kelas 4', 24, 'Eksemplar', '18900', '2023-07-18'),
(19, 3, 'Buku Siswa Kelas 5', 19, 'Eksemplar', '20000', '2023-07-18'),
(20, 3, 'Buku Siswa Kelas 6', 20, 'Eksemplar', '19000', '2023-07-18'),
(21, 3, 'Buku Pendidikan Jasmani dan Kesehatan', 150, 'Eksemplar', '20500', '2023-07-18'),
(22, 12, 'Meja Bekas', 16, 'Unit', '20000', '2023-07-22'),
(23, 12, 'Kursi Bekas', 12, 'Unit', '20000', '2023-07-30'),
(25, 1, 'Balpoint', 25, 'Pack', '12000', '2023-08-04'),
(26, 1, 'Gunting', 3, 'Buah', '5000', '2023-08-07'),
(28, 5, 'Lap Pel', 12, 'Buah', '15000', '2023-08-07'),
(32, 12, 'Seragam Olahraga', 120, 'Set', '120000', '2023-08-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_beli` int(11) NOT NULL,
  `id_pembelian` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `harga_satuan` int(20) DEFAULT NULL,
  `jumlah` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_beli`, `id_pembelian`, `id_barang`, `id_kategori`, `harga_satuan`, `jumlah`) VALUES
(68, 33, 10, 8, 2500000, 1),
(69, 34, 1, 1, 20000, 5),
(70, 34, 25, 1, 12000, 5),
(72, 34, 15, 3, 17500, 3),
(73, 35, 16, 3, 18000, 2),
(74, 35, 1, 1, 20000, 2),
(75, 34, 9, 5, 10000, 2),
(76, 36, 18, 3, 18900, 4),
(77, 37, 9, 5, 10000, 1),
(78, 37, 28, 5, 15000, 2),
(79, 37, 1, 1, 20000, 1),
(81, 38, 28, 5, 15000, 1),
(82, 38, 10, 8, 2500000, 1),
(114, 38, 1, 1, 20000, 1);

--
-- Trigger `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `detail_pembelian` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok - OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangtambah` AFTER UPDATE ON `detail_pembelian` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok - OLD.jumlah + NEW.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok + NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_jual` int(11) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_penjualan`, `id_jual`, `id_barang`, `id_kategori`, `jumlah`, `harga_satuan`) VALUES
(71, 27, 2, 1, 2, 15000),
(72, 27, 15, 3, 1, 17500),
(73, 28, 2, 1, 2, 15000),
(74, 28, 19, 3, 1, 20000),
(76, 29, 22, 12, 2, 20000),
(77, 29, 23, 12, 2, 20000),
(80, 30, 22, 12, 1, 20000),
(83, 32, 22, 12, 1, 20000),
(84, 32, 32, 12, 1, 120000),
(85, 32, 23, 12, 2, 20000);

--
-- Trigger `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `ambil` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kembali` AFTER DELETE ON `detail_penjualan` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah` AFTER UPDATE ON `detail_penjualan` FOR EACH ROW BEGIN
	UPDATE data_barang set stok = stok + OLD.jumlah - NEW.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_peminjaman` int(11) NOT NULL,
  `id_p` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `jumlah` int(20) DEFAULT NULL,
  `status_p` int(5) DEFAULT NULL,
  `kondisi_awal` varchar(100) DEFAULT NULL,
  `kondisi_Akhir` varchar(100) DEFAULT NULL,
  `ket_awal` varchar(50) NOT NULL,
  `ket_akhir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_peminjaman`, `id_p`, `id_barang`, `id_kategori`, `jumlah`, `status_p`, `kondisi_awal`, `kondisi_Akhir`, `ket_awal`, `ket_akhir`) VALUES
(5, 108, 2, 1, 2, 3, NULL, NULL, '', ''),
(8, 109, 11, 8, 2, 3, NULL, NULL, '', ''),
(9, 110, 14, 8, 3, 3, NULL, NULL, '', ''),
(15, 110, 8, 1, 1, 0, NULL, NULL, '', ''),
(20, 115, 9, 5, 2, 3, NULL, NULL, '', ''),
(44, 129, 6, 1, 1, 2, NULL, NULL, '', ''),
(45, 129, 2, 1, 1, 3, NULL, NULL, '', ''),
(49, 131, 14, 8, 2, 2, NULL, NULL, '', ''),
(50, 131, 9, 5, 2, 3, NULL, NULL, '', ''),
(51, 131, 11, 8, 3, 0, NULL, NULL, '', ''),
(64, 140, 28, 5, 2, 3, 'Bukti_Awal.png', 'Bukti_Kembali1.png', 'Baik', 'Baik'),
(65, 140, 11, 8, 1, 3, 'Bukti_Awal1.png', 'Bukti_Akhir.jpg', 'Baik', 'Rusak Ringan'),
(67, 140, 9, 5, 2, 0, NULL, NULL, '', ''),
(69, 141, 11, 8, 2, 1, 'Bukti_Awal3.png', NULL, 'Baik', ''),
(70, 142, 11, 8, 2, 1, 'Bukti_Awal2.png', NULL, 'Baik', '');

--
-- Trigger `detail_pinjam`
--
DELIMITER $$
CREATE TRIGGER `Pinjam` BEFORE UPDATE ON `detail_pinjam` FOR EACH ROW BEGIN
	IF (NEW.status_p = 1) THEN
        UPDATE data_barang set stok = stok - NEW.jumlah
        WHERE id_barang = NEW.id_barang;
    ELSEIF (NEW.status_p = 3) THEN
    UPDATE data_barang set stok = stok + OLD.jumlah
        WHERE id_barang = OLD.id_barang;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ambilstok1` AFTER DELETE ON `detail_pinjam` FOR EACH ROW BEGIN
	IF (OLD.status_p = 1) THEN
        UPDATE data_barang set stok = stok + OLD.jumlah
        WHERE id_barang = OLD.id_barang;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Alat Tulis Kantor'),
(3, 'Buku Siswa'),
(4, 'Alat Elektronik'),
(5, 'Alat Kebersihan'),
(8, 'Alat Perabotan Sekolah'),
(12, 'Barang Untuk Dijual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `jenkel` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `name`, `jenkel`, `alamat`, `no_hp`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Nesa Siti Wulansari', 'Perempuan', 'Bandung', '08977790224', 'Nesa@gmail.com', 'Perempuan2.png', '$2y$10$FUjrWPALJACO4QZ3Y.mONeOGeUasAPRz6mTboOSYzbF8IpbOR/xTu', 1, 1, 1685431453),
(6, 'Dini Aryanti', 'Perempuan', '', '', 'Dini@gmail.com', 'default1.png', '$2y$10$HxHaYe8Va4glkrNWf0aDq.P8g18bxQpHGzdiBd3isW43jlhhcNiYe', 2, 1, 1685768360),
(23, 'Ita Anggraeni', 'Perempuan', '', '', 'Ita@gmail.com', 'default.png', '$2y$10$j1XfuBm7qnSji7bv/1cqA.DCtAmtZkA6tPGixG6VPKoMgmxwFosre', 2, 1, 1687271413),
(27, 'Mariyam, S.Ag., S.Pd.i', 'Perempuan', '', '', 'Mariyam@gmail.com', 'Perempuan.png', '$2y$10$j1XfuBm7qnSji7bv/1cqA.DCtAmtZkA6tPGixG6VPKoMgmxwFosre', 6, 1, 1690693468),
(35, 'Ilham', NULL, '', '', 'ilham@gmail.com', 'default.png', '$2y$10$gD6GqywvKiuyyMMDqs.syeMfnKyjWILnEaoCWkIHiwIYKW1FTyYhu', 2, 1, 1691366107),
(36, 'Aminah', NULL, '', '', 'Aminah@gmail.com', 'default.png', '$2y$10$Uujc/7V5pShPm6iR1GtVwems5hjvdfJaAs/EEgixjYMeFECYL2qJy', 2, 0, 1691366107),
(37, 'Lita Putri Anzely', NULL, '', '', 'Lita@gmail.com', 'default.png', '$2y$10$K/02xfT97J1gkbR4QNCd5.k6qWyY0YQjG7gTtmdosqU/ZQm9JtAEi', 2, 0, 1691366107),
(38, 'Elis', 'Perempuan', 'Bandung Barat', '089728378723', 'El@gmail.com', 'Perempuan.png', '$2y$10$ZW0iLWqDrRLFVu1BP4mFnuReLwyRHN1thjb.YvdnHT5BVVX4r0Vwe', 2, 1, 1691366107);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_role`
--

CREATE TABLE `login_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login_role`
--

INSERT INTO `login_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Masyarakat'),
(6, 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(10) NOT NULL,
  `id_suplier` int(10) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `metode` varchar(20) DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_suplier`, `id_user`, `tgl_pembelian`, `metode`, `bukti`, `nama_rekening`, `no_rekening`, `status`) VALUES
(33, 3, 5, '2023-07-18', 'Tunai', 'Aritmatika2.jpg', NULL, NULL, 'Dibeli'),
(34, 4, 5, '2023-08-02', 'Transfer', 'school.png', 'CV Muamalah', '827382738728', 'Dibeli'),
(35, 3, 5, '2023-08-02', 'Transfer', 'default.png', 'PT. Sinar Mega', '823827831873', 'Dibeli'),
(36, 1, 5, '2023-08-03', 'Tunai', 'digital1.jpg', NULL, NULL, 'Dibeli'),
(37, 1, 5, '2023-08-03', 'Tunai', 'default2.png', NULL, NULL, 'Dibeli'),
(38, 1, 5, '2023-08-04', 'Tunai', 'absensi1.jpg', NULL, NULL, 'Dibeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_p` int(10) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT current_timestamp(),
  `keterangan` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_p`, `id_user`, `tgl_pinjam`, `tgl_kembali`, `keterangan`, `status`) VALUES
(109, 23, '2023-07-26', '2023-07-31', 'Untuk Kegiatan Peringatan 17 Agustus', 'Dikembalikan'),
(110, 6, '2023-07-25', '2023-07-26', 'Untuk Kegiatan Workshop', 'Dikembalikan'),
(129, 23, '2023-08-01', '2023-08-03', 'Untuk Kegiatan Belajar Mengajar', 'Dipinjam'),
(131, 6, '2023-08-03', '2023-09-01', 'Untuk Kegiatan Karang Taruna', 'Dipinjam'),
(140, 38, '2023-09-18', '2023-09-20', 'untuk kegiatan rapat', 'Dipinjam'),
(141, 38, '2023-09-18', NULL, 'untuk kegiatan rapat', 'Pending'),
(142, 6, '2023-09-20', NULL, 'Untuk Kegiatan Karang Taruna', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_jual` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_jual` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_jual`, `id_user`, `nama`, `tgl_jual`, `status`, `bukti`) VALUES
(27, 5, 'Agus', '2023-08-03', 'Dijual', 'default3.png'),
(28, 5, 'Maman1', '2023-08-05', 'Dijual', 'calender.png'),
(29, 5, 'Agung Majid', '2023-08-03', 'Dijual', 'default4.png'),
(30, 5, 'Aku', '2023-08-02', 'Dijual', 'features-1.png'),
(32, 5, 'Wulan', '2023-09-12', 'Dijual', 'Bukti1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'Admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'User', 'fas fa-fw fa-user', 1),
(3, 3, 'Menu Management', 'Menu', 'fas fa-fw fa-folder', 1),
(6, 3, 'Sub Menu Management', 'Menu/submenu', 'fas fa-fw fa-folder-open', 1),
(13, 1, 'Role', 'Admin/role', 'fas fa-fw fa-user-tie', 1),
(14, 2, 'Edit Profile', 'User/edit', 'fas fa-fw fa-user-edit', 1),
(15, 2, 'Change Password', 'User/change', 'fas fa-fw fa-key', 1),
(16, 1, 'Data Login', 'Admin/KelLog', 'fas fa-fw fa-archive', 1),
(26, 63, 'Data Barang', 'Master', 'fas fa-fw fa-clipboard-list', 1),
(28, 63, 'Kategori Barang', 'Master/Katbar', 'fas fa-fw fa-table', 1),
(32, 63, 'Data Suplier', 'Master/Suplier', 'fas fa-fw fa-user-tie', 1),
(33, 67, 'Pembelian Barang', 'Transaksi/pembelian', 'fas fa-fw fa-clipboard-list', 1),
(34, 66, 'Peminjaman Barang', 'Barang/Peminjaman', 'fas fa-fw fa-clipboard-list', 1),
(36, 69, 'Data Stok Barang', 'User/lihatstok', 'fas fa-fw fa-archive', 1),
(37, 67, 'Penjualan Barang', 'Transaksi/jual', 'fas fa-fw fa-chart-line', 1),
(38, 69, 'Peminjaman Barang', 'User/user', 'fas fa-fw fa-list', 1),
(39, 66, 'Barang Keluar', 'Barang/keluar', 'fas fa-fw fa-archive', 1),
(40, 70, 'Laporan Barang Keluar', 'Laporan/barkel', 'fas fa-fw fa-archive', 1),
(41, 70, 'Laporan Peminjaman', 'Laporan/pinjam', 'fas fa-fw fa-clipboard-list', 1),
(42, 70, 'Laporan Pembelian', 'Laporan/beli', 'fas fa-fw fa-archive', 1),
(43, 70, 'Laporan Penjualan', 'Laporan/jual', 'fas fa-fw fa-clipboard-list', 1),
(45, 70, 'Laporan Data Barang', 'Laporan/databarang', 'fas fa-fw fa-clipboard-list', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `id_suplier` int(10) NOT NULL,
  `nama_sup` varchar(40) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_sup`, `alamat`, `nama_rekening`, `no_rekening`, `no_hp`) VALUES
(1, 'PT. Giya Bermartabat', 'Jl. Mendung', 'PT. Giya Bermartabat', '982327387822', '08978238782'),
(3, 'PT. Sinar Mega', 'Jl. Cibeureum', 'PT. Sinar Mega', '823827831873', '08787287387'),
(4, 'CV Muamalah', 'Bandung', 'CV Muamalah', '827382738728', '08798928398'),
(5, 'SD Andir Mukti', 'Jl. Jend. Sudirman', 'SD Andir Mukti', '364376476427', '087276361266');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmenu`
--

CREATE TABLE `tmenu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tmenu`
--

INSERT INTO `tmenu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(63, 'Master'),
(66, 'Barang'),
(67, 'Transaksi'),
(69, 'Peminjaman'),
(70, 'Laporan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roleakses` (`role_id`),
  ADD KEY `fk_menuakses` (`menu_id`);

--
-- Indeks untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `fk_barang3` (`id_barang`),
  ADD KEY `FK_kategori3` (`id_kategori`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_beli`),
  ADD KEY `FK_detail_pembelian` (`id_pembelian`),
  ADD KEY `FK_detail_pinjam` (`id_barang`),
  ADD KEY `fk_detail_pinjam1` (`id_kategori`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `FK_detail_penjualan` (`id_jual`),
  ADD KEY `fk_detail_penjualan1` (`id_barang`),
  ADD KEY `fk_detail_penjualan2` (`id_kategori`);

--
-- Indeks untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `FK_pinjam_user` (`id_p`),
  ADD KEY `FK_barang_user` (`id_barang`),
  ADD KEY `FK_kategori_user` (`id_kategori`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_menu` (`role_id`);

--
-- Indeks untuk tabel `login_role`
--
ALTER TABLE `login_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_pembelian2` (`id_suplier`),
  ADD KEY `fk_pembelian` (`id_user`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `FK_user_pinjam1` (`id_user`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `fk_penjualan` (`id_user`);

--
-- Indeks untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_submenu` (`menu_id`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `tmenu`
--
ALTER TABLE `tmenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `login_role`
--
ALTER TABLE `login_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_p` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id_suplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tmenu`
--
ALTER TABLE `tmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `access_menu`
--
ALTER TABLE `access_menu`
  ADD CONSTRAINT `fk_menuakses` FOREIGN KEY (`menu_id`) REFERENCES `tmenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roleakses` FOREIGN KEY (`role_id`) REFERENCES `login_role` (`id`);

--
-- Ketidakleluasaan untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD CONSTRAINT `FK_kategori3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`),
  ADD CONSTRAINT `fk_barang3` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `FK_detail_pinjam` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `fk_detail_pinjam1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`),
  ADD CONSTRAINT `fk_detail_pinjam2` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`);

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `FK_detail_penjualan` FOREIGN KEY (`id_jual`) REFERENCES `penjualan` (`id_jual`),
  ADD CONSTRAINT `fk_detail_penjualan1` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `fk_detail_penjualan2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD CONSTRAINT `FK_barang_user` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`),
  ADD CONSTRAINT `FK_kategori_user` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`),
  ADD CONSTRAINT `FK_pinjam_user` FOREIGN KEY (`id_p`) REFERENCES `peminjaman` (`id_p`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_login` FOREIGN KEY (`role_id`) REFERENCES `login_role` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian` FOREIGN KEY (`id_user`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `fk_pembelian2` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `FK_user_pinjam1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan` FOREIGN KEY (`id_user`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `fk_submenu` FOREIGN KEY (`menu_id`) REFERENCES `tmenu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
