<section>
<?php
  if (isset($_GET['id_img']))
  {
    if (isset($_POST['commenter']) && $_POST['commenter'] == "Commenter")
    {
      //echo $_SESSION['login'];
      // proteger champs commentaire
      $req = $pdo->prepare("INSERT INTO commentaire(`id_image`, `login`, `texte`) VALUES (?, ?, ?)");
      $req->execute(array($_GET['id_img'], $_SESSION['login'], $_POST['commentaire']));
    }
    $req = $pdo->query("SELECT id,image FROM `image` WHERE id='".$_GET['id_img']."'"); // modif id membre
    $tab = $req->fetch();
    $tmp = $tab['id'];
    echo "<div><img src='".$tab['image']."'><br /></div>";
    $req = $pdo->query("SELECT login,texte FROM `commentaire` WHERE id_image='".$_GET['id_img']."'"); // modif id membre
    $tab = $req->fetchAll();
    foreach ($tab as $val) {
      echo "<span>".$val['login'].": ".$val['texte']."</span><br />";
    }
    ?>
    <form method="post" action="index.php?nav=galerie&id_img=<?php echo $tmp; ?>">
      <textarea name="commentaire" rows="8" cols="45"></textarea>
      <input type="submit" name="commenter" value="Commenter"/>
    <form>
    <?php
  }
  else {
  $req = $pdo->query("SELECT id,image FROM `image` ORDER BY id DESC"); // modif id membre
  $tab = $req->fetchAll();
  //print_r($tab);
  //echo($tab[0]['image']);
  foreach ($tab as $val) {
    echo "<div><img style='height:172.5px; width:230px;' src='".$val['image']."'><br />";
    echo "<a href='index.php?nav=galerie&id_img=".$val['id']."'>commentaires";
    echo "</a></div>";
  }
  //echo "<img style='height:172.5px; width:230px;' src='".$tab[0]['image']."'>";
}
?>
</section>
