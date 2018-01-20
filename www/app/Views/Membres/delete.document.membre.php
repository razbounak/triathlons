<?php
/* 
 * Créer le 15.11.2017
  * Générer à 11:20
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
use App\Session\Session;
use App\Core\Table;
use App\Membre\Membre;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    $fichier = $_POST['fichier'];
    Membre::deleteDocument($id, $fichier);
    Session::setFlash("Le fichier a bien été supprimé.", 'success');
    Table::Close();
}
Table::setTitle('Suppression du fichier');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer le document ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="fichier" value="<?= $_GET['fichier']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>