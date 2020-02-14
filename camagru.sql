-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 12 fév. 2020 à 16:26
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comm`
--

CREATE TABLE `comm` (
  `id` int(11) NOT NULL,
  `id_photo` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comm` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date_comm` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comm`
--

INSERT INTO `comm` (`id`, `id_photo`, `user_id`, `comm`, `date_comm`) VALUES
(72, 183, 57, 'sssss', '2020-01-30'),
(73, 184, 57, 'lknkjjh', '2020-01-30'),
(74, 183, 57, '/.,;\'../', '2020-01-30'),
(75, 183, 57, '/.,;\'../', '2020-01-30'),
(76, 183, 57, 'oionkmokm', '2020-01-30'),
(77, 183, 57, 'oionkmokm', '2020-01-30'),
(78, 183, 57, 'oionkmokm', '2020-01-30'),
(79, 183, 57, 'momo', '2020-01-30'),
(80, 196, 57, ' vcnbhm', '2020-01-31'),
(81, 197, 57, 'kwjhgfk', '2020-01-31'),
(82, 197, 57, 'kwjhgfk', '2020-01-31'),
(83, 197, 57, 'kwjhgfk', '2020-01-31'),
(84, 197, 57, 'kwjhgfk', '2020-01-31'),
(85, 200, 57, 'fadia la plus belle', '2020-01-31'),
(86, 200, 64, '123456789', '2020-01-31'),
(87, 201, 64, '75ydfgij', '2020-01-31'),
(88, 201, 64, '75ydfgij', '2020-01-31'),
(89, 201, 57, 'fadia la plus belle', '2020-01-31'),
(90, 201, 57, 'fadia la plus belle', '2020-01-31'),
(91, 201, 57, 'fadia la plus belle', '2020-01-31'),
(92, 201, 57, 'fadia la plus belle', '2020-01-31'),
(93, 201, 57, 'fadia la plus belle', '2020-01-31'),
(94, 199, 57, 'jibygvbh', '2020-01-31'),
(95, 196, 57, 'lkmkl,', '2020-01-31'),
(96, 196, 65, 'cf mcgjhl', '2020-01-31'),
(97, 201, 65, 'kjhhbhkjnj', '2020-01-31'),
(98, 203, 57, 'kjiujhi', '2020-01-31'),
(99, 203, 57, 'oiluhijl', '2020-01-31'),
(100, 203, 57, ',ml;mokp', '2020-01-31'),
(101, 196, 57, '75jrhj', '2020-01-31'),
(102, 196, 57, 'ssss', '2020-02-01'),
(103, 196, 57, 'ssss', '2020-02-01'),
(104, 196, 66, 'BGGGGGG', '2020-02-01'),
(105, 215, 66, 'yeaaah', '2020-02-01'),
(106, 196, 67, 'ljnjml;', '2020-02-03'),
(107, 219, 67, '56465', '2020-02-03'),
(108, 196, 72, 'afljdabk', '2020-02-03'),
(109, 200, 74, 'trop hlou', '2020-02-03'),
(110, 237, 74, 'fdbd', '2020-02-03'),
(111, 239, 79, 'dfghj', '2020-02-05'),
(112, 239, 79, 'fghjkl', '2020-02-05'),
(113, 239, 79, 'fghj', '2020-02-05'),
(114, 239, 79, 'fgbhj', '2020-02-05'),
(115, 239, 79, 'rtyu', '2020-02-05'),
(116, 239, 79, 'rtyu', '2020-02-05'),
(117, 218, 81, 'sdfg', '2020-02-11'),
(118, 218, 81, 'sdfg', '2020-02-11'),
(119, 238, 81, 'dfghj', '2020-02-11'),
(120, 196, 81, ',lm l,.', '2020-02-11'),
(121, 238, 81, 'afgrhtjryk', '2020-02-11'),
(122, 236, 82, 'test', '2020-02-11'),
(123, 241, 82, '<IMG SRC=/ onerror=\"alert(String.fromCharCode(88,83,83))\"></img>', '2020-02-11');

-- --------------------------------------------------------

--
-- Structure de la table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `creation_date` date DEFAULT NULL,
  `kys_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `confirmation` int(11) DEFAULT NULL,
  `sendemail` int(11) DEFAULT '1',
  `tokenmdpoublie` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `data_user`
--

INSERT INTO `data_user` (`id`, `pseudo`, `password`, `email`, `creation_date`, `kys_email`, `confirmation`, `sendemail`, `tokenmdpoublie`) VALUES
(73, 'salut', '$2y$10$.r/PbF1X3xVcNAkei6KgsOCkI8VdfRQF7btnnI80d0dIZ8x6.k6kK', 'fadia@alphaconcept.net', '2020-02-03', 'Na4kX', 1, 1, NULL),
(74, 'Said', '$2y$10$/G40/l1RhclpkLX1/2YPtu9HJliK3sPyWmPdDTBWNPYUq5n9fPkKq', 'sidiagadir@hotmail.com', '2020-02-03', 'q6JA8', 1, 1, NULL),
(80, 'djadja', '$2y$10$V47MptFe3hymoRDUAVLAnuDkaQxcGQJgLdGU6SbAujkBdwKaNJoxG', 'best@gmail.com', '2020-02-11', 'mEa0j', NULL, 1, NULL),
(82, 'lol4\' OR 1 = 1', '$2y$10$DNHaZy/BdVQUqaQ6GBM2o.Z17SeNeXYpxSt7mcbhmc7a/lzJ4UGom', 'alex@deedapp.fr', '2020-02-11', 'jZl6L', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_photo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id`, `id_user`, `id_photo`) VALUES
(72, 57, 196),
(73, 57, 197),
(74, 57, 198),
(75, 57, 200),
(76, 64, 196),
(77, 64, 197),
(78, 64, 198),
(79, 64, 199),
(80, 64, 201),
(81, 65, 196),
(82, 65, 197),
(83, 57, 199),
(84, 66, 196),
(85, 66, 215),
(86, 66, 216),
(87, 67, 219),
(88, 71, 219),
(89, 72, 200),
(90, 72, 201),
(91, 74, 203),
(92, 74, 237),
(93, 79, 239),
(94, 81, 238),
(95, 81, 196),
(96, 82, 242),
(97, 82, 241),
(98, 82, 237);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `image_uniqid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_user` int(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `like` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `image_uniqid`, `id_user`, `date`, `like`) VALUES
(196, 'uploads/modified/5e32f67f0f5b9.png', 57, '2020-01-30', 5),
(197, 'uploads/modified/5e32f6830ec05.png', 57, '2020-01-30', 3),
(198, 'uploads/modified/5e32f6f0310e8.png', 57, '2020-01-30', 2),
(199, 'uploads/modified/5e33f97c5d468.png', 57, '2020-01-31', 2),
(200, 'uploads/modified/5e33fe7762fa0.png', 57, '2020-01-31', 2),
(201, 'uploads/modified/5e34034548fec.png', 64, '2020-01-31', 2),
(202, 'uploads/modified/5e3431d05d5fe.png', 65, '2020-01-31', 0),
(203, 'uploads/modified/5e3431d395c74.png', 65, '2020-01-31', 1),
(204, 'uploads/modified/5e3435a53e0c7.png', 65, '2020-01-31', 0),
(206, 'uploads/modified/5e346b6486e63.png', 57, '2020-01-31', 0),
(207, 'uploads/modified/5e346bf010af6.png', 57, '2020-01-31', 0),
(208, 'uploads/modified/5e346c3f985b1.png', 57, '2020-01-31', 0),
(209, 'uploads/modified/5e346c5fe3e58.png', 57, '2020-01-31', 0),
(211, 'uploads/modified/5e35d0bebc92d.png', 57, '2020-02-01', 0),
(212, 'uploads/modified/5e35d0d276fdc.png', 57, '2020-02-01', 0),
(213, 'uploads/modified/5e35d0dee0ceb.png', 57, '2020-02-01', 0),
(214, 'uploads/modified/5e35d1078e1f9.png', 57, '2020-02-01', 0),
(215, 'uploads/modified/5e35dec886ecb.png', 66, '2020-02-01', 1),
(216, 'uploads/modified/5e35ded151550.png', 66, '2020-02-01', 1),
(217, 'uploads/modified/5e35e10458a5a.png', 66, '2020-02-01', 0),
(218, 'uploads/modified/5e37ff6a552b2.png', 57, '2020-02-03', 0),
(219, 'uploads/modified/5e37ffecb9206.png', 57, '2020-02-03', 2),
(225, 'uploads/modified/5e38106e367a3.png', 71, '2020-02-03', 0),
(228, 'uploads/modified/5e381a4cc63de.png', 72, '2020-02-03', 0),
(229, 'uploads/modified/5e381a4e42fe0.png', 72, '2020-02-03', 0),
(231, 'uploads/modified/5e381a6a9997f.png', 72, '2020-02-03', 0),
(234, 'uploads/modified/5e38404503819.png', 73, '2020-02-03', 0),
(235, 'uploads/modified/5e3840c680701.png', 73, '2020-02-03', 0),
(236, 'uploads/modified/5e3840cccd05e.png', 73, '2020-02-03', 0),
(237, 'uploads/modified/5e384def2d5b8.png', 74, '2020-02-03', 2),
(238, 'uploads/modified/5e384e8ff1351.png', 73, '2020-02-03', 1),
(241, 'uploads/modified/5e430301c149f.png', 82, '2020-02-11', 1),
(248, 'uploads/modified/5e4308fb2b8a3.png', 82, '2020-02-11', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comm`
--
ALTER TABLE `comm`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comm`
--
ALTER TABLE `comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
