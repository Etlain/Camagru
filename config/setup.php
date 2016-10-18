<?php
  require("database.php");

  $pdo->exec("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE `camagru`");
  $pdo->exec("CREATE TABLE IF NOT EXISTS `image`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `id_personne` int(10) unsigned NOT NULL, `image` text NOT NULL, PRIMARY KEY (`id`), KEY `id_personne` (`id_personne`))");
  $pdo->exec("CREATE TABLE IF NOT EXISTS `personne`(`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `login` varchar(12) NOT NULL, `mdp` varchar(130) NOT NULL, `mail` varchar(130) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `login` (`login`,`mail`))");
  $pdo->exec("ALTER TABLE `image` ADD CONSTRAINT `image_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`);");
?>
