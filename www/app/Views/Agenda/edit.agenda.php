<?php

use App\Agenda\Agenda;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;
use App\Date\Date;

$id = $_GET['id'];
$agenda = Agenda::find($id);
$form = new Form($agenda);
Table::setTitle('Edition : '. $agenda->nom);

if(isset($_POST['modifier']) AND $_POST['nom'] != '' AND $_POST['date'] != '' AND $_POST['lien'] != '' AND $_POST['lieu'] != '' AND $_POST['ville'] != ''):

    $date = Date::Formate($_POST['date']);
    $nom = $_POST['nom'];
    $lien = $_POST['lien'];
    $lieu = $_POST['lieu'];
    $ville = $_POST['ville'];

    Agenda::Edit($id, [
        'nom'    => $nom,
        'date'   => $date,
        'lien'   => $lien,
        'lieu'   => $lieu,
        'ville'  => $ville
    ]);
    Session::setFlash("L'événement a bien été modifié", 'success');
    Table::Redirect('agenda');
endif;
?>

<div class="header">
    <h1>Modifier l'agenda : <?= $agenda->nom;?></h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('nom', "Titre de l'événement* : ", 'Titre simple et court');?>

        <?= $form->input('date', "Date de l'événement* :", 'Sous Format : JJ/MM/AAAA')?>

        <?= $form->input('lien', 'Lien* :', 'Adresse du site');?>

        <?= $form->input('lieu', 'Lieu* :', 'Lieu de déroulement : Lac de Chalain');?>

        <?= $form->input('ville', 'Ville* :', 'Ville + département');?>

        <?= $form->submit('modifier', 'Modifier', 'agenda') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=agenda"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>