<?php

use App\HTML\Form;
use App\Parametre\Parametre;
use App\Session\Session;

$degre = Parametre::AfficheT(1);
$form = new Form($degre);

$decompte = Parametre::AfficheDecompte(1);
$form2 = new Form($decompte);

?>

<div class="header">
    <h1>Gestion des Paramètres du site de Chalain</h1>
</div>

<?= Session::flash(); ?>

<div class="bloc-edit">
    <h2>Température du lac de Chalain</h2>
    <div class="bloc bloc-50 calendar">
        <div class="bloc-titre tab">Température</div>
        <div>Le lac est actuellement à <strong><?= $degre->degres;?>°C</strong></div> <div class="edit"><a title="Modifier la température" href="index.php?page=edit.parametre&id=<?= $degre->id;?>"> </a></div>
    </div>
    </div>

</div>

<div class="bloc-edit">
    <h2>Compte à rebours du site de Chalain :</h2>

    <div class="bloc bloc-50 calendar">
        <div class="bloc-titre tab">Compte à rebours</div>
        <div class="bloc-flex produit">
            <div class="w-25 mobil ar m100">Prochaine date :</div><!--
            --><div class="w-15 ac mobil m100"><?= $decompte->date;?></div><!--
            --><div class="w-25 ar mobil m100">le compte à rebours est :</div><!--
            --><div class="w-15 ac mobil m100"> <?php
                    if($decompte->online == 1) :
                        echo "<strong>ACTIF</strong>";
                    elseif($decompte->online == 0) :
                        echo "<strong>INACTIF</strong>";
                    endif;
                    ?></div><!--
            --><div class="edit w-20 mobil m100">
                <a title="Modifier la température" href="index.php?page=edit.parametre&id=<?= $degre->id;?>"> </a>
            </div>
        </div>
    </div>
</div>