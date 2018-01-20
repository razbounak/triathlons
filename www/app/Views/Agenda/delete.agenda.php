<?php

use App\Agenda\Agenda;
use App\Session\Session;
use App\Core\Table;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    Agenda::Delete($id);
    Session::setFlash("L'événement a bien été supprimé", 'error');
    Table::Close();
}
Table::setTitle('Suppression Evénement');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer cet événement ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>