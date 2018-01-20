<?php
use App\Core\Table;
use App\Session\Session;
use App\HTML\Form;
use App\Chalain\Chalain;

Table::setTitle('Ajouter un Résultat');

$form = new Form();

if(isset($_POST['ajouter']) AND $_FILES['fichier'] != '') {

    $fichier = $_FILES['fichier'];
    $name = $_POST['nom'];
    $nom_fichier = $fichier['name'];

    $extension_upload = substr(strtolower($fichier['name']), -3);
    $extension_autoriser = array('pdf');

    if(in_array($extension_upload, $extension_autoriser)) {
        if ($fichier['size'] <= 8388608) {
            Chalain::UploadResult($fichier);
            Chalain::AddResultat([
                'nom' => $name,
                'fichier' => $nom_fichier
            ]);
            Session::setFlash('Le fichier a bien été ajouté.', 'success');
            Table::Redirect('resultats');
        } else {
            $_SESSION['errors'] = 'Taille du fichier trop important, merci de réduire son poids. Maxi. : 1,5 Mo';
        }
    } else {
        $_SESSION['errors'] = 'Vous ne pouvez transférer que des fichiers .PDF';
    }
}
?>
<div class="header">
    <h1>Ajouter un Résultat</h1>
</div>
<div class="bloc-edit">

    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Nom :", 'Traithlon de Chalain + ANNEE'); ?>

        <?= $form->file('fichier', "Sélectionnez le fichier", '[Formats PDF | Maxi. 1 Mo]', 8388608) ;?>

        <?= $form->submit('ajouter', 'Ajouter', 'resultats');?>

    </form>

</div>