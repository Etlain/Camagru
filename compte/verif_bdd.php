<?php
  include_once("config/database.php"); // modifier adresse
  $pdo->query("USE camagru");

  function bdd_is($pdo, $champs, $elem){
    $req = $pdo->query("SELECT id FROM membre WHERE ".$champs."='".$elem."'");
    if ($req->fetch())
      return (true);
    return (false);
  }

  if (!bdd_is($pdo, "login", $_POST['c_login']) && !bdd_is($pdo, "mail", $_POST['c_mail']))
  {
    $pwd = hash("whirlpool", hash("gost", "chocolat".$_POST['c_pwd']));
    $pdo->exec("INSERT INTO membre(login, mdp, mail) VALUES ('".$_POST['c_login']."', '".$pwd."', '".$_POST['c_mail']."')");
    include("compte/mail.php");
    echo "Votre compte a bien ete creer, vous aller recevoir un mail d'activation.<br />";
    echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a>";
  }
  else
  {
    if (bdd_is($pdo, "login", $_POST['c_login']))
      echo "<span style='text-align:center'>Login deja utilise</span>";
    else if (bdd_is($pdo, "mail", $_POST['c_mail']))
      echo "<span style='text-align:center'>Mail deja utilise</span>";
    include("section/create.php");
  }
?>
