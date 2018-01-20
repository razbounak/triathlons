<?php

use App\HTML\Form;
use App\Chalain\Chalain;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter une Actualité Chalain | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $title = $_POST['news_title'];
    $content = $_POST['news_body'];
    $seo = $_POST['news_seo'];
    $date = date('Y-m-d');
    $url = $_POST['news_url'];
    $picture = $_FILES['image'];

    if($picture['size'] >= 1 && $picture['size'] <= 4096000) :
        $nomImage = time() .'.jpg';
        Chalain::ImageArticle($picture, $nomImage);
        Chalain::AddArticle([
        'news_title'     => $title,
        'news_body'      => $content,
        'news_date'      => $date,
        'news_url'       => $url,
        'image'         => $nomImage,
        'news_seo'      => $seo
        ]);

        Session::setFlash("L'article a bien été enregistré.", 'success');
        Table::Redirect('articles.chalain');

    endif;

endif;
?>

<div class="header">
    <h1>Ajouter un article | Chalain</h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('news_title', "titre de l'article :");?>

        <?= $form->input('news_seo', "Descriptif de l'article :", "Texte affiché sur Facebook | Maxi. 250 Caractères.");?>

        <?= $form->textarea('news_body');?>

        <?= $form->input('news_url', 'Lien :', "Indiquer l'adresse du site", false);?>

        <?= $form->file('image', "Illustration :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000);?>

        <?= $form->submit('ajouter', "Ajouter cet article", 'articles.chalain') ;?>

    </form>
</div>
