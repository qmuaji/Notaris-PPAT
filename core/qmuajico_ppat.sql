-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2021 at 01:33 PM
-- Server version: 5.7.35-log
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qmuajico_ppat`
--

-- --------------------------------------------------------

--
-- Table structure for table `AktaStatus`
--

CREATE TABLE `AktaStatus` (
  `Id` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AktaStatus`
--

INSERT INTO `AktaStatus` (`Id`, `Status`) VALUES
(1, 'Diperiksa'),
(2, 'Diproses'),
(3, 'Selesai'),
(4, 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `Document`
--

CREATE TABLE `Document` (
  `Id` int(11) NOT NULL,
  `KdTransaksi` varchar(20) DEFAULT NULL,
  `DocPersyaratan` varchar(255) NOT NULL,
  `DocAkta` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Document`
--

INSERT INTO `Document` (`Id`, `KdTransaksi`, `DocPersyaratan`, `DocAkta`) VALUES
(1, 'RSKY040921', 'Documents/persyaratan_040921AAAA_20_02_20-1582163891.pdf', 'Documents/akta_20_02_20-1582163891.pdf'),
(2, 'KRSY040921', 'Documents/persyaratan_030921BBBB_20_02_20-1582163891.pdf', ''),
(3, 'RNSJ040921', 'Documents/persyaratan_030921CCCC_20_02_20-1582163893.pdf', ''),
(4, '0118040921', 'documents/persyaratan_011804092104_09_21-1630771390.pdf', ''),
(5, '1189050921', 'documents/persyaratan_118905092105_09_21-1630775074.pdf', ''),
(6, 'NY1S050921', 'documents/persyaratan_NY1S05092105_09_21-1630804949.docx', ''),
(7, 'RNR9050921', 'documents/persyaratan_RNR905092105_09_21-1630805720.docx', ''),
(8, '9SPA050921', 'documents/persyaratan_9SPA05092105_09_21-1630805762.docx', ''),
(9, 'TU91050921', 'documents/persyaratan_TU9105092105_09_21-1630807651.pdf', ''),
(10, 'S91I050921', 'documents/persyaratan_S91I05092105_09_21-1630819428.pdf', ''),
(11, 'RYYU060921', 'documents/persyaratan_RYYU06092106_09_21-1630932058.docx', '');

-- --------------------------------------------------------

--
-- Table structure for table `JenisAkta`
--

CREATE TABLE `JenisAkta` (
  `Id` int(11) NOT NULL,
  `JenisAkta` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `JenisAkta`
--

INSERT INTO `JenisAkta` (`Id`, `JenisAkta`) VALUES
(1, 'AKTA PENDIRIAN'),
(2, 'PERJANJIAN SEWA'),
(5, 'PERJANJIAN PERNIKAHAN'),
(6, 'PENDIRIAN CV'),
(7, 'PERJANJIAN JUAL BELI'),
(8, 'WASIAT'),
(9, ' PERUBAHAN PT DAN CV'),
(10, 'KESEPAKATAN BERSAMA'),
(11, 'PENDIRIAN KOPERASI'),
(12, 'PENDIRIAN YAYASAN'),
(13, 'PERJANJIAN HUTANG'),
(14, 'PENDIRIAN PERKUMPULAN'),
(15, 'AKTA KUASA');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int(11) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `NamaLengkap` varchar(50) NOT NULL,
  `TmptLahir` varchar(20) NOT NULL,
  `TglLahir` date NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `NoTlp` varchar(20) NOT NULL,
  `UserRoleId` int(11) NOT NULL DEFAULT '1',
  `Password` varchar(128) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EmailCode` varchar(128) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='UserRole = Penghadap, Admin dan Notaris';

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `NIK`, `NamaLengkap`, `TmptLahir`, `TglLahir`, `Pekerjaan`, `Alamat`, `NoTlp`, `UserRoleId`, `Password`, `Email`, `LastLogin`, `IsActive`, `CreationDate`, `EmailCode`, `Img`) VALUES
(2, '327511180480009', 'Miftahul Anam', 'Banyumas', '1980-04-18', 'Karyawan Swasta', '&quot;Perum Taman Harmoni Blok A3, Nomor 9, RT 005/RW 007,\r\n Kelurahan Padurenan, Kecamatan Mustika Jaya, Kota Bekasi, Jawa Barat&quot;', '085846291912', 1, 'f6b6faf5982abf60433b0b88041f9a7d1c096c08', 'mifahul@gmail.com', '2021-09-02 10:59:16', 1, '2021-09-01 20:59:16', '', ''),
(6, '3202241107980000', 'MUHAMMAD RIZAL ARIYANTO', 'Sukabumi', '1998-07-11', 'Wiraswasta', '\"Kp. Cibungur 4, RT 006/RW 001,\r\nKelurahan Talaga Murni, Kecamatan Cibitung, Kabupaten Sukabumi Jawa Barat\"\r\n', '0821-1894-5554', 1, 'f6b6faf5982abf60433b0b88041f9a7d1c096c08', 'mrizal@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-01 20:59:16', '', ''),
(3, '357818470770001', 'Deta Admin', 'Sukabumi', '1999-09-13', 'Staff Karyawan', 'Jl Indah ke bulan', '+62 858-4629-1912', 2, 'f6b6faf5982abf60433b0b88041f9a7d1c096c08', 'deta@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-01 21:06:18', '', ''),
(4, '3202241107980021', 'Rian Erza', 'Sukabumi', '1990-09-14', 'Owner Notaris PPAT', 'Jl. Arif Rahman Hakim No.75, Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43134', '(0266) 6244564', 3, 'f6b6faf5982abf60433b0b88041f9a7d1c096c08', 'notaris@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-01 21:06:18', '', ''),
(7, '1727283939', 'Risky Muaji Setya P', 'Sulawesi Tengah', '1990-03-22', 'Rebahan', 'Jl indah ke bulan', '085722442265', 1, 'f6b6faf5982abf60433b0b88041f9a7d1c096c08', 'muaji.risky@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-02 17:18:55', '69672fb51c8796ecaf3d2fc078b5dc6b8fd8f461', '');

-- --------------------------------------------------------

--
-- Table structure for table `UserAktaTransaction`
--

CREATE TABLE `UserAktaTransaction` (
  `Id` int(11) NOT NULL,
  `TglTransaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `KdTransaksi` varchar(20) NOT NULL,
  `NamaAkta` varchar(128) NOT NULL,
  `JenisAktaId` int(11) NOT NULL,
  `TglAkta` date DEFAULT NULL,
  `NoAkta` varchar(50) DEFAULT NULL,
  `NoSK` varchar(50) NOT NULL,
  `NPWP` varchar(20) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `PenghadapId` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `SudahBayar` int(11) NOT NULL,
  `Keterangan` enum('LUNAS','BELUM LUNAS','','') NOT NULL DEFAULT 'BELUM LUNAS',
  `SisaTagihan` int(11) NOT NULL,
  `MetodeBayar` enum('TUNAI','TRANSFER','','') DEFAULT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `AktaStatusId` int(11) NOT NULL DEFAULT '1',
  `AdminId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserAktaTransaction`
--

INSERT INTO `UserAktaTransaction` (`Id`, `TglTransaksi`, `KdTransaksi`, `NamaAkta`, `JenisAktaId`, `TglAkta`, `NoAkta`, `NoSK`, `NPWP`, `NIK`, `PenghadapId`, `Harga`, `SudahBayar`, `Keterangan`, `SisaTagihan`, `MetodeBayar`, `Deskripsi`, `AktaStatusId`, `AdminId`) VALUES
(5, '2021-07-01 10:04:34', '020721PKPS', 'PT. GOLDEN SAND RESOURCES', 9, '2021-07-09', '5', 'AHU-0043920.AH.01.01.TAHUN 2021', '42.946.919.0-047.000', '357818470770001', 6, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PENDIRIAN PT. GOLDEN SAND RESOURCES', 3, 2),
(4, '2021-07-01 09:03:10', '030721CVRG', 'CV. INDO RAJUT GROSIR', 6, '2021-07-07', '5', 'AHU-0045730-AH.01.14.TAHUN 2021', '42.967.100.1-405.000', '3202241107980000', 2, 2500000, 2500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PENDIRIAN CV. INDO RAJUT GROSIR', 3, 2),
(3, '2021-09-03 00:44:15', '030921CCCC', 'PT. ANGKASA CERAH BERSINAR', 9, '2021-07-05', '3', 'AHU-0038270.AH.01.02.TAHUN 2021', '84.806.948.0-047.000', '3275111804800091', 6, 4500000, 4500000, 'LUNAS', 0, 'TUNAI', 'PEMBUATAN AKTA PERUBAHAN JENIS PERSEROAN, PERALIHAN SAHAM, MAKSUD DAN TUJUAN PT.ACB', 3, 3),
(2, '2021-09-04 00:40:59', '030921BBBB', 'PT. MAHARAJA BUKIT EMAS', 1, '2021-07-05', '2', 'AHU-0043096.AH.01.01.TAHUN 2021', '42.900.166.2-047.000', '357818470770001', 6, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', '\"PEMBUATAN AKTA PENDIRIAN\nPT. MAHARAJA BUKIT EMAS\"', 3, 2),
(1, '2021-09-12 02:02:40', '300621PKPS', 'PT. TEXMODA', 9, '2021-07-03', '1', 'AHU-AH.01.03-0416632', '03.042.464-2043.000', '327511180480009', 1, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', '', 3, 2),
(6, '2021-06-30 18:22:29', 'NY1S050921', 'PT. KAYUMAS ANUGRAH JAYA', 9, '2021-07-08', '6', 'AHU-AH.01.03-0427378', '91.105.015.1-047.000', '357818470770001', 6, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PERUBAHAN PEMEGANG SAHAM PT. KAYUMAS ANUGRAH JAYA', 3, 2),
(7, '2021-09-04 18:35:20', 'RNR9050921', 'PT. DELIMA SISMA MEDIKA', 9, '2021-07-09', '7', 'AHU-AH.01.03-0427472', '02.018.642.5-408.000', '327503201040024', 7, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PERUBAHAN PEMEGANG SAHAM PT. DELIMA SISMA MEDIKA', 3, 2),
(8, '2021-09-04 18:36:02', '9SPA050921', 'PT. HARUM SISMA MEDIKA', 6, '2021-07-09', '8', 'AHU-AH.01.03-0427528', '02.346.154.4048.000', '327503201040024', 7, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PERUBAHAN PEMAGANG SAHAM PT. HARUM SISMA MEDIKA', 3, 2),
(9, '2021-09-04 19:07:31', 'TU91050921', 'PT. KELUARGA MULYA', 6, '2021-07-09', '9', 'AHU-0040051.AH.01.02.TAHUN 2021', '02.381.060.9-048.000', '327503201040024', 7, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PERUBAHAN MAKSUD DAN TUJUAN PT. KELAURGA MULYA', 3, 2),
(10, '2021-07-08 19:45:19', '090721PKPS', 'PT. SISMADI SUKMUL', 6, '2021-07-09', '10', 'AHU-0040069.AH.01.02.TAHUN 2021', '01.308.712.7-042.000', '327503201040024', 7, 4500000, 4500000, 'LUNAS', 0, 'TRANSFER', 'PEMBUATAN AKTA PERUBAHAN MAKSUD DAN TUJUAN PT. SISMADI SUKMUL', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `UserRole`
--

CREATE TABLE `UserRole` (
  `Id` int(11) NOT NULL,
  `RoleName` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserRole`
--

INSERT INTO `UserRole` (`Id`, `RoleName`) VALUES
(1, 'Penghadap'),
(2, 'Admin'),
(3, 'Notaris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AktaStatus`
--
ALTER TABLE `AktaStatus`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Status` (`Status`);

--
-- Indexes for table `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `JenisAkta`
--
ALTER TABLE `JenisAkta`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `JenisAkta` (`JenisAkta`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `UserRole` (`UserRoleId`);

--
-- Indexes for table `UserAktaTransaction`
--
ALTER TABLE `UserAktaTransaction`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserIdAdmin` (`AdminId`),
  ADD KEY `UserIdPenghadap` (`PenghadapId`);

--
-- Indexes for table `UserRole`
--
ALTER TABLE `UserRole`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AktaStatus`
--
ALTER TABLE `AktaStatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Document`
--
ALTER TABLE `Document`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `JenisAkta`
--
ALTER TABLE `JenisAkta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `UserAktaTransaction`
--
ALTER TABLE `UserAktaTransaction`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `UserRole`
--
ALTER TABLE `UserRole`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
