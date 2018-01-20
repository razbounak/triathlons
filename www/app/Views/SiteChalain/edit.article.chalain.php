<?php

use App\Chalain\Chalain;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$article = Chalain::findArticle($id);

$form = new Form($article);

$oldImage = $article->image;

Table::setTitle('Edition : '. $article->news_title);

if(isset($_POST['modifier'])) :

    $date = $_POST['date'];
    $title = $_POST['news_title'];
    $content = $_POST['news_body'];
    $seo = $_POST['news_seo'];
    $url = $_POST['news_url'];

    Chalain::EditArticle($id, [
        'news_title'    => $title,
        'news_body'     => $content,
        'news_date'     => $date,
        'news_url'      => $url,
        'news_seo'      => $seo
    ]);
    Session::setFlash("L'article à bien été modifié.", 'success');
    Table::Redirect('articles.chalain');
endif;

if(isset($_POST['illustration'])) :

    Chalain::DestroyImage($oldImage);
    $file = $_FILES['image'];
    $name = time() .'.jpg';
    Chalain::ImageArticle($file, $name);
    Chalain::EditArticle($id,[
        'image' => $name
    ]);
    Session::setFlash("L'image de l'article a bien été modifiée.", 'success');
    Table::Redirect('articles.chalain');
endif;
?>

<div class="header">
    <h1>Modifier l'image d'illustration</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="label">Image de l'article :</div><!--
            --><div class="input"><?= $article->getImgArticle();?></div>
        </div>

        <?= $form->file('image', "Changer d'image", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->submit('illustration', "Modifier l'image", 'articles.chalain');?>
    </form>
</div>

<div class="return"><a href="index.php?page=articles.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>

<div class="header">
    <h1>Modifier le texte </h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <input type="hidden" name="date" value="<?= $article->news_date;?>">

        <?= $form->input('news_title', "Titre de l'article : *");?>

        <?= $form->input('news_seo', "Descriptif de l'article :", "Texte affiché sur Facebook | Maxi. 250 Caractères.");?>

        <?= $form->textarea('news_body');?>

        <?= $form->input('news_url', 'Lien :', "Indiquer l'adresse du site | Optionnel", false);?>

        <?= $form->submit('modifier', 'Modifier', 'articles.chalain') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=articles.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>