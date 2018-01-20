<?php

use App\Core\Table;
use App\Session\Session;
use App\HTML\Form;
use App\Fichier\Fichier;

Table::setTitle('Ajouter un Fichier');

$form = new Form();

if(isset($_POST['ajouter']) AND $_FILES['fichier'] != '') {

    $date = $_POST['date'];
    $fichier = $_FILES['fichier'];
    $name = $_POST['nom_fichier'];

    $nom_fichier = $fichier['name'];

    $extension_upload = substr(strtolower($fichier['name']), -3);
    $extension_autoriser = array('pdf');

    if(in_array($extension_upload, $extension_autoriser)) {
        if ($fichier['size'] <= 8388608) {
            Fichier::Upload($fichier);
            Fichier::Create([
                'nom_fichier' => $name,
                'fichier' => $nom_fichier,
                'date' => $date
            ]);
            Session::setFlash('Le fichier a bien été ajouté.', 'success');
            Table::Redirect('fichiers');
        } else {
            $_SESSION['errors'] = 'Taille du fichier trop important, merci de réduire son poids. Maxi. : 1,5 Mo';
        }
    } else {
        $_SESSION['errors'] = 'Vous ne pouvez transférer que des fichiers .PDF';
    }
}
?>

<div class="header">
    <h1>Ajouter un fichier PDF</h1>
</div>

<div class="bloc-edit">

    <?php if(isset($_SESSION['errors'])) : ?>
        <div class="alerte">
            <p>Erreur : <?php echo $_SESSION['errors'];?></p>
        </div>
    <?php endif; unset($_SESSION['errors']); ?>

    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom_fichier', 'Nom du fichier', 'Longueur maxi 50 caractères') ;?>

        <?= $form->file('fichier', "Sélectionnez le fichier", '[Formats PDF | Maxi. 1 Mo]', 8388608) ;?>

        <input type="hidden" name="date" value="<?= date('Y-m-d');?>" />

        <?= $form->submit('ajouter', 'Ajouter le fichier', 'fichiers') ;?>

    </form>
</div>