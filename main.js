window.addEventListener("scroll",function(){var nav = 
    document.getElementById("header-bar");
    nav.classList.toggle("active",window.scrollY > 0);
    })
    function back_home(){
    document.getElementById("info").style.display="none";}  
    function on(){
    document.getElementById("slider").style.display="flex";}
    function off(){
    document.getElementById("slider").style.display="none";}
    function swch(){var swch= document.querySelector("body");
    swch.classList.toggle("swch");
}
var num =0;
function get(){
    alert(num);
    num ++;
}