<?php

use App\Agenda\Agenda;
use App\Core\Table;
use App\Session\Session;

Table::setTitle("Agenda | Triath'Lons");
$NbCom = Agenda::NumberAll();

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

$evens = Agenda::all($start, $end);
?>

<div class="header">
    <h1>Agenda / Evénements</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('agenda');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un événement</span></a></div>

<div class="bloc bloc-50 calendar">
    <div class="bloc-titre bloc-flex">
        <div class="w-20 pl">Date</div>
        <div class="w-35">Titre</div>
        <div class="ac w-15">Aperçu</div>
        <div class="ac w-15">Editer</div>
        <div class="ac w-15">Supprimer</div>
    </div>
    <?php foreach ($evens as $agenda) : ?>
        <div class="evens bloc-flex">
            <div class="w-20 pl mobil m50"><?= $agenda->temps; ?></div><!--
            --><div class="w-35"><?= $agenda->nom;?></div><!--
            --><div class="ac w-15 mobil m30"><a href="<?= $agenda->getUrl('view.agenda');?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="ac w-15 mobil m30"><a href="<?= $agenda->getUrl('edit.agenda');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="ac w-15 mobil m30"><a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $agenda->getUrl('delete.agenda');?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach;?>
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

<div class="title-h3 comments">Statistiques</div>

<div class="flex bloc comments">
    <div class="bloc-number gradvert bloc-20">
        <div class="number"><?= Agenda::NumberMonth() ;?></div>
        <div>articles dans les 3 derniers mois</div>
    </div>
    <div class="bloc-number gradviolet bloc-20">
        <div class="number"><?= Agenda::NumberYear() ;?></div>
        <div>articles en <?= date('Y');?></div>
    </div>
    <div class="bloc-number gradbleu bloc-20">
        <div class="number"><?= Agenda::NumberAll() ;?></div>
        <div>articles au total.</div>
    </div>
</div>