<?php

namespace App\Admin;

use App\App;
use App\Core\Table;

class Admin extends Table {

    protected static $table = 'admin';

    public static function all(){
        return App::getDatabase()->Query("SELECT *
                                            FROM " . self::$table . " ", 'App\Core\Admin');
    }

    public static function find($id) {
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$table . " 
                                            WHERE id = ?", [$id]);
    }

    public function getUrl($name) {
        return 'index.php?page=' . $name .'&id=' . $this->id;
    }

    /**
     * @param $id
     * @param $fields
     * @return array|bool|mixed
     */
    public static function Edit($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " .self::$table . " SET $sql_part WHERE id = ?", $attributes, true);
    }


}