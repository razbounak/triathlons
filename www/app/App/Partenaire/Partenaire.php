<?php

namespace App\Partenaire;

use App\App;
use App\Core\Table;

class Partenaire extends Table {

    protected static $table = 'partenaires';

    /**
     * @return array
     */
    public static function all($key) {
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " .self::$table ."
                                            WHERE cle = ? ORDER BY nom", [$key], null, false);
    }

    /**
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id], 'App\Partenaire\Partenaire', true);
    }

    public static function last($limit) {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY id DESC
                LIMIT 0, " . $limit ."
                ", 'App\Partenaire\Partenaire');
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
        return App::getDatabase()->Prepare("INSERT INTO " . self::$table . " SET $sql_part ", $attributes, true);
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function Delete($id) {
        return App::getDatabase()->Prepare("DELETE FROM ". self::$table ." WHERE id = ?", [$id]);
    }

    public static function NumberTotally(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBT FROM " . self::$table . " ", "App\Partenaire\Partenaire", true);
        $NbCom = $number->NBT;
        return $NbCom;
    }

}