<?php
namespace App\Annonce;

use App\App;
use App\Core\Table;

class Annonce extends Table{

    protected static $table = 'annonce';

    /**
     * Récurpère tous les commentaires par Xn à la fois
     * @return array
     */
    public static function all($start, $end) {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                WHERE online = 1
                ORDER BY id DESC
                LIMIT $start, $end
                ", 'App\Annonce\Annonce');
    }
    /**
     * Récurpère les derniers commentaires
     * @return array
     */
    public static function last($limit) {
        return App::getDatabase()->Query("SELECT *
                                            FROM " .self::$table ."
                                            WHERE online = 1
                                            ORDER BY date DESC
                                            LIMIT $limit
                ", 'App\Annonce\Annonce');
    }

    /**
     * Récurpère un commentaire
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id], 'App\Annonce\Annonce', true);
    }


    /**
     * @return array|mixed|\PDOStatement
     */
    public static function findNoValidator() {
        return App::getDatabase()->Query("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date
                                            FROM " . self::$table . " 
                                            WHERE online = 0
                                            LIMIT 6", 'App\Annonce\Annonce');
    }

    public function liste($key, $value){
        $records = $this->all();
        $return = [];
        foreach ($records AS $v) :
            $return[$v->$key] = $v->$value;
        endforeach;
        return $return;
    }

    public static function NbWithoutValide() {
        $NbCom = App::getDatabase()->Query("SELECT COUNT(*) AS Nb FROM " . self::$table . " WHERE online = 0", 'App\Annonce\Annonce', true);
        $nombre = $NbCom->Nb;
        if($nombre == 1) :
            return "Vous avez 1 commentaire à valider.";
        elseif($nombre > 1) :
            return "Vous avez $nombre commentaires à valider";
        endif;
    }

    public static function NBAValider() {
        $NbCom = App::getDatabase()->Query("SELECT COUNT(*) AS Nb FROM " . self::$table . " WHERE online = 0", 'App\Annonce\Annonce', true);
        $nombre = $NbCom->Nb;
        return $nombre;
    }

    public static function NumberOfMonth(){
        $date = new \DateTime('now');
        $dateEnd = $date->format('Y-m-d');

        $datedepart = new \DateTime('now');
        $datemodif = $datedepart->modify("-3 months");
        $datedebut = $datemodif->format('Y-m-d');

        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBM 
                                                 FROM " . self::$table . " 
                                                 WHERE online = 1 AND date
                                                 BETWEEN '$datedebut' AND '$dateEnd' ",
            "App\Annonce\Annonce", true);
        return $number->NBM;
    }

    public static function NumberOfYear(){
        $debut = date('Y').'-01-01';
        $fin = date('Y').'-12-31';
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBY 
                                                FROM " . self::$table . " 
                                                WHERE online = 1 AND date 
                                                BETWEEN '$debut' AND '$fin' ",
            "App\Annonce\Annonce", true);
        return $number->NBY;
    }

    public static function NumberTotally(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBT FROM " . self::$table . " WHERE online = 1", "App\Annonce\Annonce", true);
        $NbCom = $number->NBT;
        return $NbCom;
    }

    public static function Validator($id) {
        return App::getDatabase()->Prepare("UPDATE " . self::$table . " SET online = 1 WHERE id = ?", [$id], 'App\Annonce\Annonce');
    }

    /**
     * @param $id
     * @param $fields
     * @return array|bool|mixed
     */
    public static function Edit($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " .self::$table . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    /**
     * @param $fields
     * @return array|bool|mixed
     */
    public static function Create($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " .self::$table . " SET $sql_part ", $attributes, true);
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function Delete($id){
        return App::getDatabase()->Prepare("DELETE FROM ". self::$table ." WHERE id = ?", [$id]);
    }

    public function getUrl($name, $titre = false) {
        if ($titre == false ) :
            return 'index.php?page=' . $name .'&id=' . $this->id;
        elseif ($titre == true ) :
            return 'index.php?page=' . $name .'&id=' . $this->id . '&image=' . $this->image;
        endif;
    }

    public function getImg() {
        return '<img src="http://triathlons.fr/image/'. $this->image . '" alt=" ' . $this->titre . ' "/>';
    }

}