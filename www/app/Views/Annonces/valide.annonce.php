<?php

use App\Image\Image;
use App\Session\Session;
use App\Annonce\Annonce;
use App\Core\Table;

$id = $_GET['id'];
$posts = Annonce::find($id);

Table::setTitle('En cours de validation... ');

if (isset($_POST['valide'])) :
    $id = $_POST['id'];
    Annonce::Validator($id);
    Session::setFlash("L'annonce a été validé", "success");
    Table::Redirect('annonces');
endif;

if (isset($_POST['supprimer'])) :

    $id = $_POST['id'];
    Image::Destroy($posts->image, false);

    Annonce::Delete($id);

    Session::setFlash("L'annonce a été supprimée", "error");
    Table::Redirect('annonces');
endif;
?>

<div class="header">
    <h1>Aperçu de l'annonce à valider :</h1>
</div>

<div class="bloc-edit">

    <div class="commentaire">
        <div class="flex">
            <div class="label">Annonce écrit le : </div><div class="input"><?= $posts->date;?></div>
        </div>
        <div class="flex">
            <div class="label">Par : </div><div class="input"><?= $posts->autor;?></div>
        </div>
        <div class="flex">
            <div class="label">Titre: </div><div class="input"><?= $posts->titre ;?></div>
        </div>
        <div class="flex">
            <div class="label">Description : </div><div class="input"><?= $posts->content ;?></div>
        </div>
        <div class="flex">
            <div class="label">Image du produit :</div><div class="input"><?= $posts->getImg() ;?></div>
        </div>
    </div>

    <form action="#" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <button name="supprimer" type="submit" class="btn danger">supprimer</button><!--
        --><button name="valide" type="submit" class="btn valide">valider</button>
    </form>
    <div class="return"><a href="index.php?page=annonces"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Annuler la validation</span></a></div>
</div>