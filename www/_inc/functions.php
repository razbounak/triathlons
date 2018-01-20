<?php
function getMonth($mois){
    switch($mois) :
        case 1:
            return "janvier";
            break;
        case 2:
            return "février";
            break;
        case 3:
            return "mars";
            break;
        case 4:
            return "avril";
            break;
        case 5:
            return "mai";
            break;
        case 6:
            return "juin";
            break;
        case 7:
            return "juillet";
            break;
        case 8:
            return "août";
            break;
        case 9:
            return "septembre";
            break;
        case 10:
            return "octobre";
            break;
        case 11:
            return "novembre";
            break;
        case 12:
            return "décembre";
            break;
    endswitch;
}

function getMois($mois){
    switch($mois) :
        case 1:
            return "Jan.";
            break;
        case 2:
            return "Fév.";
            break;
        case 3:
            return "Mars";
            break;
        case 4:
            return "Avr.";
            break;
        case 5:
            return "Mai";
            break;
        case 6:
            return "Juin";
            break;
        case 7:
            return "Jul.";
            break;
        case 8:
            return "Aoû.";
            break;
        case 9:
            return "Sep.";
            break;
        case 10:
            return "Oct.";
            break;
        case 11:
            return "Nov.";
            break;
        case 12:
            return "Déc.";
            break;
    endswitch;
}