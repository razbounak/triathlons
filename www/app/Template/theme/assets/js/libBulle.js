
// ensembles de fonctions rÃ©cupÃ©rÃ©es dans http://www.accimoto.com/js/bulles/bulle.js
// utiliser dans la page adminContact
function GetId(id) { return document.getElementById(id); }
var iVisible=false; 
function move(e) {
  if (iVisible) {  
		//info image
  		var largImg = GetId("curseur").offsetWidth;
  		var hautImg = GetId("curseur").offsetHeight;
		//info page complÃ¨te
		/*var maxBas = document.body.offsetHeight;//ne change pas si on rÃ©duit la fenÃªtre (sauf ie6, mais valeur abÃ©rente ...)
		var maxDroite = document.body.offsetWidth;//change si on rÃ©duit la fenÃªtre*/
		//autres infos  : uniquement pour FF, mais donne les valeurs rÃ©elles de la fenÃªtre en cours !!!
		/*var largFen = window.innerWidth;
		var hautFen = window.innerHeight;*/
		
		//info page complÃ¨te : //chang dans tous les cas, donc Ã  conserver :
		var larg = document.documentElement.clientWidth;
		var haut = document.documentElement.clientHeight;
		
		//scroll : //chang dans tous les cas, donc Ã  conserver :
		var posX = document.documentElement.scrollLeft;
		var posY = document.documentElement.scrollTop;
		
		//poisitonnement
		if (navigator.appName!="Microsoft Internet Explorer") {
			if((hautImg)>(haut-e.pageY+posY)){
				GetId("curseur").style.top=e.pageY-(hautImg-(haut-e.pageY+posY))+"px";
			}else{
				GetId("curseur").style.top=e.pageY+20+"px";
			}
			if((largImg)>(larg-e.pageX+posX)){
				GetId("curseur").style.left=e.pageX-largImg-20+"px";
			}else{
				GetId("curseur").style.left=e.pageX+30+"px";
			}
			//e.pageY : position / haut de la page, sans tenir compte du scroll !!!
			
		} else { 
			if (document.documentElement.clientWidth>0) {
				if(hautImg>(haut-event.y)){
					GetId("curseur").style.top=haut-hautImg+"px";
				}else{
					GetId("curseur").style.top=20+event.y+document.documentElement.scrollTop+"px";
				}
				if(largImg>(larg-event.x)){
					GetId("curseur").style.left=event.x-largImg-20+"px";
				}else{
					GetId("curseur").style.left=30+event.x+document.documentElement.scrollLeft+"px";
				}
				//ie6et7 : position haut de la fenÃªtre : chang en fonction du scroll
			} else {
				GetId("curseur").style.left=30+event.x+document.body.scrollLeft+"px";
				GetId("curseur").style.top=20+event.y+document.body.scrollTop+"px";
				//alert("ie2"+event.y);
			}
		}
	}
}
function montre(text) {
	if(iVisible==false) {
		GetId("curseur").style.visibility="visible";
		GetId("curseur").style.display="block";
		GetId("curseur").innerHTML = text;
		iVisible=true;
	}
}
function cache() {
	if(iVisible==true) {
		GetId("curseur").style.visibility="hidden";
		GetId("curseur").style.display="none";
		GetId("curseur").style.left = "-600px";
		GetId("curseur").style.top = "-600px";
		iVisible=false;
	}
}
document.onmousemove=move;