<?php
use App\Article\Article;
use App\Core\Table;

$id = $_GET['id'];
$article = Article::find($id);
Table::setTitle("Article : ". $article->news_title . " | Triath'Lons");
?>
<div class="header">
    <h1>Article : <?= $article->news_title;?></h1>
</div>
<div class="bloc-edit">
    <div class="bloc-titre pl">
        <h1>Ecrit le : <?= $article->temps;?></h1>
    </div>
    <div class="bloc-extrait"><?= $article->news_seo;?></div>
    <div class="content">
        <?= $article->news_body;?>
        <div class="image"><img src="http://triathlons.fr/image/<?= $article->image;?>" alt=""></div>
    </div>
</div>

<div class="modify"><a href="<?= $article->getUrl('edit.article')?>"><span class="icon-modify"></span><span class="text-modify">Modifier l'actualité</span></a></div>

<div class="del"><a href="#" class="tooltip" title="Supprimer l'Evenement" onClick="javascript:ouvrePopUp('<?= $article->getUrl('delete.article');?>','Suppression','430','207')"><span class="icon-del"></span><span class="text-del">Supprimer l'actualité</span></a></div>

<div class="return"><a href="index.php?page=articles"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>