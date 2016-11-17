<?php
  if (bdd_is($pdo, "actif", "1"))
  {
      $exec = $pdo->prepare("SELECT id FROM membre WHERE mail='?' AND `key`='?'");
      if ($exec->execute(array($_SESSION['rmail'], $_SESSION['key'])))
      {
?>
<section>
<h2>Mot de passe oublié</h2>
<form action="?form=forget" method="post">
  Password :<br /><input type="password" name="n_pwd">
  <br />
  <br />
  <?php
  echo "<span style='color:red'>".$error."</span>";
  $error = "";
  ?>
  <br />
  <br />
  <input type="submit" name="submit" value="Confirmer">
</form>
<div>
<a href="index.php">Se connecter</a>
</div>
</section>
<?php }
      else
      {
        echo "<div style='text-align:center'>Vous n'êtes pas autoriser a acceder à cette page.<br />";
        echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
      }
    }
    else
    {
      echo "<div style='text-align:center'>Vous n'êtes pas autoriser a acceder à cette page.<br />";
      echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
    }
?>
