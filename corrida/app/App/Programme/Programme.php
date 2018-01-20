<?php

namespace App\Programme;

use App\App;
use App\Core\Table;

class Programme extends Table {

    protected static $table = 'corrida_programme';

    public static function all(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$table . " ");
    }

}