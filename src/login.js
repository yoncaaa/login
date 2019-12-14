
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
function selectedTab(tabIndex) {
    //Hide all Tabs
    document.getElementById('neuerContent').style.display= "none";
    document.getElementById('aktuellerContent').style.display= "none";
    //Show selected Tab
    document.getElementById(tabIndex).style.display= "block";
}
function create(){
    let newElement=document.createElement('div');

    document.getElementById('neuerContent').appendChild(newElement);
}
function selectedTabKursu(tabIndex) {
    //Hide all Tabs
    document.getElementById('allekurse').style.display= "none";
    document.getElementById('freizeit').style.display= "none";



    //Show selected Tab
    document.getElementById(tabIndex).style.display= "block";
}

function selectedTaba(id) {
    //Hide all Tabs
    document.getElementById('neuerContent').style.display= "none";
    document.getElementById('aktuellerContent').style.display= "none";
    //Show selected Tab
    document.getElementById(id).style.display= "block";