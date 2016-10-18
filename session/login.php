<?php
  require("session/auth.php");
  if (auth($_POST['login'], $_POST['passwd'])
    $_SESSION['login'] = $_POST["login"];
  else
    $_SESSION['login'] = "";
?>
