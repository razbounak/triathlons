<?php

namespace App\Programme;

use App\App;
use App\Core\Table;

class Programme extends Table {

    public static function all($nomTable){
        return App::getDatabase()->Query("SELECT * FROM " . $nomTable . " ", 'App\Programme\Programme');
    }

    public static function Edit($id, $fields, $tableName) {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . $tableName . " SET $sql_part WHERE news_id = ?", $attributes, true);
    }

}