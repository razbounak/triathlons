<?php

namespace App\Produit;

use App\App;
use App\Core\Table;

class Produit extends Table {

    protected static $table = 'boutique';

    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " . self::$table ."
                ", 'App\Produit\Produit');
    }
    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function onLine() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " . self::$table ."
                WHERE etat = 1
                ", 'App\Produit\Produit');
    }

    public static function NbAll() {
        $NbCom = App::getDatabase()->Query("SELECT COUNT(*) AS Nb FROM " . self::$table . " ", 'App\Produit\Produit', true);
        $nombre = $NbCom->Nb;
        return $nombre;
    }

    public static function find($id){
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$table. " WHERE id = ?", [$id], 'App\Produit\Produit', true);
    }

    public static function Create($fields) {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " .self::$table . " SET $sql_part ", $attributes, true);
    }

    public static function Edit($id, $fields) {
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

    public static function Delete($id) {
        return App::getDatabase()->Prepare("DELETE FROM ". self::$table ." WHERE id = ?", [$id]);
    }

    public static function last($limit) {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY id DESC
                LIMIT 0, " . $limit ."
                ", 'App\Produit\Produit');
    }

    public function getUrl($name, $titre = false) {
        if ($titre == false ) :
            return 'index.php?page=' . $name .'&id=' . $this->id;
        elseif ($titre == true ) :
            return 'index.php?page=' . $name .'&id=' . $this->id . '&image=' . $this->image;
        endif;
    }

    public function getImg(){
        return '<img src="' . parent::$path . $this->image . '" alt="' . $this->nom . '" />';
    }
}