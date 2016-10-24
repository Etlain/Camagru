<?php
if (isset($_POST['submit']) && $_POST['submit'] == "Connexion")
{
  include("compte/requete.php");
  include("compte/verif.php");
  $_SESSION['login'] = $_POST['l_login'];
  if (bdd_is($pdo, "actif", "1"))
  {
    if (verif_login($_POST['l_login'], $error) && bdd_is($pdo, "login", $_POST['l_login']))
    {
      if (verif_password($_POST['l_pwd'], $error))
      {
        $pwd = hash("whirlpool", hash("gost", 'chocolat'.$_POST['l_pwd']));
        if (bdd_is($pdo, "mdp", $pwd))
          $_SESSION['logged'] = "1";
        else
          $error = "Mot de passe invalide";
      }
      else
        $error = "Mot de passe invalide";
  }
  else
    $error = "Login invalide";
}
else
  $error = "Compte pas activer";
}
?>
