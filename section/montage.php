<div id="container_section">
<section id="webcam">
<video id="video"></video>
<button id="take_picture" <?php //echo "disabled='disabled'"; ?>>Prendre une photo</button>
<div style="text-align:center">
  ou :<br />
<form method="post" action="index.php" enctype="multipart/form-data">
<input id="file" type="file" name="img_file" <?php //echo "disabled='disabled'"; ?>/><br />
<button id="submit_file" type="submit" name="Valider" value="Valider" <?php //echo "disabled='disabled'"; ?>>Valider</button>
</form>
</div>
<form style="text-align:center;" onclick="is_img(event)">
<input type="radio" name="photo" id="salameche"><img style="height:25px; width:23px;" src="images/salameche.png">
<input type="radio" name="photo" id="pikachu"><img style="height:25px; width:28px;" src="images/pikachu.png" alt="pickachu">
<input type="radio" name="photo" id="pokeball"><img style="height:25px; width:29.5px;" src="images/pokeball.png" alt="pokeball">
<input type="radio" name="photo" id="tenshinhan"><img style="height:25px; width:12px;" src="images/tenshinhan.png" alt="tenshinhan">
<input type="radio" name="photo" id="mickey"><img style="height:25px; width:20px;" src="images/mickey.png" alt="mickey">
<input type="radio" name="photo" id="caca"><img style="height:25px; width:26px;" src="images/caca.png" alt="caca">
<input type="radio" name="photo" id="evoli"><img style="height:25px; width:22px;" src="images/evoli.png" alt="evoli">
<input type="radio" name="photo" id="aucun">Aucun
</form>
<div onmousemove="pos_mouse(event)">
  <?php
    $put_img = 0;
    if (isset($_POST['Valider']) && $_POST['Valider'] == "Valider" && isset($_FILES['img_file']))
    {
      if ($_FILES['img_file']['tmp_name'] != NULL)
      {
        $data = base64_encode(file_get_contents($_FILES['img_file']['tmp_name']));
        $tab = getimagesize("data:image/png;base64,".$data);
        if (!empty($tab))
          $put_img = 1;
        else
          echo "erreur fichier";
      }
      else
        echo "fichier inexistant";
    }
  ?>
<img onclick="put_img(event)" id="b">
<!--<canvas onclick="put_img(event)" id="canvas"></canvas>-->
<div id="canvas_button">
<button onclick="save_img()" type="submit" name="submit" value="Enregistrer" id="save_picture" <?php echo "disabled='disabled'"; ?>>Enregistrer</button>
</div>
</div>
<script>var canvas = document.createElement("canvas");</script>
<script type="text/javascript" src="section/video.js"></script>
</section>
<div><span id="t"></span><img id="a"></div>
<section id="picture">
  <?php
    if (!empty($_GET['del_img']))
    {
      $req = $pdo->prepare("DELETE FROM `image` WHERE id=? AND id_membre=?;");
      $req->execute(array($_GET['del_img'], $_SESSION['logged']));
      $req = $pdo->prepare("DELETE FROM `commentaire` WHERE id_image=?;");
      $req->execute(array($_GET['del_img']));
      $req = $pdo->prepare("DELETE FROM `like` WHERE id_image=?;");
      $req->execute(array($_GET['del_img']));
    }
    $req = $pdo->query("SELECT id,image FROM `image` WHERE id_membre='".$_SESSION['logged']."' ORDER BY id DESC"); // modif id membre
    $tab = $req->fetchAll();
    foreach ($tab as $val) {
      echo "<img style='height:172.5px; width:230px;' src='".$val['image']."'><br />";
      echo "<form action='index.php' method='get'><button type='submit' name='del_img' value='".$val['id']."'>Supprimer</button>";
      echo "</form>";
    }
  ?>
</section>
</div>
<script type="text/javascript">
var b = 0;
var img;
var button;

function is_checked()
{
  var group_button = document.getElementsByName("photo");
  for (var i = 0; i < group_button.length; i++)
  {
    if (group_button[i].checked)
      return group_button[i].id;
  }
  return 0;
}

function is_img(event)
{
  if (img)
    img.parentNode.removeChild(img);
  img = 0;
  if (!(button = is_checked()))
  {
    document.getElementById("take_picture").disabled = "disabled";
    document.getElementById("save_picture").disabled = "disabled";
    return ;
  }
  else if (button == "aucun")
  {
    document.getElementById("take_picture").disabled = "";
    document.getElementById("file").disabled = "";
    document.getElementById("submit_file").disabled = "";
    b = 0;
    return ;
  }
  document.getElementById("take_picture").disabled = "";
  document.getElementById("file").disabled = "";
  document.getElementById("submit_file").disabled = "";
  b = 1;
  var div = document.createElement("div");
  div.id = "remove";
  div = document.getElementById("container_section").appendChild(div);
  img = document.createElement("img");
  img = div.appendChild(img);
  img.src = "images/"+button+".png";
  img.style.position = "absolute";
  img.style.left = String(event.pageX + 1) + "px";
  img.style.top = String(event.pageY + 1) + "px";
}

function pos_mouse(event){
  if (b == 1)
  {
    img.style.left = String(event.pageX + 1) + "px";
    img.style.top = String(event.pageY + 1) + "px";
  }
}

function put_img(event){
  if (img)
  {
    var image = document.querySelector('#b');
    var x = event.pageX + 1 - image.offsetLeft;
    var y = event.pageY + 1 - image.offsetTop;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "section/action_img.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200)
      {
        image.setAttribute('src', "data:image/png;base64,"+this.responseText);
        //var data = new Image();
        //data.src = "data:image/png;base64,"+this.responseText;
        //document.getElementById('b').setAttribute("src", data.src);
        //canvas.getContext('2d').drawImage(data, 0, 0, width, height);
    }
  }
    xmlhttp.send("x="+x+"&y="+y+"&src="+encodeURI(image.getAttribute("src"))+"&name="+encodeURI(button));
}
}

function save_img(){
    var image = document.querySelector('#b');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "section/action_img.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200)
      {
        window.location.reload();
        //document.getElementById("t").innerHTML = this.responseText;
      }
  }
    xmlhttp.send("src="+encodeURI(image.getAttribute("src"))+"&submit=Enregistrer");
}

function file_load()
{
  var canvas = document.querySelector('#canvas');
  var img_file = '<?php echo $put_img;?>';

  if (img_file == 1)
  {
    //var data = new Image();

    var data = "data:image/png;base64," + '<?php if (isset($data)){echo $data;}?>';
    document.getElementById('b').setAttribute('src', data);
    //image.setAttribute('src', data.src);
    //canvas.getContext('2d').drawImage(data, 0, 0, width, height);
    document.getElementById("save_picture").disabled = "";
  }
}
  file_load();
</script>
