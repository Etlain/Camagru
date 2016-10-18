<?php
    session_start();
    $_SESSION['login'] = "";
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
      <img id="logo" src="images/logo.gif" alt="logo webcam" title="logo">
      <h1 id="site_name">Camagru</h1>
    </div>
<?php
  if (!empty($_SESSION['login']))
    include("section/nav.html"); // condition
?>
  </header>
  <?php
  if (!empty($_SESSION['login']))
      include("section/montage.php"); // condition
  else
      include("section/login.php");
  ?>
  <footer id="footer">
  </footer>
</body>
</html>
