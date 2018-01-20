<?php

namespace App\Resultat;

use App\App;
use App\Core\Table;

class Resultat extends Table {

    protected static $table = 'resultats';

    public static function all(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$table . " ORDER BY id DESC", 'App/Reglement/Reglement');
    }

    public static function last($limit){
        return App::getDatabase()->Query("SELECT * 
                                            FROM " . self::$table . " 
                                            ORDER BY id DESC
                                            LIMIT 0, " . $limit . " ", 'App/Reglement/Reglement');
    }

    public static function find($id){
        return App::getDatabase()->Prepare("SELECT * 
                                            FROM " . self::$table . "
                                            WHERE id = ?
                                            ORDER BY id ", [$id],'App/Reglement/Reglement');
    }

}