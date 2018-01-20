<?php

namespace App\Chalain;

use App\App;
use App\Core\Table;

class Chalain extends Table {

    protected static $article = 'chalain_news';
    protected static $sponsors = 'chalain_partenaires';
    protected static $pdf = 'chalain_fichier';
    protected static $reglement = 'chalain_reglement';
    protected static $courses = 'chalain_courses';
    protected static $inscription = 'chalain_inscription';
    protected static $programme = 'chalain_programme';
    protected static $warning = 'chalain_warning';
    protected static $temperature = 'temperature';
    protected static $decompte = 'decompte';
    protected static $resultat = 'resultats';

    protected static $pathImage = "/home/triathlomx/triathlons/chalain/images/";
    protected static $pathImageSponsors = "/home/triathlomx/triathlons/chalain/images/sponsors/";
    protected static $pathPDF = "/home/triathlomx/triathlons/chalain/fichier/";

    protected static $linkImage = 'https://chalain.triathlons.fr/images/';
    protected static $linkPDF = 'https://chalain.triathlons.fr/fichier/';
    protected static $linkSponsor = 'https://chalain.triathlons.fr/images/sponsors/';

    // ZONE DES ARTICLES ------------------------------------------------------------------------------------------
    public static function AfficheArticle(){
        return App::getDatabase()->Query("
                SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                FROM " .self::$article ."
                ORDER BY news_date DESC
                ", 'App\Chalain\Chalain');
    }
    public static function AfficheArticleLast($limit){
        return App::getDatabase()->Query("
                SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                FROM " .self::$article ."
                ORDER BY news_date DESC
                LIMIT 0, " . $limit . "
                ", 'App\Chalain\Chalain');
    }
    public static function findArticle($id) {
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                                            FROM " . self::$article . " 
                                            WHERE news_id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function AddArticle($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$article . " SET $sql_part ", $attributes, true);
    }
    public static function EditArticle($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$article . " SET $sql_part WHERE news_id = ?", $attributes, true);
    }
    public static function DeleteArticle($id, $fichier){
        unlink(self::$pathImage . $fichier);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$article ." WHERE news_id = ?", [$id]);
    }
    public static function ImageArticle($img, $name, $mlargeur = 500) {
        $nom = strtolower(substr($name, 0, -4));
        if(substr(strtolower($img['name']), -4) == ".jpg") :
            $ImageTmp = imagecreatefromjpeg($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".png" ) :
            $ImageTmp = imagecreatefrompng($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".gif") :
            $ImageTmp = imagecreatefromgif($img['tmp_name']);
        else :
            return false;
        endif;
        $dimensionImage = getimagesize($img['tmp_name']);
        $NewHeight = (($dimensionImage[1] * (($mlargeur) / $dimensionImage [0])));
        $NewImage = imagecreatetruecolor($mlargeur , $NewHeight);
        imagecopyresampled($NewImage, $ImageTmp, 0, 0, 0, 0, $mlargeur, $NewHeight, $dimensionImage[0], $dimensionImage[1]);
        imagedestroy($ImageTmp);
        imagejpeg($NewImage, self::$pathImage . $nom . ".jpg", 70);
    }
    public static function DestroyImage($fichier){
        unlink(self::$pathImage . $fichier);
    }
    public function getImgArticle() {
        if($this->image != '') :
            return '<img src="' . self::$linkImage . $this->image . '" alt ="" />';
        else :
            return '';
        endif;
    }

    // ZONE DES SPONSORS --------------------------------------------------------------------------------------------
    public static function AfficheSponsors(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$sponsors . " ", 'App\Chalain\Chalain');
    }
    public static function AffcheSponsorslast($limit){
        return App::getDatabase()->Query("SELECT * FROM " . self::$sponsors . " LIMIT  0," . $limit . " " , 'App\Chalain\Chalain');
    }
    public static function AddSponsors($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$sponsors . " SET $sql_part ", $attributes, true);
    }
    public static function DeleteSponsors($id, $image){
        unlink(self::$pathImageSponsors . $image);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$sponsors ." WHERE id = ?", [$id]);
    }
    public static function ImageSponsors($img, $name, $mlargeur = 210) {
        $nom = strtolower(substr($name, 0, -4));
        if(substr(strtolower($img['name']), -4) == ".jpg") :
            $ImageTmp = imagecreatefromjpeg($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".png" ) :
            $ImageTmp = imagecreatefrompng($img['tmp_name']);
        elseif(substr(strtolower($img['name']),-4) == ".gif") :
            $ImageTmp = imagecreatefromgif($img['tmp_name']);
        else :
            return false;
        endif;
        $dimensionImage = getimagesize($img['tmp_name']);
        $NewHeight = (($dimensionImage[1] * (($mlargeur) / $dimensionImage [0])));
        $NewImage = imagecreatetruecolor($mlargeur , $NewHeight);
        imagecopyresampled($NewImage, $ImageTmp, 0, 0, 0, 0, $mlargeur, $NewHeight, $dimensionImage[0], $dimensionImage[1]);
        imagedestroy($ImageTmp);
        imagejpeg($NewImage, self::$pathImageSponsors . $nom . ".jpg", 70);
    }
    public function getSponsor(){
        if($this->image != '') :
            return '<img src="' . self::$linkSponsor . $this->image . '" alt ="" />';
        else :
            return '';
        endif;
    }

    // ZONE DES PROGRAMMES --------------------------------------------------------------------------------------------
    public static function AfficheProgramme(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$programme . " ", 'App\Chalain\Chalain');
    }
    public static function FindProgramme($id) {
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$programme . " WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function EditProgramme($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$programme . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    // ZONE DES FICHIERS PDF -----------------------------------------------------------------------------------------
    public static function AffichePDF() {
        return App::getDatabase()->Query("SELECT * FROM " . self::$pdf  . " ", 'App\Chalain\Chalain');
    }
    public static function AffichePDFLast($limit) {
        return App::getDatabase()->Query("SELECT * FROM " . self::$pdf  . " LIMIT 0, " . $limit . " ", 'App\Chalain\Chalain');
    }
    public static function AddPDF($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$pdf . " SET $sql_part ", $attributes, true);
    }
    public static function DeletePDF($id, $fichier){
        unlink(self::$pathPDF . $fichier);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$pdf ." WHERE id = ?", [$id]);
    }
    public static function UploadPDF($fichier){
        move_uploaded_file($fichier['tmp_name'], self::$pathPDF . basename($fichier['name']));
        return true;
    }

    // ZONE DES COURSES ----------------------------------------------------------------------------------------------
    public static function AfficheCourse() {
        return App::getDatabase()->Query("SELECT * FROM " . self::$courses . " ", 'App\Chalain\Chalain');
    }
    public static function AfficheCourseLast($limit) {
        return App::getDatabase()->Query("SELECT * FROM " . self::$courses . " LIMIT 0, " . $limit . " ", 'App\Chalain\Chalain');
    }
    public static function FindCourse($id) {
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$courses . " WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function EditCourse($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$courses . " SET $sql_part WHERE id = ?", $attributes, true);
    }


    // ZONE DES REGLEMENTS -------------------------------------------------------------------------------------------
    public static function AfficheReglement(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$reglement . " ", 'App\Chalain\Chalain');
    }
    public static function FindReglement($id){
        return App::getDatabase()->Prepare("SELECT * FROM ". self::$reglement ." WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function EditReglement($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$reglement . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    // ZONE DES WARNING ----------------------------------------------------------------------------------------------
    public static function AfficheWarning() {
        return App::getDatabase()->Query("SELECT * , DATE_FORMAT(data, '%d/%m/%Y') as temps
                                          FROM " . self::$warning  . " 
                                          ORDER BY data DESC", 'App\Chalain\Chalain');
    }
    public static function FindWarning($id){
        return App::getDatabase()->Prepare("SELECT * FROM ". self::$warning ." WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function DeleteWarning($id){
        return App::getDatabase()->Prepare("DELETE FROM ". self::$warning ." WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function AddWarning($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$warning . " SET $sql_part ", $attributes, true);
    }
    public static function EditWarning($id,$fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$warning . " SET $sql_part WHERE id = ?", $attributes, true);
    }

    // ZONE DES INSCRIPTIONS ------------------------------------------------------------------------------------------
    public static function AfficheInscription(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$inscription . " ", 'App\Chalain\Chalain');
    }
    public static function FindInscription($id){
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$inscription . " WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function EditInscription($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;
        return App::getDatabase()->Prepare("UPDATE " . self::$inscription . " SET $sql_part WHERE id = ?", $attributes, true);
    }
    // ZONE DES TEMPERATURE ET DECOMPTE ------------------------------------------------------------------------------
    public static function AfficheTemperature($id){
        return App::getDatabase()->Prepare("SELECT *
                                            FROM " . self::$temperature . "
                                            WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function AfficheDecompte($id){
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(compteur_date, '%d/%m/%Y') as compteur_date
                                            FROM " . self::$decompte . "
                                            WHERE id = ?", [$id], 'App\Chalain\Chalain');
    }
    public static function EditTemperature($id, $fields, $table){
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

    // ZONE DES RESULTATS -------------------------------------------------------------------------------------------------
    public static function allResultat(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$resultat . " ORDER BY id DESC ", 'App\Chalain\Chalain');
    }

    public static function AfficheResultatLast($limit){
        return App::getDatabase()->Query("SELECT * FROM " . self::$resultat . " ORDER BY id DESC LIMIT 0, " . $limit . " ", 'App\Chalain\Chalain');
    }

    public static function AddResultat($fields){
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $valeur) :
            $sql_parts[] = "$key = ?";
            $attributes[] = $valeur;
        endforeach;
        $sql_part = implode(',', $sql_parts);
        return App::getDatabase()->Prepare("INSERT INTO " . self::$resultat . " SET $sql_part ", $attributes, true);
    }

    public static function UploadResult($fichier){
        move_uploaded_file($fichier['tmp_name'], self::$pathPDF . basename($fichier['name']));
        return true;
    }

    public static function DeleteResultat($id, $fichier){
        unlink(self::$pathPDF . $fichier);
        return App::getDatabase()->Prepare("DELETE FROM ". self::$resultat ." WHERE id = ?", [$id]);
    }


}