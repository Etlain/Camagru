<?php
include_once("config/database.php"); // modifier adresse
$pdo->query("USE camagru");

function bdd_is($pdo, $champs, $elem){
  $req = $pdo->query("SELECT id FROM membre WHERE ".$champs."='".$elem."'");
  if ($req->fetch())
    return (true);
  return (false);
}
?>
