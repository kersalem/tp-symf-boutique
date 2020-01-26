-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 26 Janvier 2020 à 13:35
-- Version du serveur :  5.7.28-0ubuntu0.19.04.2
-- Version de PHP :  7.2.24-0ubuntu0.19.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_MI5`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visuel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `visuel`, `texte`) VALUES
(1, 'Fruits', 'images/fruits.jpg', 'De la passion ou de ton imagination'),
(2, 'Junk Food', 'images/junk_food.jpg', 'Chère et cancérogène, tu es prévenu(e)'),
(3, 'Légumes', 'images/legumes.jpg', 'Plus tu en manges, moins tu en es un'),
(6, 'Poissons', 'images/poisson-oranda.jpg', 'Du poisson qui veut du poisson');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `date_commande`, `statut`, `usager_id`) VALUES
(3, '2020-01-15 14:24:19', 'En attente', 9),
(4, '2020-01-15 14:26:06', 'En attente', 9),
(5, '2020-01-15 14:48:11', 'En attente', 9),
(6, '2020-01-15 14:48:52', 'En attente', 9),
(7, '2020-01-15 14:59:09', 'En attente', 9),
(8, '2020-01-15 15:01:21', 'En attente', 9),
(9, '2020-01-16 19:36:09', 'En attente', 10),
(10, '2020-01-21 14:48:09', 'En attente', 11),
(11, '2020-01-22 20:34:03', 'En attente', 12),
(12, '2020-01-22 22:27:15', 'En attente', 15),
(13, '2020-01-22 22:43:58', 'En attente', 15),
(14, '2020-01-22 22:56:30', 'En attente', 15),
(15, '2020-01-22 23:05:45', 'En attente', 15),
(16, '2020-01-22 23:06:06', 'En attente', 15),
(17, '2020-01-24 13:26:21', 'En attente', 23);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`quantite`, `prix`, `commande_id`, `produit_id`) VALUES
(1, 3, 3, 1),
(1, 3, 4, 1),
(1, 3, 5, 1),
(1, 3, 6, 1),
(1, 3, 7, 1),
(3, 3, 8, 1),
(1, 3, 9, 1),
(4, 3, 10, 1),
(1, 3, 11, 1),
(1, 3, 12, 1),
(1, 2, 13, 2),
(1, 2, 14, 4),
(1, 1, 14, 6),
(1, 2, 15, 4),
(1, 1, 15, 6),
(1, 2, 16, 4),
(1, 1, 16, 6),
(1, 3, 17, 1),
(1, 2, 17, 4),
(1, 8, 17, 8);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200111155114', '2020-01-11 17:33:35'),
('20200114194254', '2020-01-14 19:43:58'),
('20200114213752', '2020-01-14 21:38:12'),
('20200115074842', '2020-01-15 07:49:02'),
('20200115123205', '2020-01-15 12:32:11'),
('20200115125530', '2020-01-15 12:55:35'),
('20200115130924', '2020-01-15 13:09:27'),
('20200115131728', '2020-01-15 13:17:32');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visuel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `categorie_id`, `libelle`, `texte`, `visuel`, `prix`) VALUES
(1, 1, 'Pomme', 'Elle est bonne pour la tienne', 'images/pommes.jpg', 3),
(2, 1, 'Poire', 'Ici tu n\'en es pas une', 'images/poires.jpg', 2),
(3, 1, 'Pêche', 'Elle va te la donner', 'images/peche.jpg', 2),
(4, 2, 'Carotte', 'C\'est bon pour ta vue', 'images/carottes.jpg', 2),
(5, 2, 'Tomate', 'Fruit ou Légume ? Légume', 'images/tomates.jpg', 1),
(6, 2, 'Chou Romanesco', 'Mange des fractales', 'images/romanesco.jpg', 1),
(7, 3, 'Nutella', 'C\'est bon, sauf pour ta santé', 'images/nutella.jpg', 4),
(8, 3, 'Pizza', 'Y\'a pas pire que za', 'images/pizza.jpg', 8),
(9, 3, 'Oreo', 'Seulement si tu es un smartphone', 'images/oreo.jpg', 2),
(10, 1, 'Kiwi', 'Provenance espagne', 'images/kiwi.jpg', 2),
(11, 6, 'Bar', 'Frais du jour', 'images/bar.png', 15),
(12, 6, 'Saumon', 'Provenance Bretagne', 'images/saumon-menu-sport.jpg', 12);

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

CREATE TABLE `usager` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `usager`
--

INSERT INTO `usager` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(9, 'a', '[]', 'a', 'a', 'a'),
(10, '1', '[]', '2', '2', '2'),
(11, 'test mardi', '[]', 'test mardi', 'test mardi', 'test mardi'),
(12, 'antoine', '[]', 'antoine', 'a', 'a'),
(13, 'perfect', '[]', 'per', 's', 's'),
(14, 'antoi@', '[]', 'antoine', 'a', 'a'),
(15, 'xdrdxr', '[]', 'drxdr', 'xdrxdr', 'drxdr'),
(16, 'ghfh44444444444', '[]', 'ghfhfg', 'fghfhg', 'ghfg'),
(17, 'dfgdfg', '[\"ROLE_CLIENT\"]', '$2y$12$TlpZYzt.CY/C2lLlVViGAO6GfHAaM8IsaUO7QYhigdni6ckNeOs4C', 'kkljl', 'jkljklj'),
(18, 'oipîop^', '[\"ROLE_CLIENT\"]', '$2y$12$faUnnfTZZzB1.AeXrINvP.tErnhYfWRkab1V8Lm/Gnf/1/Z2Vmsfq', 'ipîp^', 'ipîp^'),
(19, 'fgf', '[\"ROLE_CLIENT\"]', '$2y$12$djC6pjVB7YvASkrYBCJVZu3GSxRtqPU2yNZIiiZUdf57PS/KGLtn6', 'khuh', 'hkhukuhk'),
(20, 'kersalemarie@orange.fr', '[\"ROLE_CLIENT\"]', '$2y$12$HtmMkTXBjH/xELyI54UmE.VYaCn93qiwhc7M15rptRMPOFc3y/ypu', 'toto', 'toto'),
(23, 'kersa@1', '[\"ROLE_CLIENT\", \"ROLE_ADMIN\"]', '$2y$12$RaHKBoJvoNH24LL24xc5pe/urzx7RGrcwqoAl2r5x7kr/Q5EtWk1y', 'm', 'm'),
(31, 'toto@1', '[\"ROLE_CLIENT\"]', '$2y$12$0pEk4nYsDxk3sQITk/22h.zVMWxxu5vezgwXPRK4ZFc1dVQyLPjVC', 'menu', 'm'),
(32, 'test@toto', '[\"ROLE_CLIENT\"]', '$2y$12$rX6Em/m3upmggXzH15u6G.G.ekmnOgrgNB52oahyttWLVMYy4nu0S', 'toto', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `–regenerate`
--

CREATE TABLE `–regenerate` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D4F36F0FC` (`usager_id`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`commande_id`,`produit_id`),
  ADD KEY `IDX_3170B74B82EA2E54` (`commande_id`),
  ADD KEY `IDX_3170B74BF347EFB` (`produit_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`);

--
-- Index pour la table `usager`
--
ALTER TABLE `usager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3CDC65FFE7927C74` (`email`);

--
-- Index pour la table `–regenerate`
--
ALTER TABLE `–regenerate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `usager`
--
ALTER TABLE `usager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `–regenerate`
--
ALTER TABLE `–regenerate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D4F36F0FC` FOREIGN KEY (`usager_id`) REFERENCES `usager` (`id`);

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `FK_3170B74B82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_3170B74BF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
