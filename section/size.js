var body_width;
document.querySelector("body").addEventListener("resize", size(body_width));
console.log("test");
function size(body_width){
body_width = document.body.clientWidth;
console.log(body_width);
}
