// JavaScript Document

// JavaScript Document
// attention tous les parametres doivent avoir pour nom :
// p_typevariableNomVariable avec p = parametre, typevariable = str:string, int:integer, boo:booléen etc.
// et NomVariable = nom explicite en français


// date création ?
// utilité : permet de protéger une adresse email des spam en la décomposant en ayant un title en + (référencement)
// fonctionnement : écrire dans la page :
//<script language="javascript">mailToDecousu('texte a afficher','partie avant le @', 'partie entre le @ et le .','partie apres le .','texte a afficher en description du lien','style ou class a appliquer');<//script>

function mailToDecousu(p_strTitr,p_strNom,p_strDom,p_strExt,p_strDescript,p_strClass){
	var mailToCousu;
	mailToCousu = "<a href='mailto:"+ p_strNom + "@" + p_strDom + "." + p_strExt + "' ";
	if(p_strDescript != ""){
		mailToCousu = mailToCousu + " title='" + p_strDescript + "' ";
	}
	if(p_strClass != ""){
		mailToCousu = mailToCousu + " class='" + p_strClass + "' ";
	}
	if(p_strTitr != ""){
		mailToCousu = mailToCousu + ">" + p_strTitr ;
	}else{
		mailToCousu = mailToCousu + ">" + p_strNom + "@" + p_strDom + "." + p_strExt ;
	}
	mailToCousu = mailToCousu + "</a>";
	document.write(mailToCousu);
}

// Team8
// date création ?
// modif le 14/03/08 pour ajouter le choix de dimensions
// utilité : ouvrir un popup avec tjs les mm dimensions 
// fonctionnement : appeler la fonction dans un href ou un onClick
// remarque : ces dimensions sont spécifiques à l'admin, pour une ouverture de popup + évoluée, faire une nouvelle fonction
function ouvrePopUp(p_strURL,p_strNomPopUp,p_width,p_height){
	var w;
	  w=window.open(p_strURL,p_strNomPopUp,"toolbar=yes,menubar=no,location=no,scrollbars=yes,resizable=yes,directories=no,width="+p_width+",height="+p_height);
	  w.focus();
}


//Team8
//300508
//dev dans Actif-immo
//chang href de css print
//090908 : modif pour chgt tous css
function changCss(p_strNomStyle,p_intNumLink){
	var tag = document.getElementsByTagName("link").item(p_intNumLink);	
	tag.href = "/style/"+p_strNomDest+".css";
}

//pour les cookies

//pour afficher le contenu dans un listing de l'admin
function position(e){
	x = (navigator.appName.substring(0,3) == "Net") ? e.pageX : event.x+document.body.scrollLeft;
	y = (navigator.appName.substring(0,3) == "Net") ? e.pageY : event.y+document.body.scrollTop;
}
function affich(id){
	document.getElementById("mess"+id).style.display = "block";
	if(navigator.appName.substring(0,3) == "Net") document.captureEvents(Event.MOUSEMOVE);
	document.onmousemove = position;
	//document.write("y : "+y+" x : "+x);
	var message = document.getElementById("mess"+id).innerHTML;
	document.getElementById("mess"+id).outerHTML = "<div id=mess"+id+" style='display:none; position:absolute; top:"+y+"px; left:"+x+"px;' class='mess'>"+message+"</div>";
	alert(document.getElementById("mess"+id).style.top);
}
function cach(id){
	document.getElementById("mess"+id).style.display = "none";
}


// Team8
// date création ?
// utilité : afficher cacher un div dans une page 
// fonctionnement : appeler la fonction dans un href ou un onClick
function montreCach(p_strId){
	if(document.getElementById(p_strId).style.display == "none"){
		document.getElementById(p_strId).style.display = "block";
	}else{
		if(document.getElementById(p_strId).style.display == "block"){
			document.getElementById(p_strId).style.display = "none";
		}
	}
}


//Team8
//pour les sousmenu déroulants verticaux et pour toutes les actions sur au moins 2 évt d'affichage/masquage d'un objet
//fonctionnement : le rollOver se fait sur un objet indépendant et affiche ou masque un autre objet indépendant
//300408
function affSsMenu(p_strIdSsRub){
	document.getElementById(p_strIdSsRub).style.display="block";
}

function cachSsMenu(p_intNomSsRub){
	document.getElementById(p_strIdSsRub).style.display="none";
}

//Team8
//pour les sous menus déroulants
//dans le cas ou il y aurait un risque de rollOver sur pls objets donc d'affichages simultannés : 
function aff(p_idSSMenu,p_intNumMaxSsRub){
	var maxSs = p_intNumMaxSsRub;
	for(var i=1;i<=maxSs;i++){
		if(document.getElementById("ssmenu"+i)!=null){
			document.getElementById("ssmenu"+i).style.display="none";
		}
	}
	document.getElementById("ssmenu"+p_idSSMenu).style.display = "block";
}
function cach(p_intNumMaxSsRub){
	var maxSs = p_intNumMaxSsRub;
	for(var i=1;i<=maxSs;i++){
		if(document.getElementById("ssmenu"+i)!=null){
			document.getElementById("ssmenu"+i).style.display="none";
		}
	}
}

//Team8
//vu pour la 1ere fois dans Nettoyage service : mais inutilisée dans ce site
//utile dans Alicante
//fonctionnement : mettre une image de fond dans un objet(ou dans son conteneur) et au survol de l'objet faire apparaitre une autre image : a peu pres = "rollOver en image mappée"
//contrainte : toutes les img doivent avoir pour id : im_num

function menu(etat, no){
	var obj2 = document.getElementById("im_" + no);
	if(etat == 1) {
		obj2.style.visibility="visible";
	} else {
		obj2.style.visibility="hidden";
	}
}

//a partir du menu trouvé par Christophe pour Exotiperles
//Team8 : modification du menu
//fonctionnement : faire apparaitre-disparaitre le sous-menu et changer l'image du menu
//Contrainte : l'image de chaque menu comprend les 2 boutons l'un au dessus de l'autre et dans un div avec une hauteur limitée on positionne l'un ou l'autre
function chgMenuAffSsMenu(p_intNumSsRub,p_intNumMaxSsRub,p_intHauteurMenu){
	var maxSs = p_intNumMaxSsRub;
	for(var i=1;i<=maxSs;i++){
		if(document.getElementById("ss"+i)!=null){
			document.getElementById("ss"+i).style.display="none";
			document.getElementById("m"+i).style.backgroundPosition= window.opera ? '0 0 !important':'0 0';
		}
	}
	document.getElementById("ss"+p_intNumSsRub).style.display="block";
	document.getElementById("m"+p_intNumSsRub).style.backgroundPosition= window.opera ? '0 -'+p_intHauteurMenu+'px !important':'0 -'+p_intHauteurMenu+'px';
}

//Team8
//date création ?
//dev dans actif-immo
//arrondit d'une valeur
function arrondi(p_floatNombre){
	return Math.round(100*parseFloat(p_floatNombre))/100;
}


/*fonctions pour les formulaires*/

// Team8
// 02/01/2008
// utilité : modifier l'adresse d'action d'un formulaire depuis un élément ou un lien et soumettre ou pas ce formulaire en mm temps
// fonctionnement : appeler la fonction dans un href ou un onClick
function changAdrForm(p_strNomForm,p_strAdrAction,p_booSoumission){
	document.forms[p_strNomForm].action = p_strAdrAction;
	if(p_booSoumission==1){
		document.forms[p_strNomForm].submit();
	}
}

// Team8
// 03/01/2008
// modif : 26/02/08 : valider la suppression
// modif le 13/03/08 pour avoir choix nom hidden
// utilité : modifier l'adresse d'action d'un formulaire et modifier la valeur d'un input hidden action
// fonctionnement : appeler la fonction dans un href ou un onClick, créer un input hidden avec name="action"
function changInput(p_strNomForm,p_booSoumission,p_strValHidden,p_strNomHidden){
	var trait = true;
	if(p_strValHidden=="suppr"){
		trait = false;
		var supp=confirm("Etes-vous sûr de vouloir le(les) supprimer ?");
		if(supp==false){
			trait = false;
		}else{
			trait = true;
		}
	}
	if(trait){
		document.forms[p_strNomForm].elements[p_strNomHidden].value = p_strValHidden;
		if(p_booSoumission==1){
			document.forms[p_strNomForm].submit();
		}	
	}else{
		var long = document.forms[p_strNomForm].elements.length;
		for(var i=0;i<long;i++){
			document.forms[p_strNomForm].elements[i].checked = false;
		}
	}
}

// Team8
// 29/01/2008
// utilité : modifier l'adresse d'action d'un formulaire et modifier la valeur d'un input hidden action
// fonctionnement : appeler la fonction dans un href ou un onClick, créer un input hidden avec name="action"
function changAdrFormInput(p_strNomForm,p_strAdrAction,p_booSoumission,p_strValHidden,p_strNomInput){
	document.forms[p_strNomForm].action = p_strAdrAction;
	document.forms[p_strNomForm].elements[p_strNomInput].value = p_strValHidden;
	if(p_booSoumission==1){
		document.forms[p_strNomForm].submit();
	}	
}

/*vérification des formulaires types*/

// Team8
// date création ?
// utilité : vérifier la bonne saisie du formulaire de contact (il peut servir de modele pour d'autre formulaires)
// fonctionnement : écrire dans la page :
//<input type="button" onclick="javascript:verifForm('formContact');" value="Envoyez" />
//et dans le form : <form name='formContact' ... >
function verifForm(p_strNomForm){
	if(document.forms[p_strNomForm].elements["nomExp"].value == ""){
		alert("Veuillez nous indiquez votre nom");
		return false;
	}

	if(document.forms[p_strNomForm].elements["emailExp"].value == ""){
		alert("Veuillez nous indiquez votre email");
		return false;
	}else{
		var mailExp = document.forms[p_strNomForm].elements["emailExp"].value;
		var verif = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,10}$/;
		  if (verif.exec(mailExp) == null){
			alert("Veuillez saisir une adresse mail valide");
			return false;
		  }
	}
	
	document.forms[p_strNomForm].submit();
}

// Team8
// date création ?
// utilité : vérifier la bonne saisie du formulaire de lien (dans le mm exprit que celui pour le contact)
// fonctionnement : idem contact en changeant les noms :
//<input type="button" onclick="javascript:verifFormLien('formLien');" value="Ajouter" />
//et dans le form : <form name='formLien' ... >
function verifFormLien(p_strNomForm){
	if(document.forms[p_strNomForm].elements["nomLien"].value == ""){
		alert("Veuillez saisir un intitulé");
		return false;
	}
	if(document.forms[p_strNomForm].elements["urlLien"].value == ""){
		alert("Veuillez indiquer l'url du lien");
		return false;
	}
	document.forms[p_strNomForm].submit();
}

// Team8
// 210708
// utilité : vérifier la bonne saisie du formulaire des actu (dans le mm esprit que celui pour le contact)
// fonctionnement : idem contact en changeant les noms :
//<input type="button" onclick="javascript:verifFormActu('form');" value="Ajouter" />
//et dans le form : <form name='form' ... >
function verifFormActu(p_strNomForm){
	if(document.forms[p_strNomForm].elements["nom"].value == ""){
		alert("Veuillez saisir un intitulé");
		return false;
	}
	if(document.forms[p_strNomForm].elements["descr"].value == ""){
		alert("Veuillez indiquer le descriptif de l'actualité");
		return false;
	}
	if(document.forms[p_strNomForm].elements["datP"].value != ""&&document.forms[p_strNomForm].elements["datP"].value != "xxxx-xx-xx"){
		var datP = document.forms[p_strNomForm].elements["datP"].value;
		var verif = /^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/;
		  if (verif.exec(datP) == null){
			alert("Si vous saisissez une date de validité, veuillez respecter le format indiqué, merci");
			return false;
		  }
	}
	document.forms[p_strNomForm].submit();
}

/*vérification des formulaires spé*/


//Team8 090908 : chgt nom fonction pour qu'il soit plus adapté et ajout nom id en parametre et nomenclature correcte parametres (avant fonction inversion(urlImg);)
// Team8 : modification légere du systeme pour qu'il prenne des nom de photos dynamiques et surtout aléatoires
//Team8 010708 : reprise de la version dynamique de inversion, mais simplifiée
//Team8 01122008 : rollover sur une image : cgt de l'image, chgt de son titre et de ses élts informatifs
//ex :  onMouseOver="javascript:chgImg('<? echo $tab[$i]["str_urlPhoto"]?>','principale');chgInfo('<? echo $tab[$i]["str_intit"]?>','titr');"
function chgImg(p_strUrlImg,p_strNomId){
	var photo = document.getElementById(p_strNomId);
	photo.src=p_strUrlImg;
}
function chgInfo(p_strInfo,p_strNomId){
	var obj = document.getElementById(p_strNomId);
	obj.innerHTML=p_strInfo;
}

//Team8
//020708
//changer la lang du site :
function chgLang(p_strSuffLg){
	document.cookie = "lang=" + p_strSuffLg ;
	//window.location.reload(); <=> F5
	//window.location.refresh(); n'existe pas
	//window.history.go(0); ne marche pas
	//c'est de la triche, mais ça fonctionne : 
	url = window.location.href;
	window.location.href = url;
}