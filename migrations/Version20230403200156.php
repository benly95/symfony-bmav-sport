<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403200156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
 set foreign_key_checks=0;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE `adresse` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `client_id`, `rue`, `code_postal`, `ville`, `pays`) VALUES
(1, NULL, 'dqsdqdqs', 87000, 'Paris', 'FR'),
(2, NULL, 'qdsdqsd', 78000, 'dqsdqd', 'FR'),
(3, NULL, 'dqsdq', 78000, 'dqsdqsdq', 'FR'),
(4, NULL, 'dqsdq', 78000, 'dqsdqsdq', 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `image`) VALUES
(1, 'Homme', '', ''),
(2, 'Femme', '', ''),
(3, 'Enfant', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

DROP TABLE IF EXISTS `categorie_produit`;
CREATE TABLE `categorie_produit` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`id`, `nom`, `description`, `image`) VALUES
(2, 'Maillot', 'Maillot de foot des clubs européens', '/images/avatar.png'),
(3, 'Pantalon', 'Pantalon de sport', '/images/kisspng.png'),
(4, 'Accessoires', 'Accessoire de sport', '/images/13032.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `telephone`) VALUES
(1, 'fsdf', 'sfddf', 'sfsfsdf@free.fr', 'sqdqdqd'),
(2, 'qd', 'dqsd', 'dqsdq@free.fr', 'dqsdq');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230403114631', '2023-04-03 19:17:33', 1861),
('DoctrineMigrations\\Version20230403194953', '2023-04-03 21:49:57', 787),
('DoctrineMigrations\\Version20230403200156', '2023-04-03 22:01:58', 86);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE `livraison` (
  `id` int NOT NULL,
  `panier_id` int NOT NULL,
  `adresse_id` int NOT NULL,
  `transporteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_de_livraison` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `panier_id`, `adresse_id`, `transporteur`, `mode_de_livraison`, `information_livraison`) VALUES
(1, 1, 2, 'CHR', 'normal', 'dqsdsqdqsd'),
(2, 2, 4, 'CHR', 'normal', 'wdqsdqsd');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE `marque` (
  `id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `description`, `nom`, `image_logo`) VALUES
(1, '', 'Adidas', ''),
(2, '', 'Nike', ''),
(3, '', 'Kappa', ''),
(4, '', 'Umbro', ''),
(5, '', 'Puma', '/images/Logo/580b57fcd9996e24bc43c4f8.png'),
(6, '', 'Le coq sportif', '');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE `paiement` (
  `id` int NOT NULL,
  `panier_id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `moyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `panier_id`, `status`, `date`, `total`, `moyen`) VALUES
(1, 1, 'valider', '2023-04-03 22:35:26', 51520, 'cb'),
(2, 2, 'valider', '2023-04-03 22:45:33', 4500, 'cb');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE `panier` (
  `id` int NOT NULL,
  `adresse_de_facture_id` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `date_de_commande` datetime DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `adresse_de_facture_id`, `client_id`, `date_de_commande`, `total`, `status`) VALUES
(1, 1, 1, '2023-04-03 22:35:26', 51520, 'payer'),
(2, 3, 2, '2023-04-03 22:45:33', 4500, 'payer');

-- --------------------------------------------------------

--
-- Structure de la table `panier_item`
--

DROP TABLE IF EXISTS `panier_item`;
CREATE TABLE `panier_item` (
  `id` int NOT NULL,
  `panier_id` int NOT NULL,
  `variant_produit_id` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `prix_unitaire` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier_item`
--

INSERT INTO `panier_item` (`id`, `panier_id`, `variant_produit_id`, `quantite`, `prix_unitaire`) VALUES
(2, 1, 78, 16, 1220),
(3, 1, 97, 4, 500),
(4, 2, 45, 3, 1500);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `id` int NOT NULL,
  `marque_id` int NOT NULL,
  `categorie_id` int DEFAULT NULL,
  `categorie_produit_id` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `marque_id`, `categorie_id`, `categorie_produit_id`, `nom`, `description`, `image`) VALUES
(1, 1, 1, 2, 'Maillot simple', 'Maillot de foot', '/images/Produit/maillot-simple.png'),
(2, 1, 1, 2, 'Maillot juventus', 'Mailllot de foot', '/images/Produit/maillot-juventus.png'),
(3, 1, 1, 2, 'Maillot real madrid', 'Mailllot de foot', '/images/Produit/maillot-real-madrid.png'),
(4, 1, 1, 3, 'Pantalon pant', 'Pantalon sport', '/images/Produit/pantalon-pant.png'),
(5, 1, 1, 2, 'Maillot de corps', 'Maillot de foot', '/images/Produit/maillot-de-corps.png'),
(6, 2, 1, 2, 'Maillot academy', 'Mailllot de foot', '/images/Produit/maillot-academy.png'),
(7, 2, 1, 2, 'Maillot-sleeve', 'Maillot de foot', '/images/Produit/maillot-sleeve.png'),
(8, 2, 1, 2, 'Maillot argentina', 'Maillot de foot', '/images/Produit/maillot-argentina.png'),
(9, 2, 1, 2, 'Maillot jersey', 'Maillot de foot', '/images/Produit/maillot-jersey.png'),
(10, 2, 1, 2, 'Maillot manche courte', 'Mailllot de foot', '/images/Produit/maillot-manche-courte.png'),
(11, 2, 1, 3, 'Pantalon pro', 'Pantalon sport', '/images/Produit/pantalon-pro.png'),
(12, 2, 1, 3, 'Pantalon tracksuit', 'Pantalon sport polair', '/images/Produit/pantalon-tracksuit.png'),
(13, 2, 1, 2, 'Maillot de foot manche longue', 'Maillot de foot', '/images/Produit/maillot-foot-manche-longue.png'),
(14, 3, 1, 3, 'Pantalon clothing', 'Pantalon sport', '/images/Produit/pantalon-clothing.png'),
(15, 3, 1, 3, 'pantalon smart', 'Pantalon sport', '/images/Produit/pantalon-smart.png'),
(16, 3, 1, 3, 'pantalon-fit', 'Pantalon sport', '/images/Produit/pantalon-fit.png'),
(17, 3, 1, 2, 'Maillot-barcelone', 'Maillot de foot', '/images/Produit/maillot-barcelone.jpg'),
(18, 4, 1, 2, 'Maillot gardien sleeve', 'Maillot de foot', '/images/Produit/maillot-gardien-sleeve.png'),
(19, 4, 1, 2, 'Maillot gardien de foot', 'Maillot de foot', '/images/Produit/maillot-gardien-foot.png'),
(20, 4, 1, 2, 'Maillot celtics', 'Maillot de foot', '/images/Produit/maillot-celtics.jpg'),
(21, 5, 1, 3, 'Pantalon sweatpants', 'Pantalon sport', '/images/Produit/pantalon-sweatpants.png'),
(22, 5, 1, 3, 'Pantalon casual', 'Pantalon sport', '/images/Produit/pantalon-casual.png'),
(23, 5, 1, 2, 'tee-shirt hoodie', 'tee-shirt classique', '/images/Produit/tee-shirt-hoodie.png'),
(24, 5, 1, 2, 'Maillot borussia', 'Maillot de foot', '/images/Produit/maillot-borussia-.png'),
(25, 6, 1, 2, 'Maillot ogc nice', 'Maillot de foot', '/images/Produit/maillot-ogc-nice-.png'),
(26, 1, 1, 4, 'Sac backpack', 'Sac a dos', '/images/produit/sac-backpack.png'),
(27, 1, 1, 4, 'Sac backpack three', 'sac a dos', '/images/produit/sac-backpack-three.png'),
(28, 1, 1, 4, 'Sac training', 'sac a dos', '/images/produit/sac trainig.png'),
(29, 4, 1, 4, 'sac backpack two', 'sac a dos', '/images/produit/sac-training.png'),
(30, 5, 1, 4, 'Sac duffel', 'sac de sport', '/images/produit/sac-duffel.png'),
(31, 4, 1, 4, 'Ballon-england', 'ballon de foot', '/images/produit/ballon-englang.png'),
(32, 4, 1, 4, 'Gant soccer', 'Gant de gardien de foot', '/images/produit/gant-soccer.png'),
(33, 2, 1, 4, 'ballon barcelone', 'ballon de foot', '/images/produit/ballon-barcelone.png'),
(34, 2, 1, 4, 'ballon premier league', 'ballon de foot', '/images/produit/ballon-premier-league.png'),
(35, 4, 1, 4, 'ballon sport football', 'ballon foot', '/images/produit/ballon-sport-football.png'),
(36, 1, 1, 4, 'Gant de but', 'Gant de gardien de football', '/images/produit/Gant-de-but.png'),
(37, 2, 1, 4, 'goalkeeper', 'Gant de gardien de foot', '/images/produit/goalkeeper.png'),
(38, 2, 1, 4, 'sac elemental', 'sac a dos', '/images/produit/sac-elemental.png'),
(39, 5, 1, 4, 'Sac pionneer', 'Sac a dos', '/images/produit/sac-pionneer.png'),
(40, 2, 1, 4, 'ballon brazil', 'ballon foot', '/images/produit/ballon-brazil.png'),
(41, 1, 1, 4, 'ballon manchester', 'ballon de foot', '/images/produit/ballon-manchester.png'),
(42, 2, 1, 4, 'bouteille de sport', 'bouteille pour sportif', '/images/produit/bouteille-de-sport.png');

-- --------------------------------------------------------

--
-- Structure de la table `variant_produit`
--

DROP TABLE IF EXISTS `variant_produit`;
CREATE TABLE `variant_produit` (
  `id` int NOT NULL,
  `produit_id` int NOT NULL,
  `taille` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couleur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `variant_produit`
--

INSERT INTO `variant_produit` (`id`, `produit_id`, `taille`, `couleur`, `prix`) VALUES
(1, 1, 'XL', NULL, 1000),
(2, 2, 'XL', NULL, 1000),
(3, 3, 'XL', NULL, 1000),
(4, 5, 'XL', NULL, 1000),
(5, 6, 'XL', NULL, 1000),
(6, 7, 'XL', NULL, 1000),
(7, 8, 'XL', NULL, 1000),
(8, 9, 'XL', NULL, 1000),
(9, 10, 'XL', NULL, 1000),
(10, 13, 'XL', NULL, 1000),
(11, 17, 'XL', NULL, 1000),
(12, 18, 'XL', NULL, 1000),
(13, 19, 'XL', NULL, 1000),
(14, 20, 'XL', NULL, 1000),
(15, 23, 'XL', NULL, 1000),
(16, 24, 'XL', NULL, 1000),
(17, 25, 'XL', NULL, 1000),
(32, 1, 'XXL', NULL, 1500),
(33, 2, 'XXL', NULL, 1500),
(34, 3, 'XXL', NULL, 1500),
(35, 5, 'XXL', NULL, 1500),
(36, 6, 'XXL', NULL, 1500),
(37, 7, 'XXL', NULL, 1500),
(38, 8, 'XXL', NULL, 1500),
(39, 9, 'XXL', NULL, 1500),
(40, 10, 'XXL', NULL, 1500),
(41, 13, 'XXL', NULL, 1500),
(42, 17, 'XXL', NULL, 1500),
(43, 18, 'XXL', NULL, 1500),
(44, 19, 'XXL', NULL, 1500),
(45, 20, 'XXL', NULL, 1500),
(46, 23, 'XXL', NULL, 1500),
(47, 24, 'XXL', NULL, 1500),
(48, 25, 'XXL', NULL, 1500),
(63, 4, 'XL', NULL, 770),
(64, 11, 'XL', NULL, 770),
(65, 12, 'XL', NULL, 770),
(66, 14, 'XL', NULL, 770),
(67, 15, 'XL', NULL, 770),
(68, 16, 'XL', NULL, 770),
(69, 21, 'XL', NULL, 770),
(70, 22, 'XL', NULL, 770),
(78, 4, 'XXL', NULL, 1220),
(79, 11, 'XXL', NULL, 1220),
(80, 12, 'XXL', NULL, 1220),
(81, 14, 'XXL', NULL, 1220),
(82, 15, 'XXL', NULL, 1220),
(83, 16, 'XXL', NULL, 1220),
(84, 21, 'XXL', NULL, 1220),
(85, 22, 'XXL', NULL, 1220),
(93, 26, NULL, NULL, 500),
(94, 27, NULL, NULL, 500),
(95, 28, NULL, NULL, 500),
(96, 29, NULL, NULL, 500),
(97, 30, NULL, NULL, 500),
(98, 31, NULL, NULL, 500),
(99, 32, NULL, NULL, 500),
(100, 33, NULL, NULL, 500),
(101, 34, NULL, NULL, 500),
(102, 35, NULL, NULL, 500),
(103, 36, NULL, NULL, 500),
(104, 37, NULL, NULL, 500),
(105, 38, NULL, NULL, 500),
(106, 39, NULL, NULL, 500),
(107, 40, NULL, NULL, 500),
(108, 41, NULL, NULL, 500),
(109, 42, NULL, NULL, 500);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C35F081619EB6921` (`client_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_produit`
--
ALTER TABLE `categorie_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A60C9F1FF77D927C` (`panier_id`),
  ADD UNIQUE KEY `UNIQ_A60C9F1F4DE7DC5C` (`adresse_id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B1DC7A1EF77D927C` (`panier_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_24CC0DF21BA9295B` (`adresse_de_facture_id`),
  ADD KEY `IDX_24CC0DF219EB6921` (`client_id`);

--
-- Index pour la table `panier_item`
--
ALTER TABLE `panier_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EBFD0067F77D927C` (`panier_id`),
  ADD KEY `IDX_EBFD0067FDB5826E` (`variant_produit_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC274827B9B2` (`marque_id`),
  ADD KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_29A5EC2791FDB457` (`categorie_produit_id`);

--
-- Index pour la table `variant_produit`
--
ALTER TABLE `variant_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4600C161F347EFB` (`produit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie_produit`
--
ALTER TABLE `categorie_produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `panier_item`
--
ALTER TABLE `panier_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `variant_produit`
--
ALTER TABLE `variant_produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F081619EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `FK_A60C9F1F4DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`),
  ADD CONSTRAINT `FK_A60C9F1FF77D927C` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_B1DC7A1EF77D927C` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF219EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_24CC0DF21BA9295B` FOREIGN KEY (`adresse_de_facture_id`) REFERENCES `adresse` (`id`);

--
-- Contraintes pour la table `panier_item`
--
ALTER TABLE `panier_item`
  ADD CONSTRAINT `FK_EBFD0067F77D927C` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`),
  ADD CONSTRAINT `FK_EBFD0067FDB5826E` FOREIGN KEY (`variant_produit_id`) REFERENCES `variant_produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC274827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  ADD CONSTRAINT `FK_29A5EC2791FDB457` FOREIGN KEY (`categorie_produit_id`) REFERENCES `categorie_produit` (`id`),
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `variant_produit`
--
ALTER TABLE `variant_produit`
  ADD CONSTRAINT `FK_4600C161F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);
COMMIT;

SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
