<?php

use App\Produit\Produit;
use App\Core\Table;

$id = $_GET['id'];
$produit = Produit::find($id);

Table::setTitle('Edition : '. $produit->nom);

?>
<div class="header">
    <h1>Produit : <?= $produit->nom?> </h1>
</div>

<div class="bloc-edit">
    <div class="bloc-titre pl">
        <h1><?= $produit->nom;?></h1>
    </div>
    <div class="bloc-extrait">Quantité : <?= $produit->quantite ;?> | Tarif : <?= $produit->prix ;?> ,00 €</div>
    <div class="content">
        <?= $produit->description;?>
        <div class="image"><img src="http://localhost/TriathLons/image/<?= $produit->image; ?>" alt="<?= $produit->nom;?>" width="300"></div>
    </div>
</div>

<div class="return"><a href="index.php?page=produits"><span class="icon-return"></span><span class="text-return">Retour</span></a></div>

