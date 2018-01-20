<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 13/06/2016
 * Time: 18:22
 */

namespace App\Core;

class Table {

    private static $title = 'Zone Administration';
    protected static $pathImage = '/home/triathlomx/triathlons/corrida/image/';
    protected static $pathMiniature = '/home/triathlomx/triathlons/corrida/thumbnail/';
    protected static $pathFichier = '/home/triathlomx/triathlons/corrida/fichier/';
    protected static $path = 'https://triathlons.fr/image/';

    public static function Month($mois){
       
    }

    public function __get($key) {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }
    
    public static function Close() {
        echo '<script language="javascript">
					function ferme(){ window.close(); }
					opener.location.reload();
					setTimeout("ferme()", 0);
				</script>';
    }

    public static function Redirect($url) {
        header("Location: index.php?page=$url");
    }
    
    public static function Email(){
        
    }

    public function getUrl($name) {
        return 'index.php?page=' . $name;
    }

    public static function add($name) {
        return 'index.php?page=add.' . $name;
    }

    public static function getTitle(){
        return self::$title;
    }

    public static function setTitle($title) {
        self::$title = $title;
    }

}
