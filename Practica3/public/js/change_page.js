/**
 * @author mangekyou
 */


var currentPage;
function init(){
  currentPage = document.getElementById('index');
}

function change_page(id) {
  var newPage = document.getElementById(id);

  if (newPage != currentPage) {
    currentPage.className = "section-container";
    newPage.className = "section-container active";
    currentPage = newPage;
  }

}


window.addEventListener("load", init, false);
//window.onload=init;
