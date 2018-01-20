<?php

use App\Session\Session;
use App\Diapo\Diapo;

$diapo = Diapo::all();

$i = 1;
?>
<div class="header">
    <h1>Gestion du Diaporama</h1>
</div>

<?= Session::flash();?>

<div class="bloc-edit">

    <div class="modify"><a href="index.php?page=edit.diaporama"><span class="icon icon-modify"><i class="ion-edit"></i></span> <span class="text-modify">Modifier les images</span></a></div>

    <ul class="portfolio-item">

        <li>
            <?php foreach ($diapo as $item) : ?>
                <p>Image n° : <?= $i++ ;?></p>
                <?= $item->getImg(); ?>
                <hr>
            <?php endforeach; ?>
        </li>

    </ul>

</div>