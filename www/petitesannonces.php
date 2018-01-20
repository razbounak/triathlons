<?php

use App\Annonce\Annonce;
use App\HTML\Form;
use App\Image\Image;

$title = 'Petites annonces';
$description = "Petites annonces du Triath'Lons";
include('_inc/header.php');

$form = new Form();

if(isset($_POST['add']) AND $_POST['titre'] != '' AND $_POST['autor'] != '' AND $_POST['content'] != '' AND $_POST['quantite'] != '' AND $_POST['price'] != '') :

    $date = date('Y-m-d');
    $titre = $_POST['titre'];
    $name = $_POST['autor'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['price'];
    $online = 0;
    $message = $_POST['content'];
    $file = $_FILES['image'];
    if($file['size'] >= 1 && $file['size'] <= 4096000) :
        $nom = time() . '.jpg';
        Image::Create($file, $nom);
        Annonce::Create([
            'titre'     => $titre,
            'content'   => $message,
            'autor'     => $name,
            'quantite'  => $quantite,
            'price'     => $prix,
            'image'     => $nom,
            'date'      => $date,
            'online'    => $online
        ]);
        $_SESSION['success'] = 'Votre annonce a bien été ajoutée. Elle sera affichée après validation';
    else :
        $_SESSION['error'] = "INFORMATION : Image refusée - taille trop importante | Maxi. 50 Ko";
    endif;
endif;
?>	
<main class="site-content" role="main">
<section class="boutique">
<div class="overlay">
    <div class="container">
        <div class="row">
            <div class="mt"></div>
            <div class="col-md-12">
                <h1>Les annonces du Triath'Lons</h1>
            <?php
            $annonces = Annonce::last(6);
                foreach ($annonces as $annonce) : ?>
                    <div class="produit">
                        <h3><?= $annonce->titre; ?></h3>
                        <?php if(!empty($annonce->image)) : ?>
                            <img src="image/<?= $annonce->image;?>" alt="<?= $annonce->titre?>">
                        <?php endif; ?>
                        <div class="description">
                            <?= $annonce->content; ?>
                        </div>
                        <div class="qt">
                            <?php if(!empty($annonce->quantite) OR $annonce->quantite != 0) : ?>
                                Quantité : <?= $annonce->quantite; ?>
                            <?php endif; ?>
                        </div><!--
                             --><div class="price">
                            <?php if($annonce->price != 0) : ?>
                                <i class="fa fa-shopping-cart"></i> <?= $annonce->price;?> ,00 €
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="portfolio" class="index">
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
                <div class="sec-title text-center">
                    <h2>Ajouter votre annonce</h2>
                </div>
                <p>La club vous offre la possibilité de vendre un produit d'occassion sur le site, en rapport avec le triathlon</p>
                <p>Votre annonce sera publiée après validation de l'administrateur du site.</p>

                <p>Donnez le maximum d'information sur votre produit et sur vos COORDONNEES.</p>

                <?php
                    if(!empty($_SESSION['error'])) : ?>
                        <div class="refus"><?= $_SESSION['error'];?></div>
                <?php endif;
                    if(!empty($_SESSION['success'])) : ?>
                        <div class="succes"><?= $_SESSION['success'];?></div>
                <?php endif;
                    unset($_SESSION);
                ?>

				<form action="petitesannonces.php" method="POST" enctype="multipart/form-data" class="contact-form">

                    <?= $form->input('titre', "Titre de l'annonce :");?>

                    <?= $form->input('autor', 'Auteur :', 'Format : Prénom + Nom de famille. Initiale acceptée.');?>

                    <?= $form->textarea('content', null, "N'oubliez pas de mentionner vos coordonnées de contact, email ou/et téléphone");?>

                    <?= $form->input('quantite', 'Quantité :');?>

                    <?= $form->input('price', 'Prix :');?>

                    <?= $form->file('image', "Image du produit :", 'Formats JPG/PNG | Maxi. 50 Ko', 4096000)?>

                    <button class="btn-form valide" name="add" type="submit">Ajouter mon annonce</button>
				</form>
			</div>
		</div>
	</div>
</section>			
</main>
<?php include'_inc/footer.php'; ?>
<script src="app/Views/template/theme/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('desc');
</script>