<?php

use App\Annonce\Annonce;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$annonce = Annonce::find($id);
$form = new Form($annonce);
$oldImage = $annonce->image;
Table::setTitle('Edition : '. $annonce->titre);

if(isset($_POST['modifier']) AND $_POST['titre'] != '' AND $_POST['autor'] != '' AND $_POST['content'] != '' AND $_POST['quantite'] != '' AND $_POST['price'] != '' AND $_POST['online'] != '') :

    $date = $_POST['date'];
    $titre = $_POST['titre'];
    $name = $_POST['autor'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['price'];
    $online = $_POST['online'];
    $message = $_POST['content'];

    Annonce::Edit($id, [
        'titre'     => $titre,
        'content'   => $message,
        'autor'     => $name,
        'quantite'  => $quantite,
        'price'     => $prix,
        'date'      => $date,
        'online'    => $online
    ]);
    Session::setFlash("L'annonce à bien été modifiée.", 'success');
    Table::Redirect('annonces');
endif;

if(isset($_POST['illustration'])) :

    Image::Destroy($oldImage, false);
    $file = $_FILES['image'];
    $name = time() .'.jpg';
    Image::Create($file, $name, 500);
    Annonce::Edit($id,[
        'image' => $name
    ]);
    Session::setFlash("L'image du produit a bien été modifiée.", 'success');
    Table::Redirect('annonces');
endif;
?>

<div class="header">
    <h1>Modifier l'image d'illustration</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="label">Image du produit :</div><!--
            --><div class="input"><?= $annonce->getImg();?></div>
        </div>

        <?= $form->file('image', "Changer d'image", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->submit('illustration', "Modifier l'image", 'annonces');?>
    </form>
</div>

    <div class="return"><a href="index.php?page=annonces"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>

<div class="header">
    <h1>Modifier le texte </h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <input type="hidden" value="<?= date('Y-m-d');?>" name="date">

        <?= $form->input('titre', "Titre de l'annonce :");?>

        <?= $form->input('autor', 'Auteur :', 'Format : Prénom + Nom de famille');?>

        <?= $form->textarea('content', null);?>

        <?= $form->input('quantite', 'Quantité :');?>

        <?= $form->input('price', 'Prix :');?>

        <?= $form->select('online', 'En ligne', null, [1 => 'En Ligne', '0' => 'Hors Ligne'] ) ?>

        <?= $form->submit('modifier', 'Modifier', 'annonces') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=annonces"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>