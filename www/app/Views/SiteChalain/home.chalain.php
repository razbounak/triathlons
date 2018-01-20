<?php
/**
* Created by PhpStorm.
* User: FCWD
* Date: 06/01/2017
* Time: 18:00
*/
use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

Table::setTitle('Tableau de bord | Zone Administration');

$id = $_COOKIE['IDUSER'];

$articles = Chalain::AfficheArticleLast(6);
$fichiers = Chalain::AffichePDFLast(5);
$courses = Chalain::AfficheCourseLast(6);
$sponsors = Chalain::AffcheSponsorslast(5);
$informations = Chalain::AfficheWarning();
$degre = Chalain::AfficheTemperature(1);
$decompte = Chalain::AfficheDecompte(1);
$reglements = Chalain::AfficheReglement();
$programmes = Chalain::AfficheProgramme();
$inscriptions = Chalain::AfficheInscription();
$resuls = Chalain::AfficheResultatLast(4);

?>
<div class="header flex">
    <h1>Triath'Lons | SITE DE CHALAIN</h1>
</div>

<?= Session::flash();?>
<div class="flex">

    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Température du lac de Chalain</div>
        <div class="bloc-flex">
            <div class="w-30 pl mobil m100 h42">Température : <strong><?= $degre->degres;?>°C</strong></div><!--
        --><div class="w-30 mobil m100 h42">Etat :
                <?php
                if($degre->online == 1) : ?>
                    <strong class="green">ACTIF</strong>
                <?php elseif($degre->online == 0) : ?>
                    <strong class="red">INACTIF</strong>
                <?php endif;
                ?></div><!--
        --><div class="w-20 mobil m100 edit"><a title="&#201;diter la température" href="index.php?page=edit.temperature&id=<?= $degre->id;?>"><i class="ion-edit cvert"></i></a></div>
        </div>
    </div>
    <div class="bloc bloc-50 calendar">
        <div class="titre-bloc">Compte à rebours Chalain</div>
        <div class="bloc-flex produit">
            <div class="w-25 mobil pl h42 m100">Prochaine date :</div><!--
            --><div class="w-15 ac h42 mobil m100"><?= $decompte->compteur_date;?></div><!--
            --><div class="w-30 ar h42 mobil m100">le compte à rebours est :</div><!--
            --><div class="w-15 ac h42 mobil m100"> <?php
                if($decompte->online == 1) : ?>
                    <strong class="green">ACTIF</strong>
                <?php elseif($decompte->online == 0) : ?>
                    <strong class="red">INACTIF</strong>
                <?php endif;
                ?></div><!--
            --><div class="edit w-15 mobil m100">
                <a title="&#201;diter la température" href="index.php?page=edit.temperature&id=<?= $degre->id;?>"><i class="ion-edit cvert"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="flex">
    <div class="bloc bloc-60">
        <div class="titre-bloc">Actualité</div>
        <?php
        foreach ($articles AS $article) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-20 pl mobil m50"><?= $article->temps;?></div><!--
               --><div class="w-60 mobil m50"><?= $article->news_title;?></div><!--
               --><div class="ac w-10 mobil m50"><a href="index.php?page=edit.article.chalain&id=<?= $article->news_id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
               --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.article.chalain&id=<?= $article->news_id;?>&image=<?= $article->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('article.chalain');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une actualité</span></a></div>
    </div>
    <div class="bloc bloc-40">
        <div class="titre-bloc jaune">Réglementation sportive</div>
        <?php
        foreach ($reglements AS $reglement) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-40 pl mobile m100"><?= $reglement->titre;?></div><!--
                --><div class="w-40 mobil m50"><?= $reglement->fichier;?></div><!--
                --><div class="ac w-20 mobil m50"><a href="index.php?page=edit.reglement.chalain&id=<?= $reglement->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
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
                <div class="w-60 mobil m50 pl"><?= $fichier->nom_fichier;?></div><!--
               --><div class="ac w-20 mobil m50"><a href="https://chalain.triathlons.fr/fichier/<?= $fichier->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
               --><div class="ac w-20 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.pdf.chalain&id=<?= $fichier->id?>&fichier=<?= $fichier->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="violet ac h42"><a href="index.php?page=pdf.chalain"><span class="icon icon-apercu"></span> VOIR TOUS LES FICHIERS PDF</a></div>
        <div class="ajout"><a href="<?= Table::add('pdf.chalain');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Fichier</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc">Courses</div>
        <?php
        foreach ($courses AS $course) : ?>
        <div class="compterendu bloc-flex">
            <div class="name w-50 pl mobil m100">Triathlon COURSE : <strong><?= $course->name;?></strong></div><!--
            --><div class="w-10 mobil m50"><?= $course->prix;?>,00€</div><!--
            --><div class="w-10 mobil m50"><?= $course->prix_nl;?>,00€ NL</div><!--
            --><div class="w-20 ac mobil m100">
                <?php if($course->online == 1) :?>
                    <span class="green">ACTIF</span>
                <?php elseif($course->online == 0) :?>
                    <span class="red">INACTIF</span>
                <?php endif;?>
            </div><!--
            --><div class="edit w-10 mobil m50"><a href="index.php?page=edit.course.chalain&id=<?= $course->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
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
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.sponsor&id=<?= $sponsor->id;?>&image=<?= $sponsor->image;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="violet ac h42"><a href="index.php?page=sponsors"><span class="icon icon-apercu"></span> VOIR TOUS LES PARTENAIRES</a></div>
        <div class="ajout"><a href="<?= Table::add('sponsor');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Partenaire</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Informations</div>
        <?php
        foreach ($informations AS $information) : ?>
            <div class="compterendu bloc-flex">
                <div class="name w-20 pl mobil m50"><?= $information->data;?></div><!--
                --><div class="date w-70 mobil m50"><?= $information->texte;?></div><!--
                --><div class="ac w-20 mobil m50"><a href="index.php?page=edit.warning&id=<?= $information->id; ?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
                --><div class="suppr w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.warning&id=<?= $information->id;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="index.php?page=add.warning"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une Information</span></a></div>
    </div>
</div>

<div class="flex">
    <div class="bloc bloc-30">
        <div class="titre-bloc jaune">Inscriptions</div>
        <?php
        foreach($inscriptions AS $inscription) : ?>
            <div class="bloc-flex">
                <div class="w-80 pl mobil m100 h42"><?= $inscription->name;?></div><!--0
                --><div class="edit w-20 mobil m100"><a href="index.php?page=edit.inscription.chalain&id=<?= $inscription->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Programme</div>
        <?php
        foreach($programmes AS $programme) : ?>
            <div class="bloc-flex">
                <div class="w-80 pl mobil m100"><?= $programme->texte;?></div><!--
                --><div class="edit w-20 mobil m100"><a href="index.php?page=edit.programme.chalain&id=<?= $programme->id;?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Résultats</div>
        <?php
        foreach($resuls AS $resutltat) : ?>
            <div class="bloc-flex">
                <div class="w-60 mobil m50 pl h42"><?= $resutltat->nom;?></div><!--
               --><div class="view w-20 mobil m50"><a href="https://chalain.triathlons.fr/fichier/<?= $resutltat->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
               --><div class="suppr w-20 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('index.php?page=delete.resultat.chalain&id=<?= $resutltat->id;?>&fichier=<?= $resutltat->fichier;?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="ajout"><a href="<?= Table::add('resultat.chalain');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un résultat</span></a></div>
    </div>
</div>