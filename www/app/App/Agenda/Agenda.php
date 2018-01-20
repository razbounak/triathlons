<?php

namespace App\Agenda;

use App\App;
use App\Core\Table;

class Agenda extends Table {

    protected static $table = 'event';

    /**
     * @param $start
     * @param $end
     * @return array|mixed|\PDOStatement
     */
    public static function all($start, $end){
        return App::getDatabase()->Query("
                    SELECT *, DATE_FORMAT(date, '%d / %m / %Y') AS temps, DATE_FORMAT(date, '%k:%i') AS heure
                    FROM " . self::$table . "
                    ORDER BY date DESC
                    LIMIT $start, $end
            ", 'App\Agenda\Agenda');
    }

    /**
     * @param $limit
     * @return array|mixed|\PDOStatement
     */
    public static function last(){
        return App::getDatabase()->Query("
                    SELECT *, 
                        DATE_FORMAT(date, '%d') AS jour,
                        DATE_FORMAT(date, '%m') AS mois,
                        DATE_FORMAT(date, '%Y') AS annee,
                        DATE_FORMAT(date, '%d/%m/%Y') AS temps
                    FROM " . self::$table . "
                    WHERE date >= date(NOW())
                    ORDER BY date
            ", 'App\Agenda\Agenda');
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function find($id) {
        return App::getDatabase()->Prepare("
                    SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date
                    FROM " . self::$table . " 
                    WHERE id = ?", [$id], 'App\Agenda\Agenda');
    }

    /**
    * @return mixed
    */
    public static function NumberYear(){
        $datedebut = date('Y').'-01-01';
        $dateEnd = date('Y').'-12-31';
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA 
                                                  FROM " . self::$table . "
                                                  WHERE date
                                                  BETWEEN '$datedebut' AND '$dateEnd' ",
            'App\Agenda\Agenda', true);
        return $number->NBA;
    }

    /**
     * @return mixed
     */
    public static function NumberMonth(){
        $date = new \DateTime('now');
        $dateEnd = $date->format('Y-m-d');

        $datedepart = new \DateTime('now');
        $datemodif = $datedepart->modify("-3 months");
        $datedebut = $datemodif->format('Y-m-d');

        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA 
                                                  FROM " . self::$table . " 
                                                  WHERE date
                                                  BETWEEN '$datedebut' AND '$dateEnd' ",
            'App\Agenda\Agenda', true);
        return $number->NBA;
    }

    /**
     * @return mixed
     */
    public static function NumberAll(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA 
                                                    FROM " . self::$table . " ",
            'App\Agenda\Agenda', true);
        return $number->NBA;
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

    public function getUrl($name) {
        return 'index.php?page=' . $name .'&id=' . $this->id;
    }


}