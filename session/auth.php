<?php
  function auth($login, $pwd){
    if (empty($login) || empty($pwd))
      return (FALSE);
    require_once("config/database.php");
    $login = $pdo->quote($login);
    $pwd = $pdo->quote($pwd);
    $pwd = hash("whirlpool", hash("gost", 'chocolat'.$pwd));
    $b = $pdo->exec("SELECT id FROM personne WHERE login='.$mail.' AND mdp='".$pwd."'");
    if ($b)
      return (TRUE);
    return (FALSE);
  }
?>
