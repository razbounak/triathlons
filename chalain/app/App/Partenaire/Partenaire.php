<?php

namespace App\Partenaire;

use App\App;
use App\Core\Table;

class Partenaire extends Table {

    protected static $table = 'chalain_partenaires';

    /**
     * @return array
     */
    public static function all() {
        return App::getDatabase()->Query("SELECT *
                                            FROM " .self::$table ."
                                            ORDER BY id ", 'App\Partenaire\Partenaire');
    }


}