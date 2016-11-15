<?php
  $DB_DSN = "mysql:host=localhost;charset=utf8";
  $DB_USER = "root";
  $DB_PASSWORD = "";

  try{
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo ("Connection bdd erreur : ".$e->getMessage());
  }
?>
