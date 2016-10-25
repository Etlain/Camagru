<link rel="stylesheet" type="text/css" href="css/main.css">
<?php
if (!empty($_SESSION['logged']))
{
?>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <style>  @media screen and (max-width: 650px){
    #webcam{
      margin: 0px;
    }
  }
  </style>
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 590px)" href="css/responsive.css">
<?php
}
else
{
?>
  <link rel="stylesheet" type="text/css" href="css/form.css">
<?php } ?>
