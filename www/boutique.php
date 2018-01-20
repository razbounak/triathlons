<?php
use App\Produit\Produit;
$title = "Boutique | Triath'Lons";
$description = "Boutique du Triath'Lons";
include('_inc/header.php');
?>
    <style type="text/css">
        .row p {
            color:#FFF;
        }
        .row p a {
            color: #fc0;
            font-weight: bold;
        }
    </style>
<main class="site-content" role="main">
    <section class="boutique">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="mt"></div>
                    <div class="col-md-12">
                    <h1>La boutique Triath'Lons</h1>
                        <p>Pour toute commande, envoyer un email avec vos articles et vos tailles à <a href="mailto:boutiquetriathlons@gmail.com">boutiquetriathlons@gmail.com</a></p>
                <?php
                    $produits = Produit::onLine();
                    foreach ($produits AS $produit) : ?>
                        <div class="produit">
                            <h3><?= $produit->nom; ?></h3>
                            <img src="image/<?= $produit->image;?>" alt="<?= $produit->nom;?>">
                            <div class="description">
                                <?= $produit->description; ?>
                            </div>
                            <div class="qt">
                                Quantité : <?= $produit->quantite; ?>
                            </div><!--
                             --><div class="price">
                                    <i class="fa fa-shopping-cart"></i> <?= $produit->prix;?> ,00 €
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('_inc/footer.php'); ?>