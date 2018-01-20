<?php

use App\Core\Table;
use App\Session\Session;
use App\Page\Page;

$menus = Page::all();

Table::setTitle("Gestion du menu | Triath'Lons");
?>
<div class="header">
    <h1>Gestion des Pages</h1>
</div>
<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('page');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une page</span></a></div>

<div class="bloc bloc-actu actualite">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-40 pl">Titre</div>
        <div class="w-20 ac">Menu</div>
        <div class="w-20 ac">Editer</div>
        <div class="w-20 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Pages</div>
    <?php foreach ($menus as $menu) : ?>
        <div class="bloc-flex stock">
            <div class="date w-40 pl mobil m100"><?= $menu->titre;?></div><!--
            --><div class="w-20 mobil ac m100"><?= $menu->cle;?></div><!--
            --><div class="ac w-20 mobil m50"><a href="<?= $menu->getUrl('edit.page');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="ac w-20 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $menu->getUrl('delete.page', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>