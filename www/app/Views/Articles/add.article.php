<?php

use App\Article\Article;
use App\HTML\Form;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

$albums = \App\Album\Album::allAlbum();

Table::setTitle("Ajouter une Actualité | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $title = $_POST['news_title'];
    $content = $_POST['news_body'];
    $seo = $_POST['news_seo'];
    $date = date('Y-m-d');
    $url = $_POST['news_url'];
    $album = $_POST['id_album'];
    $picture = $_FILES['image'];
    $cle = $_POST['cle'];

    if($picture['size'] >= 1 && $picture['size'] <= 4096000) :
        if ($cle == 'Triathlons') :
            $nomImage = time() .'.jpg';
            Image::Create($picture, $nomImage);
            Image::Miniature($picture, $nomImage, 300, 300);
            Article::Create([
                'news_title'     => $title,
                'news_body'      => $content,
                'news_date'      => $date,
                'news_url'       => $url,
                'image'         => $nomImage,
                'thumbnail'     => $nomImage,
                'id_album'      => $album,
                'cle'           => $cle,
                'news_seo'      => $seo
            ], 'news');
        elseif ($cle == 'Chalain') :
            $nomImage = time() .'.jpg';
            Article::Image($picture, $nomImage);
            Article::Create([
                'news_title'     => $title,
                'news_body'      => $content,
                'news_date'      => $date,
                'news_url'       => $url,
                'image'         => $nomImage,
                'thumbnail'     => $nomImage,
                'id_album'      => $album,
                'cle'           => $cle,
                'news_seo'      => $seo
            ], 'chalain_news');
        endif;
        Session::setFlash("L'article a bien été enregistré.", 'success');
        Table::Redirect('articles');
    endif;
endif;
?>

<div class="header">
    <h1>Ajouter un Article</h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('news_title', "titre de l'article :");?>

        <?= $form->input('news_seo', "Descriptif de l'article :", "Texte affiché sur Facebook | Maxi. 250 Caractères.");?>

        <?= $form->textarea('news_body');?>

        <?= $form->input('news_url', 'Lien :', "Indiquer l'adresse du site", false);?>

        <?= $form->file('image', "Illustration :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000);?>

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

        <?= $form->submit('ajouter', "Ajouter cet article", 'articles') ;?>

    </form>
</div>