<?php
use App\Annonce\Annonce;
use App\Core\Table;
$id = $_GET['id'];

$annonce = Annonce::find($id);
Table::setTitle('Annonce de : ' . $annonce->autor);
?>
<div class="header">
    <h1>Aperçu de l'annonce</h1>
</div>

<div class="bloc-edit">
    <div class="bloc-titre pl">
        <h1><?= $annonce->titre;?></h1>
    </div>
    <div class="bloc-extrait">Ecrit le : <?= $annonce->date;?> | par <em><?= $annonce->autor;?></em></div>
    <div class="content">
        <div class="image"><?= $annonce->getImg();?></div>
        <?= $annonce->content;?>
    </div>
</div>

<div class="modify"><a href="<?= $annonce->getUrl('edit.annonce')?>"><span class="icon-modify"><i class="ion-edit"></i></span><span class="text-modify">Modifier l'actualité</span></a></div>

<div class="del"><a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $annonce->getUrl('delete.annonce');?>','Suppression','430','207')"><span class="icon-del"><i class="ion-close-round"></i></span><span class="text-del">Supprimer l'actualité</span></a></div>

<div class="return"><a href="index.php?page=annonces"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>