<?php

use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

$fichiers = Chalain::AffichePDF();
?>
<div class="header">
    <h1>Gestion des Fichiers PDF | CHALAIN</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('pdf.chalain');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un fichier</span></a></div>

<div class="bloc bloc-30">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-70 pl">Titre</div><!--
        --><div class="acenter w-15">Voir le PDF</div><!--
        --><div class="acenter w-15">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Fichier PDF</div>
    <?php
    foreach ($fichiers as $fichier) : ?>
        <div class="bloc-flex evens">
            <div class="w-70 pl mobil m100"><?= $fichier->nom_fichier;?></div><!--
            --><div class="ac w-15 mobil m50"><a href="https://chalain.triathlons.fr/fichier/<?= $fichier->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="ac w-15 mobil m50"><a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.pdf.chalain&id=<?= $fichier->id;?>&fichier=<?= $fichier->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a></div>
        </div>
    <?php endforeach;?>
</div>

<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>