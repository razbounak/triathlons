<?php
use App\Album\Album;
use App\Core\Table;
use App\Session\Session;

$NbCom = Album::NumberAll();
Table::setTitle("Albums | Triath'Lons");
$perPage = 20;
$nbPage = ceil($NbCom / $perPage);

// Vérifie la valeur dans URL
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<= $nbPage) {
    $cPage = $_GET['p'];
} else {
    $cPage = 1;
}

$start = (int) (($cPage-1) * $perPage);
$end = (int) $perPage;

$albums = Album::all($start, $end);

?>
<div class="header">
    <h1>Gestions des Albums</h1>
</div>

<?= Session::flash();?>

<div class="add"><a href="<?= Table::add('album');?>"><span class="icon icon-add"> </span> <span class="text-add">Ajouter un Album</span></a></div>

<div class="bloc bloc-30">
    <div class="bloc-titre bloc-flex mask">
        <div class="w-20 pl">Date</div><!--
        --><div class="w-30">Titre</div><!--
        --><div class="w-20 ac">Site</div><!--
        --><div class="acenter w-15">Voir l'album</div><!--
        --><div class="acenter w-15">Supprimer</div>
    </div>
    <div class="bloc-titre tab">Fichier PDF</div>
    <?php
    foreach ($albums as $album) : ?>
        <div class="bloc-flex evens">
            <div class="w-20 pl mobil m100"><?= $album->date;?></div><!--
            --><div class="w-30 mobil m100"><?= $album->nom_album;?></div><!--
            --><div class="w-20 ac mobil m100"><?= $album->cle;?></div><!--
            --><div class="view w-15 mobil m50"><a href="index.php?page=view.album&id=<?= $album->id;?>"> </a></div><!--
            --><div class="suppr w-15 mobil m50"><a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.album&id=<?= $album->id; $nombre = 1;
                $photos = Album::findPhoto($album->id);
                    foreach ($photos as $photo) :
                        echo '&image' . $nombre++ . '=' . $photo->image;
                    endforeach;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a></div>
        </div>
    <?php endforeach;?>
</div>
<div class="pagination">
    <?php
    for($i = 1 ; $i <= $nbPage ; $i++) :
        if($i == $cPage) :
            echo '<a href="#" class="actif">' . $i . '</a>';
        else :
            echo '<a href="index.php?page=albums&p=' . $i . '">' . $i . '</a>';
        endif;
    endfor;
    ?>
</div>