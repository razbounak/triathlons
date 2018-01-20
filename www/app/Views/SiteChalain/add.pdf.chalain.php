<?php

use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

$form = new \App\HTML\Form($_POST);

if (isset($_POST['ajouter'])) :

    $name = $_POST['nom_fichier'];
    $fichier = $_FILES['fichier'];

    if ($fichier['size'] >= 1 && $fichier['size'] <= 2067152) :
        $filename = $fichier['name'];
        Chalain::UploadPDF($fichier);
        Chalain::AddPDF([
            'nom_fichier' => $name,
            'fichier' => $filename
        ]);
        Session::setFlash("Le fichier pdf a bien été ajouté", 'success');
        Table::Redirect('pdf.chalain');
    endif;

endif;

?>

<div class="header">
    <h1>Ajouter un Fichier PDF | Chalain</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom_fichier', "titre de l'article :");?>

        <?= $form->file('fichier', "Fichier PDF :", 'Formats PDF | Maxi. 1 Mo', 2097152);?>

        <?= $form->submit('ajouter', "Ajouter cet article", 'pdf.chalain') ;?>

    </form>
</div>

<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>