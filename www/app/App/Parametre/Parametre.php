<?php
namespace App\Parametre;

use App\App;
use App\Core\Table;

class Parametre extends Table {

    protected static $temperature = 'temperature';
    protected static $decompte = 'decompte';

    public static function AfficheT($id){
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$temperature . "
                                            WHERE id = ?", [$id], 'App\Parametre\Parametre');
    }

    public static function AfficheDecompte($id){
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date
                                            FROM " . self::$decompte . "
                                            WHERE id = ?", [$id], 'App\Parametre\Parametre');
    }

    public static function Edit($id, $fields, $table){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . $table . " SET $sql_part WHERE id = ?", $attributes, true);
    }

}