<?php
  $req = $pdo->query("SELECT id FROM membre WHERE `login`=".$pdo->quote($_GET['login'])." AND `key`=".$pdo->quote($_GET['key']));
  $_GET['key'] = "";
  if ($req->fetch())
  {
    $pdo->exec("UPDATE membre SET `actif`='1' WHERE login=".$pdo->quote($_GET['login']));
    echo "<div style='text-align:center'>Votre compte a bien ete active.<br />";
    echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
  }
  else {
    echo "<div style='text-align:center'>Erreur avec l'activation du compte.<br />";
    echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
  }
?>
