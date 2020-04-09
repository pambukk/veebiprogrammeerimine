/*var colorWell;
var defaultColor = "#0000ff";

window.addEventListener("load", startup, false);

function startup() {
    colorWell = document.querySelector("#colorWell");
    colorWell.value = defaultColor;
    colorWell.addEventListener("input", updateFirst, false);
    colorWell.addEventListener("change", updateAll, false);
    colorWell.select();
  }

  function updateFirst(event) {
    var p = document.querySelector("p");
  
    if (p) {
      p.style.color = event.target.value;
    }
  }
  function updateAll(event) {
    document.querySelectorAll("p").forEach(function(p) {
      p.style.color = event.target.value;
    });
  }
*/

let kirjavarv;
let kirjavarvoriginaal = "#000044";

window.addEventListener("load", startup, false);

function startup() {
    kirjavarv = document.querySelector("#kirjavarv");
    kirjavarv.value = kirjavarvoriginaal;
    kirjavarv.addEventListener("input", updateFirst, false);
    kirjavarv.addEventListener("change", updateAll, false);
    kirjavarv.select();
  }

  function updateFirst(event) {
    var p = document.querySelector("p");
  
    if (p) {
      p.style.color = event.target.value;
    }
  }
  function updateAll(event) {
    document.querySelectorAll("p").forEach(function(p) {
      p.style.color = event.target.value;
    });
  }