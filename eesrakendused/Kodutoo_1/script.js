
//window.onload = function(){
 //   start();
//}

function start(){
    button = document.querySelector('#stardi_kell');
    button.addEventListener('click', stardi_kell);
    let nupukiri = document.getElementById("stardi_kell");
    if (nupukiri.value=="Peata kell") nupukiri.value = "Käivita kell";
    else nupukiri.value = "Peata kell";   
    let kellavarv = document.querySelector('#kella_kast');
    kellavarv.addEventListener('mouseover', changeColor);
}
function stardi_kell() {
    let d = new Date();
    let tund = d.getHours();
    let minut = d.getMinutes();
    let sekund = d.getSeconds();
    if(sekund < 10){
        sekund = "0" + sekund;
    }
    if(minut < 10){
        minut = "0" + minut;
    }
    if(tund < 10){
        tund = "0" + tund;
    }
    document.getElementById('kella_aeg').innerHTML = "Kell on   " + tund + ":" + minut + ":" + sekund + " ";
    let t = setTimeout(stardi_kell, 50);
    let d_kuupaev = new Date();
    let dd = d_kuupaev.getDate();
    let mm = d_kuupaev.getMonth();
    let yyyy = d_kuupaev.getFullYear();
    let day = d_kuupaev.getDay();
    let dds = ['pühapäev', 'esmaspäev', 'teisipäev', 'kolmapäev', 'neljapäev', 'reede', 'laupäev'];
    let mms = ['jaanuar', 'veebruar','märts','aprill','mai','juuni','juuli','august','september','oktoober','november','detsember'];
    if(dd<10) {
        dd = '0' + dd
    }
    document.getElementById('kell_paev').innerHTML = " Täna on " + dds[day] +  " ";
    document.getElementById('kell_kuu_aasta').innerHTML = dd + ' ' + mms[mm] + '  ' + yyyy + " ";
}

function changeColor(){
    const r = Math.round(Math.random()*255);
    const g = Math.round(Math.random()*255);
    const b = Math.round(Math.random()*255);
    kellavarv.style.backgroundcolor = 'rgb('+ r +','+ g + ',' + b +')';
}    
/*
function screensaver() {
let $span = $("#kella_kast");

$span.fadeOut(1000, function() {
    let maxLeft = $(window).width() - $span.width();
    let maxTop = $(window).height() - $span.height();
    let leftPos = Math.floor(Math.random() * (maxLeft + 1))
    let topPos = Math.floor(Math.random() * (maxTop + 1))

    $span.css({ left: leftPos, top: topPos }).fadeIn(1000);
});
};
screensaver();
setInterval(screensaver, 5000);
*/
function AnimateIt() {
    var theDiv = $("#suur_kast"),
        theContainer = $("#kella_kast"),
        maxLeft = theContainer.width() - theDiv.width(),
        maxTop = theContainer.height() - theDiv.height(),
        leftPos = Math.floor(Math.random() * maxLeft),
        topPos = Math.floor(Math.random() * maxTop);

    if (theDiv.position().left < leftPos) {
        theDiv.removeClass("left").addClass("right");
    } else {
        theDiv.removeClass("right").addClass("left");
    }

    theDiv.animate({
        "left": leftPos,
        "top": topPos
    }, 1200, AnimateIt);
}
AnimateIt();