-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2017 at 05:46 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evotingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE IF NOT EXISTS `kandidat` (
  `id_kandidat` int(3) NOT NULL AUTO_INCREMENT,
  `nama_kandidat` varchar(50) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto` varchar(200) NOT NULL,
  PRIMARY KEY (`id_kandidat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama_kandidat`, `visi`, `misi`, `foto`) VALUES
(1, 'Jonathan Eprilio S. Simanjuntak', 'Visi menjadikan Mahasiswa Institut Teknologi Sumatera Berpotensi', 'Misi Memberlakukan Program kreativitas pada setiap himpunan intera kampus ...', 'Kandidat-Joe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `nama`, `password`, `nim`, `prodi`, `level`) VALUES
(1, 'admin', 'Administrator', '2a24588d01f86c4822d68b5c383cb141', '', '', 1),
(2, 'User', 'User', '23e590a651f35d7ec249f4c44db89645', '14115024', 'Teknik Informatika', 2);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE IF NOT EXISTS `voting` (
  `id_voting` int(3) NOT NULL AUTO_INCREMENT,
  `id_kandidat` int(3) NOT NULL,
  `id_login` int(3) NOT NULL,
  `waktu` datetime NOT NULL,
  `poin` int(11) NOT NULL,
  PRIMARY KEY (`id_voting`),
  KEY `id_kandidat` (`id_kandidat`,`id_login`),
  KEY `id_login` (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `id_kandidat`, `id_login`, `waktu`, `poin`) VALUES
(1, 1, 2, '2017-09-25 18:37:23', 1);
--
-- Constraints for dumped tables
--

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
