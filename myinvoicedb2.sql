-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2018 at 10:52 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinvoicedb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

CREATE TABLE `clienti` (
  `codicecliente` int(11) NOT NULL,
  `ragionesociale` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `cap` int(11) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `partitaiva` bigint(20) NOT NULL,
  `cellulare` bigint(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `codicefiscale` varchar(255) NOT NULL,
  `banca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clienti`
--

INSERT INTO `clienti` (`codicecliente`, `ragionesociale`, `indirizzo`, `cap`, `citta`, `partitaiva`, `cellulare`, `telefono`, `email`, `codicefiscale`, `banca`) VALUES
(1003, 'Kilic Market', 'Viale A. Gramsci 65', 41122, 'Modena', 3125698745, 3247454657, 59311480, 'kilic_market@hotmail.it', 'KLCYSM97D4716561379', 'IT6419364789136571367');

-- --------------------------------------------------------

--
-- Table structure for table `fornitori`
--

CREATE TABLE `fornitori` (
  `codiceFornitore` int(11) NOT NULL,
  `ragionesociale` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `cap` int(11) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `partitaiva` bigint(20) NOT NULL,
  `codicefiscale` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fornitori`
--

INSERT INTO `fornitori` (`codiceFornitore`, `ragionesociale`, `indirizzo`, `cap`, `citta`, `partitaiva`, `codicefiscale`, `telefono`, `mail`) VALUES
(10001, 'KlcFoods srls', 'Viale A. Gramsci 65', 41122, 'Modena', 3159875115, 'KLCYSM98D78657Z', 59311480, 'yunusemre@klcfoods.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('', 'Yunusemre97.'),
('admin.yunusemre', 'Yunusemre97.');

-- --------------------------------------------------------

--
-- Table structure for table `prodotti`
--

CREATE TABLE `prodotti` (
  `codice` int(11) NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `prezzo` decimal(3,2) NOT NULL,
  `iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodotti`
--

INSERT INTO `prodotti` (`codice`, `descrizione`, `prezzo`, `iva`) VALUES
(123456789, 'Yayla Ayran 330ml', '7.00', 4),
(123456788, 'Mis Ayran 250ml', '6.00', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`codicecliente`);

--
-- Indexes for table `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`codiceFornitore`),
  ADD UNIQUE KEY `codiceFornitore` (`codiceFornitore`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                                                              