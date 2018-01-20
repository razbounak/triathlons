<?php

use App\Chalain\Chalain;
use App\Core\Table;
use App\Session\Session;

Table::setTitle("Actualités | Chalain");
$articles = Chalain::AfficheArticle();
?>
<?= Session::flash();?>

<div class="header">
    <h1>Actualité</h1>
</div>

<div class="add"><a href="<?= Table::add('article.chalain');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une actualité</span></a></div>

<div class="bloc bloc-actu actualite">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Date</div>
        <div class="w-50">Titre</div>
        <div class="acenter w-10">Aperçu</div>
        <div class="acenter w-10">&Eacute;diter</div>
        <div class="acenter w-10">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Articles</div>
    <?php
    foreach ($articles as $article): ?>
        <div class="article bloc-flex">
            <div class="w-20 pl"><?= $article->temps;?></div><!--
            --><div class="w-50 mobil m50"><?= $article->news_title;?></div><!--
            --><div class="ac w-10 mobil m50"><a href="index.php?page=view.article.chalain&id=<?= $article->news_id;?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="ac w-10 mobil m50"><a href="index.php?page=edit.article.chalain&id=<?= $article->news_id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="ac w-10 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.article.chalain&id=<?= $article->news_id;?>&image=<?= $article->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>