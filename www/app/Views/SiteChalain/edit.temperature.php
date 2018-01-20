<?php

// ZONE EDITION

use App\Chalain\Chalain;
use App\Core\Table;
use App\Date\Date;
use App\HTML\Form;
use App\Session\Session;

$id = $_GET['id'];
$degre = Chalain::AfficheTemperature(1);
$form = new Form($degre);

$decompte = Chalain::AfficheDecompte(1);
$form2 = new Form($decompte);

if(isset($_POST)) :

    $online =  $_POST['online'];

    if(isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $degres = $_POST['degres'];
        $date = date('Y-m-d H:i:00');

         Chalain::EditTemperature($id, [
            'id'        => $id,
            'degres'    => $degres,
            'date'      => $date,
             'online'   => $online

        ], 'temperature');
        Session::setFlash("La température a bien été modifiée.", 'success');
        Table::Redirect('home.chalain');
    }
    if(isset($_POST['edit'])) {
        $id = $_POST['id'];
        $date = Date::Formate($_POST['compteur_date']);

        Chalain::EditTemperature($id, [
            'id'                => $id,
            'compteur_date'     => $date,
            'online'            => $online
        ], 'decompte');
        Session::setFlash("Le compte à rebours a bien été modifié.", 'success');
        Table::Redirect('home.chalain');
    }
endif;

?>

<div class="bloc-edit">
    <h2>Température du lac de Chalain :</h2>
    <form action="#" method="POST">

        <input type="hidden" value="<?= $degre->id;?>" name="id">

        <?= $form->input('degres', 'Température du lac :', 'Modifier la température du lac')?>

        <?= $form2->select('online', 'Mettre en ligne : *', null, [ 1 => 'OUI', 0 => 'NON']);?>

        <?= $form->submit('modifier', 'Modifier', 'home.chalain') ;?>

    </form>
</div>

<div class="bloc-edit">
    <h2>Compte à rebours du site de Chalain :</h2>
    <form action="#" method="POST">

        <input type="hidden" value="<?= $decompte->id;?>" name="id">

        <?= $form2->input('compteur_date', 'Date du Triathlon :', 'Sous Format : JJ/MM/AAAA')?>

        <?= $form2->select('online', 'Mettre en ligne : *', null, [ 1 => 'OUI', 0 => 'NON']);?>

        <?= $form2->submit('edit', 'Modifier', 'home.chalain') ;?>

    </form>
</div>