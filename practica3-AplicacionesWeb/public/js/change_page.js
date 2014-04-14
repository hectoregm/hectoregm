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
		currentPage.className = "main-container";
		newPage.className = "main-container active";
		currentPage = newPage;
	}

}


window.addEventListener("load", init, false);
//window.onload=init;