<?php

use App\Information\Information;
use App\HTML\Form;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter une Information | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $texte = $_POST['texte'];
    $cle = $_POST['cle'];

    Information::Create([
        'texte' => $texte,
        'cle'   => $cle
    ]);
    Session::setFlash("l'information à bien été ajoutée.", 'success');
    Table::Redirect('informations');
endif;
?>

<div class="header">
    <h1>Ajouter une Information</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">
        <p>Exemple : <strong style="font-weight:bold;">27.01.2017</strong> - Ouverture du forum</p>
        <?= $form->textarea('texte', null, 'IMPORTANT : mettre en gras la date ou le mot du DEBUT');?>

        <?= $form->select('cle', 'Site concerné :', null, ['Triathlons' => 'Triathlons', 'Corrida' => 'Corrida', 'Chalain' => 'Chalain'])?>

        <?= $form->submit('ajouter', 'Ajouter', 'informations') ;?>
    </form>
</div>