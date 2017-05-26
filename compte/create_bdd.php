<?php
  if (!bdd_is($pdo, "login", $_POST['c_login']) && !bdd_is($pdo, "mail", $_POST['c_mail']))
  {
    $pwd = hash("whirlpool", hash("gost", "chocolat".$_POST['c_pwd']));
    $pdo->exec("INSERT INTO membre(login, mdp, mail) VALUES ('".$_POST['c_login']."', '".$pwd."', '".$_POST['c_mail']."')");
    include("compte/mail_activation.php");
    echo "<div style='text-align:center'>Votre compte a bien ete creer, vous aller recevoir un mail d'activation.<br />";
    echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
  }
  else
  {
    if (bdd_is($pdo, "login", $_POST['c_login']))
      $error = "Login deja utilise";
    else if (bdd_is($pdo, "mail", $_POST['c_mail']))
      $error = "Mail deja utilise";
    include("section/create.php");
  }
?>
