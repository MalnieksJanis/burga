-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 12:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_burga`
--

-- --------------------------------------------------------

--
-- Table structure for table `alkohola_pirkts`
--

CREATE TABLE `alkohola_pirkts` (
  `iegades_id` int(11) DEFAULT NULL,
  `pircejs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventarizacija`
--

CREATE TABLE `inventarizacija` (
  `inventarizacijas_id` int(11) NOT NULL,
  `datums` date DEFAULT NULL,
  `produkta_id` int(11) DEFAULT NULL,
  `fiziskais_daudzums` int(11) DEFAULT NULL,
  `sistematiskais_daudzums` int(11) DEFAULT NULL,
  `ierakstis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lietotaji`
--

CREATE TABLE `lietotaji` (
  `lietotajvards` varchar(50) NOT NULL,
  `parole` varchar(255) DEFAULT NULL,
  `vards` varchar(50) DEFAULT NULL,
  `uzvards` varchar(50) DEFAULT NULL,
  `loma` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lietotaji`
--

INSERT INTO `lietotaji` (`lietotajvards`, `parole`, `vards`, `uzvards`, `loma`) VALUES
('admin', 'admin_parole', 'Admins', 'Adminovskis', 'administrators'),
('dezurfuksis', 'dezurfuksi$', 'Dezur', 'Fuksis', 'lietotajs'),
('ekanoms', 'ekanoms$', 'Vārds', 'Uzvārds', 'administrators'),
('lietotajs', 'lietotajs_parole', 'Lietotajs', 'Lietotajevskis', 'lietotajs');

-- --------------------------------------------------------

--
-- Table structure for table `nauda`
--

CREATE TABLE `nauda` (
  `naudas_id` int(11) NOT NULL,
  `nosaukums` varchar(50) DEFAULT NULL,
  `monetas_daudzums` int(11) DEFAULT NULL,
  `vertiba` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nauda`
--

INSERT INTO `nauda` (`naudas_id`, `nosaukums`, `monetas_daudzums`, `vertiba`) VALUES
(1, 'Cents', 10, 0.01),
(2, 'Divi centi', 10, 0.02),
(3, 'Pieci centi', 10, 0.05),
(4, 'Desmit centi', 10, 0.10),
(5, 'Divdesmit centi', 10, 0.00),
(6, 'Piecdesmit centi', 10, 0.00),
(7, 'Eiro', 10, 1.00),
(8, 'Divi eiro', 10, 2.00),
(9, 'Pieci eiro', 10, 5.00),
(10, 'Desmit eiro', 10, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `naudas_inventarizacija`
--

CREATE TABLE `naudas_inventarizacija` (
  `inventarizacijas_id` int(11) NOT NULL,
  `datums` date DEFAULT NULL,
  `naudas_id` int(11) DEFAULT NULL,
  `fiziska_summa` decimal(10,2) DEFAULT NULL,
  `sistematiska_summa` decimal(10,2) DEFAULT NULL,
  `ierakstis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naudas_izlietojums`
--

CREATE TABLE `naudas_izlietojums` (
  `izlietojuma_id` int(11) NOT NULL,
  `naudas_id` int(11) DEFAULT NULL,
  `lietotajs` varchar(50) DEFAULT NULL,
  `summa` decimal(10,2) DEFAULT NULL,
  `datums_izlietots` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nopirkta_prece`
--

CREATE TABLE `nopirkta_prece` (
  `iegades_id` int(11) NOT NULL,
  `produkta_id` int(11) DEFAULT NULL,
  `daudzums` int(11) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `datums_pirkts` date DEFAULT NULL,
  `pircejs` varchar(50) DEFAULT NULL,
  `Nosaukums` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pirkumi`
--

CREATE TABLE `pirkumi` (
  `iegades_id` int(11) NOT NULL,
  `nosaukums` varchar(255) DEFAULT NULL,
  `daudzums` int(11) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `datums_pirkts` date DEFAULT NULL,
  `pircejs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pirkumi`
--

INSERT INTO `pirkumi` (`iegades_id`, `nosaukums`, `daudzums`, `cena`, `datums_pirkts`, `pircejs`) VALUES
(1, 'ds', 23, 3.00, '2023-11-28', NULL),
(2, 'ds', 5, 1.50, '2023-11-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pirkumu_vesture`
--

CREATE TABLE `pirkumu_vesture` (
  `id` int(11) NOT NULL,
  `nosaukums` varchar(255) NOT NULL,
  `daudzums` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `datums_pirkts` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produkts`
--

CREATE TABLE `produkts` (
  `produkta_id` int(11) NOT NULL,
  `nosaukums` varchar(100) DEFAULT NULL,
  `daudzums` int(11) DEFAULT NULL,
  `iepirkuma_cena` decimal(10,2) DEFAULT NULL,
  `pardosanas_cena` decimal(15,2) DEFAULT NULL,
  `piegades_datums` date DEFAULT NULL,
  `kategorija` varchar(50) DEFAULT NULL,
  `ceka_nr` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkts`
--

INSERT INTO `produkts` (`produkta_id`, `nosaukums`, `daudzums`, `iepirkuma_cena`, `pardosanas_cena`, `piegades_datums`, `kategorija`, `ceka_nr`) VALUES
(2, 'Snickers', 5, 1.00, 1.50, '2023-11-22', 'Šokolāde', NULL),
(3, 'Marss', 6, 0.80, 1.30, '2023-11-22', 'Šokolāde', NULL),
(4, 'Apelsīnu sula', 3, 1.00, 1.25, '2023-11-21', 'Sulas', NULL),
(5, 'Ādažu čipsi 100g', 5, 1.23, 1.80, '2023-11-25', 'Uzkodas', '123'),
(6, 'Ādažu čipsi 100g', 2, 1.25, 1.85, '2023-11-25', 'Uzkodas', '123'),
(7, 'Snickers', 2, 1.00, 1.50, '2023-11-24', 'Šokolāde', 'abc123'),
(8, 'Marss', 5, 0.80, 1.20, '2023-11-24', 'Šokolāde', 'abc123'),
(9, 'Marss', 6, 0.90, 1.00, '2023-11-25', 'Šokolāde', 'abc1234'),
(10, 'null', 0, 0.90, 1.40, '2023-11-25', 'Šokolāde', 'abc125'),
(11, 'Tērvetes alus', 20, 1.00, 1.50, '2023-11-28', 'Alus', NULL),
(12, 'Tērvetes alus', 20, 1.00, 1.50, '2023-11-28', 'Alus', NULL),
(13, 'Tērvetes alus', 20, 1.00, 1.50, '2023-11-28', 'Alus', '123aba2'),
(14, 'Ādažu čipsi 100g', 32, 2.00, 3.00, '2023-11-28', '123', '213'),
(15, 'Iļģuciema kvass', 10, 0.75, 1.00, '2023-11-30', 'Saldināti dzērieni', '12345asd');

--
-- Triggers `produkts`
--
DELIMITER $$
CREATE TRIGGER `after_insert_produkts` AFTER INSERT ON `produkts` FOR EACH ROW BEGIN
    DECLARE existing_count INT;

    -- Pārbauda, vai produkts jau eksistē produktu_saraksta tabulā
    SELECT COUNT(*) INTO existing_count FROM produktu_saraksts WHERE nosaukums = NEW.nosaukums;

    IF existing_count > 0 THEN
        -- Ja produkts jau eksistē, atjauno kopējo daudzumu un pardosanas cenu
        UPDATE produktu_saraksts
        SET kop_daudzums = kop_daudzums + NEW.daudzums,
            pardosanas_cena = NEW.pardosanas_cena,
            pedeja_atjauninajuma_datums = NOW()
        WHERE nosaukums = NEW.nosaukums;
    ELSE
        -- Ja produkts nav bijis, pievieno jaunu ierakstu
        INSERT INTO produktu_saraksts (nosaukums, kop_daudzums, pardosanas_cena, pedeja_atjauninajuma_datums)
        VALUES (NEW.nosaukums, NEW.daudzums, NEW.pardosanas_cena, NOW());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produktu_saraksts`
--

CREATE TABLE `produktu_saraksts` (
  `nosaukums` varchar(100) NOT NULL,
  `kop_daudzums` int(11) DEFAULT NULL,
  `pardosanas_cena` decimal(10,2) DEFAULT NULL,
  `pedeja_atjauninajuma_datums` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produktu_saraksts`
--

INSERT INTO `produktu_saraksts` (`nosaukums`, `kop_daudzums`, `pardosanas_cena`, `pedeja_atjauninajuma_datums`) VALUES
('Ādažu čipsi 100g', 32, 3.00, '2023-11-28 19:25:10'),
('Iļģuciema kvass', 10, 1.00, '2023-11-29 12:50:42'),
('Marss', 11, 1.00, '2023-11-24 13:06:04'),
('Snickers', 12, 1.40, '2023-11-24 13:11:38'),
('Tērvetes alus', 60, 1.50, '2023-11-28 18:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `tiesibas`
--

CREATE TABLE `tiesibas` (
  `id` int(11) NOT NULL,
  `lietotajvards` varchar(50) DEFAULT NULL,
  `tabula` varchar(50) DEFAULT NULL,
  `lasisanas_tiesibas` tinyint(1) DEFAULT NULL,
  `rakstisanas_tiesibas` tinyint(1) DEFAULT NULL,
  `dzesanas_tiesibas` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiesibas`
--

INSERT INTO `tiesibas` (`id`, `lietotajvards`, `tabula`, `lasisanas_tiesibas`, `rakstisanas_tiesibas`, `dzesanas_tiesibas`) VALUES
(1, 'admin', 'tabula1', 1, 1, 1),
(2, 'lietotajs', 'tabula2', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alkohola_pirkts`
--
ALTER TABLE `alkohola_pirkts`
  ADD KEY `iegades_id` (`iegades_id`);

--
-- Indexes for table `inventarizacija`
--
ALTER TABLE `inventarizacija`
  ADD PRIMARY KEY (`inventarizacijas_id`),
  ADD KEY `produkta_id` (`produkta_id`);

--
-- Indexes for table `lietotaji`
--
ALTER TABLE `lietotaji`
  ADD PRIMARY KEY (`lietotajvards`);

--
-- Indexes for table `nauda`
--
ALTER TABLE `nauda`
  ADD PRIMARY KEY (`naudas_id`);

--
-- Indexes for table `naudas_inventarizacija`
--
ALTER TABLE `naudas_inventarizacija`
  ADD PRIMARY KEY (`inventarizacijas_id`),
  ADD KEY `naudas_id` (`naudas_id`);

--
-- Indexes for table `naudas_izlietojums`
--
ALTER TABLE `naudas_izlietojums`
  ADD PRIMARY KEY (`izlietojuma_id`),
  ADD KEY `naudas_id` (`naudas_id`);

--
-- Indexes for table `nopirkta_prece`
--
ALTER TABLE `nopirkta_prece`
  ADD PRIMARY KEY (`iegades_id`);

--
-- Indexes for table `pirkumi`
--
ALTER TABLE `pirkumi`
  ADD PRIMARY KEY (`iegades_id`);

--
-- Indexes for table `pirkumu_vesture`
--
ALTER TABLE `pirkumu_vesture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkts`
--
ALTER TABLE `produkts`
  ADD PRIMARY KEY (`produkta_id`);

--
-- Indexes for table `produktu_saraksts`
--
ALTER TABLE `produktu_saraksts`
  ADD PRIMARY KEY (`nosaukums`);

--
-- Indexes for table `tiesibas`
--
ALTER TABLE `tiesibas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lietotajvards` (`lietotajvards`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventarizacija`
--
ALTER TABLE `inventarizacija`
  MODIFY `inventarizacijas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nauda`
--
ALTER TABLE `nauda`
  MODIFY `naudas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `naudas_inventarizacija`
--
ALTER TABLE `naudas_inventarizacija`
  MODIFY `inventarizacijas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `naudas_izlietojums`
--
ALTER TABLE `naudas_izlietojums`
  MODIFY `izlietojuma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nopirkta_prece`
--
ALTER TABLE `nopirkta_prece`
  MODIFY `iegades_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pirkumi`
--
ALTER TABLE `pirkumi`
  MODIFY `iegades_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pirkumu_vesture`
--
ALTER TABLE `pirkumu_vesture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produkts`
--
ALTER TABLE `produkts`
  MODIFY `produkta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tiesibas`
--
ALTER TABLE `tiesibas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alkohola_pirkts`
--
ALTER TABLE `alkohola_pirkts`
  ADD CONSTRAINT `alkohola_pirkts_ibfk_1` FOREIGN KEY (`iegades_id`) REFERENCES `nopirkta_prece` (`iegades_id`);

--
-- Constraints for table `inventarizacija`
--
ALTER TABLE `inventarizacija`
  ADD CONSTRAINT `inventarizacija_ibfk_1` FOREIGN KEY (`produkta_id`) REFERENCES `produkts` (`produkta_id`);

--
-- Constraints for table `naudas_inventarizacija`
--
ALTER TABLE `naudas_inventarizacija`
  ADD CONSTRAINT `naudas_inventarizacija_ibfk_1` FOREIGN KEY (`naudas_id`) REFERENCES `nauda` (`naudas_id`);

--
-- Constraints for table `naudas_izlietojums`
--
ALTER TABLE `naudas_izlietojums`
  ADD CONSTRAINT `naudas_izlietojums_ibfk_1` FOREIGN KEY (`naudas_id`) REFERENCES `nauda` (`naudas_id`);

--
-- Constraints for table `nopirkta_prece`
--
ALTER TABLE `nopirkta_prece`
  ADD CONSTRAINT `nopirkta_prece_ibfk_1` FOREIGN KEY (`produkta_id`) REFERENCES `produkts` (`produkta_id`);

--
-- Constraints for table `tiesibas`
--
ALTER TABLE `tiesibas`
  ADD CONSTRAINT `tiesibas_ibfk_1` FOREIGN KEY (`lietotajvards`) REFERENCES `lietotaji` (`lietotajvards`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
