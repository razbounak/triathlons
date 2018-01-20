<?php
/* 
 * Créer le 15.11.2017
  * Générer à 11:19
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
use App\HTML\Form;
use App\Membre\Membre;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter un Document | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $name = $_POST['name'];

    $date = $_POST['date'];
    $fichier = $_FILES['fichier'];
    $nom_fichier = $fichier['name'];

    if ($fichier['size'] <= 8388608) :
        Membre::UploadDocs($fichier);
        Membre::AddDocument([
            'name' => $name,
            'fichier' => $nom_fichier,
            'date' => $date
        ]);
        Session::setFlash("Le document a bien été ajouté.", 'success');
        Table::Redirect('documents.membre');
    else :
        $_SESSION['errors'] = 'Taille du fichier trop important, merci de réduire son poids. Maxi. : 1,5 Mo';
    endif;

endif;
?>

<div class="header">
    <h1>Ajouter un document</h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('name', "Nom du fichier :", "Longueur maxi 50 caractères");?>

        <?= $form->file('fichier', "Sélectionnez le fichier", 'Formats PDF, Excel, Word | Maxi. 1.5 Mo', 8388608) ;?>

        <input type="hidden" name="date" value="<?= date('Y-m-d');?>" />

        <?= $form->submit('ajouter', "Ajouter cet article", "documents.membre") ;?>

    </form>
</div>