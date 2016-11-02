<div id="container_section">
<section id="webcam">
<video id="video"></video>
<button id="take_picture">Prendre une photo</button>
<form style="text-align:center;" onclick="is_img(event)">
<input type="radio" name="photo" id="salameche"><img style="height:25px; width:23px;" src="images/salameche.png">
<input type="radio" name="photo" id="pikachu"><img style="height:25px; width:28px;" src="images/pikachu.png" alt="pickachu">
<input type="radio" name="photo" id="pokeball"><img style="height:25px; width:29.5px;" src="images/pokeball.png" alt="pokeball">
<input type="radio" name="photo" id="tenshinhan"><img style="height:25px; width:12px;" src="images/tenshinhan.png" alt="tenshinhan">
<input type="radio" name="photo" id="mickey"><img style="height:25px; width:20px;" src="images/mickey.png" alt="mickey">
<input type="radio" name="photo" id="caca"><img style="height:25px; width:26px;" src="images/caca.png" alt="caca">
<input type="radio" name="photo" id="evoli"><img style="height:25px; width:29.5px;" src="images/evoli.png" alt="evoli">
<input type="radio" name="photo" id="aucun">Aucun
</form>
<canvas onclick="put_img(event)" id="canvas"></canvas>
<div id="canvas_button">
<button id="save_picture">Enregistrer</button>
<button id="keep_picture">Reprendre</button>
</div>
<script type="text/javascript" src="section/video.js"></script>
</section>


  <!--<section id="picture">
    tst
  </section>-->
</div>
<script type="text/javascript">
var b = 0;
var img;
function is_checked(){
  var group_button = document.getElementsByName("photo");
  for (var i = 0; i < group_button.length; i++)
  {
    console.log(group_button[i].id);
    if (group_button[i].checked)
      return group_button[i].id;
  }
  return 0;
}

function is_img(event){
  var button;

  if (img)
    img.parentNode.removeChild(img);
  img = 0;
  if (!(button = is_checked()))
    return ;
  else if (button == "aucun")
  {
    b = 0;
    return ;
  }
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
    var canvas = document.querySelector('#canvas');
    var x = event.pageX + 1 - canvas.offsetLeft;
    var y = event.pageY + 1 - canvas.offsetTop;
    canvas.getContext('2d').drawImage(img, x, y, img.width, img.height);
  }
}
</script>
