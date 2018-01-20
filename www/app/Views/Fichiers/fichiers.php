<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 09/01/2017
 * Time: 14:00
 */

use App\Core\Table;
use App\Fichier\Fichier;
use App\Session\Session;

Table::setTitle("Fichiers PDF | Triath'Lons");

$NbCom = Fichier::NumberAll();

$perPage = 15;
$nbPage = ceil($NbCom / $perPage);

// Vérifie la valeur dans URL
if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) {
    $cPage = $_GET['p'];
} else {
    $cPage = 1;
}

$start = (int) (($cPage-1) * $perPage);
$end = (int) $perPage;

?>
<?= Session::flash();?>

<div class="header">
    <h1>Gestions des Fichiers PDF</h1>
</div>

<div class="add"><a href="<?= Table::add('fichier');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un fichier</span></a></div>

<div class="bloc bloc-30">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-15 pl">Titre</div><!--
        --><div class="w-65">url</div><!--
        --><div class="acenter w-10">Voir le PDF</div><!--
        --><div class="acenter w-10">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Fichier PDF</div>
    <?php
    $fichiers = Fichier::all($start, $end);
    foreach ($fichiers as $fichier) : ?>
        <div class="bloc-flex evens">
            <div class="w-15 pl mobil m100"><?= $fichier->nom_fichier;?></div><!--
            --><div class="w-65 mobil m100"><?= $fichier->getFichier();?></div><!--
            --><div class="ac w-10 mobil m50"><a href="../fichier/<?= $fichier->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="ac w-10 mobil m50"><a href="#" class="tooltip" title="Supprimer l'Evenement" onClick="javascript:ouvrePopUp('<?= $fichier->getUrl('delete.fichier', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a></div>
        </div>
    <?php endforeach;?>
</div>

<div class="pagination">
    <?php
    for($i = 1 ; $i <= $nbPage ; $i++) :
        if($i == $cPage) :
            echo '<a href="#" class="actif">' . $i . '</a>';
        else :
            echo '<a href="index.php?page=fichiers&p=' . $i . '">' . $i . '</a>';
        endif;
    endfor;
    ?>
</div>
