<?php

use App\Fichier\Fichier;
use App\Session\Session;
use App\Core\Table;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    $titre = $_POST['titre'];
    Fichier::Delete($id, $titre);
    Session::setFlash("Le fichier a bien été supprimé.", 'error');
    Table::Close();
}
Table::setTitle('Suppression Fichier PDF');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer le Fichier ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="titre" value="<?= $_GET['titre']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>