<?php

namespace App\Article;

use App\App;
use App\Core\Table;

class Article extends Table {

    protected static $table = 'chalain_news';

    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("
                SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                FROM " .self::$table ."
                ORDER BY news_date DESC
                ", 'App\Article\Article');
    }

    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function last($limit) {
        return App::getDatabase()->Query("SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                                            FROM " .self::$table ."
                                            ORDER BY news_date DESC
                                            LIMIT $limit
                ", 'App\Article\Article');
    }

    /**
     * Récurpère un article en liant la catégorie associé
     * @return array
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                                            FROM " . self::$table . " 
                                            WHERE news_id = ?", [$id], 'App\Article\Article');
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
        return App::getDatabase()->Prepare("UPDATE " .self::$table . " SET $sql_part WHERE news_id = ?", $attributes, true);
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
        return App::getDatabase()->Prepare("DELETE FROM ". self::$table ." WHERE news_id = ?", [$id]);
    }

    /**
     * @param $name
     * @return string
     */
    public function getUrl($name) {
        return 'index.php?page=' . $name .'&id=' . $this->news_id . '&image=' . $this->image;
    }

    /**
     * @param $name
     * @return string
     */
    public function getImg() {
        if($this->image != '') :
            return '<img src="' . parent::$path . $this->image . '" alt ="" />';
        else :
            return '';
        endif;
    }

    public static function NumberAll() {
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBART FROM " . self::$table . " ", 'App\Article\Article', true);
        $NbArt = $number->NBART;
        return $NbArt;
    }

}