<?php

namespace App\Diapo;

use App\App;
Use App\Core\Table;

class Diapo extends Table {

    protected static $table = 'imagelogo';
    protected static $pathDiapo = '/home/triathlomx/triathlons/www/img/slider/';

    /**
     * Récurpère les derniers articles
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("SELECT *
                                            FROM " .self::$table ."
                                            ORDER BY id 
                                            ", 'App\Diapo\Diapo');
    }

    public static function find($id){
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$table. " WHERE id = ?", [$id], 'App\Diapo\Diapo', true);
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
     * @param $name
     * @return string
     */
    public function getImg() {
        if($this->image != '') :
            return '<img src="http://triathlons.fr/img/slider/' . $this->image . '" alt ="" width="300" />';
        else :
            return '';
        endif;
    }

    /**
     * @param $img
     * @param $name
     * @param int $mlargeur
     * @return bool
     */
    public static function CreateImage($img, $name, $mlargeur = 1200) {
        $nom = strtolower(substr($name, 0, -4));
        if(substr(strtolower($img['name']), -4) == ".jpg") :
            $ImageTmp = imagecreatefromjpeg($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".png" ) :
            $ImageTmp = imagecreatefrompng($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".gif") :
            $ImageTmp = imagecreatefromgif($img['tmp_name']);
        else :
            return false;
        endif;
        $dimensionImage = getimagesize($img['tmp_name']);
        $NewHeight = (($dimensionImage[1] * (($mlargeur) / $dimensionImage [0])));
        $NewImage = imagecreatetruecolor($mlargeur , $NewHeight);
        imagecopyresampled($NewImage, $ImageTmp, 0, 0, 0, 0, $mlargeur, $NewHeight, $dimensionImage[0], $dimensionImage[1]);
        imagedestroy($ImageTmp);
        imagejpeg($NewImage, self::$pathDiapo . $nom . ".jpg", 95);
    }

    public static function Delete($image) {
        unlink(self::$pathDiapo . $image);
    }

}