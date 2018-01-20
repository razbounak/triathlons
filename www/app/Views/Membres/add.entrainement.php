<?php
/* 
 * Créer le 15.11.2017
  * Générer à 11:18
   * par Franck Contet - FCWD
    * Projet : TriathLons
*/
use App\HTML\Form;
use App\Membre\Membre;
use App\Session\Session;
use App\Core\Table;
use App\Date\Date;

$form = new Form($_POST);

Table::setTitle("Ajouter un Entrainement | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $name = $_POST['name'];
    $link = $_POST['link'];
    $text = $_POST['text'];
    $date_post = date('Y-m-d H:i:s');
    $date = Date::Formate($_POST['date']);
    $sport = $_POST['activity'];
    if ($_FILES == '') : $name_fichier = null;
    else :
        $fichier = $_FILES['fichier'];
        Membre::UploadEntrainement($fichier);
        $name_fichier = $fichier['name'];
    endif;
    Membre::AddEntrainement([
        'name'      => $name,
        'link'      => $link,
        'text'      => $text,
        'date'      => $date,
        'date_post' => $date_post,
        'activity'  => $sport,
        'fichier'   => $name_fichier
    ]);
    Session::setFlash("L'entrainement a bien été ajouté.", 'success');
    Table::Redirect('entrainements');

endif;
?>

<div class="header">
    <h1>Ajouter un entrainement</h1>
</div>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('name', "Nom de l'entrainement :", "Par exemmple : Entrainement + date");?>

        <?= $form->input('date', "Date de l'entrainement* :", 'Sous Format : JJ/MM/AAAA')?>

        <?= $form->select('activity', 'Sport :', null, ['Natation' => 'Natation', 'Running' => 'Running', 'Vélo' => 'Vélo']);?>

        <?= $form->textarea('text', null, "Non obligatoire");?>

        <?= $form->input('link', 'Lien :', "Indiquer l'adresse du site | Non obligatoire", false);?>

        <?= $form->file('fichier', "Sélectionnez le fichier", 'Formats PDF, Word & Excel | Maxi. 1.5 Mo | Non obligatoire', 8388608, true);?>

        <?= $form->submit('ajouter', "Ajouter cet article", 'entrainements') ;?>

    </form>
</div>

