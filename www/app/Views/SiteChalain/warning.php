<?php

use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

$infos = Chalain::AfficheWarning();

?>
<div class="header">
    <h1>Gestion des Informations</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('warning');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une information</span></a></div>

<div class="bloc bloc-actu actualite">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-15 pl">Date</div>
        <div class="w-55">Titre</div>
        <div class="w-15 ac">Editer</div>
        <div class="ac w-15">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Articles</div>
    <?php
    foreach ($infos as $info): ?>
        <div class="article bloc-flex">
            <div class="titre w-15 pl"><?= $info->temps;?></div><!--
            --><div class="extrait w-55 mobil m50"><?= $info->texte;?></div><!--
            --><div class="ac w-15 mobil m50"><a href="index.php?page=edit.warning&id=<?= $info->id; ?>"title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="ac w-15 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.warning&id=<?= $info->id;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>