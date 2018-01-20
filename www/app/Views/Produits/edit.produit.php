<?php

use App\Produit\Produit;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$produits = Produit::find($id);
$form = new Form($produits);
$oldImage = $produits->image;
Table::setTitle('Edition : '. $produits->nom);

if(isset($_POST['add'])) :

    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $message = $_POST['description'];
    $online = $_POST['etat'];

    Produit::Edit($id, [
        'nom'           => $nom,
        'description'   => $message,
        'quantite'      => $quantite,
        'prix'          => $prix,
        'etat'          => $online
    ]);
        Session::setFlash("Le produit à bien été ajouté.", 'success');
        Table::Redirect('produits');
endif;

if(isset($_POST['illustration'])) :

    $file = $_FILES['image'];
    $id = $_POST['id'];
    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $name = time() .'.jpg';
        Image::Destroy($oldImage, false);
        Image::Create($file, $name);
        Produit::Edit($id, [
            'image' => $name
        ]);
        Session::setFlash("L'image du produit a bien été modifiée.", 'success');
        Table::Redirect('produits');
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 500 Ko";
    endif;

endif;
?>

<div class="header">
    <h1>Modifier l'image d'illustration</h1>
</div>

<div class="bloc-edit">

    <form action="#" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="label">Image du produit :</div><!--
            --><div class="input"><?= $produits->getImg();?></div>
        </div>

        <?= $form->file('image', "Changer d'image", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->submit('illustration', "Modifier l'image", 'produits');?>

        <input type="hidden" name="id" value="<?= $_GET['id'];?>">

    </form>

</div>

<div class="return"><a href="index.php?page=produits"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>

<div class="header">
    <h1>Modifier le texte</h1>
</div>

<div class="bloc-edit">

    <form action="#" method="POST">

        <?= $form->input('nom', "Nom du produit :");?>

        <?= $form->textarea('description');?>

        <?= $form->input('quantite', 'Quantité :');?>

        <?= $form->input('prix', 'Prix :', 'Sans centime et €');?>

        <?= $form->select('etat', '&#201;tat', null, [1 => 'En Ligne', '0' => 'Hors Ligne']);?>

        <?= $form->submit('add', 'Ajouter', 'produits') ;?>

    </form>

</div>

<div class="return"><a href="index.php?page=produits"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>