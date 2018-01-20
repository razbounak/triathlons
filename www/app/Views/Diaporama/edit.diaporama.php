<?php

use App\Diapo\Diapo;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$form = new Form();

$diapo = Diapo::all();

Table::setTitle('Edition le diaporama');

if(isset($_POST['modifier'])):

    $id = $_POST['id'];
    if($id == 1) {
        $image = $_POST['image1'];
    } elseif ($id == 2) {
        $image = $_POST['image2'];
    } elseif ($id == 3) {
        $image = $_POST['image3'];
    }

    $file = $_FILES['image'];
    $nomImage = time() .'.jpg';
    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        Diapo::Delete($image);
        Diapo::CreateImage($file, $nomImage, 1900);
        Diapo::Edit( $id,[
            'image' => $nomImage
        ]);
        Session::setFlash("L'image a bien été modifiée.", 'success');
        Table::Redirect('diaporama');
    endif;
endif;
?>

<div class="header">
    <h1>Modifier les images du diaporama</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->file('image', "Image * :", null, 4096000); ?>

        <?= $form->select('id', "Sélectionnez l'image : ", null, [ 1 => 'IMAGE 1', 2 => 'IMAGE 2', 3 => 'IMAGE 3'])?>

        <?php $i = 1; foreach ($diapo as $image) : ?>
            <input type="hidden" name="image<?= $i++ ;?>" value="<?= $image->image;?>">
        <?php endforeach; ?>

        <?= $form->submit('modifier', 'Modifier', 'agenda') ;?>
    </form>
</div>

<div class="return"><a href="index.php?page=diaporama"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>