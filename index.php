<?php
    session_start();
    $_SESSION['logged'] = "";
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8">
<?php
  include("css/css.php");
?>
  <title>Camagru</title>
<head>
<body>
  <header id="header">
    <div id="container_logo">
      <a href="index.php"><img id="logo" src="images/logo2.gif" alt="logo webcam" title="logo"></a>
      <h1 id="site_name">Camagru</h1>
    </div>
<?php
  if (!empty($_SESSION['logged']))
    include("section/nav.html"); // condition
?>
  </header>
  <?php
  if (!empty($_SESSION['logged']))
      include("section/montage.php"); // condition
  else
      include("section/connect.php");
  ?>
  <?php // javascript pour faire en sorte que le footer sois en bas, modifier la taille de l element au dessus lui donner 100px de plus?>
  <footer id="footer">
  </footer>
</body>
</html>
