<?php

use App\Club\Club;
use App\Session\Session;
use App\Image\Image;
use App\Core\Table;
use App\HTML\Form;

$form = new Form($_POST);

Table::setTitle("Ajouter un club | Triath'Lons");

if(isset($_POST['add'])) :

    $titre = $_POST['nom'];
    $site = $_POST['site'];
    $file = $_FILES['image'];

    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $nomImage = time() .'.jpg';
        Image::Create($file, $nomImage, 225);
        Club::Create([
            'nom'      => $titre,
            'site'     => $site,
            'image'    => $nomImage
        ]);
        Session::setFlash("Le club a bien été ajouté.", 'success');
        Table::Redirect('clubs');
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 500 Ko";
    endif;
endif;
?>
<?= Session::flash();?>

<div class="header">
    <h1>Ajouter un Club</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">
        <?= $form->input('nom', "Nom du partenaire * : ");?>

        <?= $form->input('site', 'Adresse du site :', 'Site Internet du partenaire')?>

        <?= $form->file('image', 'Image* :', 'Formats JPG/PNG | Maxi. 500 Ko', 4096000);?>

        <?= $form->submit('add', 'Ajouter', 'articles') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=clubs"><span class="icon-return"></span><span class="text-return">Retour</span></a></div>
