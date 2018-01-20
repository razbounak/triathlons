<?php

namespace App\Date;

use App\Core\Table;

class Date extends Table {

    /**
     * @param $date
     * @return string de la date au bon format
     */
    public static function Formate($date) {
        $tabDate = explode('/' , $date);
        $date  = $tabDate[2] . '-' . $tabDate[1] . '-' . $tabDate[0];
        return $date;
    }

    /**
     * @param $date
     * @param $heure
     * @return string date et heure au bon format
     */
    public static function FormateDateHeure($date, $heure) {
        $tabDate = explode('/' , $date);
        $date  = $tabDate[2] . '-' . $tabDate[1] . '-' . $tabDate[0] . ' ' . $heure;
        return $date;
    }

    public static function reFormate($date) {
        $tabDate = explode('/' , $date);
        $date  = $tabDate[2] . ' ' . $tabDate[1] . ' ' . $tabDate[0];
        return $date;
    }

    /**
     * @param $mois
     * @return string
     */
    public static function getMonth($mois){
        switch($mois) :
            case 1 :    return "jan.";  break;
            case 2 :    return "fév.";  break;
            case 3 :    return "mars";  break;
            case 4 :    return "avr.";  break;
            case 5 :    return "mai";   break;
            case 6 :    return "juin";  break;
            case 7 :    return "jul.";  break;
            case 8 :    return "Aoû.";  break;
            case 9 :    return "Sep.";  break;
            case 10 :   return "Oct.";  break;
            case 11 :   return "Nov.";  break;
            case 12 :   return "Déc.";  break;
        endswitch;
    }

    /**
     * @param $jour
     * @return string
     */
    public static function getJour($jour) {
        switch($jour) :
            case 1 :    return "dimanche";  break;
            case 2 :    return "lundi";     break;
            case 3 :    return "mardi";     break;
            case 4 :    return "mercredi";  break;
            case 5 :    return "jeudi";     break;
            case 6 :    return "vendredi";  break;
            case 7 :    return "samedi";    break;
        endswitch;
    }

    /**
     * @param $mois
     * @return string
     */
    public static function getMois($mois) {
        switch($mois) :
            case 1 :    return "janvier";       break;
            case 2 :    return "février";       break;
            case 3 :    return "mars";          break;
            case 4 :    return "avril";         break;
            case 5 :    return "mai";           break;
            case 6 :    return "juin";          break;
            case 7 :    return "juillet";       break;
            case 8 :    return "août";          break;
            case 9 :    return "septembre";     break;
            case 10 :   return "octobre";       break;
            case 11 :   return "novembre";      break;
            case 12 :   return "décembre";      break;
        endswitch;
    }

}