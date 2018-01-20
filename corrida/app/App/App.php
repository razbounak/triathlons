<?php

namespace App;

use App\Database\Database;

class App {

    const DB_NAME = 'triathlomxclub';
    const DB_HOST = 'triathlomxclub.mysql.db';
    const DB_USER = 'triathlomxclub';
    const DB_PASS = 'Triathlons39';

    private static $database;

    public static function getDatabase(){
        if (self::$database === null) :
            self::$database = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        endif;
        return self::$database;
    }

}