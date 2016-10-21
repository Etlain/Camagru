<?php
    session_start();
    $error = "";
    include_once("config/database.php");
    include("compte/login_bdd.php");
    if (!empty($_GET['nav']) && $_GET['nav'] == "logout")
      include("session/logout.php");
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="images/favicon.ico" />
<?php
  include("css/css.php");
?>
  <title>Camagru</title>
<head>
<body>
  <header id="header">
    <div id="container_logo">
      <a href="index.php"><img id="logo" src="images/logo.gif" alt="logo webcam" title="logo"></a>
      <a href="index.php" style="text-decoration:none;"><h1 id="site_name">Camagru</h1></a>
    </div>
<?php
  if (!empty($_SESSION['logged']))
    include("section/nav.php");
?>
  </header>
  <?php
  if (!empty($_SESSION['logged']))
      include("section/montage.php");
  else if (!empty($_GET['key']) && !empty($_GET['login']))
      include("compte/activation.php");
  else
      include("section/connect.php");
  ?>
  <?php // javascript pour faire en sorte que le footer sois en bas, modifier la taille de l element au dessus lui donner 100px de plus?>
  <footer id="footer">
  </footer>
</body>
</html>
