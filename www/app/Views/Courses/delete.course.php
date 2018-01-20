<?php

use App\Annonce\Annonce;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

if(isset($_POST['delete'])) {

    Image::Destroy($_POST['image'], false);
    $id = $_POST['id'];
    Annonce::Delete($id);
    Session::setFlash("L'annonce a bien été supprimée", 'error');
    Table::Close();
}
Table::setTitle('Suppression Annonce');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer ce Commentaire ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="image" value="<?= $_GET['image']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>
