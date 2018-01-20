<?php
use App\Club\Club;
use App\Core\Table;
use App\Session\Session;

$NbCom = Club::NumberTotally();

$perPage = 15;
$nbPage = ceil($NbCom / $perPage);

// Vérifie la valeur dans URL
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<= $nbPage) {
    $cPage = $_GET['p'];
} else {
    $cPage = 1;
}

$start = (int) (($cPage-1) * $perPage);
$end = (int) $perPage;

Table::setTitle("Gestion des Clubs | Triath'Lons");

$clubs = Club::all($start, $end); ?>

<div class="header">
    <h1>Gestions des Clubs</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('club');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une club</span></a></div>

<div class="bloc bloc-actu comptesRendus">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-30 pl">Nom</div>
        <div class="w-50">Site</div>
        <div class="w-20 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Clubs</div>
    <?php
    foreach ($clubs as $club) : ?>
        <div class="bloc-flex evens">
            <div class="w-30 pl mobil m100"><?= $club->nom;?></div><!--
            --><div class="w-50 mobil m100"><?= $club->site;?></div><!--
            --><div class="ac w-20 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $club->getUrl('delete.club', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination comptesRendus">
    <?php
    for($i = 1 ; $i <= $nbPage ; $i++) :
        if($i == $cPage) :
            echo '<a href="#" class="actif">' . $i . '</a>';
        else :
            echo '<a href="index.php?page=clubs&p=' . $i . '">' . $i . '</a>';
        endif;
    endfor;
    ?>
</div>