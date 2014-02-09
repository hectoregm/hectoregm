/**
 * @author Ramirez Gonzalez Juan Jose
 * @author kraker_orion@ciencias.unam.mx
 */

 dojo.require("dojo.NodeList-traverse");
 var count = 0;
 var currentItem = 1;
 dojo.ready(function(){
 count = dojo.query("img", "dojo-slideshow").length;
 setDecription(dojo.query(".active-image").attr("title"))
 setInterval("dojoSlideShow()", 3000);
 });
 function dojoSlideShow(){
 
 var active = dojo.query(".active-image");
 var next = active.next("img");
 active.removeClass();
 if(next == "") {
 currentItem = 0;
 next = dojo.query("#dojo-slideshow img").first();
 }
 currentItem++;
 next.addClass("active-image");
 setDecription(next.attr("title"));
 
 }
 function setDecription(title) {
 dojo.byId("slideshow-desc").innerHTML = "(" + currentItem + " of " + count + ") " + title;
 }