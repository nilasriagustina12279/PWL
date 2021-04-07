 
-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2021 at 11:28 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl`
--

-- --------------------------------------------------------

--
-- Table structure for table `id_sopir`
--

CREATE TABLE `id_sopir` (
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` int NOT NULL,
  `sim` int NOT NULL,
  `tarif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `id_type`
--

CREATE TABLE `id_type` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `no_ktp`
--

CREATE TABLE `no_ktp` (
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `no_plat`
--

CREATE TABLE `no_plat` (
  `tahun` int NOT NULL,
  `tarif` int NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `no_transaksi`
--

CREATE TABLE `no_transaksi` (
  `tanggal_pesan` date NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali_plan` date NOT NULL,
  `tanggal_kembali_act` date NOT NULL,
  `jam_kembali_plan` int NOT NULL,
  `jam_kembali_act` int NOT NULL,
  `denda` int NOT NULL,
  `kilometer_pinjam` int NOT NULL,
  `kilometer_kembali` int NOT NULL,
  `bbm_pinjam` int NOT NULL,
  `bbm_kembali` int NOT NULL,
  `kondisi_pinjam` varchar(10) NOT NULL,
  `kondisi_kembali` varchar(10) NOT NULL,
  `kerusakan` text NOT NULL,
  `biaya_kerusakan` int NOT NULL,
  `biaya_bbm` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;