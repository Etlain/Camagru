<link rel="stylesheet" type="text/css" href="css/main.css">
<?php
if (!empty($_SESSION['logged']))
{
?>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 560px)" href="css/responsive.css">
<?php
}
else
?>
  <link rel="stylesheet" type="text/css" href="css/form.css">
