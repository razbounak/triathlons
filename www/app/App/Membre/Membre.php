<?php
/* 
 * Créer le 15.09.2017
  * Générer à 13:17
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/

namespace App\Membre;

use App\App;
use App\Core\Table;

class Membre extends Table {

    protected static $entrainement  = 'membre_entrainement';
    protected static $parcours      = 'membre_parcours';
    protected static $document      = 'membre_document';
    protected static $pathDocument  = '/home/triathlomx/triathlons/membre/fichiers/';
    protected static $pathentrainement  = '/home/triathlomx/triathlons/membre/entrainements/';

    // ZONE DES ENTRAINEMENTS
    public static function showEntrainement($limit = null){
        return App::getDatabase()->Query("
                                          SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                          FROM " . self::$entrainement . "
                                          ORDER BY date DESC
                                          LIMIT 0, $limit");
    }

    public static function allEntrainement($start, $end){
        return App::getDatabase()->Query("
                                         SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                         FROM " .self::$entrainement ."
                                         ORDER BY date DESC
                                         LIMIT $start, $end
                                         ", 'App\Membre\Membre');
    }

    public static function findEntrainement($id){
        return App::getDatabase()->Prepare("
                                            SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS date
                                            FROM " . self::$entrainement . "
                                            WHERE id = ?
                                            ORDER BY date DESC", [$id]);
    }

    public static function AddEntrainement($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$entrainement . " SET $sql_part ", $attributes, true);
    }

    public static function EditEntrainement($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$entrainement . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    public static function deleteEntrainement($id, $fichier = null){
        if ($fichier == null) :
            return App::getDatabase()->Prepare("DELETE FROM ". self::$entrainement ." WHERE id = ?", [$id]);
        else :
            $name = self::$pathentrainement .'' .$fichier;
            unlink($name);
            return App::getDatabase()->Prepare("DELETE FROM ". self::$entrainement ." WHERE id = ?", [$id]);
        endif;
    }

    public static function NumberAll(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA FROM " . self::$entrainement . " ", 'App\Membre\Membre', true);
        return $number->NBA;
    }

    public static function UploadEntrainement($fichier){
        move_uploaded_file($fichier['tmp_name'], self::$pathentrainement . basename($fichier['name']));
        return true;
    }

    // ZONE DES DOCUMENTS --------------------------------------------
    public static function showDocument($limit = null){
        return App::getDatabase()->Query("
                                        SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                         FROM " . self::$document . "
                                        ORDER BY date DESC
                                         LIMIT 0, $limit");
    }

    public static function allDocument($start, $end){
        return App::getDatabase()->Query("
                                         SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                         FROM " .self::$document ."
                                         ORDER BY date DESC
                                         LIMIT $start, $end
                                         ", 'App\Membre\Membre');
    }

    public static function findDocument($id){
        return App::getDatabase()->Prepare("
                                            SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                            FROM " . self::$document . "
                                            WHERE id = ?
                                            ORDER BY date DESC", [$id]);
    }

    public static function AddDocument($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$document . " SET $sql_part ", $attributes, true);
    }

    public static function EditDocument($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$document . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    public static function deleteDocument($id, $fichier){
        $name = self::$pathDocument .'' .$fichier;
        unlink($name);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$document ." WHERE id = ?", [$id]);
    }

    public static function UploadDocs($fichier){
        move_uploaded_file($fichier['tmp_name'], self::$pathDocument . basename($fichier['name']));
        return true;
    }

    public static function NumberAllDocs(){
        $number = App::getDatabase()->Query("SELECT COUNT(*) AS NBA FROM " . self::$document . " ", 'App\Membre\Membre', true);
        return $number->NBA;
    }

    // ZONE DES PARCOURS
    public static function showParcours($limit = null){
        if ($limit != null) :
            return App::getDatabase()->Query("
                                          SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                          FROM " . self::$parcours . "
                                          ORDER BY date DESC
                                          LIMIT 0, $limit");
        else :
            return App::getDatabase()->Query("
                                          SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                          FROM " . self::$parcours . "
                                          ORDER BY date DESC");
        endif;

    }

    public static function findParcours($id){
        return App::getDatabase()->Prepare("
                                            SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS temps
                                            FROM " . self::$parcours . "
                                            WHERE id = ?
                                            ORDER BY date DESC", [$id]);
    }
    public static function EditParcours($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$parcours . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    public static function AddParcours($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$parcours . " SET $sql_part ", $attributes, true);
    }

    public static function deleteParcours($id){
        return App::getDatabase()->Prepare("DELETE FROM ". self::$parcours ." WHERE id = ?", [$id]);
    }

}