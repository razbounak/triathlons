<?php

namespace App\Information;

use App\App;
use App\Core\Table;

class Information extends Table {

    protected static $table = 'chalain_warning';

    /**
     * Récupère les entrées $key de la base
     * @param $key
     * @return array|bool|mixed
     */
    public static function last() {
        return App::getDatabase()->Query("
                SELECT *
                FROM " .self::$table ."
                ORDER BY data DESC
                LIMIT 0, 5
                ", 'App\Information\Information');
    }


}
