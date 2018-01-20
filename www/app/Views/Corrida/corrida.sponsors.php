<?php

use App\Core\Table;
use App\Session\Session;
use App\Corrida\Corrida;

$sponsors = Corrida::AfficheSponsors();
?>

<div class="header">
    <h1>Gestion des Partenaires</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('sponsor.corrida');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un partenaire</span></a></div>

<div class="bloc bloc-actu actualite">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Image</div>
        <div class="w-30">Nom</div>
        <div class="w-30">URL</div>
        <div class="acenter w-20">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Articles</div>
    <?php

    foreach ($sponsors as $sponsor): ?>
        <div class="stock bloc-flex">
            <div class="titre w-20 mobil m100 pl"><img src="http://chalain.triathlons.fr/images/sponsors/<?= $sponsor->image;?>" alt="" width="75"></div><!--
            --><div class="extrait w-30 mobil m50"><?= $sponsor->nom;?></div><!--
            --><div class="w-30 mobil m100"><?= $sponsor->site;?></div><!--
            --><div class="ac w-20 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.sponsor.corrida&id=<?= $sponsor->id;?>&image=<?= $sponsor->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="return"><a href="index.php?page=home.corrida"><span class="icon-return"></span><span class="text-return">Retour</span></a></div>
