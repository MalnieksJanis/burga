-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 04:32 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sagatavot_atskaiti` ()   BEGIN
    SET NAMES utf8mb4; -- Sets the character set to UTF-8

    SET @file_path = 'C:/Users/malni/Downloads/sagatavot_atskaiti.csv';

    -- Calculate date range for the last month
    SET @start_date = DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01');
    SET @end_date = LAST_DAY(NOW() - INTERVAL 1 MONTH);

    -- Create temporary table with results
    CREATE TEMPORARY TABLE temp_produkta_atskaites AS
    SELECT
        nosaukums,
        SUM(daudzums) AS kop_daudzums,
        AVG(iepirkuma_cena) AS videja_iepirkuma_cena,
        AVG(pardosanas_cena) AS videja_pardosanas_cena
    FROM produkts
    WHERE piegades_datums BETWEEN @start_date AND @end_date
    GROUP BY nosaukums;

    -- Create dynamic SQL query
    SET @sql_query = CONCAT(
        'SELECT *
        FROM temp_produkta_atskaites'
    );

    -- Execute dynamic SQL query
    PREPARE stmt FROM @sql_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Drop temporary table
    DROP TEMPORARY TABLE IF EXISTS temp_produkta_atskaites;

    SELECT @file_path AS file_path;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sagatavot_pirkumu_vestures_informaciju` ()   BEGIN
    SET NAMES utf8mb4;
    SET @file_path = CONCAT('C:/Users/malni/Downloads/sagatavot_pirkumu_vestures_informaciju.csv');

    -- Izvēlētie lauki no tabulas
    SET @sql_query = CONCAT("
        SELECT `id`, `nosaukums`, `daudzums`, `cena`, `datums_pirkts`
        FROM `pirkumu_vesture`
    ");

    PREPARE stmt FROM @sql_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
    
    SELECT @file_path AS file_path;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sagatavot_sestu_menesu_atskaiti` ()   BEGIN
    SET NAMES utf8mb4; -- Uzstāda kodējumu uz UTF-8

    SET @file_path = 'C:/Users/malni/Downloads/sagatavot_sestu_menesu_atskaiti.csv';

    -- Aprēķina datumu robežas pēdējiem 6 mēnešiem
    SET @start_date = DATE_FORMAT(NOW() - INTERVAL 6 MONTH, '%Y-%m-01');
    SET @end_date = LAST_DAY(NOW());

    -- Izveido pagaidu tabulu ar rezultātiem
    CREATE TEMPORARY TABLE temp_produkta_atskaites AS
    SELECT
        nosaukums,
        SUM(daudzums) AS kop_daudzums,
        AVG(iepirkuma_cena) AS videja_iepirkuma_cena,
        AVG(pardosanas_cena) AS videja_pardosanas_cena
    FROM produkts
    WHERE piegades_datums BETWEEN @start_date AND @end_date
    GROUP BY nosaukums;

    -- Izveido dinamisko SQL vaicājumu
    SET @sql_query = CONCAT(
        'SELECT * 
        FROM temp_produkta_atskaites'
    );

    -- Izpilda dinamisko SQL vaicājumu
    PREPARE stmt FROM @sql_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Dropo pagaidu tabulu
    DROP TEMPORARY TABLE IF EXISTS temp_produkta_atskaites;

    SELECT @file_path AS file_path;
END$$

DELIMITER ;

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
('ekonoms', 'ekonom$', 'Vārds', 'Uzvārds', 'administrators'),
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
(1, 'Cents', 10, 0.01, '2024-01-04', NULL),
(2, 'Divi centi', 10, 0.02, '2024-01-04', NULL),
(3, 'Pieci centi', 10, 0.05, '2024-01-04', NULL),
(4, 'Desmit centi', 10, 0.10, '2024-01-04', NULL),
(5, 'Divdesmit centi', 10, 0.00, '2024-01-04', NULL),
(6, 'Piecdesmit centi', 10, 0.00, '2024-01-04', NULL),
(7, 'Eiro', 10, 1.00, '2024-01-04', NULL),
(8, 'Divi eiro', 10, 2.00, '2024-01-04', NULL),
(9, 'Pieci eiro', 10, 5.00, '2024-01-04', NULL),
(10, 'Desmit eiro', 10, 10.00, '2024-01-04', NULL);

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
(62, 'Ādažu čipsi 100g', 1, 3.00, '2024-01-04'),
(63, 'Iļģuciema kvass', 1, 1.00, '2024-01-04'),
(64, 'Marss', 1, 1.00, '2024-01-04'),
(65, 'Ādažu čipsi 100g', 1, 3.00, '2024-01-04'),
(66, 'Marss', 1, 1.00, '2024-01-04'),
(67, 'Marss', 2, 1.00, '2024-01-04');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(16, 'Rīgas balzāms (upeņu)', 1, 8.00, 9.00, '2023-12-24', 'Alkohols', '123-asv'),
(17, 'Bauskas gaišais', 20, 0.00, 1.00, '2024-04-01', 'Alus', 'ssdwdwq');

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
('Ādažu čipsi 100g', 0, 3.00, '2023-11-28 19:25:10', '2024-01-04', NULL),
('Bauskas gaišais', 20, 1.00, '2024-01-04 21:22:21', NULL, NULL),
('Iļģuciema kvass', 1, 1.00, '2023-11-29 12:50:42', '2024-01-04', NULL),
('Marss', 14, 1.00, '2023-11-24 13:06:04', '2024-01-04', NULL),
('Rīgas balzāms (upeņu)', 1, 9.00, '2023-12-24 17:13:13', '2024-01-04', NULL),
('Snickers', 1, 1.40, '2023-11-24 13:11:38', '2024-01-04', NULL),
('Tērvetes alus', 1, 1.50, '2023-11-28 18:59:29', '2024-01-04', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `nesakritibas`
--
ALTER TABLE `nesakritibas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nauda`
--
ALTER TABLE `nauda`
  MODIFY `naudas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nesakritibas`
--
ALTER TABLE `nesakritibas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pirkumi`
--
ALTER TABLE `pirkumi`
  MODIFY `iegades_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pirkumu_vesture`
--
ALTER TABLE `pirkumu_vesture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `produkts`
--
ALTER TABLE `produkts`
  MODIFY `produkta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
