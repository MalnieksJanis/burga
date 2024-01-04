-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 02:41 PM
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
  `ierakstis` varchar(50) DEFAULT NULL,
  `inventarizacijas_datums` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventarizacija`
--

INSERT INTO `inventarizacija` (`inventarizacijas_id`, `datums`, `produkta_id`, `fiziskais_daudzums`, `sistematiskais_daudzums`, `ierakstis`, `inventarizacijas_datums`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, '2024-01-02');

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
  `vertiba` decimal(10,2) DEFAULT NULL,
  `inventarizacijas_datums` date DEFAULT NULL,
  `paskaidrojums` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nauda`
--

INSERT INTO `nauda` (`naudas_id`, `nosaukums`, `monetas_daudzums`, `vertiba`, `inventarizacijas_datums`, `paskaidrojums`) VALUES
(1, 'Cents', 43, 0.01, '2024-01-02', NULL),
(2, 'Divi centi', 2, 0.02, '2024-01-02', NULL),
(3, 'Pieci centi', 1, 0.05, '2024-01-02', NULL),
(4, 'Desmit centi', 2, 0.10, '2024-01-02', NULL),
(5, 'Divdesmit centi', 2, 0.00, '2024-01-02', NULL),
(6, 'Piecdesmit centi', 3, 0.00, '2024-01-02', NULL),
(7, 'Eiro', 43, 1.00, '2024-01-02', NULL),
(8, 'Divi eiro', 2, 2.00, '2024-01-02', NULL),
(9, 'Pieci eiro', 2, 5.00, '2024-01-02', NULL),
(10, 'Desmit eiro', 1, 10.00, '2024-01-02', NULL);

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
-- Table structure for table `nesakritibas`
--

CREATE TABLE `nesakritibas` (
  `id` int(11) NOT NULL,
  `produkta_nosaukums` varchar(255) NOT NULL,
  `realais_daudzums` int(11) NOT NULL,
  `ievaditais_daudzums` int(11) NOT NULL,
  `ievades_laiks` timestamp NOT NULL DEFAULT current_timestamp()
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

--
-- Dumping data for table `pirkumu_vesture`
--

INSERT INTO `pirkumu_vesture` (`id`, `nosaukums`, `daudzums`, `cena`, `datums_pirkts`) VALUES
(25, 'Marss', 2, 1.00, '2024-01-04'),
(26, 'Marss', 1, 1.00, '2024-01-04'),
(27, 'Marss', 2, 1.00, '2024-01-04'),
(28, 'Marss', 2, 1.00, '2024-01-04'),
(29, 'Marss', 1, 1.00, '2024-01-04'),
(30, 'Marss', 1, 1.00, '2024-01-04'),
(31, 'Marss', 1, 1.00, '2024-01-04'),
(32, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(33, 'Rīgas balzāms (upeņu)', 1, 9.00, '2024-01-04'),
(34, 'Iļģuciema kvass', 11, 1.00, '2024-01-04'),
(35, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(36, 'Marss', 1, 1.00, '2024-01-04'),
(37, 'Marss', 1, 1.00, '2024-01-04'),
(38, 'Marss', 1, 1.00, '2024-01-04'),
(39, 'Iļģuciema kvass', 2, 1.00, '2024-01-04'),
(40, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(41, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(42, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(43, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(44, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(45, 'Ādažu čipsi 100g', 1, 3.00, '2024-01-04'),
(46, 'Marss', 1, 1.00, '2024-01-04'),
(47, 'Marss', 1, 1.00, '2024-01-04'),
(48, 'Marss', 1, 1.00, '2024-01-04'),
(49, 'Marss', 1, 1.00, '2024-01-04'),
(50, 'Marss', 1, 1.00, '2024-01-04'),
(51, 'Marss', 1, 1.00, '2024-01-04'),
(52, 'Marss', 1, 1.00, '2024-01-04'),
(53, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(54, 'Iļģuciema kvass', 2, 1.00, '2024-01-04'),
(55, 'Rīgas balzāms (upeņu)', 1, 9.00, '2024-01-04'),
(56, 'Rīgas balzāms (upeņu)', 1, 9.00, '2024-01-04'),
(57, 'Marss', 1, 1.00, '2024-01-04'),
(58, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(59, 'Marss', 1, 1.00, '2024-01-04'),
(60, 'Marss', 1, 1.00, '2024-01-04'),
(61, 'Marss', 1, 1.00, '2024-01-04'),
(62, 'Ādažu čipsi 100g', 1, 3.00, '2024-01-04');

--
-- Triggers `pirkumu_vesture`
--
DELIMITER $$
CREATE TRIGGER `after_purchase` AFTER INSERT ON `pirkumu_vesture` FOR EACH ROW BEGIN
    DECLARE pNosaukums VARCHAR(100);
    DECLARE pDaudzums INT;

    -- Iegūst produktu nosaukumu un pirkuma daudzumu no ievietotajiem datiem
    SELECT nosaukums, daudzums INTO pNosaukums, pDaudzums FROM pirkumu_vesture ORDER BY id DESC LIMIT 1;

    -- Pārbauda, vai produkts eksistē tabulā produktu_saraksts
    IF EXISTS (SELECT 1 FROM produktu_saraksts WHERE nosaukums = pNosaukums) THEN
        -- Atjauno produktu daudzumu produktu_saraksta tabulā, ja produkts eksistē
        UPDATE produktu_saraksts SET kop_daudzums = GREATEST(kop_daudzums - pDaudzums, 0) WHERE nosaukums = pNosaukums;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_nosaukums_trigger` BEFORE INSERT ON `pirkumu_vesture` FOR EACH ROW BEGIN
    -- Split the content of nosaukums using the "|" delimiter
    SET NEW.nosaukums = SUBSTRING_INDEX(NEW.nosaukums, '|', 1);
END
$$
DELIMITER ;

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
(15, 'Iļģuciema kvass', 10, 0.75, 1.00, '2023-11-30', 'Saldināti dzērieni', '12345asd'),
(16, 'Rīgas balzāms (upeņu)', 1, 8.00, 9.00, '2023-12-24', 'Alkohols', '123-asv');

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
  `pedeja_atjauninajuma_datums` datetime DEFAULT NULL,
  `inventarizacijas_datums` date DEFAULT NULL,
  `paskaidrojums` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produktu_saraksts`
--

INSERT INTO `produktu_saraksts` (`nosaukums`, `kop_daudzums`, `pardosanas_cena`, `pedeja_atjauninajuma_datums`, `inventarizacijas_datums`, `paskaidrojums`) VALUES
('Ādažu čipsi 100g', 0, 3.00, '2023-11-28 19:25:10', '2024-01-02', NULL),
('Iļģuciema kvass', 2, 1.00, '2023-11-29 12:50:42', '2024-01-02', NULL),
('Marss', 17, 1.00, '2023-11-24 13:06:04', '2024-01-02', NULL),
('Rīgas balzāms (upeņu)', 1, 9.00, '2023-12-24 17:13:13', '2024-01-02', NULL),
('Snickers', 1, 1.40, '2023-11-24 13:11:38', '2024-01-02', NULL),
('Tērvetes alus', 1, 1.50, '2023-11-28 18:59:29', '2024-01-02', NULL);

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
-- Indexes for table `nesakritibas`
--
ALTER TABLE `nesakritibas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `inventarizacijas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `nesakritibas`
--
ALTER TABLE `nesakritibas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `produkts`
--
ALTER TABLE `produkts`
  MODIFY `produkta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
