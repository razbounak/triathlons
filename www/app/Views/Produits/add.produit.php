<?php

use App\Produit\Produit;
use App\HTML\Form;
use App\Image\Image;
use App\Session\Session;
use App\Core\Table;

$form = new Form($_POST);

Table::setTitle("Ajouter un Produit | Triath'Lons");

if(isset($_POST['add'])) {

    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $message = $_POST['description'];
    $file = $_FILES['image'];
    $online = $_POST['etat'];
    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $nomImage = time() .'.jpg';
        Image::Create($file, $nomImage);
        Produit::Create([
            'nom'           => $nom,
            'description'   => $message,
            'quantite'      => $quantite,
            'prix'          => $prix,
            'image'         => $nomImage,
            'etat'          => $online
        ]);
        Session::setFlash("Le produit à bien été ajouté.", 'success');
        Table::Redirect('produits');
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 500 Ko";
    endif;
}
?>

<div class="header">
    <h1>Ajouter un Produit</h1>
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

        <?= $form->input('nom', "Nom du produit :");?>

        <?= $form->textarea('description');?>

        <?= $form->input('quantite', 'Quantité :');?>

        <?= $form->input('prix', 'Prix :', 'Sans centime et €');?>

        <?= $form->file('image', "Image du produit :", 'Formats JPG/PNG | Maxi. 500 Ko', 4096000)?>

        <?= $form->select('etat', '&#201;tat', null, [1 => 'En Ligne'])?>

        <?= $form->submit('add', 'Ajouter', 'annonces') ;?>
    </form>
</div>