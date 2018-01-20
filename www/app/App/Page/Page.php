<?php

namespace App\Page;

use App\App;
use App\Core\Table;

class Page extends Table {

    protected static $table = 'page';

    /**
     * Récurpère tous les commentaires par Xn à la fois
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY id DESC
                ", 'App\Page\Page');
    }

    /**
     * Récurpère tous les commentaires par Xn à la fois
     * @return array
     */
    public static function findKey($key) {
        return App::getDatabase()->Prepare("
                SELECT *
                FROM " .self::$table ."
                WHERE cle = ?
                ORDER BY titre", [$key], 'App\Page\Page', false);
    }

    /**
     * Récurpère un commentaire
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id], 'App\Page\Page', true);
    }

    public static function last($limit) {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY id DESC
                LIMIT 0, " . $limit ."
                ", 'App\Page\Page');
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