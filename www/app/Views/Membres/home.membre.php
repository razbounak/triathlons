<?php
/* 
 * Créer le 15.11.2017
  * Générer à 13:18
   * par Franck Contet - FCWD
    * Projet : TriathLons Membre
*/
use App\Core\Table;
use App\Session\Session;
use App\Membre\Membre;

$entrainements = Membre::showEntrainement(6);
$documents = Membre::showDocument(6);
$parcours = Membre::showParcours(6);

?>
<div class="header flex">
    <h1>ZONE MEMBRES</h1>
</div>

<?= Session::flash();?>

<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc">Entrainements</div>
        <?php
        foreach ($entrainements AS $entrainement) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-20 pl mobil m50"><?= $entrainement->temps;?></div><!--
               --><div class="w-30 mobil m50"><?= ucfirst($entrainement->name);?></div><!--
               --><div class="w-20 mobil m50"><?= ucfirst($entrainement->activity);?></div><!--
               --><div class="ac w-15 mobil m50"><a href="index.php?page=edit.entrainement&id=<?= $entrainement->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-15 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.entrainement&id=<?= $entrainement->id;?>&fichier=<?= $entrainement->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('entrainement');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un entrainement</span></a></div>
    </div>
</div>

<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Documents</div>
        <?php
        foreach ($documents AS $document) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-20 pl mobil m50"><?= $document->temps;?></div><!--
               --><div class="w-60 mobil m50"><?= $document->name;?></div><!--
               --><div class="ac w-10 mobil m50"><a href="index.php?page=edit.article.chalain&id=<?= $document->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.document.membre&id=<?= $document->id;?>&fichier=<?= $document->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('document.membre');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un document</span></a></div>
    </div>
    <div class="bloc bloc-40">
        <div class="titre-bloc jaune">Parcours</div>
        <?php
        foreach ($parcours AS $parcour) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-40 pl mobile m100"><?= $parcour->name;?></div><!--
                --><div class="w-40 mobil m50"><?= $parcour->fichier;?></div><!--
                --><div class="ac w-20 mobil m50"><a href="index.php?page=edit.parcours&id=<?= $parcour->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
                --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.parcours&id=<?= $parcour->id;?>&fichier=<?= $parcour->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="ajout"><a href="<?= Table::add('parcours');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un parcours</span></a></div>
    </div>
</div>
