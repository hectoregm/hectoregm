/**
 * @author Ramirez Gonzalez Juan Jose
 */
window.onload = function() {
	var canv1 = document.getElementById("semanticCanvas");

	var sem_elem = canv1.getContext("2d");
	sem_elem.font = "20px Arial";
	
	dwg_header(sem_elem,10,10,360,50);

	dwg_nav(sem_elem,10, 70, 360, 50);

	dwg_section(sem_elem,10, 130, 240, 80);

	dwg_aside(sem_elem, 260, 130, 110, 170);

	dwg_article(sem_elem,10, 220, 240, 80);

	dwg_footer(sem_elem,10, 310, 360, 50);
}

function dwg_header(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle = "#0092bf";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "<header>");
}
function dwg_nav(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle =  "#c92f00";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "  <nav>");
}
function dwg_section(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle = "#00FF00";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "<section>");
}

function dwg_article(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle = "#e5de04";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "<article>");
}
function dwg_aside(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle = "#0000FF";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "<aside>");
}
function dwg_footer(canv_contxt, x, y, wd, hg){
	canv_contxt.fillStyle = "#728ba0";
	canv_contxt.fillRect(x, y, wd, hg);
	dwg_text(canv_contxt, x, y, wd, hg, "<footer>");
}




function dwg_text(canv_contxt,x, y, wd, hg, text){
	canv_contxt.fillStyle = "#000";
	canv_contxt.fillText(text, x+(wd/3), y+(hg/2)+10);
	
}
