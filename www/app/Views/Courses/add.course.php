<?php

use App\Produits\Produits;
use App\HTML\Form;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter un | Triath'Lons");

if(isset($_POST['ajouter'])) :

endif;
?>

<div class="header">
    <h1>Ajouter un </h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Nom du produit :");?>

        <?= $form->input('description', null, null, ['type' => 'textarea']);?>

        <?= $form->input('quantite', 'Quantité :');?>

        <?= $form->input('prix', 'Prix :', 'Sans centime et €');?>

        <?= $form->file('image', "Image du produit :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->select('etat', '&#201;tat', null, [1 => 'En Ligne', '0' => 'Hors Ligne'])?>

        <?= $form->submit('ajouter', 'Ajouter', 'annonces') ;?>

    </form>
</div>