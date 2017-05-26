<section>
<h2>Connexion</h2>
<form action="index.php" method="post">
  Login :<br /><input type="text" name="l_login" value="<?php echo htmlspecialchars($_SESSION['login']);?>">
  <br />
  <br />
  Password :<br /><input type="password" name="l_pwd">
  <br />
  <br />
  <?php
  echo "<span style='color:red'>".$error."</span>";
  $error = "";
  ?>
  <br />
  <br />
  <input type="submit" name="submit" value="Connexion">
</form>
<div>
<a href="?form=forget">Mot de passe oublié</a>
<br />
<a href="?form=create">Creer un compte</a>
</div>
</section>
