<?php

use App\Core\Table;
use App\Partenaire\Partenaire;
use App\Session\Session;

if(isset($_GET['key'])) :
    $key = $_GET['key'];
else :
    $key = 'triathlons';
endif;

if($key == 'triathlons') :
    $result = Partenaire::all('triathlons');
elseif($key == 'corrida') :
    $result = Partenaire::all('corrida');
elseif($key == 'chalain') :
    $result = Partenaire::all('chalain');
endif;

Table::setTitle("Gestion des partenaires | Triath'Lons");
?>

<div class="header">
    <h1>Gestion des Partenaires</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('partenaire');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un partenaire</span></a></div>

<div class="bloc bloc-actu actualite">

    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Nom</div>
        <div class="w-60">Url</div>
        <div class="w-10 ac">Aperçu</div>
        <div class="w-10 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Partenaire</div>
    <?php foreach ($result as $partenaire) : ?>
        <div class="bloc-flex">
            <div class="w-20 pl mobil m100"><?= $partenaire->nom;?></div><!--
            --><div class="w-60 mobil m100"><?= $partenaire->site;?></div><!--
            --><div class="ac ac w-10 mobil m50"><a href="index.php?page=view.annonce&id=<?= $partenaire->id;?>"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="ac w-10 mobil m50">
                <a href="#" class="tooltip" title="Supprimer l'Evenement" onClick="javascript:ouvrePopUp('index.php?page=delete.partenaire&id=<?= $partenaire->id;?>&image=<?= $partenaire->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>