<?php
/* 
 * Créer le 15.11.2017
  * Générer à 11:18
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
use App\Session\Session;
use App\Membre\Membre;
use App\Core\Table;
$NbCom = Membre::NumberAll();

$perPage = 10;
$nbPage = ceil($NbCom / $perPage);

// Vérifie la valeur dans URL
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<= $nbPage) {
    $cPage = $_GET['p'];
} else {
    $cPage = 1;
}

$start = (int) (($cPage-1) * $perPage);
$end = (int) $perPage;

$entrainements = Membre::allEntrainement($start, $end);

?>
<div class="header">
    <h1>Gestion des Entraienemnts</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('entrainement');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span><span class="text-add">Ajouter un entrainement</span></a></div>

<div class="bloc bloc-actu actualite">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Date</div>
        <div class="w-30">Nom</div>
        <div class="w-20">Sport</div>
        <div class="ac w-15">&#201;diter</div>
        <div class="ac w-15">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Entrainements</div>
    <?php

    foreach ($entrainements AS $entrainement): ?>
        <div class="stock bloc-flex">
            <div class="w-20 pl mobil m50"><?= $entrainement->temps;?></div><!--
               --><div class="w-30 mobil m50"><?= ucfirst($entrainement->name);?></div><!--
               --><div class="w-20 mobil m50"><?= ucfirst($entrainement->activity);?></div><!--
               --><div class="ac w-15 mobil m50"><a href="index.php?page=edit.entrainement&id=<?= $entrainement->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-15 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.entrainement&id=<?= $entrainement->id;?>&fichier=<?= $entrainement->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination actualite">
    <?php
    for($i = 1 ; $i <= $nbPage ; $i++) :
        if($i == $cPage) :
            echo '<a href="#" class="actif">' . $i . '</a>';
        else :
            echo '<a href="index.php?page=agenda&p=' . $i . '">' . $i . '</a>';
        endif;
    endfor;
    ?>
</div>

<div class="return"><a href="index.php?page=home.membre"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>