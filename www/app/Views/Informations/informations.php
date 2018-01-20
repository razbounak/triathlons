<?php
use App\Information\Information;
use App\Session\Session;
use App\Core\Table;
?>
<div class="header">
    <h1>Gestion des Informations</h1>
</div>

<?= Session::flash(); ?>

<div class="add"><a href="<?= Table::add('information');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une Information</span></a></div>

<div class="bloc bloc-70 annonce">
    <div class="bloc-titre bloc-flex mask ">
        <div class="w-60 pl">Information</div>
        <div class="w-20 ac">Site concerné</div>
        <div class="w-20 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Commentaires</div>
    <?php
    $informations = Information::all();
    foreach ($informations as $information) : ?>
        <div class="bloc-flex stock">
            <div class="date w-60 pl mobil m100"><?= $information->texte;?></div><!--
            --><div class="w-20 mobil m50 ac"><?= $information->cle;?></div><!--
            --><div class="ac w-20 mobil m50">
                <a href="#" class="tooltip" title="Supprimer l'Evenement" onClick="javascript:ouvrePopUp('<?= $information->getUrl('delete.information', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>