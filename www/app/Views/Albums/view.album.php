<?php

use App\Album\Album;
use App\Core\Table;

$id = $_GET['id'];
$album = Album::findAlbum($id);
$photos = Album::findPhoto($id);

Table::setTitle('Abum : '. $album->nom_album);

?>
<style type="text/css">
    .bloc-edit {
        width: 100% !important;
    }
    .bloc-edit li {
        display: inline-block;
        vertical-align: top;
        margin: 1%;
        height: 280px;
        overflow: hidden;
    }
</style>
<div class="header">
    <h1>Album : <?= $album->nom_album;?></h1>
</div>

<div class="bloc-edit">

    <ul>
        <?php foreach($photos as $photo) : ?>
            <li><img src="http://triathlons.fr/image/<?= $photo->image;?>" alt="" width="300px"></li>
        <?php endforeach; ?>
    </ul>

    <div class="return"><a href="index.php?page=albums"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>

</div>

