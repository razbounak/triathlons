<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 06/01/2017
 * Time: 18:00
 */
use App\Agenda\Agenda;
use App\Annonce\Annonce;
use App\Article\Article;
use App\Fichier\Fichier;
use App\Information\Information;
use App\Partenaire\Partenaire;
use App\Produit\Produit;
use App\Page\Page;
use App\Session\Session;
use App\Core\Table;

Table::setTitle('Tableau de bord | Zone Administration');

$id = $_COOKIE['IDUSER'];
?>

<div class="header flex">
    <h1>Triath'Lons | Tableau de bord</h1>
    <div class="profil">
        <div class="w-60">
            <p><?= $_COOKIE['PRENOM'] . ' ' . $_COOKIE['NOM'];?></p>
            <p><?= $_COOKIE['FONCTION']; ?></p>
        </div><!--
        --><div class="modif w-20 aleft"><a class="info" href="index.php?page=edit.admin&id=<?= $_COOKIE['IDUSER'];?>"> <span>Modifier vos informations</span></a></div>
    </div>
</div>

<?= Session::flash();?>

<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Annonce</div>
        <?php
        $numberCom = Annonce::NBAValider();
        if ($numberCom != 0 ) :
        $annonces = Annonce::findNoValidator();
        foreach ($annonces as $annonce) : ?>
        <div class="comment bloc-flex">
            <div class="w-25 pl mobil m50"><?= $annonce->titre;?></div><!--
            --><div class="w-25 mobil m50"><?= $annonce->autor;?></div><!--
            --><div class="w-40 pl"><?= $annonce->content;?></div><!--
            --><div class="ac w-10 mobil m50"><a href="<?= $annonce->getUrl('valide.annonce');?>" title="Lire le commentaire et le valider"><i class="ion-checkmark-round cvert"></i></a></div>
        </div>
        <?php endforeach;
        else :
        $annonces = Annonce::last(3);
        foreach ($annonces as $annonce) : ?>
            <div class="comment bloc-flex">
                <div class="w-20 mobil m50 pl"><?= $annonce->titre;?></div><!--
                --><div class="w-20"><?= $annonce->autor;?></div><!--
                --><div class="w-45 mobil m50"><?= substr($annonce->content, 0, 100);?></div><!--
                --><div class="ac w-5 mobil m50"><a href="<?= $annonce->getUrl('view.annonce');?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
                --><div class="ac w-5 mobil m50"><a href="<?= $annonce->getUrl('edit.annonce');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
                --><div class="ac w-5 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $annonce->getUrl('delete.annonce', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;
        endif; ?>
        <div class="ajout"><a href="<?= Table::add('annonce');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une annonce</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc">Evénements</div>
        <?php
        $agendas = Agenda::last(3);
        foreach ($agendas AS $agenda) : ?>
            <div class="compterendu bloc-flex">
                <div class="name w-20 pl mobil m50"><?= $agenda->temps;?></div><!--
                --><div class="w-60 mobil m50"><?= $agenda->nom;?></div><!--
                --><div class="ac w-10 ac mobil m50"><a href="<?= $agenda->getUrl('view.agenda');?>" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
                --><div class="ac w-10 ac mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $agenda->getUrl('delete.agenda', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('agenda');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Evénement</span></a></div>
    </div>
</div>
<div class="flex">
    <div class="bloc bloc-60">
        <div class="titre-bloc">Actualité</div>
        <?php
        $articles = Article::last(3);
        foreach ($articles AS $article) : ?>
            <div class="compterendu bloc-flex">
                <div class="name w-20 pl mobil m50"><?= $article->temps;?></div><!--
                --><div class="w-60 mobil m50"><?= $article->news_title;?></div><!--
                --><div class="ac w-10 mobil m50"><a href="<?= $article->getUrl('view.article');?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
                --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $article->getUrl('delete.article', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('article');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une actualité</span></a></div>
    </div>
    <div class="bloc bloc-40">
        <div class="titre-bloc jaune">Fichiers PDF</div>
        <?php
            $fichiers = Fichier::last(3);
            foreach ($fichiers AS $fichier) : ?>
                <div class="compterendu bloc-flex">
                    <div class="w-25 pl mobil m50"><?= $fichier->temps;?></div><!--
                --><div class="w-55 mobil m50"><?= $fichier->nom_fichier;?></div><!--
                --><div class="ac w-10 mobil m50"><a href="../fichier/<?= $fichier->fichier;?>" target="_blank" title="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
                --><div class="ac w-10 mobil m50">
                        <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $fichier->getUrl('delete.fichier', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                    </div>
                </div>
            <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('fichier');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Fichier</span></a></div>
    </div>
</div>
<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Boutique</div>
        <?php
        $produits = Produit::last(3);
        foreach ($produits AS $produit) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-45 pl mobil m100"><?= $produit->nom;?></div><!--
                --><div class="w-20 mobil m50"><?= $produit->prix;?>,00 €</div><!--
                --><div class="w-15 mobil m50">QT : <?= $produit->quantite;?></div><!--
                --><div class="ac w-10 mobil m50"><a href="<?= $produit->getUrl('view.produit');?>" class="Aperçu"><i class="ion-ios-search-strong cbleu"></i></a></div><!--
                --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $produit->getUrl('delete.produit', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('produit');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Produit</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc">Partenaires</div>
        <?php
        $partenaires = Partenaire::last(3);
        foreach ($partenaires AS $partenaire) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-50 pl mobil m50"><?= $partenaire->nom;?></div><!--
                --><div class="w-30 mobil m50"><?= $partenaire->cle;?></div><!--
                --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $partenaire->getUrl('delete.partenaire', true);?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('partenaire');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Partenaire</span></a></div>
    </div>
</div>
<div class="flex">
    <div class="bloc bloc-50">
        <div class="titre-bloc">Accès aux Pages</div>
        <?php
        $pages = Page::last(3);
        foreach ($pages AS $page_menu) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-25 pl mobil m100"><?= $page_menu->titre;?></div><!--
                --><div class="w-55 mobil m50"><?= $page_menu->description;?></div><!--
                --><div class="ac w-10 mobil m50"><a href="<?= $page_menu->getUrl('edit.page');?>" title="&#201;diter"><i class="ion-edit cvert"></i></a></div><!--
                --><div class="ac w-10 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $page_menu->getUrl('delete.page');?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('page');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Page</span></a></div>
    </div>
    <div class="bloc bloc-50">
        <div class="titre-bloc jaune">Informations</div>
        <?php
        $informations = Information::last('Triathlons');
        foreach ($informations AS $information) : ?>
            <div class="compterendu bloc-flex">
                <div class="w-60 pl mobil m50"><?= $information->texte;?></div><!--
                --><div class="w-35 ac mobil m50"><?= $information->cle;?></div><!--
                --><div class="ac w-5 mobil m50">
                    <a href="#" class="tooltip" title="Supprimer" onClick="javascript:ouvrePopUp('<?= $information->getUrl('delete.information');?>','Suppression','430','207');"><i class="ion-close-round crouge"></i></a>
                </div>
            </div>
        <?php endforeach;?>
        <div class="ajout"><a href="<?= Table::add('information');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une Information</span></a></div>
    </div>
</div>

<div class="flex">
    <div class="bloc bloc-30">
        <div class="titre-bloc">Album </div>
        <div class="ajout"><a href="<?= Table::add('album');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un album</span></a></div>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Programme </div>
        <div class="ajout"><a href="<?= Table::add('programme');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter un Programme</span></a></div>
    </div>
    <div class="bloc bloc-30">
        <div class="titre-bloc">Réglementation </div>
        <div class="ajout"><a href="<?= Table::add('reglementation');?>"><span class="icon icon-add"><i class="ion-plus-round"></i></span> <span class="text-add">Ajouter une réglementation</span></a></div>
    </div>
</div>