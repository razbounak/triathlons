<?php
/* 
 * Créer le 15.11.2017
  * Générer à 11:19
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
use App\Session\Session;
use App\Membre\Membre;
use App\Core\Table;
$NbCom = Membre::NumberAllDocs();

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

$documents = Membre::allDocument($start, $end);

?>
<div class="header">
    <h1>Gestion des Documents</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('document.membre');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un document</span></a></div>

<div class="bloc bloc-actu calendar">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Date</div>
        <div class="w-40">Nom</div>
        <div class="ac w-20">&#201;diter</div>
        <div class="ac w-20">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Entrainements</div>
    <?php

    foreach ($documents AS $document): ?>
        <div class="stock bloc-flex">
            <div class="w-20 pl mobil m50"><?= $document->temps;?></div><!--
               --><div class="w-40 mobil m50"><?= ucfirst($document->name);?></div><!--
               --><div class="ac w-20 mobil m50"><a href="index.php?page=edit.document&id=<?= $document->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-20 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.document.membre&id=<?= $document->id;?>&fichier=<?= $document->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination calendar">
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