
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

/*const appearOption = {}
const faders = document.querySelectorAll('.img-box')
const AppearOnScroll = new IntersectionObserver(function (entries, AppearOnScroll){
    entries.forEach(entry =>{
        if(!entry.isIntersecting){ return;}
        else{
            entry.target.classList.add('.appear');
            AppearOnScroll.unobserve(entry.target);
        }
    });
}, appearOption);

faders.forEach(fader =>{
    AppearOnScroll.observe(fader);
})*/