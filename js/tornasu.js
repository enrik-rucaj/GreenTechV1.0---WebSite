
let tornaSu = document.getElementById("torna_su");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    tornaSu.className="visibile";
  } else {
    tornaSu.className="nascosto";
  }
}