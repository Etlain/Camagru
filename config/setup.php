<?php
  require("database.php");

  $pdo->exec("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE `camagru`");
  $pdo->exec("CREATE TABLE IF NOT EXISTS `image`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `id_membre` int(10) unsigned NOT NULL, `image` longtext NOT NULL, PRIMARY KEY (`id`), KEY `id_membre` (`id_membre`))");
  $pdo->exec("CREATE TABLE IF NOT EXISTS `membre`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `login` varchar(12) NOT NULL, `mdp` varchar(130) NOT NULL, `mail` varchar(254) NOT NULL, `key` varchar(32), `actif` INT DEFAULT 0, PRIMARY KEY (`id`), UNIQUE KEY `login` (`login`,`mail`))");
  $pdo->exec("CREATE TABLE IF NOT EXISTS `commentaire`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `id_image` int(10) unsigned NOT NULL, `login` varchar(12) NOT NULL, `texte` text NOT NULL, PRIMARY KEY (`id`))");
  $pdo->exec("ALTER TABLE `image` ADD CONSTRAINT `image_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`);");
  $pdo->exec("ALTER TABLE `commentaire` ADD CONSTRAINT `commentaire_image` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`);");
  $pdo = NULL;
?>
