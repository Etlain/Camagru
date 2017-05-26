(function(){
  var streaming = false;
  video = document.querySelector('#video');
  cover = document.querySelector('#cover');
  image = document.querySelector('#b');
  canvas = document.createElement("canvas");
  photo = document.querySelector('#photo');
  take_picture = document.querySelector('#take_picture');
  if (document.body.clientWidth < 600)
    width = 380;
  else
    width = 460;
  height = 0;

  navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.mozGetUserMedia);
  navigator.getUserMedia({video : true, audio: false},
  function (stream){
    if (navigator.mozGetUserMedia){
      video.mozSrcObject = stream;
    }
    else {
      var vendorURL = window.URL || window.webkitURL;
      video.src = vendorURL.createObjectURL(stream);
    }
    video.play();
  },
  function(err){
    console.log("error webcam");
  }
);

video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);
})();

function takepicture() {
      canvas.width = width;
      canvas.height = height;
      canvas.getContext('2d').drawImage(video, 0, 0, width, height);
      var data = canvas.toDataURL('image/png');
      image.setAttribute('src', data);
      //document.parentNode.removeChild(canvas);
    }

take_picture.addEventListener('click', function(ev){
          document.getElementById("save_picture").disabled = "";
          takepicture();
        ev.preventDefault();
      }, false);
