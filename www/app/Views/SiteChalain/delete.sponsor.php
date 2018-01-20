<?php

use App\Session\Session;
use App\Core\Table;
use App\Chalain\Chalain;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    $fichier = $_POST['image'];
    Chalain::DeleteSponsors($id, $fichier);
    Session::setFlash("Le partenaire a bien été supprimé.", 'error');
    Table::Close();
}
Table::setTitle('Suppression information');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer ce partenaire ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="image" value="<?= $_GET['image']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>