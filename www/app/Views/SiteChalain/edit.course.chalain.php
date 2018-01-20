<?php

use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

$id = $_GET['id'];
$course = Chalain::FindCourse($id);

$form = new \App\HTML\Form($course);

if(isset($_POST['modifier'])) :

    $swim = $_POST['swim'];
    $velo = $_POST['velo'];
    $cap = $_POST['cap'];
    $prix = $_POST['prix'];
    $prix_nl = $_POST['prix_nl'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $extrait = $_POST['extrait'];
    $name = $_POST['name'];
    $seo = $_POST['seo'];
    $online = $_POST['online'];

    Chalain::EditCourse($id, [
        'swim'	    => $swim,
        'velo'      => $velo,
        'cap'       => $cap,
        'prix'      => $prix,
        'prix_nl'   => $prix_nl,
        'url'       => $url,
        'description' => $description,
        'extrait'   => $extrait,
        'name'      => $name,
        'online'    => $online,
        'seo'       => $seo
    ]);
    Session::setFlash("La course a bien été modifiée.", 'success');
    Table::Redirect('home.chalain');

endif;

?>
<div class="header">
    <h1>Edition Courses : <?= $course->name;?></h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('name', "Nom de la Course : *", 'Nom court limiter à 16 caractères maxi');?>

        <?= $form->input('seo', "Adresse de la page : *", 'nom du la course sans espace et tiret')?>

        <?= $form->input('swim', "Distance en natation :", "");?>

        <?= $form->input('velo', "Distance en Vélo :", "");?>

        <?= $form->input('cap', "Distance en CàP :", "");?>

        <?= $form->input('prix', "Prix :", "Format : sans centime ni €");?>

        <?= $form->input('prix_nl', "Prix non-licenciés :", "Format : sans centime ni €");?>

        <?= $form->input('extrait', "Résumé court :", "Limiter à 90 caractères");?>

        <?= $form->textarea('description');?>

        <?= $form->input('url', 'Lien inscription :', 'Lien vers inscription de la course');?>

        <?= $form->select('online', 'En Ligne :', null, [ 0 => 'HORS LIGNE', 1 => 'EN LIGNE']);?>

        <?= $form->submit('modifier', 'Modifier', 'home.chalain') ;?>
    </form>
</div>


<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>