<?php
/* 
 * Créer le 21.09.2017
  * Générer à 09:41
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
 namespace App\Corrida;

 use App\App;
 use App\Core\Table;

class Corrida extends Table {

    protected static $article = 'corrida_news';
    protected static $sponsors = 'corrida_partenaires';
    protected static $pdf = 'corrida_fichier';
    protected static $reglement = 'corrida_reglement';
    protected static $courses = 'corrida_courses';
    protected static $inscription = 'corrida_inscription';
    protected static $programme = 'corrida_programme';
    protected static $warning = 'corrida_warning';
    protected static $resultat = 'corrida_resultats';

    protected static $pathImage = "/home/triathlomx/triathlons/corrida/images/";
    protected static $pathImageSponsors = "/home/triathlomx/triathlons/corrida/images/sponsors/";
    protected static $pathPDF = "/home/triathlomx/triathlons/corrida/fichier/";

    protected static $linkImage = 'https://corrida.triathlons.fr/images/';
    protected static $linkPDF = 'https://corrida.triathlons.fr/fichier/';
    protected static $linkSponsor = 'https://corrida.triathlons.fr/images/sponsors/';

    // ZONE DES ARTICLES ------------------------------------------------------------------------------------------
    public static function AfficheArticle(){
        return App::getDatabase()->Query("
                SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                FROM " .self::$article ."
                ORDER BY news_date DESC
                ", 'App\Corrida\Corrida');
    }
    public static function AfficheArticleLast($limit){
        return App::getDatabase()->Query("
                SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                FROM " .self::$article ."
                ORDER BY news_date DESC
                LIMIT 0, " . $limit . "
                ", 'App\Corrida\Corrida');
    }
    public static function findArticle($id) {
        return App::getDatabase()->Prepare("SELECT *, DATE_FORMAT(news_date, '%d/%m/%Y') AS temps
                                            FROM " . self::$article . " 
                                            WHERE news_id = ?", [$id], 'App\Corrida\Corrida');
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
        return App::getDatabase()->Query("SELECT * FROM " . self::$sponsors . " ", 'App\Corrida\Corrida');
    }
    public static function AffcheSponsorslast($limit){
        return App::getDatabase()->Query("SELECT * FROM " . self::$sponsors . " LIMIT  0," . $limit . " " , 'App\Corrida\Corrida');
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
        return App::getDatabase()->Query("SELECT * FROM " . self::$programme . " ", 'App\Corrida\Corrida');
    }
    public static function FindProgramme($id) {
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$programme . " WHERE id = ?", [$id], 'App\Corrida\Corrida');
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
        return App::getDatabase()->Query("SELECT * FROM " . self::$pdf  . " ", 'App\Corrida\Corrida');
    }
    public static function AffichePDFLast($limit) {
        return App::getDatabase()->Query("SELECT * FROM " . self::$pdf  . " LIMIT 0, " . $limit . " ", 'App\Corrida\Corrida');
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
        return App::getDatabase()->Query("SELECT * FROM " . self::$courses . " ", 'App\Corrida\Corrida');
    }
    public static function AfficheCourseLast($limit) {
        return App::getDatabase()->Query("SELECT * FROM " . self::$courses . " LIMIT 0, " . $limit . " ", 'App\Corrida\Corrida');
    }
    public static function FindCourse($id) {
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$courses . " WHERE id = ?", [$id], 'App\Corrida\Corrida');
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
        return App::getDatabase()->Query("SELECT * FROM " . self::$reglement . " ", 'App\Corrida\Corrida');
    }
    public static function FindReglement($id){
        return App::getDatabase()->Prepare("SELECT * FROM ". self::$reglement ." WHERE id = ?", [$id], 'App\Corrida\Corrida');
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


    // ZONE DES INSCRIPTIONS ------------------------------------------------------------------------------------------
    public static function AfficheInscription(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$inscription . " ", 'App\Corrida\Corrida');
    }
    public static function FindInscription($id){
        return App::getDatabase()->Prepare("SELECT * FROM " . self::$inscription . " WHERE id = ?", [$id], 'App\Corrida\Corrida');
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

    // ZONE DES RESULTATS -------------------------------------------------------------------------------------------------
    public static function allResultat(){
        return App::getDatabase()->Query("SELECT * FROM " . self::$resultat . " ORDER BY id DESC ", 'App\Corrida\Corrida');
    }
    public static function AfficheResultatLast($limit){
        return App::getDatabase()->Query("SELECT * FROM " . self::$resultat . " ORDER BY id DESC LIMIT 0, " . $limit . " ", 'App\Corrida\Corrida');
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