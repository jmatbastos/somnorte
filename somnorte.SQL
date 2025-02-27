-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 09:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_somnorte`
--

-- --------------------------------------------------------

--
-- Table structure for table `cachets`
--

CREATE TABLE `cachets` (
  `id` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `nif` int(11) NOT NULL,
  `cachet_inicial` varchar(20) NOT NULL,
  `pago` varchar(20) NOT NULL,
  `saldo` varchar(20) NOT NULL,
  `cachet_contab` varchar(20) NOT NULL,
  `cachet_p_contab` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `invoice_ref` varchar(40) DEFAULT NULL,
  `receipt_ref` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cachets`
--

INSERT INTO `cachets` (`id`, `ref`, `month`, `nif`, `cachet_inicial`, `pago`, `saldo`, `cachet_contab`, `cachet_p_contab`, `status`, `invoice_ref`, `receipt_ref`) VALUES
(59, 3, 'Jan_21', 321390434, '143,00 €', '143,00 €', '0,00 €', '143,00 €', ' -   € ', ' Pago ', NULL, NULL),
(60, 1, 'Jan_21', 237649579, '576,00 €', '576,00 €', '0,00 €', '576,00 €', ' -   € ', ' Pago ', NULL, NULL),
(63, 2172, 'Jan_25', 338207142, '205,05 €', '0,00 €', '205,05 €', '0,00 €', ' 205,05 € ', 'Não Pago', NULL, NULL),
(64, 2173, 'Jan_25', 350524373, '70,40 €', '0,00 €', '70,40 €', '0,00 €', '70,40 €', 'Não Pago', NULL, NULL);

--
-- Triggers `cachets`
--
DELIMITER $$
CREATE TRIGGER `alter_inf2` BEFORE INSERT ON `cachets` FOR EACH ROW SET NEW.nif = NEW.nif + 123456789
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `char_name` text NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `no_of_lines` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `studio_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_cachet` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `episode_id`, `char_name`, `actor_id`, `no_of_lines`, `series_id`, `studio_id`, `director_id`, `date`, `id_cachet`, `status`) VALUES
(290, 106, 'ANNALEE', 3, 13, 1, NULL, NULL, NULL, NULL, NULL),
(291, 106, 'BORIBON', 3, 11, 1, NULL, NULL, NULL, NULL, NULL),
(292, 106, 'MÉDICO', 1, 5, 1, NULL, NULL, NULL, NULL, NULL),
(293, 106, 'NARRADOR', NULL, 13, 1, NULL, NULL, NULL, NULL, NULL),
(294, 107, 'ANNALEE', 3, 14, 1, NULL, NULL, NULL, NULL, NULL),
(295, 107, 'BORIBON', 3, 11, 1, NULL, NULL, NULL, NULL, NULL),
(296, 107, 'NARRADOR', NULL, 10, 1, NULL, NULL, NULL, NULL, NULL),
(297, 108, 'ANNALEE', 3, 6, 1, NULL, NULL, NULL, NULL, NULL),
(298, 108, 'BEN', 2, 2, 1, NULL, NULL, NULL, NULL, NULL),
(299, 108, 'BORIBON', 3, 16, 1, NULL, NULL, NULL, NULL, NULL),
(300, 108, 'COELHO', 2, 2, 1, NULL, NULL, NULL, NULL, NULL),
(301, 108, 'ESQUILO', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(302, 108, 'NARRADOR', NULL, 15, 1, NULL, NULL, NULL, NULL, NULL),
(303, 108, 'OURIÇO', NULL, 2, 1, NULL, NULL, NULL, NULL, NULL),
(304, 109, 'ANNALEE', 3, 5, 1, NULL, NULL, NULL, NULL, NULL),
(305, 109, 'BEM', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(306, 109, 'BEN', 2, 14, 1, NULL, NULL, NULL, NULL, NULL),
(307, 109, 'BORIBON', 3, 18, 1, NULL, NULL, NULL, NULL, NULL),
(308, 109, 'NARRADOR', NULL, 9, 1, NULL, NULL, NULL, NULL, NULL),
(309, 109, 'OURIÇO', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(310, 110, 'ANNALEE', 3, 12, 1, NULL, NULL, NULL, NULL, NULL),
(311, 110, 'BORIBON', 3, 14, 1, NULL, NULL, NULL, NULL, NULL),
(312, 110, 'GATINHO', NULL, 3, 1, NULL, NULL, NULL, NULL, NULL),
(313, 110, 'NARRADOR', NULL, 6, 1, NULL, NULL, NULL, NULL, NULL),
(314, 111, 'ANNALEE', 3, 2, 1, NULL, NULL, NULL, NULL, NULL),
(315, 111, 'BORIBON', 3, 17, 1, NULL, NULL, NULL, NULL, NULL),
(316, 111, 'GATINHO', NULL, 4, 1, NULL, NULL, NULL, NULL, NULL),
(317, 111, 'NARRADOR', NULL, 14, 1, NULL, NULL, NULL, NULL, NULL),
(318, 112, 'ANNALEE', 3, 3, 1, NULL, NULL, NULL, NULL, NULL),
(319, 112, 'BORIBON', 3, 21, 1, NULL, NULL, NULL, NULL, NULL),
(320, 112, 'FRIZZY', NULL, 3, 1, NULL, NULL, NULL, NULL, NULL),
(321, 112, 'GATINHO', NULL, 5, 1, NULL, NULL, NULL, NULL, NULL),
(322, 112, 'NARRADOR', NULL, 20, 1, NULL, NULL, NULL, NULL, NULL),
(323, 112, 'SNEEZY', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(324, 113, 'ANNALEE', 3, 10, 1, NULL, NULL, NULL, NULL, NULL),
(325, 113, 'BEN', 2, 2, 1, NULL, NULL, NULL, NULL, NULL),
(326, 113, 'BORIBON', 3, 13, 1, NULL, NULL, NULL, NULL, NULL),
(327, 113, 'NARRADOR', NULL, 15, 1, NULL, NULL, NULL, NULL, NULL),
(328, 113, 'SNEEZY', NULL, 4, 1, NULL, NULL, NULL, NULL, NULL),
(329, 114, 'ANNALEE', 3, 10, 1, NULL, NULL, NULL, NULL, NULL),
(330, 114, 'BORIBON', 3, 10, 1, NULL, NULL, NULL, NULL, NULL),
(331, 114, 'NARRADOR', NULL, 16, 1, NULL, NULL, NULL, NULL, NULL),
(332, 115, 'ANNALEE', 3, 8, 1, NULL, NULL, NULL, NULL, NULL),
(333, 115, 'BEN', 2, 4, 1, NULL, NULL, NULL, NULL, NULL),
(334, 115, 'BORIBON', 3, 14, 1, NULL, NULL, NULL, NULL, NULL),
(335, 115, 'NARRADOR', NULL, 16, 1, NULL, NULL, NULL, NULL, NULL),
(336, 116, 'ANNALEE', 3, 7, 1, NULL, NULL, NULL, NULL, NULL),
(337, 116, 'BORIBON', 3, 8, 1, NULL, NULL, NULL, NULL, NULL),
(338, 116, 'NARRADOR', NULL, 14, 1, NULL, NULL, NULL, NULL, NULL),
(339, 116, 'SNEEZY', NULL, 3, 1, NULL, NULL, NULL, NULL, NULL),
(340, 117, 'ANNALEE', NULL, 13, 0, NULL, NULL, NULL, NULL, NULL),
(341, 117, 'BORIBON', NULL, 11, 1, NULL, NULL, NULL, NULL, NULL),
(342, 117, 'MÉDICO', NULL, 5, 1, NULL, NULL, NULL, NULL, NULL),
(343, 117, 'NARRADOR', NULL, 13, 1, NULL, NULL, NULL, NULL, NULL),
(344, 117, 'ANNALEE', NULL, 13, 0, NULL, NULL, NULL, NULL, NULL),
(345, 117, 'BORIBON', NULL, 11, 1, NULL, NULL, NULL, NULL, NULL),
(346, 117, 'MÉDICO', NULL, 5, 1, NULL, NULL, NULL, NULL, NULL),
(347, 117, 'NARRADOR', NULL, 13, 1, NULL, NULL, NULL, NULL, NULL),
(348, 118, 'LARILAS', NULL, 25, 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240826084031', '2024-08-26 10:42:02', 448),
('DoctrineMigrations\\Version20240826165403', '2024-08-26 18:54:33', 151);

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `series_REF` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `episode`, `series_REF`) VALUES
(1, 106, 'P_10'),
(5, 107, 'P_10'),
(8, 108, 'P_10'),
(15, 109, 'P_10'),
(21, 110, 'P_10'),
(25, 111, 'P_10'),
(29, 112, 'P_10'),
(35, 113, 'P_10'),
(40, 114, 'P_10'),
(43, 115, 'P_10'),
(47, 116, 'P_10'),
(101, 117, 'P_10'),
(104, 117, 'P_11'),
(156, 118, 'P_10'),
(105, 118, 'P_11');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `value` decimal(5,2) NOT NULL,
  `invoice_ref` varchar(40) NOT NULL,
  `invoice_date` date NOT NULL,
  `register_date` date NOT NULL,
  `filename` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `no_of_lines`
--

CREATE TABLE `no_of_lines` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `no_of_lines` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `no_of_lines`
--

INSERT INTO `no_of_lines` (`id`, `episode_id`, `persona_id`, `no_of_lines`) VALUES
(1, 1, 1, 13),
(2, 1, 2, 11),
(3, 1, 3, 5),
(4, 1, 4, 13),
(5, 5, 1, 14),
(6, 5, 2, 11),
(7, 5, 4, 10),
(8, 8, 1, 6),
(9, 8, 5, 2),
(10, 8, 2, 16),
(11, 8, 6, 2),
(12, 8, 7, 1),
(13, 8, 4, 15),
(14, 8, 8, 2),
(15, 15, 1, 5),
(16, 15, 9, 1),
(17, 15, 5, 14),
(18, 15, 2, 18),
(19, 15, 4, 9),
(20, 15, 8, 1),
(21, 21, 1, 12),
(22, 21, 2, 14),
(23, 21, 10, 3),
(24, 21, 4, 6),
(25, 25, 1, 2),
(26, 25, 2, 17),
(27, 25, 10, 4),
(28, 25, 4, 14),
(29, 29, 1, 3),
(30, 29, 2, 21),
(31, 29, 11, 3),
(32, 29, 10, 5),
(33, 29, 4, 20),
(34, 29, 12, 1),
(35, 35, 1, 10),
(36, 35, 5, 2),
(37, 35, 2, 13),
(38, 35, 4, 15),
(39, 35, 12, 4),
(40, 40, 1, 10),
(41, 40, 2, 10),
(42, 40, 4, 16),
(43, 43, 1, 8),
(44, 43, 5, 4),
(45, 43, 2, 14),
(46, 43, 4, 16),
(47, 47, 1, 7),
(48, 47, 2, 8),
(49, 47, 4, 14),
(50, 47, 12, 3),
(101, 101, 1, 13),
(102, 101, 2, 11),
(103, 101, 3, 5),
(104, 104, 13, 13),
(105, 105, 14, 25),
(156, 156, 1, 13),
(157, 156, 2, 11),
(158, 156, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `series_REF` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`id`, `name`, `series_REF`) VALUES
(1, 'ANNALEE', 'P_10'),
(9, 'BEM', 'P_10'),
(5, 'BEN', 'P_10'),
(2, 'BORIBON', 'P_10'),
(6, 'COELHO', 'P_10'),
(7, 'ESQUILO', 'P_10'),
(11, 'FRIZZY', 'P_10'),
(10, 'GATINHO', 'P_10'),
(14, 'LARILAS', 'P_11'),
(3, 'MÉDICO', 'P_10'),
(4, 'NARRADOR', 'P_10'),
(13, 'NARRADOR', 'P_11'),
(8, 'OURIÇO', 'P_10'),
(12, 'SNEEZY', 'P_10');

-- --------------------------------------------------------

--
-- Table structure for table `persona_has_actors`
--

CREATE TABLE `persona_has_actors` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `no_of_lines` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persona_has_actors`
--

INSERT INTO `persona_has_actors` (`id`, `persona_id`, `actor_id`, `no_of_lines`) VALUES
(17, 3, 1, NULL),
(20, 4, 2, NULL),
(22, 1, 2, NULL),
(24, 2, 1, NULL),
(25, 5, 3, NULL),
(26, 6, 3, NULL),
(27, 12, 3, NULL),
(28, 13, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persona_in_episode_has_actor`
--

CREATE TABLE `persona_in_episode_has_actor` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persona_in_episode_has_actor`
--

INSERT INTO `persona_in_episode_has_actor` (`id`, `episode_id`, `persona_id`, `actor_id`) VALUES
(31, 1, 1, 3),
(32, 2, 2, 3),
(33, 3, 3, 2),
(34, 7, 4, 1),
(36, 104, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `REF` varchar(80) DEFAULT NULL,
  `name` text NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `REF`, `name`, `client_id`) VALUES
(1, 'P_10', 'Serie teste', 6),
(2, 'P_11', 'Serie teste 2', 8),
(3, 'P_12', 'Serie teste 3', 6),
(4, 'P_13', 'Serie teste 4', 8),
(5, 'P_14', 'Serie teste 5', 8);

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE `studios` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`id`, `name`) VALUES
(1, 'Estudio 1'),
(2, 'Estudio 2'),
(3, 'Estudio 3'),
(4, 'Estudio 4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `name`, `nif`) VALUES
(1, 'jose.bastos@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$qRAIdQpTLci7P5ocf.T.3O36xNKOxLoT/t1/8S1qs976x/Gj6C8ZG', 'Jose Bastos', 123456780),
(2, 'pmurta@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$13$gLF7ZQwNaLepqGbPrGmKB.nHpbWqbKcUbkRIRd4QbALe7Hr7QC94K', 'Pedro Murta', 123456781),
(3, 'asancho@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$13$ukaUZq7rglfnmrjOnfCOgulKazqRiSFOUJ3AVwUx8yDn5qt/lEbjG', 'António Sancho', 123456782),
(4, 'ricardo.tavares@gmail.com', '[\"ROLE_CLIENT\"]', '$2y$13$jWUcuolK/EIVj6Sr.x1jXOW.U1WCiC8c5bKToR9NgSWaXypnqhkz.', 'Ricardo Tavares', 123456783),
(5, 'jsilva@gmail.com', '[\"ROLE_DIRECTOR\"]', '$2y$13$zNiTYcniraPWXmPZPGWVZuEvnMrY9khKCTfvEjal7jfiBjE69IhPe', 'José Silva', 123456784),
(6, 'luis.amaral@gmail.com', '[\"ROLE_CLIENT\"]', '$2y$13$ftVpBbHG3.raeYthRAJ8KedsS0ApwPFOeqXa1Xq/RpdnM8VYP2En2', 'Luis Amaral', 123456789),
(7, 'luis.araujo@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$zNiTYcniraPWXmPZPGWVZuEvnMrY9khKCTfvEjal7jfiBjE69IhPe', 'Luis Araujo', 217844871),
(8, 'mario.amaral@gmail.com', '[\"ROLE_CLIENT\"]', '$2y$13$PyWFpDCNsPBpgxVI/eWLbeaSfqlAx.gy/wDnHg5WUkimXtNTJSTg2', 'Mario Amaral', 123456785),
(80, 'a6738@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$10$wp7lYHTS6E2qduw9qMYRVellHMmUHy0/RQpJKvvqcvgZYqVhUG.om', 'Ascensão Amaral ', 321390434),
(81, 'a5048@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$10$xQxHyE25pFfvypavUPcrOOeihoDhZsrlB0fPclppFh5txvjkWKAfK', 'Ana Saltão_Rui Oliveira ', 237649579),
(82, 'a4731@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$10$9XycY6amrHo6VVhijjF.U.gCKswrClCYjXo8loxPYvhIy1tyjiYzu', 'Susana Ramalho ', 338207142),
(83, 'a7001@gmail.com', '[\"ROLE_ACTOR\"]', '$2y$10$qihOT.n.pmDE2byeQnh.EuO.dp.pXd6eFUV8FOER1uXhmCqfFQufu', 'Teresa Arcanjo', 350524373);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `alter_inf` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.nif = NEW.nif + 123456789
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cachets`
--
ALTER TABLE `cachets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref` (`ref`),
  ADD KEY `cachets_ibfk_1` (`nif`),
  ADD KEY `cachets_ibfk_2` (`invoice_ref`),
  ADD KEY `cachets_ibfk_3` (`receipt_ref`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `director_id` (`director_id`),
  ADD KEY `studio_id` (`studio_id`),
  ADD KEY `series_id` (`series_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `episode` (`episode`,`series_REF`),
  ADD KEY `series_REF` (`series_REF`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_ref` (`invoice_ref`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `no_of_lines`
--
ALTER TABLE `no_of_lines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `episode_id_2` (`episode_id`,`persona_id`),
  ADD KEY `episode_id` (`episode_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`series_REF`),
  ADD KEY `series_REF` (`series_REF`);

--
-- Indexes for table `persona_has_actors`
--
ALTER TABLE `persona_has_actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `persona_in_episode_has_actor`
--
ALTER TABLE `persona_in_episode_has_actor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episode_id` (`episode_id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `REF` (`REF`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cachets`
--
ALTER TABLE `cachets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `no_of_lines`
--
ALTER TABLE `no_of_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `persona_has_actors`
--
ALTER TABLE `persona_has_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `persona_in_episode_has_actor`
--
ALTER TABLE `persona_in_episode_has_actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cachets`
--
ALTER TABLE `cachets`
  ADD CONSTRAINT `cachets_ibfk_1` FOREIGN KEY (`nif`) REFERENCES `users` (`nif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cachets_ibfk_2` FOREIGN KEY (`invoice_ref`) REFERENCES `invoices` (`invoice_ref`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cachets_ibfk_3` FOREIGN KEY (`receipt_ref`) REFERENCES `invoices` (`invoice_ref`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `characters_ibfk_3` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`);

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`series_REF`) REFERENCES `series` (`REF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `no_of_lines`
--
ALTER TABLE `no_of_lines`
  ADD CONSTRAINT `no_of_lines_ibfk_1` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `no_of_lines_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`series_REF`) REFERENCES `series` (`REF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persona_has_actors`
--
ALTER TABLE `persona_has_actors`
  ADD CONSTRAINT `persona_has_actors_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_has_actors_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persona_in_episode_has_actor`
--
ALTER TABLE `persona_in_episode_has_actor`
  ADD CONSTRAINT `persona_in_episode_has_actor_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_in_episode_has_actor_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_in_episode_has_actor_ibfk_3` FOREIGN KEY (`episode_id`) REFERENCES `no_of_lines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
