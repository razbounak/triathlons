<?php

namespace App\Club;

use App\Core\Table;
use App\App;

class Club extends Table {

    protected static $table = 'clubs';

    /**
     * Récurpère tous les commentaires par Xn à la fois
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY nom
                ", 'App\Club\Club');
    }

    /**
     * Récurpère un commentaire
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id], 'App\Club\Club', true);
    }

    public static function NumberTotally(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBT FROM " . self::$table . " ", "App\Club\Club", true);
        $NbCom = $number->NBT;
        return $NbCom;
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
        return '<img src="'. parent::$path . $this->image . '" alt=" ' . $this->nom . ' "/>';
    }


}