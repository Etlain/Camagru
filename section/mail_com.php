<?php
$req = $pdo->query("SELECT membre.id,login, mail FROM `membre` INNER JOIN `image` ON membre.id=image.id_membre WHERE image.id ='2'");
$tab = $req->fetch();
if ($tab['id'] != $_SESSION['logged'])
{
  $sujet = "Commentaire image";
  $entete = "From: commentaire@camagru.fr";
  $message = 'Bonjour '.$tab['login'].',
'.$_SESSION['login'].' a commenter votre image :

'.$_SESSION['login'].': '.htmlspecialchars($_POST['commentaire']).'

'.$site.'?nav=galerie&id_img='.$_GET['id_img'].'

---------------
Ceci est un mail automatique, merci de ne pas y repondre.';
  mail($tab['mail'], $sujet, $message, $entete);
}
?>
