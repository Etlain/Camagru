<?php
  if (!empty($_GET['rmail']) && !empty($_GET['key']))
    include("compte/new_pwd.php");
  else
  {
    if (isset($_POST['submit']) && $_POST['submit'] == "Valider")
    {
      include("compte/requete.php");
      $_SESSION["mail"] = $_POST['f_mail'];
      if (bdd_is($pdo, "actif", "0"))
        $error = "Votre compte n'est pas active";
      else if (verif_mail($_POST['f_mail'], $error) && bdd_is($pdo, "mail", $_POST['f_mail']))
        include("compte/mail_pwd.php");
    }
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
