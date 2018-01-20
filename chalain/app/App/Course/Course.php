<?php

namespace App\Course;

use App\App;
use App\Core\Table;

class Course extends Table {

    protected static $table = 'chalain_courses';

    public static function all() {
        return App::getDatabase()->Query("SELECT * FROM ". self::$table . " WHERE online = 1", 'App/Course/Course');
    }

    public static function inscription(){
        return App::getDatabase()->Query("SELECT * FROM chalain_inscription", 'App/Course/Course');
    }

    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT * FROM ". self::$table . " WHERE id = ? ", [$id], 'App/Course/Course/');
    }
}