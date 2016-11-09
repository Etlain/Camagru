<?php
session_start();
  //echo $_POST['x'];
  //echo ($_POST['src']);
  //$src = imagecreatetruecolor (500, 500);
  //echo $src;
  if (isset($_POST['submit']) && $_POST['submit'] == "Enregistrer")
  {
    include_once("../config/database.php");
    $pdo->query("USE camagru");
    //include("../compte/requete.php");
    //echo "test ".$_SESSION['logged'];
    $exec = $pdo->prepare("INSERT INTO `image`(`id_membre`, `image`) VALUES (?, ?);");
    $exec->execute(array($_SESSION['logged'], str_replace(' ','+', urldecode($_POST['src']))));
    $pdo = NULL;
    echo "<div style='text-align:center'>Image Enregistrer</div>";
  }
  else
  {
    if ($name != "aucun")
    {
      $name = urldecode($_POST['name']);
      $size = getimagesize("../images/".$name.".png");
      $src = str_replace(' ','+', urldecode($_POST['src']));
      $src = explode(',', $src);
      file_put_contents("tmp.png", base64_decode($src[1]));
      $a = imagecreatefrompng("tmp.png");
      imagecopy($a, imagecreatefrompng("../images/".$name.".png"), $_POST['x'], $_POST['y'], 0, 0, $size[0], $size[1]);
      unlink("tmp.png");
      imagepng($a, "tmp.png");
      echo (base64_encode(file_get_contents("tmp.png")));
      unlink("tmp.png");
    }
  }
?>
