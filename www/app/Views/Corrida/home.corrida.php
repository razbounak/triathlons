<?php
/**
* Created by PhpStorm.
* User: FCWD
* Date: 06/01/2017
* Time: 18:00
*/
use App\Core\Table;
use App\Session\Session;
use App\Corrida\Corrida;

Table::setTitle('Tableau de bord | Zone Administration');

$id = $_COOKIE['IDUSER'];

$articles = Corrida::AfficheArticleLast(6);
$fichiers = Corrida::AffichePDFLast(5);
$courses = Corrida::AfficheCourseLast(6);
$sponsors = Corrida::AffcheSponsorslast(5);
$reglements = Corrida::AfficheReglement();
$programmes = Corrida::AfficheProgramme();
$inscriptions = Corrida::AfficheInscription();
$resuls = Corrida::AfficheResultatLast(4);

?>
<div class="header flex">
    <h1>Triath'Lons | SITE DE LA CORRIDA</h1>
</div>

<?= Session::flash();?>

<div class="flex">
    <div class="bloc bloc-60">
        <div class="titre-bloc">Actualité</div>
        <?php
        foreach ($articles AS $article) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-20 pl mobil m50"><?= $article->temps;?></div><!--
               --><div class="w-60 mobil m50"><?= $article->news_title;?></div><!--
               --><div class="ac w-10 mobil m50"><a href="index.php?page=edit.article.corrida&id=<?= $article->news_id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.article.corrida&id=<?= $article->news_id;?>&image=<?= $article->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('article.corrida');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une actualité</span></a></div>
    </div>
    <div class="bloc bloc-40">
        <div class="titre-bloc jaune">Réglementation sportive</div>
        <?php
        foreach ($reglements AS $reglement) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-30 pl mobile m100"><?= $reglement->name;?></div><!--
                --><div class="w-50 mobil m50"><?= $reglement->text;?></div><!--
                --><div class="ac w-20"><a href="index.php?page=edit.reglement.corrida&id=<?= $reglement->id; ?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="flex">
    <div class="bloc bloc-40">
        <div class="titre-bloc jaune">Fichiers PDF</div>
        <?php
        foreach ($fichiers AS $fichier) : ?>
            <div class="compterendu bloc-flex">
                <div class="date w-60 mobil m50 pl"><?= $fichier->nom_fichier;?></div><!--
               --><div class="ac w-20 mobil m50"><a href="https://corrida.triathlons.fr/fichier/<?= $fichier->fichier;?>" target="_blank"> </a></div><!--
               --><div class="ac w-20 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.pdf.corrida&id=<?= $fichier->id?>&fichier=<?= $fichier->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="violet ac h42"><a href="index.php?page=pdf.corrida"><span class="icon icon-apercu"></span> VOIR TOUS LES FICHIERS PDF</a></div>
        <div class="ajout"><a href="<?= Table::add('pdf.corrida');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Fichier</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc">Courses</div>
        <?php
        foreach ($courses AS $course) : ?>
        <div class="compterendu bloc-flex">
            <div class="name w-50 pl mobil m100">COURSE : <strong><?= $course->name;?></strong></div><!--
            --><div class="w-10 mobil m50"><?= $course->prix;?>,00€</div><!--
            --><div class="w-10 mobil m50"><?= $course->prix_nl;?>,00€ NL</div><!--
            --><div class="w-20 ac mobil m100">
                <?php if($course->online == 1) :?>
                    <span class="green">ACTIF</span>
                <?php elseif($course->online == 0) :?>
                    <span class="red">INACTIF</span>
                <?php endif;?>
            </div><!--
            --><div class="ac w-10 mobil m50"><a href="index.php?page=edit.course.corrida&id=<?= $course->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc">Partenaires</div>
        <?php
        foreach ($sponsors AS $sponsor) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-80 pl mobil m70"><?= $sponsor->nom;?></div><!--
                --><div class="ac w-20 mobil m30">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.sponsor.corrida&id=<?= $sponsor->id;?>&image=<?= $sponsor->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="violet ac h42"><a href="index.php?page=corrida.sponsors"><span class="icon icon-apercu"></span> VOIR TOUS LES PARTENAIRES</a></div>
        <div class="ajout"><a href="<?= Table::add('sponsor.corrida');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Partenaire</span></a></div>
    </div>

</div>

<div class="flex">
    <div class="bloc bloc-30">
        <div class="titre-bloc jaune">Inscriptions</div>
        <?php
        foreach($inscriptions AS $inscription) : ?>
            <div class="bloc-flex">
                <div class="w-80 pl mobil m100 h42"><?= $inscription->name;?></div><!--0
                --><div class="ac w-20 mobil m100"><a href="index.php?page=edit.inscription.corrida&id=<?= $inscription->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Programme</div>
        <?php
        foreach($programmes AS $programme) : ?>
            <div class="bloc-flex">
                <div class="w-80 pl mobil m100"><?= $programme->text;?></div><!--
                --><div class="ac w-20 mobil m100"><a href="index.php?page=edit.programme.corrida&id=<?= $programme->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Résultats</div>
        <?php
        foreach($resuls AS $resultat) : ?>
            <div class="bloc-flex">
                <div class="w-60 mobil m50 pl h42"><?= $resultat->nom;?></div><!--
               --><div class="ac w-20 mobil m50"><a href="<?= $resultat->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
               --><div class="ac w-20 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.resultat.corrida&id=<?= $resultat->id;?>&fichier=<?= $resultat->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="ajout"><a href="<?= Table::add('resultat.corrida');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un résultat</span></a></div>
    </div>
</div>