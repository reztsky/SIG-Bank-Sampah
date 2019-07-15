-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2019 at 07:54 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_sampah`
--

CREATE TABLE `bank_sampah` (
  `id_bank_sampah` varchar(10) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `jumlah_nasabah` int(11) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `id_lokasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_sampah`
--

INSERT INTO `bank_sampah` (`id_bank_sampah`, `nama_bank`, `jumlah_nasabah`, `no_telp`, `penanggung_jawab`, `id_lokasi`) VALUES
('BNK0000001', 'Bank Sampah Mandiri', 120, '03125757785', 'Jaya', 'LOK0000001'),
('BNK0000002', 'Bank Sampah Mandiri', 60, '301000020', 'Jaya Jay', 'LOK0000004');

-- --------------------------------------------------------

--
-- Table structure for table `data_lokasi`
--

CREATE TABLE `data_lokasi` (
  `id_lokasi` varchar(10) NOT NULL,
  `alamat_jalan` varchar(255) NOT NULL,
  `kelurahan` int(11) NOT NULL,
  `kecamatan` int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longtitude` varchar(255) NOT NULL,
  `keterangan_lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_lokasi`
--

INSERT INTO `data_lokasi` (`id_lokasi`, `alamat_jalan`, `kelurahan`, `kecamatan`, `latitude`, `longtitude`, `keterangan_lokasi`) VALUES
('LOK0000001', 'Sidotopo Sekolahiian 10/21a', 91, 22, '-7.228784599999999', '112.75371659999996', 'Depan service elektronik'),
('LOK0000002', 'Sidotopo Sekolahan 10/21a', 91, 22, '-7.228784599999999', '112.75371659999996', 'Depan sErvice Elektronik '),
('LOK0000003', 'Sidotopo Sekolahan I', 91, 22, '-7.2294144', '112.75340490000008', 'ss'),
('LOK0000004', 'Stikom Surabaya', 29, 8, '-7.311460500000001', '112.78237209999998', 'Stikom Surabaya'),
('LOK0000005', 'Jalan Sidotopo Sekolahan IX, Sidotopo, Kota Surabaya, Jawa Timur', 91, 22, '-7.228331300000002', '112.7530908', 'SS'),
('LOK0000008', 'Sidotopo Sekolahan 10/21a', 91, 22, '-7.228784599999999', '112.75371659999996', 'Depan sErvice Elektronik 1');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengepul`
--

CREATE TABLE `data_pengepul` (
  `id_pengepul` varchar(10) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `nama_pengepulan` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_lokasi` varchar(10) NOT NULL,
  `jumlah_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pengepul`
--

INSERT INTO `data_pengepul` (`id_pengepul`, `penanggung_jawab`, `nama_pengepulan`, `no_telp`, `id_lokasi`, `jumlah_pegawai`) VALUES
('PNG0000001', 'Sultan', 'Sultan Mah Bebas', '03125757785', 'LOK0000002', 60),
('PNG0000002', 'Bagas', 'Bagas MAh Bebas', '03322221111', 'LOK0000003', 10),
('PNG0000003', 'Nugroho', 'Nugroho Bebas Sampah', '0899293999', 'LOK0000005', 10);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id_jenis` varchar(5) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id_jenis`, `nama_jenis`) VALUES
('1', 'Plastik'),
('2', 'Kertas');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'Asemrowo'),
(2, 'Benowo'),
(3, 'Bubutan'),
(4, 'Bulak'),
(5, 'Dukuh Pakis'),
(6, 'Gayungan'),
(7, 'Genteng'),
(8, 'Gubeng'),
(9, 'Gunung Anyar'),
(10, 'Jambangan'),
(11, 'Karang Pilang'),
(12, 'Kenjeran'),
(13, 'Krembangan'),
(14, 'Lakarsantri'),
(15, 'Mulyorejo'),
(16, 'Pabean Cantian'),
(17, 'Pacarkeling'),
(18, 'Pakal'),
(19, 'Rungkut'),
(20, 'Sambikerep'),
(21, 'Sawahan'),
(22, 'Semampir'),
(23, 'Simokerto'),
(24, 'Sukolilo'),
(25, 'Sukomanunggal'),
(26, 'Tambaksari'),
(27, 'Tandes'),
(28, 'Tegalsari'),
(29, 'Tenggilis Mejoyo'),
(30, 'Wiyung'),
(31, 'Wonocolo'),
(32, 'Wonokromo');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nama_kelurahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kecamatan`, `nama_kelurahan`) VALUES
(1, 1, 'Asemrowo'),
(2, 1, 'Genting Kalianak'),
(3, 1, 'Tambak Sarioso'),
(4, 2, 'Kandangan'),
(5, 2, 'Romokalisari'),
(6, 2, 'Sememi'),
(7, 3, 'Alun Alun Contong'),
(8, 3, 'Bubutan'),
(9, 3, 'Gundih'),
(10, 3, 'Jepara'),
(11, 3, 'Tembok Dukuh'),
(12, 4, 'Bulak'),
(13, 4, 'Kedung Cowek'),
(14, 4, 'Kenjeran'),
(15, 4, 'Sukolilo Baru'),
(16, 5, 'Dukuh Kupang'),
(17, 5, 'Gunung Sari'),
(18, 5, 'Pradah Kalikenal'),
(19, 6, 'Dukuh Menanggal'),
(20, 6, 'Gayungan'),
(21, 6, 'Ketintang'),
(22, 6, 'Menanggal'),
(23, 7, 'Embong Kaliasin'),
(24, 7, 'Genteng'),
(25, 7, 'Kapasari'),
(26, 7, 'Ketabang'),
(27, 7, 'Peneleh'),
(28, 7, 'Ujung'),
(29, 8, 'Airlangga'),
(30, 8, 'Baratajaya'),
(31, 8, 'Gubeng'),
(32, 8, 'Mojo'),
(33, 9, 'Gununganyar'),
(34, 9, 'Gununganyar Tambak'),
(35, 9, 'Rungkut Menanggal'),
(36, 9, 'Rungkut Tengah'),
(37, 10, 'Jambangan'),
(38, 10, 'Karah'),
(39, 10, 'Kebonsari'),
(40, 10, 'Pagesangan'),
(41, 11, 'Karang Pilang'),
(42, 11, 'Kebraon'),
(43, 11, 'Kedurus'),
(44, 11, 'Warugunung'),
(45, 12, 'Bulak Banteng'),
(46, 12, 'Sidotopo Wetan'),
(47, 12, 'Tambak Wedi'),
(48, 12, 'Tanah Kalikedinding'),
(49, 13, 'Dupak'),
(50, 13, 'Kemayoran'),
(51, 13, 'Krembangan Selatan'),
(52, 13, 'Morokrembangan'),
(53, 13, 'Perak Barat'),
(54, 14, 'Jeruk'),
(55, 14, 'Lakarsantri'),
(56, 14, 'Lidah Kulon'),
(57, 14, 'Sumurwelut'),
(58, 15, 'Dukuh Sutorejo'),
(59, 15, 'Kalijudan'),
(60, 15, 'Kalisari'),
(61, 15, 'Kejawan Putih'),
(62, 15, 'Manyar Sabrangan'),
(63, 16, 'Bongkaran'),
(64, 16, 'Krembangan Utara'),
(65, 16, 'Nyamplungan'),
(66, 16, 'Perak Timur'),
(67, 16, 'Perak Utara'),
(68, 17, 'Pacar Keling'),
(69, 18, 'Babat Jerawat'),
(70, 18, 'Benowo'),
(71, 18, 'Pakal'),
(72, 18, 'Sumber Rejo'),
(73, 19, 'Kalirungkut'),
(74, 19, 'Kedung Baruk'),
(75, 19, 'Medokan Ayu'),
(76, 19, 'Penjaringansari'),
(77, 19, 'Rungkut Kidul'),
(78, 19, 'Wonorejo'),
(79, 20, 'Bringin'),
(80, 20, 'Lontar'),
(81, 20, 'Made'),
(82, 20, 'Sambikerep'),
(83, 21, 'Banyu Urip'),
(84, 21, 'Kupang Krajan'),
(85, 21, 'Pakis'),
(86, 21, 'Petemon'),
(87, 21, 'Putat Jaya'),
(88, 21, 'Sawahan'),
(89, 22, 'Ampel'),
(90, 22, 'Pegirian'),
(91, 22, 'Sidotopo'),
(92, 22, 'Wonokusumo'),
(93, 23, 'Kapasan'),
(94, 23, 'Sidodadi'),
(95, 23, 'Simokerto'),
(96, 23, 'Simolawang'),
(97, 23, 'Tambak Rejo'),
(98, 24, 'Gerbang Putih'),
(99, 24, 'Keputih'),
(100, 24, 'Klampis Ngasem'),
(101, 24, 'Medokan Semampir'),
(102, 24, 'Menur Pumpungan'),
(103, 24, 'Nginden Jangkungan'),
(104, 24, 'Semolowaru'),
(105, 25, 'Putat Gede'),
(106, 25, 'Sidomulyo'),
(107, 25, 'Sidomulyo Baru'),
(108, 25, 'Sonokwijenan'),
(109, 25, 'Sukomanunggal'),
(110, 25, 'Tanjungsari'),
(111, 26, 'Dukuh Setro'),
(112, 26, 'Gading'),
(113, 26, 'Kapas Madya Baru'),
(114, 26, 'Pacarkembang'),
(115, 26, 'Ploso'),
(116, 26, 'Rangkah'),
(117, 26, 'Tambaksari'),
(118, 27, 'Balongsari'),
(119, 27, 'Banjar Sugihan'),
(120, 27, 'Karangpoh'),
(121, 27, 'Manukan Kulon'),
(122, 27, 'Manukan Wetan'),
(123, 27, 'Tandes'),
(124, 28, 'Keputran'),
(125, 28, 'Tegalsari'),
(126, 28, 'Wonorejo'),
(127, 29, 'Kutisari'),
(128, 30, 'Babatan'),
(129, 30, 'Balasklumprik'),
(130, 30, 'Jajar Tunggal'),
(131, 30, 'Jajar Tunggang'),
(132, 30, 'Wiyung'),
(133, 31, 'Bendulmerisi'),
(134, 31, 'Jemur Wonocolo'),
(135, 31, 'Margorejo'),
(136, 31, 'Sidosermo'),
(137, 31, 'Siwalankerto'),
(138, 32, 'Darmo'),
(139, 32, 'Jagir'),
(140, 32, 'Ngagel'),
(141, 32, 'Ngagelrejo'),
(142, 32, 'Ngaggel'),
(143, 32, 'Sawunggaling'),
(144, 32, 'Wonokromo');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_transaksi_keluar`
--

CREATE TABLE `relasi_transaksi_keluar` (
  `id_transaksi` varchar(10) NOT NULL,
  `id_jenis` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_transaksi_keluar`
--

INSERT INTO `relasi_transaksi_keluar` (`id_transaksi`, `id_jenis`) VALUES
('TRS0000001', '1'),
('TRS0000002', '1'),
('TRS0000003', '1'),
('TRS0000004', '1');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_transaksi_masuk`
--

CREATE TABLE `relasi_transaksi_masuk` (
  `id_transaksi` varchar(10) NOT NULL,
  `jenis_sampah` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_transaksi_masuk`
--

INSERT INTO `relasi_transaksi_masuk` (`id_transaksi`, `jenis_sampah`) VALUES
('TRS0000001', '1'),
('TRS0000002', '1'),
('TRS0000003', '2'),
('TRS0000004', '1'),
('TRS0000005', '1'),
('TRS0000006', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_keluar`
--

CREATE TABLE `transaksi_keluar` (
  `id_transaksi` varchar(10) NOT NULL,
  `dari` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `berat` double NOT NULL,
  `tujuan_setor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_keluar`
--

INSERT INTO `transaksi_keluar` (`id_transaksi`, `dari`, `tanggal`, `berat`, `tujuan_setor`) VALUES
('TRS0000001', 'BNK0000001', '2019-01-01', 88, 'jj'),
('TRS0000002', 'PNG0000001', '2019-01-01', 88, 'kkk'),
('TRS0000003', 'PNG0000001', '2019-01-01', 77, 'kk'),
('TRS0000004', 'PNG0000001', '2018-12-01', 7, 'oo');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `dari` varchar(10) NOT NULL,
  `berat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_masuk`
--

INSERT INTO `transaksi_masuk` (`id_transaksi`, `tanggal`, `dari`, `berat`) VALUES
('TRS0000001', '2019-01-04', '', 100),
('TRS0000002', '2018-11-29', 'PNG0000002', 5),
('TRS0000003', '2019-01-04', 'BNK0000001', 10),
('TRS0000004', '2019-01-06', 'PNG0000001', 8),
('TRS0000005', '2018-11-22', 'PNG0000001', 8),
('TRS0000006', '2019-01-01', 'PNG0000001', 90);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('admin', 'admin', 'admin'),
('Air29', 'Air29', 'kelurahan'),
('Alu7', 'Alu7', 'kelurahan'),
('Amp89', 'Amp89', 'kelurahan'),
('Ase1', 'Ase1', 'kelurahan'),
('Bab128', 'Bab128', 'kelurahan'),
('Bab69', 'Bab69', 'kelurahan'),
('Bal118', 'Bal118', 'kelurahan'),
('Bal129', 'Bal129', 'kelurahan'),
('Ban119', 'Ban119', 'kelurahan'),
('Ban83', 'Ban83', 'kelurahan'),
('Bar30', 'Bar30', 'kelurahan'),
('Ben133', 'Ben133', 'kelurahan'),
('Ben70', 'Ben70', 'kelurahan'),
('Bon63', 'Bon63', 'kelurahan'),
('Bri79', 'Bri79', 'kelurahan'),
('Bub8', 'Bub8', 'kelurahan'),
('Bul12', 'Bul12', 'kelurahan'),
('Bul45', 'Bul45', 'kelurahan'),
('coba123', 'coba123', 'pengepul'),
('Dar138', 'Dar138', 'kelurahan'),
('Duk111', 'Duk111', 'kelurahan'),
('Duk16', 'Duk16', 'kelurahan'),
('Duk19', 'Duk19', 'kelurahan'),
('Duk58', 'Duk58', 'kelurahan'),
('Dup49', 'Dup49', 'kelurahan'),
('Emb23', 'Emb23', 'kelurahan'),
('Gad112', 'Gad112', 'kelurahan'),
('Gay20', 'Gay20', 'kelurahan'),
('Gen2', 'Gen2', 'kelurahan'),
('Gen24', 'Gen24', 'kelurahan'),
('Ger98', 'Ger98', 'kelurahan'),
('Gub31', 'Gub31', 'kelurahan'),
('Gun17', 'Gun17', 'kelurahan'),
('Gun33', 'Gun33', 'kelurahan'),
('Gun34', 'Gun34', 'kelurahan'),
('Gun9', 'Gun9', 'kelurahan'),
('Jag139', 'Jag139', 'kelurahan'),
('Jaj130', 'Jaj130', 'kelurahan'),
('Jaj131', 'Jaj131', 'kelurahan'),
('Jam37', 'Jam37', 'kelurahan'),
('Jem134', 'Jem134', 'kelurahan'),
('Jep10', 'Jep10', 'kelurahan'),
('Jer54', 'Jer54', 'kelurahan'),
('Kal59', 'Kal59', 'kelurahan'),
('Kal60', 'Kal60', 'kelurahan'),
('Kal73', 'Kal73', 'kelurahan'),
('Kan4', 'Kan4', 'kelurahan'),
('Kap113', 'Kap113', 'kelurahan'),
('Kap25', 'Kap25', 'kelurahan'),
('Kap93', 'Kap93', 'kelurahan'),
('Kar120', 'Kar120', 'kelurahan'),
('Kar38', 'Kar38', 'kelurahan'),
('Kar41', 'Kar41', 'kelurahan'),
('Keb39', 'Keb39', 'kelurahan'),
('Keb42', 'Keb42', 'kelurahan'),
('Ked13', 'Ked13', 'kelurahan'),
('Ked43', 'Ked43', 'kelurahan'),
('Ked74', 'Ked74', 'kelurahan'),
('Kej61', 'Kej61', 'kelurahan'),
('Kem50', 'Kem50', 'kelurahan'),
('Ken14', 'Ken14', 'kelurahan'),
('Kep124', 'Kep124', 'kelurahan'),
('Kep99', 'Kep99', 'kelurahan'),
('Ket21', 'Ket21', 'kelurahan'),
('Ket26', 'Ket26', 'kelurahan'),
('Kla100', 'Kla100', 'kelurahan'),
('Kre51', 'Kre51', 'kelurahan'),
('Kre64', 'Kre64', 'kelurahan'),
('Kup84', 'Kup84', 'kelurahan'),
('Kut127', 'Kut127', 'kelurahan'),
('Lak55', 'Lak55', 'kelurahan'),
('Lid56', 'Lid56', 'kelurahan'),
('Lon80', 'Lon80', 'kelurahan'),
('Mad81', 'Mad81', 'kelurahan'),
('Man121', 'Man121', 'kelurahan'),
('Man122', 'Man122', 'kelurahan'),
('Man62', 'Man62', 'kelurahan'),
('Mar135', 'Mar135', 'kelurahan'),
('Med101', 'Med101', 'kelurahan'),
('Med75', 'Med75', 'kelurahan'),
('Men102', 'Men102', 'kelurahan'),
('Men22', 'Men22', 'kelurahan'),
('Moj32', 'Moj32', 'kelurahan'),
('Mor52', 'Mor52', 'kelurahan'),
('Nga140', 'Nga140', 'kelurahan'),
('Nga141', 'Nga141', 'kelurahan'),
('Nga142', 'Nga142', 'kelurahan'),
('Ngi103', 'Ngi103', 'kelurahan'),
('Nya65', 'Nya65', 'kelurahan'),
('Pac114', 'Pac114', 'kelurahan'),
('Pac68', 'Pac68', 'kelurahan'),
('Pag40', 'Pag40', 'kelurahan'),
('Pak71', 'Pak71', 'kelurahan'),
('Pak85', 'Pak85', 'kelurahan'),
('Peg90', 'Peg90', 'kelurahan'),
('Pen27', 'Pen27', 'kelurahan'),
('Pen76', 'Pen76', 'kelurahan'),
('Per53', 'Per53', 'kelurahan'),
('Per66', 'Per66', 'kelurahan'),
('Per67', 'Per67', 'kelurahan'),
('Pet86', 'Pet86', 'kelurahan'),
('Plo115', 'Plo115', 'kelurahan'),
('Pra18', 'Pra18', 'kelurahan'),
('Put105', 'Put105', 'kelurahan'),
('Put87', 'Put87', 'kelurahan'),
('Ran116', 'Ran116', 'kelurahan'),
('Rom5', 'Rom5', 'kelurahan'),
('Run35', 'Run35', 'kelurahan'),
('Run36', 'Run36', 'kelurahan'),
('Run77', 'Run77', 'kelurahan'),
('Sam82', 'Sam82', 'kelurahan'),
('Saw143', 'Saw143', 'kelurahan'),
('Saw88', 'Saw88', 'kelurahan'),
('Sem104', 'Sem104', 'kelurahan'),
('Sem6', 'Sem6', 'kelurahan'),
('Sid106', 'Sid106', 'kelurahan'),
('Sid107', 'Sid107', 'kelurahan'),
('Sid136', 'Sid136', 'kelurahan'),
('Sid46', 'Sid46', 'kelurahan'),
('Sid91', 'Sid91', 'kelurahan'),
('Sid94', 'Sid94', 'kelurahan'),
('Sim95', 'Sim95', 'kelurahan'),
('Sim96', 'Sim96', 'kelurahan'),
('Siw137', 'Siw137', 'kelurahan'),
('Son108', 'Son108', 'kelurahan'),
('Suk109', 'Suk109', 'kelurahan'),
('Suk15', 'Suk15', 'kelurahan'),
('Sum57', 'Sum57', 'kelurahan'),
('Sum72', 'Sum72', 'kelurahan'),
('Tam117', 'Tam117', 'kelurahan'),
('Tam3', 'Tam3', 'kelurahan'),
('Tam47', 'Tam47', 'kelurahan'),
('Tam97', 'Tam97', 'kelurahan'),
('Tan110', 'Tan110', 'kelurahan'),
('Tan123', 'Tan123', 'kelurahan'),
('Tan48', 'Tan48', 'kelurahan'),
('Teg125', 'Teg125', 'kelurahan'),
('Tem11', 'Tem11', 'kelurahan'),
('Uju28', 'Uju28', 'kelurahan'),
('War44', 'War44', 'kelurahan'),
('Wiy132', 'Wiy132', 'kelurahan'),
('Won126', 'Won126', 'kelurahan'),
('Won144', 'Won144', 'kelurahan'),
('Won78', 'Won78', 'kelurahan'),
('Won92', 'Won92', 'kelurahan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  ADD PRIMARY KEY (`id_bank_sampah`),
  ADD KEY `id_lokasi_bank` (`id_lokasi`);

--
-- Indexes for table `data_lokasi`
--
ALTER TABLE `data_lokasi`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD KEY `kecamata` (`kecamatan`),
  ADD KEY `kelurahan` (`kelurahan`);

--
-- Indexes for table `data_pengepul`
--
ALTER TABLE `data_pengepul`
  ADD PRIMARY KEY (`id_pengepul`),
  ADD KEY `id_lokasi_pengepul` (`id_lokasi`);

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `relasi_transaksi_keluar`
--
ALTER TABLE `relasi_transaksi_keluar`
  ADD PRIMARY KEY (`id_transaksi`,`id_jenis`),
  ADD KEY `id_jenis_keluar` (`id_jenis`);

--
-- Indexes for table `relasi_transaksi_masuk`
--
ALTER TABLE `relasi_transaksi_masuk`
  ADD PRIMARY KEY (`id_transaksi`,`jenis_sampah`),
  ADD KEY `id_jenis_sampah_masuk` (`jenis_sampah`);

--
-- Indexes for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `dar_bank` (`dari`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  ADD CONSTRAINT `id_lokasi_bank` FOREIGN KEY (`id_lokasi`) REFERENCES `data_lokasi` (`id_lokasi`);

--
-- Constraints for table `data_lokasi`
--
ALTER TABLE `data_lokasi`
  ADD CONSTRAINT `kecamata` FOREIGN KEY (`kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `kelurahan` FOREIGN KEY (`kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`);

--
-- Constraints for table `data_pengepul`
--
ALTER TABLE `data_pengepul`
  ADD CONSTRAINT `id_lokasi_pengepul` FOREIGN KEY (`id_lokasi`) REFERENCES `data_lokasi` (`id_lokasi`);

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `id_kecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`);

--
-- Constraints for table `relasi_transaksi_keluar`
--
ALTER TABLE `relasi_transaksi_keluar`
  ADD CONSTRAINT `id_jenis_keluar` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_sampah` (`id_jenis`),
  ADD CONSTRAINT `id_transaksi_keluar` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_keluar` (`id_transaksi`);

--
-- Constraints for table `relasi_transaksi_masuk`
--
ALTER TABLE `relasi_transaksi_masuk`
  ADD CONSTRAINT `id_jenis_sampah_masuk` FOREIGN KEY (`jenis_sampah`) REFERENCES `jenis_sampah` (`id_jenis`),
  ADD CONSTRAINT `id_transaksi_masuk` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_masuk` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
