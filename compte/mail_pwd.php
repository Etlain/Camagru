<?php
$key = md5(microtime(TRUE) * 444444);
$pdo->exec("UPDATE membre SET `key`='".$key."' WHERE mail='".$_POST['f_mail']."'");
$sujet = "Reinitialiser mot de passe";
$entete = "From: reinitialiser@camagru.fr";
$message = 'Bienvenue sur camagru,
Pour reinitialiser votre mot de passe, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.

http://localhost:8080/camagru/index.php?form=forget&rmail='.urlencode($_POST['f_mail']).'&key='.urlencode($key).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
//ini_set('SMTP','smtp.sfr.fr');
mail($_POST['f_mail'], $sujet, $message, $entete);
echo "<div style='text-align:center'>Un mail vous a ete envoyer.<br />";
echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
?>
