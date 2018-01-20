<?php

namespace App\Fichier;

use App\App;
use App\Core\Table;

class Fichier extends Table {

    protected static $table = 'fichier';

    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function all($start, $end) {
        return App::getDatabase()->Query("  SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                            FROM " . self::$table . "
                                            ORDER BY id DESC
                                            LIMIT $start, $end
                                            ", 'App\Fichier\Fichier');
    }
    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function last($limit) {
        return App::getDatabase()->Query("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as temps
                                            FROM " .self::$table ."
                                            LIMIT $limit
                ", 'App\Fichier\Fichier');
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

    public static function Upload($fichier){
        move_uploaded_file($fichier['tmp_name'], parent::$pathFichier . basename($fichier['name']));
        return true;
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
    public static function Delete($id, $fichier){
        $name = self::$path .'' .$fichier;
        unlink($name);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$table ." WHERE id = ?", [$id]);
    }

    /**
     * @param $name
     * @param bool $titre
     * @return string
     */
    public function getUrl($name, $titre = false) {
        if ($titre == false ) :
            return 'index.php?page=' . $name .'&id=' . $this->id;
        elseif ($titre == true ) :
            return 'index.php?page=' . $name .'&id=' . $this->id . '&titre=' . $this->fichier;
        endif;
    }

    public function getFichier(){
        return 'http://triathlons.fr/fichier/' . $this->fichier;
    }

    /**
     * @return mixed
     */
    public static function NumberAll(){
        $number = App::getDatabase()->Query("SELECT
                                                COUNT(*) AS NBCR
                                                FROM " . self::$table . " ", 'App\Fichier\Fichier', true);
        $NbCR = $number->NBCR;
        return $NbCR;
    }

}