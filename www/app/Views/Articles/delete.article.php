<?php

use App\Article\Article;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

if(isset($_POST['delete'])) {

    Image::Destroy($_POST['image']);
    $id = $_POST['id'];
    Article::Delete($id);
    Session::setFlash("L'article a bien été supprimé", 'error');
    Table::Close();
}
Table::setTitle('Suppression article');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer cet article ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="image" value="<?= $_GET['image']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>
