<?php


use App\Annonce\Annonce;
use App\Session\Session;
use App\Core\Table;

Table::setTitle('Annonces | Zone Administration');
$NbCom = Annonce::NumberTotally();

$perPage = 5;
$nbPage = ceil($NbCom / $perPage);

// Vérifie la valeur dans URL
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<= $nbPage) {
    $cPage = $_GET['p'];
} else {
    $cPage = 1;
}

$start = (int) (($cPage-1) * $perPage);
$end = (int) $perPage;

?>
<div class="header">
    <h1>Gestion des Annonces</h1>
</div>

<?= Session::flash(); ?>

<div class="add"><a href="<?= Table::add('annonce');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une Annonce</span></a></div>
<?php
$nombre = Annonce::NBAValider();
$infoNb = Annonce::NbWithoutValide();
if($nombre != 0) : ?>
    <div class="bloc bloc-70 annonce">
        <div class="bloc-titre bloc-flex jaune">
            <div class="w-100 pl">\ <span> <?= $infoNb;?></span> \</div>
        </div>
        <?php
        $annonces = Annonce::findNoValidator();
        foreach ($annonces as $annonce) : ?>
            <div class="bloc-flex">
                <div class="date w-20 pl"><?= $annonce->titre;?></div><!--
                --><div class="w-20 pl mobil m50"><?= $annonce->autor;?></div><!--
                --><div class="w-50 mobil m50"><?= $annonce->content;?></div><!--
                --><div class="w-10 mobil m50"><a href="<?= $annonce->getUrl('valide.annonce');?>" title="Lire le commentaire et le valider"><i class="ion-checkmark-round cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="bloc bloc-70 annonce">
    <div class="bloc-titre bloc-flex mask ">
        <div class="w-10 pl">Titre</div>
        <div class="w-10">Auteur</div>
        <div class="w-40">Annonce</div>
        <div class="w-10 ac">Etat</div>
        <div class="w-10 ac">Aperçu</div>
        <div class="w-10 ac">Editer</div>
        <div class="w-10 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Commentaires</div>
    <?php
    $annonces = Annonce::all($start, $end);
    foreach ($annonces as $annonce) : ?>
        <div class="bloc-flex stock">
            <div class="date w-10 pl mobil m50"><?= $annonce->titre;?></div><!--
            --><div class="w-10 mobil m50"><?= $annonce->autor;?></div><!--
            --><div class="w-40"><?= $annonce->content;?></div><!--
            --><div class="ac w-10 ac image mobil"><?= $annonce->online == 1 ? '<i class="ion-android-radio-button-on cvert"></i>' : '<i class="ion-android-radio-button-on crouge"></i>' ;?></div><!--
            --><div class="ac w-10 mobil m50"><a href="<?= $annonce->getUrl('view.annonce');?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i> </a></div><!--
            --><div class="ac  w-10 mobil m50"><a href="<?= $annonce->getUrl('edit.annonce');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="ac w-10 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $annonce->getUrl('delete.annonce', true);?>','Suppression','430','207');">
                    <i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>


