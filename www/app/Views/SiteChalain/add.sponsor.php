<?php

use App\HTML\Form;
use App\Chalain\Chalain;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter un Sponsor | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $title = $_POST['nom'];
    $url = $_POST['site'];

    $picture = $_FILES['image'];

    if($picture['size'] >= 1 && $picture['size'] <= 4096000) :
        $nomImage = time() .'.jpg';
        Chalain::ImageSponsors($picture, $nomImage);
        Chalain::AddSponsors([
            'nom'     => $title,
            'site'    => $url,
            'image'   => $nomImage,
        ]);

        Session::setFlash("Le sponsor a bien été ajouté.", 'success');
        Table::Redirect('sponsors');
    endif;

endif;
?>

<div class="header">
    <h1>Ajouter un article | Chalain</h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Nom du Sponsor :");?>

        <?= $form->input('site', 'Lien :', "Indiquer l'adresse du site", false);?>

        <?= $form->file('image', "Logo :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000);?>

        <?= $form->submit('ajouter', "Ajouter cet article", 'sponsors') ;?>

    </form>
</div>

