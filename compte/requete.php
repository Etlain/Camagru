<?php
include_once("config/database.php"); // modifier adresse
$pdo->query("USE camagru");

function bdd_is($pdo, $champs, $elem){
  $req = $pdo->query("SELECT id FROM membre WHERE ".$champs."='".$elem."'");
  if (($id = $req->fetch()))
    return ($id[0]);
  return (false);
}

function bdd_is2($pdo, $champs, $elem, $login){
  $req = $pdo->query("SELECT id FROM membre WHERE ".$champs."='".$elem."' AND login='".$login."'");
  if (($id = $req->fetch()))
    return ($id[0]);
  return (false);
}

function bdd_is3($pdo, $champs, $elem, $champs2, $elem2){
  $req = $pdo->query("SELECT id FROM membre WHERE ".$champs."='".$elem."' AND ".$champs2."='".$elem2."'");
  if (($id = $req->fetch()))
    return ($id[0]);
  return (false);
}
?>
