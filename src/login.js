
var log = document.getElementById("login-form");
var reg = document.getElementById("register-form");
//alle buttons in tab von kurse also links
var kursTabButtons= document.querySelectorAll(".kursTabContainer .kursButtonContainer button");
//alle contents aber bei linkem style
var kursTabPanels= document.querySelectorAll(".kursTabContainer .contents .content");
var contents=document.getElementsByClassName("content");
function swfromlog(){
    log.style.display = "none";
    reg.style.display = "initial";
}
function swfromreg(){
    reg.style.display = "none";
    log.style.display = "initial";
}
function selectedTab(contentid, buttonid) {
    //Hide all Tabs
    document.getElementById('neuerContent').style.display = "none";
    document.getElementById('aktuellerContent').style.display = "none";
    //buttons auf standardfarbe
    document.getElementById('ersterbutton').style.backgroundColor="#918db8";
    document.getElementById('zweiterbutton').style.backgroundColor="#918db8";

    //zeig den tab mit contentid
    document.getElementById(contentid).style.display="block";
    //geklickten Button dunkel färben
    document.getElementById(buttonid).style.backgroundColor="#656280";
}

function create(){
    let newElement=document.createElement('div');

    document.getElementById('neuerContent').appendChild(newElement);
}
function selectedTabKursu(panelIndex) {
    //kursTabButtons.forEach(function (node) {
    //    node.style.background="#918db8";
        //alle auf standardfarbe
    //});
    //kursTabButtons[panelIndex].style.background=colorCode;

    //hide all panels
    kursTabPanels.forEach(function(node) {
        node.style.display="none";
    });
    kursTabPanels[panelIndex].style.display="block";
}

function selectedTabKurs(contentid, buttonid) {
    //Hide all Tabs
    document.getElementById('allekurse').style.display="none";
    document.getElementById('freizeit').style.display="none";
    document.getElementById('kultur').style.display="none";
    document.getElementById('beruf').style.display="none";
    document.getElementById('sprachen').style.display="none";
    document.getElementById('sport').style.display="none";
    document.getElementById('edv').style.display="none";
    //alle buttons auf standardfarbe
    document.getElementById('a').style.backgroundColor="#918db8";
    document.getElementById('b').style.backgroundColor="#918db8";
    document.getElementById('c').style.backgroundColor="#918db8";
    document.getElementById('d').style.backgroundColor="#918db8";
    document.getElementById('e').style.backgroundColor="#918db8";
    document.getElementById('f').style.backgroundColor="#918db8";
    document.getElementById('g').style.backgroundColor="#918db8";

    //zeig den tab mit contentid
    document.getElementById(contentid).style.display="block";
    //geklickten Button dunkel färben
    document.getElementById(buttonid).style.backgroundColor="#656280";
}
