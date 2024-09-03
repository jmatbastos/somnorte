-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 01:36 PM
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
-- Database: `somnorte`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `char_name` text NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `no_of_lines` int(3) NOT NULL,
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
(290, 106, 'ANNALEE', 3, 13, 0, NULL, NULL, NULL, NULL, NULL),
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
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `REF` text NOT NULL,
  `name` text NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `REF`, `name`, `client_id`) VALUES
(1, 'P_10', 'Serie teste', 6),
(2, 'P_11', 'Serie teste 2', 8);

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
(3, 'Estudio 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(180) NOT NULL,
  `nif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `name`, `nif`) VALUES
(1, 'jose.bastos@gmail.com', '[\"ACTOR\"]', '$2y$13$qRAIdQpTLci7P5ocf.T.3O36xNKOxLoT/t1/8S1qs976x/Gj6C8ZG', 'Jose Bastos', 0),
(2, 'lixo@gmail.com', '[\"ACTOR\"]', '$2y$13$gLF7ZQwNaLepqGbPrGmKB.nHpbWqbKcUbkRIRd4QbALe7Hr7QC94K', 'Pedro Murta', 123456),
(3, 'lixo3@gmail.com', '[\"ACTOR\"]', '$2y$13$ukaUZq7rglfnmrjOnfCOgulKazqRiSFOUJ3AVwUx8yDn5qt/lEbjG', 'António Sancho', 123456),
(4, 'lixo4@gmail.com', '[\"DIRETOR\"]', '$2y$13$wpG4QCURy.BAjJE1g5uoRe15Qv7BJjrSZbj8zvEVitd9.qLaUV8Nq', 'Ricardo Tavares', 123456),
(5, 'a12345@gmail.com', '[\"DIRETOR\"]', '$2y$13$Ms2/V2Db1rwA3cdzvqGt5OLBUweJV2x7egBHItTEE89IVw8C3fuNq', 'José Silva', 12345),
(6, 'luis.amaral@gmail.com', '[\"CLIENT\"]', '$2y$13$ftVpBbHG3.raeYthRAJ8KedsS0ApwPFOeqXa1Xq/RpdnM8VYP2En2', 'Luis Amaral', 123456789),
(7, 'luis.araujo@gmail.com', '[\"ADMINISTRATOR\"]', '$2y$13$zNiTYcniraPWXmPZPGWVZuEvnMrY9khKCTfvEjal7jfiBjE69IhPe', 'Luis Araujo', 217844871),
(8, 'mario.amaral@gmail.com', '[\"CLIENT\"]', '$2y$13$PyWFpDCNsPBpgxVI/eWLbeaSfqlAx.gy/wDnHg5WUkimXtNTJSTg2', 'Mario Amaral', 222222222);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `REF` (`REF`) USING HASH,
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
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `characters_ibfk_3` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`);

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


