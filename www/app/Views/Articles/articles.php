<?php

use App\Core\Table;
use App\Session\Session;
use App\Article\Article;

Table::setTitle("Actualités | Triath'Lons");
$NbCom = Article::NumberAll();

$perPage = 35;
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
    <h1>Actualité</h1>
</div>

<div class="add"><a href="<?= Table::add('article');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une actualité</span></a></div>

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
    $articles = Article::all($start, $end, 'news');
    foreach ($articles as $article): ?>
        <div class="article bloc-flex">
            <div class="titre w-20 pl"><?= $article->temps;?></div><!--
            --><div class="extrait w-50 mobil m50"><?= $article->news_title;?></div><!--
            --><div class="view w-10 mobil m50"><a href="<?= $article->getUrl('view.article', 'news');?>"title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
            --><div class="edit w-10 mobil m50"><a href="<?= $article->getUrl('edit.article', 'news');?>"title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
            --><div class="suppr w-10 mobil m50">
                <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $article->getUrl('delete.article', 'news');?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination comments">
    <?php
    for($i = 1 ; $i <= $nbPage ; $i++) :
        if($i == $cPage) :
            echo '<a href="#" class="actif">' . $i . '</a>';
        else :
            echo '<a href="index.php?page=articles&p=' . $i . '">' . $i . '</a>';
        endif;
    endfor;
    ?>
</div>