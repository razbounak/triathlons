<?php

namespace App\Reglement;

use App\App;
use App\Core\Table;

class Reglement extends Table {

    protected static $table = 'chalain_reglement';

    public static function all(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$table . " ORDER BY id", 'App/Reglement/Reglement');
    }

}