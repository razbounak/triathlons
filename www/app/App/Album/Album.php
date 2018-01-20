<?php

namespace App\Album;

use App\Core\Table;
use App\App;

class Album extends Table {

    protected static $Album = 'album';
    protected static $Image = 'album_photo';

    /* ZONE DE SELECTION */

    /**
     * @return mixed
     */
    public static function NumberAll(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA 
                                              FROM " . self::$Album . " ",
            'App\Album\Album', true);
        return $number->NBA;
    }
    /**
     * @param $start
     * @param $end
     * @return array|mixed|\PDOStatement
     */
    public static function all($start, $end){
        return App::getDatabase()->Query("
                                            SELECT *, DATE_FORMAT(data, '%d / %m / %Y') AS date
                                            FROM " . self::$Album . "
                                            ORDER BY data DESC
                                            LIMIT $start, $end
            ", 'App\Album\Album');
    }

    /**
     * @param $start
     * @param $end
     * @return array|mixed|\PDOStatement
     */
    public static function allAlbum(){
        return App::getDatabase()->Query("
                                            SELECT *, DATE_FORMAT(data, '%d/%m/%Y') AS date
                                            FROM " . self::$Album . "
                                            ORDER BY data DESC
                                            LIMIT 0, 50
            ", 'App\Album\Album');
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function findAlbum($id) {
        return App::getDatabase()->Prepare("
                                            SELECT *
                                            FROM " . self::$Album . " 
                                            WHERE id = ?", [$id], 'App\Album\Album');
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function findPhoto($id) {
        return App::getDatabase()->Prepare("
                                            SELECT *
                                            FROM " . self::$Image . " 
                                            WHERE id_album = ?", [$id], 'App\Album\Album', false);
    }

    /**
     * @param $id
     * @return array|bool|mixed
     */
    public static function NumberPhoto($id) {
        $number = App::getDatabase()->Prepare("SELECT COUNT(*) AS NBA 
                                                FROM " . self::$Image . " 
                                                WHERE id_album = ?", [$id], 'App\Album\Album');
        return $number->NBA;
    }

    /* ZONE DE CREATION OU D'EDITION */
    /**
     * @param $fields
     * @param $table
     * @return array|bool|mixed
     */
    public static function Create($fields, $table){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . $table . " SET $sql_part ", $attributes, true);
    }

    public static function Delete($image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9, $image10, $image11, $image12, $image13, $image14, $image15){
        if($image1 != '') {
            unlink(parent::$pathImage . $image1 ); }
        if($image2 != '') {
            unlink(parent::$pathImage . $image2 ); }
        if($image3 != '') {
            unlink(parent::$pathImage . $image3 ); }
        if($image4 != '') {
            unlink(parent::$pathImage . $image4 ); }
        if($image5 != '') {
            unlink(parent::$pathImage . $image5 ); }
        if($image6 != '') {
            unlink(parent::$pathImage . $image6 ); }
        if($image7 != '') {
            unlink(parent::$pathImage . $image7 ); }
        if($image8 != '') {
            unlink(parent::$pathImage . $image8 ); }
        if($image9 != '') {
            unlink(parent::$pathImage . $image9 ); }
        if($image10 != '') {
            unlink(parent::$pathImage . $image10 ); }
        if($image11 != '') {
            unlink(parent::$pathImage . $image11 ); }
        if($image12 != '') {
            unlink(parent::$pathImage . $image12 ); }
        if($image13 != '') {
            unlink(parent::$pathImage . $image13 ); }
        if($image14 != '') {
            unlink(parent::$pathImage . $image14 ); }
        if($image15 != '') {
            unlink(parent::$pathImage . $image15 ); }
    }

    public static function Del($id) {
        App::getDatabase()->Prepare("DELETE FROM ". self::$Album ." WHERE id = ?", [$id]);
        App::getDatabase()->Prepare("DELETE FROM ". self::$Image ." WHERE id_album = ?", [$id]);
    }

}