<?php

namespace App\Resultat;

use App\App;
use App\Core\Table;

class Resultat extends Table {

    protected static $table = 'corrida_resultats';

    public static function all(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$table . " ORDER BY id DESC", 'App/Resultat/Resultat');
    }

    public static function last($limit){
        return App::getDatabase()->Query("SELECT * 
                                            FROM " . self::$table . " 
                                            ORDER BY id DESC
                                            LIMIT 0, " . $limit . " ", 'App/Resultat/Resultat');
    }

    public static function find($id){
        return App::getDatabase()->Prepare("SELECT * 
                                            FROM " . self::$table . "
                                            WHERE id = ?
                                            ORDER BY id ", [$id],'App/Resultat/Resultat');
    }

}