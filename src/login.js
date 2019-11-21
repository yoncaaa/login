
var log = document.getElementById("login-form");
var reg = document.getElementById("register-form");

function swfromlog(){
    log.style.display = "none";
    reg.style.display = "initial";
}
function swfromreg(){
    reg.style.display = "none";
    log.style.display = "initial";
}