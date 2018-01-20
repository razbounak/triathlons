<?php

use App\Page\Page;
use App\Session\Session;
use App\Core\Table;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    Page::Delete($id);
    Session::setFlash("Le page a bien été supprimée", 'error');
    Table::Close();
}
Table::setTitle('Suppression produit');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer ce produit ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>
