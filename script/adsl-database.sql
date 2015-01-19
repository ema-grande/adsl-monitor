-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Gen 19, 2015 alle 16:03
-- Versione del server: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adsl`
--

CREATE DATABASE IF NOT EXISTS `adsl`;

-- --------------------------------------------------------

--
-- Struttura della tabella `DROPS`
--

CREATE TABLE IF NOT EXISTS `DROPS` (
  `ID` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `durata` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `PING`
--

CREATE TABLE IF NOT EXISTS `PING` (
  `ID` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `ping` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `SPEED`
--

CREATE TABLE IF NOT EXISTS `SPEED` (
  `ID` int(11) NOT NULL,
  `ping` text NOT NULL,
  `dl` text NOT NULL,
  `up` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DROPS`
--
ALTER TABLE `DROPS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `PING`
--
ALTER TABLE `PING`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SPEED`
--
ALTER TABLE `SPEED`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DROPS`
--
ALTER TABLE `DROPS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PING`
--
ALTER TABLE `PING`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SPEED`
--
ALTER TABLE `SPEED`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
