<?php
if (isset($_POST['submit']) && $_POST['submit'] == "Connexion")
{
  include("compte/verif.php");
  $_SESSION['login'] = $_POST['l_login'];
  if (bdd_is2($pdo, "actif", "1", $_SESSION['login']))
  {
    if (verif_login($_POST['l_login'], $error) && bdd_is($pdo, "login", $_POST['l_login']))
    {
      if (verif_password($_POST['l_pwd'], $error))
      {
        $pwd = hash("whirlpool", hash("gost", 'chocolat'.$_POST['l_pwd']));
        if (($id = bdd_is2($pdo, "mdp", $pwd, $_SESSION['login'])))
        {
          $_SESSION['logged'] = $id;
        }
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
