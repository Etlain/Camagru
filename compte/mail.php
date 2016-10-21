<?php
  $key = md5(microtime(TRUE) * 444444);
  //$pdo->exec("UPDATE membre SET `key`='".$key."' WHERE mail='".$_POST['c_mail']."'");
  $sujet = "Activation du compte";
  $entete = "From: activation@camagru.fr";
  $message = '  Bienvenue sur camagru,
  Pour activer votre compte, veuillez cliquer sur le lien ci dessous
  ou copier/coller dans votre navigateur internet.

  http://localhost:8080/camagru/index.php?login='.urlencode($_POST['c_login']).'&key='.urlencode($key).'


  ---------------
  Ceci est un mail automatique, Merci de ne pas y répondre.';
  //ini_set('SMTP','smtp.sfr.fr');
  mail($_POST['c_mail'], $sujet, $message, $entete);
?>
