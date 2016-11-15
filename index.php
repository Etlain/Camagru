<?php
    session_start();
    $_SESSION['logged'] = "1"; // = id
    $error = "";
    $site = "http://localhost:8080/camagru/index.php";
    include_once("compte/requete.php");
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
<!--<body onmousemove="pos_mouse(event)">-->
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
  //include_once("config/requete.php");
  if (!empty($_SESSION['logged']))
      include("section/montage.php");
  else if (!empty($_GET['key']) && !empty($_GET['login']) && bdd_is($pdo, "actif", "0"))
      include("compte/activation.php");
  else
      include("section/connect.php");
  $pdo = NULL;
  ?>
  <div style="height: 150px"></div>
  <footer id="footer">
  </footer>
</body>
</html>
