<?php
  include("compte/requete.php");
  if (verif_mail($_GET['rmail'], $error) && bdd_is($pdo, "mail", $_GET['rmail']))
  {
    // eventuellement regex pour verifier la validite de la key
    //$pdo->prepare();
  }
  else {
  }
?>
