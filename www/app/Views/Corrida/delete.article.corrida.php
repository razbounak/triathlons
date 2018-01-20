<?php

use App\Session\Session;
use App\Core\Table;
use App\Corrida\Corrida;

if(isset($_POST['delete'])) :

    $id = $_POST['id'];
    $fichier = $_POST['image'];
    Corrida::DeleteArticle($id, $fichier);
    Session::setFlash("L'information a bien été supprimée", 'error');
    Table::Close();

endif;

Table::setTitle('Suppression article');

?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer cet article ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="hidden" name="image" value="<?= $_GET['image'];?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>