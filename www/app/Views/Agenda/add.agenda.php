<?php
use App\Agenda\Agenda;
use App\HTML\Form;
use App\Session\Session;
use App\Core\Table;
use App\Date\Date;

$form = new Form($_POST);

Table::setTitle('Ajouter un événement');

if(isset($_POST['add'])) {

    $date = Date::Formate($_POST['date']);
    $nom = $_POST['nom'];
    $lien = $_POST['lien'];
    $lieu = $_POST['lieu'];
    $ville = $_POST['ville'];

    Agenda::Create([
        'nom'    => $nom,
        'date'   => $date,
        'lien'   => $lien,
        'lieu'   => $lieu,
        'ville'  => $ville
    ]);
    Session::setFlash("L'événement a bien été ajoutée.", 'success');
    Table::Redirect('agenda');
}
?>
<div class="header">
    <h1>Ajouter un Evénement</h1>
</div>
<?php if(!empty($_SESSION['error'])) : ?>
    <div id="alert" class="alert">
        <span class="icon-error"></span><!--
    --><span class="text-error"><?php echo $_SESSION['error'];?></span>
    </div>
<?php endif;
unset($_SESSION['error']); ?>
<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Titre de l'événement* : ", 'Titre simple et court');?>

        <?= $form->input('date', "Date de l'événement* :", 'Sous Format : JJ/MM/AAA')?>

        <?= $form->input('lien', 'Lien* :', 'Adresse du site');?>

        <?= $form->input('lieu', 'Lieu* :', 'Lieu de déroulement : Lac de Chalain');?>

        <?= $form->input('ville', 'Ville* :', 'Ville + département');?>

        <?= $form->submit('add', 'Ajouter', 'agenda') ;?>
    </form>
</div>

