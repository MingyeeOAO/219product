var mode = true;

function back_home(){
    document.getElementById("info").style.display="none";
}  
function on(){
    document.getElementById("slider").style.display="flex";
}
function off(){
    document.getElementById("slider").style.display="none";
}
function swch(){var swch= document.querySelector("body");
    swch.classList.toggle("swch");
    mode = !mode;
}
window.addEventListener("scroll",function(){var nav = 
    document.getElementById("header-bar");
    nav.classList.toggle("active",window.scrollY > 0);
    })


var num =0;
function get(){
    alert(num);
    num ++;
}
function popup(){
    var mes=document.getElementById('pop');
    mes.style.transform="scale(1)";
    mes.style.transitionTimingFunction="cubic-bezier(0,0,0,1.47)";
    navigator.vibrate(250);
}


function popin(){
    var mes=document.getElementById('pop');
    mes.style.transform="scale(0)";
    mes.style.transitionTimingFunction="cubic-bezier(0,0,0,-1.47)";
}
var options = {
    host: 'private-github-api.com', // <-- Private github api url. If not passed, defaults to 'api.github.com'
    pathPrefix: 'prefix-for-enterprise-instance', // <-- Private github api url prefix. If not passed, defaults to null.
    protocol: 'https', // <-- http protocol 'https' or 'http'. If not passed, defaults to 'https'
    user: 'Mingyee', // <-- Your Github username
    repo: '119product', // <-- Your repository to be used a db
    remoteFilename: 'data.json' // <- File with extension .json
  };
var personalAccessToken = "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";
var GithubDB = require('..').default;
var githubDB = new GithubDB(options);

githubDB.auth(personalAccessToken);
function a(){
    githubDB.save({"num":1}).then((res) => {
        // The result from the same
        console.log(res);
    });
}
githubDB.connectToRepo();
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