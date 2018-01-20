<?php

use App\Session\Session;
use App\Core\Table;
use App\Chalain\Chalain;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    Chalain::DeleteWarning($id);
    Session::setFlash("L'information a bien été supprimée", 'error');
    Table::Close();
}
Table::setTitle('Suppression information');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer cette information ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>