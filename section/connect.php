<?php
include_once("compte/verif.php");
$_SESSION['login'] = "";
$_SESSION['mail'] = "";
$error = "";
if (isset($_GET['form']) && $_GET['form'] == "create" && empty($_SESSION['login']))
{
  if (isset($_POST['submit']) && $_POST['submit'] == "Creer")
  {
    $_SESSION['login'] = $_POST['c_login'];
    $_SESSION['mail'] = $_POST['c_mail'];
    if (verif_login($_POST['c_login'], $error) && verif_mail($_POST['c_mail'], $error) && verif_password($_POST['c_pwd'], $error))
      include("compte/verif_bdd.php");
    else
      include("section/create.php");
  }
  else
    include("section/create.php");
}
else if (isset($_GET['form']) && $_GET['form'] == "forget" && empty($_SESSION['login']))
  include("section/forget.php");
else
  include("section/login.php");
?>
