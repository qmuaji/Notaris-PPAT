-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2021 at 12:51 PM
-- Server version: 5.7.35-log
-- PHP Version: 7.3.28

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
-- Table structure for table `Akta`
--

CREATE TABLE `Akta` (
  `Id` int(11) NOT NULL,
  `TglAkta` date NOT NULL,
  `NoAkta` varchar(20) NOT NULL,
  `KdAkta` varchar(20) NOT NULL,
  `JenisAktaId` int(11) NOT NULL,
  `AktaPenghadapStatusId` int(11) NOT NULL,
  `NamaAkta` varchar(255) NOT NULL,
  `NPWP` varchar(50) NOT NULL,
  `NoSK` varchar(50) NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AktaPenghadapStatus`
--

CREATE TABLE `AktaPenghadapStatus` (
  `Id` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AktaPenghadapStatus`
--

INSERT INTO `AktaPenghadapStatus` (`Id`, `Status`) VALUES
(1, 'Diperiksa'),
(2, 'Diproses'),
(3, 'Selesai');

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
(1, 'PKPS'),
(2, 'PENDIRIAN');

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
  `Username` varchar(20) NOT NULL,
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

INSERT INTO `User` (`Id`, `NIK`, `NamaLengkap`, `TmptLahir`, `TglLahir`, `Pekerjaan`, `Alamat`, `NoTlp`, `UserRoleId`, `Username`, `Password`, `Email`, `LastLogin`, `IsActive`, `CreationDate`, `EmailCode`, `Img`) VALUES
(1, '327511180480009', 'MIFTAHUL ANAM', 'Banyumas', '1980-04-18', 'Karyawan Swasta', '\"Perum Taman Harmoni Blok A3, Nomor 9, RT 005/RW 007,\r\n Kelurahan Padurenan, Kecamatan Mustika Jaya, Kota Bekasi, Jawa Barat\"\r\n', '0857-1753-3900', 1, 'miftah', 'penghadap', 'mifahul@gmail.com', '2021-09-02 10:59:16', 1, '2021-09-02 03:59:16', '', ''),
(2, '3202241107980000', 'MUHAMMAD RIZAL ARIYANTO', 'Sukabumi', '1998-07-11', 'Wiraswasta', '\"Kp. Cibungur 4, RT 006/RW 001,\r\nKelurahan Talaga Murni, Kecamatan Cibitung, Kabupaten Sukabumi Jawa Barat\"\r\n', '0821-1894-5554', 1, 'mrizal', 'penghadap', 'mrizal@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-02 03:59:16', '', ''),
(3, '357818470770001', 'Deta Admin', 'Sukabumi', '1999-09-13', 'Staff Karyawan', 'Jl Indah ke bulan', '+62 858-4629-1912', 2, 'deta', 'admin', 'deta@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-02 04:06:18', '', ''),
(4, '3202241107980021', 'Rian Erza', 'Sukabumi', '1990-09-14', 'Owner Notaris PPAT', 'Jl. Arif Rahman Hakim No.75, Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43134', '(0266) 6244564', 3, 'notaris', 'notaris', 'notaris@gmail.com', '0000-00-00 00:00:00', 1, '2021-09-02 04:06:18', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `UserAktaTransaction`
--

CREATE TABLE `UserAktaTransaction` (
  `Id` int(11) NOT NULL,
  `TglTransaksi` date NOT NULL,
  `KdTransaksi` varchar(20) NOT NULL,
  `AktaId` int(11) NOT NULL,
  `SudahBayar` int(11) NOT NULL,
  `Keterangan` enum('LUNAS','BELUM LUNAS','','') NOT NULL DEFAULT 'BELUM LUNAS',
  `SisaTagihan` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `MetodeBayar` enum('TUNAI','TRANSFER','','') NOT NULL,
  `Deskripsi` int(11) NOT NULL,
  `Penerima` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserDocument`
--

CREATE TABLE `UserDocument` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `DocumentName` varchar(255) NOT NULL,
  `DocumentFile` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `Akta`
--
ALTER TABLE `Akta`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `AktaPenghadapStatus`
--
ALTER TABLE `AktaPenghadapStatus`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Status` (`Status`);

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
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `UserRole` (`UserRoleId`);

--
-- Indexes for table `UserAktaTransaction`
--
ALTER TABLE `UserAktaTransaction`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserIdAdmin` (`Penerima`),
  ADD KEY `UserIdPenghadap` (`UserId`),
  ADD KEY `AktaId` (`AktaId`);

--
-- Indexes for table `UserDocument`
--
ALTER TABLE `UserDocument`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT for table `Akta`
--
ALTER TABLE `Akta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `AktaPenghadapStatus`
--
ALTER TABLE `AktaPenghadapStatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `JenisAkta`
--
ALTER TABLE `JenisAkta`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `UserAktaTransaction`
--
ALTER TABLE `UserAktaTransaction`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDocument`
--
ALTER TABLE `UserDocument`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserRole`
--
ALTER TABLE `UserRole`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
