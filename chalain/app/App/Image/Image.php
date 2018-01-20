<?php

namespace App\Image;

use App\App;
use App\Core\Table;

class Image extends Table {

    protected static $table = 'images';

    public static function all() {
        return App::getDatabase()->Query("SELECT * FROM " . self::$table . " ORDER BY id DESC ");
    }

    /**
     * @param $img
     * @param $name
     * @param int $mlargeur
     * @return bool
     */
    public static function Create($img, $name, $mlargeur = 500) {
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
        imagejpeg($NewImage, parent::$pathImage . $nom . ".jpg", 70);
    }


    /**
     * @param $img
     * @param $name
     * @param int $mlargeur
     * @param int $mhauteur
     * @return bool
     */
    public static function Miniature($img, $name, $mlargeur = 100, $mhauteur = 100){
        $nom = strtolower(substr($name, 0, -4));
        $dimension = getimagesize($img['tmp_name']);
        if(substr(strtolower($img['name']), -4) == ".jpg") :
            $image = imagecreatefromjpeg($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".png" ) :
            $image = imagecreatefrompng($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".gif") :
            $image = imagecreatefromgif($img['tmp_name']);
        else :
            return false;
        endif;
        $miniature = imagecreatetruecolor($mlargeur,$mhauteur);
        if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ) : $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0; endif;
        if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]) : $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0; endif;
        if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]) : $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0; endif;
        imagecopyresampled($miniature, $image, $decalX, $decalY, 0, 0, $dimX, $dimY, $dimension[0], $dimension[1]);
        imagejpeg($miniature, parent::$pathMiniature . $nom . ".jpg", 70);
    }

    public static function ConvertJPG($img){
        if(substr(strtolower($img), -4) == ".jpg") : $image = imagecreatefromjpeg($img);
        elseif(substr(strtolower($img),-4) == ".png" ) : $image = imagecreatefrompng($img);
        elseif(substr(strtolower($img),-4) == ".gif") : $image = imagecreatefromgif($img);
        else : return false; endif;
        unlink($img);
        imagejpeg($image, substr($img, 0 , -3) . ".jpg", 70);
        return true;
    }

    /**
     * @param $image
     */
    public static function Destroy($image, $mini = true) {
        if ($mini == true) :
            unlink(self::$pathImage . $image);
            unlink(self::$pathMiniature . $image);
        elseif($mini == false) :
            unlink(self::$pathImage . $image);
        endif;
    }

    public static function Rename($image){
        $date = time();
        $img = strtolower(substr($image['name'], 0, -4)) . '-' .$date . '.jpg';
        return $img;
    }

}