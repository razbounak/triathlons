<?php

namespace App\Information;

use App\App;
use App\Core\Table;

class Information extends Table {

    protected static $table = 'information';

    /**
     * Récurpère toutes les entrées
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY id DESC
                ", 'App\Information\Information');
    }

    /**
     * Récurpère une entrée
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id], 'App\Information\Information', true);
    }

    /**
     * Récupère les entrées $key de la base
     * @param $key
     * @return array|bool|mixed
     */
    public static function last($key) {
        return App::getDatabase()->Prepare("
                SELECT *
                FROM " .self::$table ."
                WHERE cle = ?
                ORDER BY id DESC
                ", [$key], 'App\Information\Information', false);
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

    public function getUrl($name) {
        return 'index.php?page=' . $name .'&id=' . $this->id;
    }

}
