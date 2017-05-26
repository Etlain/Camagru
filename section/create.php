<section>
<h2>Création d'un compte</h2>
<form action="index.php?form=create" method="post">
  Login :<br /><input type="text" name="c_login" value="<?php echo htmlspecialchars($_SESSION['login']);?>">
  <br />
  <br />
  Password :<br /><input type="password" name="c_pwd">
  <br />
  <br />
  Mail :<br /> <input type="text" name="c_mail" value="<?php echo htmlspecialchars($_SESSION['mail']);?>">
  <br />
  <br />
  <?php
  echo "<span style='color:red'>".$error."</span>";
  $error = "";
  ?>
  <br />
  <br />
  <input type="submit" name="submit" value="Creer">
</form>
<div id="lien">
<br />
<a href="?form=forget">Mot de passe oublié</a>
<br />
<a href="index.php">Se connecter</a>
</div>
</section>
