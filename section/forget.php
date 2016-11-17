<?php
  if (!empty($_GET['rmail']) && !empty($_GET['key']))
  {
    $_SESSION['rmail'] = $_GET['rmail'];
    $_SESSION['key'] = $_GET['key'];
  }
  if (!empty($_SESSION['rmail']) && !empty($_SESSION['key']))
  {
    if (!verif_mail($_SESSION['rmail'], $str) && !bdd_is($pdo, "mail", $_SESSION['rmail']))
      include("compte/new_pwd.php");
    else if (isset($_POST['submit']) && $_POST['submit'] == "Confirmer")
    {
        if (verif_password($_POST['n_pwd'], $error))
        {
          $pwd = hash("whirlpool", hash("gost", "chocolat".$_POST['n_pwd']));
          $pdo->exec("UPDATE membre SET `mdp`='".$pwd."', `key`='NULL' WHERE mail='".$_SESSION['rmail']."'");
          $_SESSION['rmail'] = "";
          $_SESSION['key'] = "";
          echo "<div style='text-align:center'>Votre mot de passe a bien ete modifier.<br />";
          echo "<a href='index.php'>Cliquez sur ce lien pour revenir sur la page de connection</a></div>";
        }
        else
          include("compte/new_pwd.php");
    }
    else
      include("compte/new_pwd.php");
  }
  else if (isset($_POST['submit']) && $_POST['submit'] == "Valider")
  {
    $_SESSION["mail"] = $_POST['f_mail'];
    if (bdd_is3($pdo, "actif", "0", "mail", $_POST['f_mail']))
      $error = "Votre compte n'est pas active";
    else if (verif_mail($_POST['f_mail'], $error) && bdd_is($pdo, "mail", $_POST['f_mail']))
      include("compte/mail_pwd.php");
      ?>
      <section>
      <h2>Mot de passe oublié</h2>
      <form action="?form=forget" method="post">
        Mail :<br /><input type="text" name="f_mail" value="<?php echo $_SESSION['mail'];?>">
        <br />
        <br />
        <?php
        echo "<span style='color:red'>".$error."</span>";
        $error = "";
        ?>
        <br />
        <br />
        <input type="submit" name="submit" value="Valider">
      </form>
      <div>
      <a href="index.php">Se connecter</a>
      <br />
      <a href="?form=create">Creer un compte</a>
      </div>
      </section>
      <?php
  }
  else
  {
?>
<section>
<h2>Mot de passe oublié</h2>
<form action="?form=forget" method="post">
  Mail :<br /><input type="text" name="f_mail" value="<?php echo $_SESSION['mail'];?>">
  <br />
  <br />
  <?php
  echo "<span style='color:red'>".$error."</span>";
  $error = "";
  ?>
  <br />
  <br />
  <input type="submit" name="submit" value="Valider">
</form>
<div>
<a href="index.php">Se connecter</a>
<br />
<a href="?form=create">Creer un compte</a>
</div>
</section>
<?php
  }
?>
