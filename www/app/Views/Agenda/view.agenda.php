<?php
use App\Agenda\Agenda;
use App\Core\Table;

$id = $_GET['id'];
$agenda = Agenda::find($id);

Table::setTitle('Agenda de : ' . $agenda->nom);
?>
<div class="header">
    <h1>Aperçu de l'événement</h1>
</div>

<div class="bloc-edit">
    <div class="bloc-titre pl">
        <h1><?= $agenda->nom;?></h1>
    </div>
    <div class="bloc-extrait">Evénement du : <?= $agenda->date;?></div>
    <div class="content">
        Lieu : <?= $agenda->lieu;?> | ville : <?= $agenda->ville;?>
    </div>
</div>

<div class="modify"><a href="<?= $agenda->getUrl('edit.agenda')?>"><span class="icon-modify"></span><span class="text-modify">Modifier l'actualité</span></a></div>

<div class="del"><a href="#" class="tooltip" title="Supprimer l'Evenement" onClick="javascript:ouvrePopUp('<?= $agenda->getUrl('delete.agenda');?>','Suppression','430','207')"><span class="icon-del"></span><span class="text-del">Supprimer l'actualité</span></a></div>

<div class="return"><a href="index.php?page=agenda"><span class="icon-return"></span><span class="text-return">Retour</span></a></div>