<?php

use App\Partenaire\Partenaire;
use App\HTML\Form;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter un partenaire | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $titre = $_POST['nom'];
    $site = $_POST['site'];
    $cle = $_POST['cle'];
    $file = $_FILES['image'];

    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $name = time();
        $nom = $name .'.jpg';;
        Image::Create($file, $name, 225);
        Partenaire::Create([
            'nom'       => $titre,
            'site'      => $site,
            'image'     => $nom,
            'cle'       => $cle
        ]);
        Session::setFlash("Le partenaire a bien été ajouté.", 'success');
        Table::Redirect('partenaires');
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 500 Ko";
    endif;

endif;
?>

<div class="header">
    <h1>Ajouter un partenaire</h1>
</div>

<div class="bloc-edit">

    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Nom du partenaire * : ");?>

        <?= $form->input('site', 'Adresse du site :', 'Site Internet du partenaire')?>

        <?= $form->file('image', "Image du produit :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->select("cle", "Site concerné * : ", null, ['triathlons' => "Triath'Lons", 'corrida' => 'Corrida', 'chalain' => 'Chalain'])?>

        <?= $form->submit('ajouter', 'Ajouter', 'partenaires') ;?>

    </form>

</div>