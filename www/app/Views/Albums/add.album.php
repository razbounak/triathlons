<?php

use App\Album\Album;
use App\HTML\Form;
use App\Session\Session;
use App\Core\Table;
use App\Image\Image;

$form = new Form($_POST);

Table::setTitle("Ajouter un album | Triath'Lons");

if(isset($_POST['ajouter'])) :

    $times = time();
    $date = date('Y-m-d');
    $cle = $_POST['cle'];
    $nom = $_POST['nom'];

    Album::Create([
        'id'        => $times,
        'nom_album' => $nom,
        'data'      => $date,
        'cle'       => $cle
    ], 'album');

    if($_FILES['image_01']['name'] != '') :
        $name = time() + 1;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_01'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_02']['name'] != '') :
        $name = time() + 2;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_02'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_03']['name'] != '') :
        $name = time() + 3;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_03'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_04']['name'] != '') :
        $name = time() + 4;
        $nom = $name .'.jpg';
        Image::Create($_FILES['image_04'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_05']['name'] != '') :
        $name = time() + 5;
        $nom = $name .'.jpg';
        Image::Create($_FILES['image_05'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_06']['name'] != '') :
        $name = time() + 6;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_06'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_07']['name'] != '') :
        $name = time() + 7;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_07'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_08']['name'] != '') :
        $name = time() + 8;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_08'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_09']['name'] != '') :
        $name = time() + 9;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_09'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_10']['name'] != '') :
        $name = time() + 10;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_10'], $name);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_11']['name'] != '') :
        $name = time() + 11;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_11'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_12']['name'] != '') :
        $name = time() + 12;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_12'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_13']['name'] != '') :
        $name = time() + 13;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_13'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_14']['name'] != '') :
        $name = time() + 14;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_14'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    if($_FILES['image_15']['name'] != '') :
        $name = time() + 15;
        $nom = $name . '.jpg';
        Image::Create($_FILES['image_15'], $nom);
        Album::Create([
            'id_album'  => $times,
            'image'     => $nom,
            'cle'       => $cle,
        ], 'album_photo');
    endif;
    Session::setFlash("L'album a bien été crée.",'success');
    Table::Redirect('albums');
endif; ?>

<div class="header">
    <h1>Ajouter un Album</h1>
</div>
<div class="bloc-edit">
    <h1>Les albums sont constitués d'un MINIMUM de 5 photos et MAXIMUM 15 photos. Formats JPG/PNG | Maxi. 500 Ko</h1>
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->input('nom', "Nom de l'album :"); ?>

        <?= $form->select('cle', 'Site concerné * : ', null, ['triathlons' => "Triath'Lons", 'corrida' => 'Corrida', 'chalain' => 'Chalain']); ?>

        <?= $form->file('image_01', "Image 01* :", null, 4096000); ?>
        <?= $form->file('image_02', "Image 02* :", null, 4096000); ?>
        <?= $form->file('image_03', "Image 03* :", null, 4096000); ?>
        <?= $form->file('image_04', "Image 04* :", null, 4096000); ?>
        <?= $form->file('image_05', "Image 05* :", null, 4096000); ?>
        <?= $form->file('image_06', "Image 06 :", null, 4096000, true); ?>
        <?= $form->file('image_07', "Image 07 :", null, 4096000, true); ?>
        <?= $form->file('image_08', "Image 08 :", null, 4096000, true); ?>
        <?= $form->file('image_09', "Image 09 :", null, 4096000, true); ?>
        <?= $form->file('image_10', "Image 10 :", null, 4096000, true); ?>
        <?= $form->file('image_11', "Image 11 :", null, 4096000, true); ?>
        <?= $form->file('image_12', "Image 12 :", null, 4096000, true); ?>
        <?= $form->file('image_13', "Image 13 :", null, 4096000, true); ?>
        <?= $form->file('image_14', "Image 14 :", null, 4096000, true); ?>
        <?= $form->file('image_15', "Image 15 :", null, 4096000, true); ?>

        <?= $form->submit('ajouter', 'Ajouter', 'annonces');?>

    </form>

</div>