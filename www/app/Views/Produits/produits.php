<?php

use App\Produit\Produit;
use App\Session\Session;
use App\Core\Table;

Table::setTitle('Boutique | Zone Administration');

?>
<div class="header">
    <h1>Gestion de la Boutique</h1>
</div>

<?= Session::flash(); ?>

<div class="add"><a href="<?= Table::add('produit');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Produit</span></a></div>

<div class="bloc comments">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-10 pl">Image</div>
        <div class="w-30 pl">Titre</div>
        <div class="w-10 ac">Quantité</div>
        <div class="w-10 ac">Prix</div>
        <div class="w-10 ac">Etat</div>
        <div class="w-10 ac">Aperçu</div>
        <div class="w-10 ac">Editer</div>
        <div class="w-10 ac">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Commentaires</div>
    <?php
    $produits = Produit::all();
    foreach ($produits as $produit) : ?>
        <div class="bloc-flex stock">
            <div class="date w-10 pl mobil m100"><img src="http://localhost/TriathLons/image/<?= $produit->image;?>" alt="" width="75"></div><!--
            --><div class="date w-30 pl mobil m100"><?= $produit->nom;?></div><!--
            --><div class="w-10 mobil m50 ac"><?= $produit->quantite;?></div><!--
            --><div class="w-10 mobil m50 ac"><?= $produit->prix;?>,00 €</div><!--
            --><div class="w-10 ac image mobil"><?= $produit->etat == 1 ? '<i class="ion-android-radio-button-on cvert" title="EN LIGNE"></i>' : '<i class="ion-android-radio-button-on crouge" title="HORS LIGNE"></i>' ;?></div><!--
            --><div class="view w-10 mobil m50"><a href="<?= $produit->getUrl('view.produit');?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="edit w-10 mobil m50"><a href="<?= $produit->getUrl('edit.produit');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="suppr w-10 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $produit->getUrl('delete.produit', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>