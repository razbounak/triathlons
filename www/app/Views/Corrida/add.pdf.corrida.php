<?php

use App\Core\Table;
use App\HTML\Form;
use App\Session\Session;
use App\Corrida\Corrida;

$form = new Form($_POST);

if (isset($_POST['ajouter'])) :

    $name = $_POST['nom_fichier'];
    $fichier = $_FILES['fichier'];

    if ($fichier['size'] >= 1 && $fichier['size'] <= 2067152) :
        $filename = $fichier['name'];
        Corrida::UploadPDF($fichier);
        Corrida::AddPDF([
            'nom_fichier' => $name,
            'fichier' => $filename
        ]);
        Session::setFlash("Le fichier pdf a bien été ajouté", 'success');
        Table::Redirect('pdf.corrida');
    endif;

endif;

?>

<div class="header">
    <h1>Ajouter un Fichier PDF | CORRIDA</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom_fichier', "titre de l'article :");?>

        <?= $form->file('fichier', "Fichier PDF :", 'Formats PDF | Maxi. 1 Mo', 2097152);?>

        <?= $form->submit('ajouter', "Ajouter cet article", 'pdf.corrida') ;?>

    </form>
</div>

<div class="return"><a href="index.php?page=home.corrida"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>