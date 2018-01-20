<?php

use App\Article\Article;
use App\Date\Date;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$article = Article::find($id);

$form = new Form($article);

$oldImage = $article->image;

Table::setTitle('Edition : '. $article->news_title);

$albums = \App\Album\Album::allAlbum();

if(isset($_POST['modifier'])) :

    $date = Date::Formate($_POST['temps']);
    $title = $_POST['news_title'];
    $content = $_POST['news_body'];
    $seo = $_POST['news_seo'];
    $url = $_POST['news_url'];
    $album = $_POST['id_album'];
    $cle = $_POST['cle'];

    Article::Edit($id, [
        'news_title'    => $title,
        'news_body'     => $content,
        'news_date'     => $date,
        'news_url'      => $url,
        'id_album'      => $album,
        'cle'           => $cle,
        'news_seo'      => $seo
    ]);
    Session::setFlash("L'article à bien été modifié.", 'success');
    Table::Redirect('articles');
endif;

if(isset($_POST['illustration'])) :

    Image::Destroy($oldImage);
    $file = $_FILES['image'];
    $name = time() .'.jpg';
    Image::Create($file, $name, 500);
    Image::Miniature($file, $name, 300, 300);
    Article::Edit($id,[
        'image' => $name
    ]);
    Session::setFlash("L'image de l'article a bien été modifiée.", 'success');
    Table::Redirect('articles');
endif;
?>

<div class="header">
    <h1>Modifier l'image d'illustration</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="label">Image de l'article :</div><!--
            --><div class="input"><?= $article->getImg();?></div>
        </div>

        <?= $form->file('image', "Changer d'image", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->submit('illustration', "Modifier l'image", 'articles');?>
    </form>
</div>

<div class="return"><a href="index.php?page=articles"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>

<div class="header">
    <h1>Modifier le texte </h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('news_title', "Titre de l'article : *");?>

        <?= $form->input('temps', 'Article écrit le :')?>

        <?= $form->input('news_seo', "Descriptif de l'article :", "Texte affiché sur Facebook | Maxi. 250 Caractères.");?>

        <?= $form->textarea('news_body');?>

        <?= $form->input('news_url', 'Lien :', 'Indiquer l\'adresse du site | Optionnel', false);?>

        <div class="form-group">
            <label class="label" for="id_album">Lié un album à l'article</label><!--
            --><select class="input" name="id_album">
                <option value="0">aucun</option>
                <?php foreach ($albums as $album) : ?>
                    <option value="<?= $album->id;?>"><?= $album->date;?> | <?= $album->nom_album;?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?= $form->select('cle', 'Site concerné* :', null, ['Triathlons' => 'Triathlons', 'Corrida' => 'Corrida', 'Chalain' => 'Chalain']);?>

        <?= $form->submit('modifier', 'Modifier', 'articles') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=articles"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>