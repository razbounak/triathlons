<?php

// ZONE EDITION

use App\Core\Table;
use App\Date\Date;
use App\HTML\Form;
use App\Parametre\Parametre;
use App\Session\Session;

$id = $_GET['id'];
$degre = Parametre::AfficheT(1);
$form = new Form($degre);

$decompte = Parametre::AfficheDecompte(1);
$form2 = new Form($decompte);

if(isset($_POST)) :

    if(isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $degres = $_POST['degres'];

        Parametre::Edit($id, [
            'id'        => $id,
            'degres'    => $degres
        ], 'temperature');
        Session::setFlash("La température a bien été modifiée.", 'success');
        Table::Redirect('parametres');
    }
    if(isset($_POST['edit'])) {
        $id = $_POST['id'];
        $date = Date::Formate($_POST['date']);
        $online =  $_POST['online'];

        Parametre::Edit($id, [
            'id'        => $id,
            'date'      => $date,
            'online'    => $online
        ], 'decompte');
        Session::setFlash("Le compte à rebours a bien été modifié.", 'success');
        Table::Redirect('parametres');
    }
endif;

?>

<div class="bloc-edit">

    <h2>Température du lac de Chalain :</h2>

    <form action="#" method="POST">

        <input type="hidden" value="<?= $degre->id;?>" name="id">

        <?= $form->input('degres', 'Température du lac :', 'Modifier la température du lac')?>

        <?= $form->submit('modifier', 'Modifier', 'parametres') ;?>

    </form>

</div>

<div class="bloc-edit">

    <h2>Compte à rebours du site de Chalain :</h2>

    <form action="#" method="POST">

        <input type="hidden" value="<?= $decompte->id;?>" name="id">

        <?= $form2->input('date', 'Date du Triathlon :', 'Sous Format : JJ/MM/AAAA')?>

        <?= $form2->select('online', 'Mettre en ligne : *', null, [ 1 => 'OUI', 0 => 'NON']);?>

        <?= $form2->submit('edit', 'Modifier', 'parametres') ;?>

    </form>

</div>
