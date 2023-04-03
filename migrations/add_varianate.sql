INSERT INTO `variant_produit`( `produit_id`, `taille`, `couleur`, `prix`)
SELECT id as 'produit_id', 'XL' as 'taille', null as 'couleur', 1000 as 'prix' FROM produit WHERE `categorie_produit_id` = 2;
INSERT INTO `variant_produit`( `produit_id`, `taille`, `couleur`, `prix`)
SELECT id as 'produit_id', 'XXL' as 'taille', null as 'couleur', 1500 as 'prix' FROM produit WHERE `categorie_produit_id` = 2;
INSERT INTO `variant_produit`( `produit_id`, `taille`, `couleur`, `prix`)
SELECT id as 'produit_id', 'XL' as 'taille', null as 'couleur', 770 as 'prix' FROM produit WHERE `categorie_produit_id` = 3;
INSERT INTO `variant_produit`( `produit_id`, `taille`, `couleur`, `prix`)
SELECT id as 'produit_id', 'XXL' as 'taille', null as 'couleur', 1220 as 'prix' FROM produit WHERE `categorie_produit_id` = 3;
INSERT INTO `variant_produit`( `produit_id`, `taille`, `couleur`, `prix`)
SELECT id as 'produit_id', null as 'taille', null as 'couleur', 500 as 'prix' FROM produit WHERE `categorie_produit_id` = 4;