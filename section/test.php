<?php
  echo $_POST['x'];
  //$src = imagecreatetruecolor (500, 500);
  //echo $src;
  $size = getimagesize("../images/evoli.png");
  $src = str_replace(' ','+', urldecode($_POST['src']));
  $src = explode(',', $src);
  file_put_contents("tmp.png", base64_decode($src[1]));
  $a = imagecreatefrompng("tmp.png");
  imagecopy($a, imagecreatefrompng("../images/evoli.png"), $_POST['x'], $_POST['y'], 0, 0, $size[0], $size[1]);
  //unlink("tmp.png");
  imagepng($a, "tmp.png");
  echo (base64_encode(file_get_contents("tmp.png")));
  //unlink("tmp.png");
  /*$src = str_replace(' ','+', urldecode($_POST['src']));
  $src = explode(',', $src);
  file_put_contents("tmp.png", base64_decode($src[1]));*/
  //imagecopy(imagecreatefrompng($src[1]), $_POST['img'], 0, 0, 125, 154, 125, 154);
?>
