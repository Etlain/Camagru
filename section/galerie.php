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
    </form>
    <?php
  }
  else {
  if (isset($_GET['like']) && $_GET['like'] == 'ok')
  {
    $req = $pdo->prepare("SELECT status FROM `like` WHERE id_image=? AND id_membre=?"); // modif id membre
    $req->execute(array($_GET['img_id'], $_SESSION['logged']));
    $res = $req->fetch();
    if (empty($res))
    {
      $req = $pdo->prepare("SELECT id FROM `image` WHERE id=?"); // modif id membre
      $req->execute(array($_GET['img_id']));
      $res = $req->fetch();
      if (empty($res))
        $err = 1;
      else
        $err = 0;
      if ($err != 1)
      {
        $req = $pdo->prepare("INSERT INTO `like`(`id_image`, `id_membre`, `status`) VALUES (?, ?, ?)");
        $req->execute(array($_GET['img_id'], $_SESSION['logged'], '1'));
      }
    }
    else if ($res['status'] == 0)
    {
      $req = $pdo->prepare("UPDATE `like` SET status='1' WHERE id_image=? AND id_membre=?");
      $req->execute(array($_GET['img_id'], $_SESSION['logged']));
    }
    else if ($res['status'] == 1)
    {
      $req = $pdo->prepare("UPDATE `like` SET status='0' WHERE id_image=? AND id_membre=?");
      $req->execute(array($_GET['img_id'], $_SESSION['logged']));
    }
  }
  $req = $pdo->query("SELECT id,image FROM `image` ORDER BY id DESC"); // modif id membre
  $tab = $req->fetchAll();
  //print_r($tab);
  //echo($tab[0]['image']);
  foreach ($tab as $val) {
    $req = $pdo->prepare("SELECT status FROM `like` WHERE id_image=? AND id_membre=?"); // modif id membre
    $req->execute(array($val['id'], $_SESSION['logged']));
    $res = $req->fetch();
    if ($res['status'] == '1')
      $like = "j'aime plus";
    else
      $like = "j'aime";
    $req = $pdo->prepare("SELECT COUNT(status) FROM `like` WHERE id_image=? AND status='1'"); // modif id membre
    $req->execute(array($val['id']));
    $res = $req->fetch();
    //print_r($res);
    //echo $res['COUNT(status)'];
    if (!empty($res['COUNT(status)']))
      $nbr_like = $res['COUNT(status)'];
    else
      $nbr_like = "0";
    $req = $pdo->prepare("SELECT COUNT(id) FROM `commentaire` WHERE id_image=?"); // modif id membre
    $req->execute(array($val['id']));
    $res = $req->fetch();
    //print_r($res);
    //echo $res['COUNT(id)'];
    if (!empty($res['COUNT(id)']))
      $nbr_com = $res['COUNT(id)'];
    else
      $nbr_com = "0";
    echo "<div><img style='height:172.5px; width:230px;' src='".$val['image']."'><br />";
    echo "<a href='index.php?nav=galerie&img_id=".$val['id']."&like=ok'>".$like."(".$nbr_like.")</a> ";
    echo "<a href='index.php?nav=galerie&id_img=".$val['id']."'>commentaires(".$nbr_com.")</a>";
    echo "</div>";
  }
  //echo "<img style='height:172.5px; width:230px;' src='".$tab[0]['image']."'>";
}
?>
</section>
