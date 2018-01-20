<?php
/*
* Created by PhpStorm.
* User: FCWD
* Date: 15/12/2017
* Time: 17:39
*/
session_start();
define('ROOT', __DIR__);

use App\Auth\Auth;

require 'App/Autoloader.php';
\App\Autoloader::register();

$admin = new Auth();

if($admin->IsLogged() === false && !isset($_COOKIE['Admin'])) :
    $admin->Redirect('login');
endif;

if (isset($_GET['page'])) :
    $page = $_GET['page'];
else :
    $admin->Redirect('home');
endif;

ob_start();

if($admin->IsLogged()) :
    switch ($page) :
        // ACTUALITES
        case 'articles' :
            require ROOT . '/Views/Articles/articles.php';
            break;
        case 'add.article' :
            require ROOT . '/Views/Articles/add.article.php';
            break;
        case 'view.article' :
            require ROOT . '/Views/Articles/view.article.php';
            break;
        case 'edit.article' :
            require ROOT . '/Views/Articles/edit.article.php';
            break;
        case 'delete.article' :
            require ROOT . '/Views/Articles/delete.article.php';
            break;

        // AGENDA
        case 'agenda' :
            require ROOT . '/Views/Agenda/agenda.php';
            break;
        case 'add.agenda' :
            require ROOT . '/Views/Agenda/add.agenda.php';
            break;
        case 'view.agenda' :
            require ROOT . '/Views/Agenda/view.agenda.php';
            break;
        case 'edit.agenda' :
            require ROOT . '/Views/Agenda/edit.agenda.php';
            break;
        case 'delete.agenda' :
            require ROOT . '/Views/Agenda/delete.agenda.php';
            break;

        // ALBUMS
        case 'albums' :
            require ROOT . '/Views/Albums/albums.php';
            break;
        case 'add.album' :
            require ROOT . '/Views/Albums/add.album.php';
            break;
        case 'view.album' :
            require ROOT . '/Views/Albums/view.album.php';
            break;
        case 'delete.album' :
            require ROOT . '/Views/Albums/delete.album.php';
            break;

        // ANNONCES
        case 'annonces' :
            require ROOT . '/Views/Annonces/annonces.php';
            break;
        case 'add.annonce' :
            require ROOT . '/Views/Annonces/add.annonce.php';
            break;
        case 'view.annonce' :
            require ROOT . '/Views/Annonces/view.annonce.php';
            break;
        case 'edit.annonce' :
            require ROOT . '/Views/Annonces/edit.annonce.php';
            break;
        case 'valide.annonce' :
            require ROOT . '/Views/Annonces/valide.annonce.php';
            break;
        case 'delete.annonce' :
            require ROOT . '/Views/Annonces/delete.annonce.php';
            break;

        // DIAPORAMA
        case 'diaporama' :
            require ROOT . '/Views/Diaporama/diaporama.php';
            break;
        case 'edit.diaporama' :
            require ROOT . '/Views/Diaporama/edit.diaporama.php';
            break;

        // FICHIERS
        case 'fichiers' :
            require ROOT . '/Views/Fichiers/fichiers.php';
            break;
        case 'add.fichier' :
            require ROOT . '/Views/Fichiers/add.fichier.php';
            break;
        case 'delete.fichier' :
            require ROOT . '/Views/Fichiers/delete.fichier.php';
            break;

        // CLUBS
        case 'clubs' :
            require ROOT . '/Views/Clubs/clubs.php';
            break;
        case 'add.club' :
            require ROOT . '/Views/Clubs/add.club.php';
            break;
        case 'delete.club' :
            require ROOT . '/Views/Clubs/delete.club.php';
            break;

        // INFORMATIONS
        case 'informations' :
            require ROOT . '/Views/Informations/informations.php';
            break;
        case 'add.information' :
            require ROOT . '/Views/Informations/add.information.php';
            break;
        case 'delete.information' :
            require ROOT . '/Views/Informations/delete.information.php';
            break;

        // PAGES
        case 'pages' :
            require ROOT . '/Views/Pages/pages.php';
            break;
        case 'add.page' :
            require ROOT . '/Views/Pages/add.page.php';
            break;
        case 'edit.page' :
            require ROOT . '/Views/Pages/edit.page.php';
            break;
        case 'delete.page' :
            require ROOT . '/Views/Pages/delete.page.php';
            break;

        // PARTENAIRES
        case 'partenaires' :
            require ROOT . '/Views/Partenaires/partenaires.php';
            break;
        case 'add.partenaire' :
            require ROOT . '/Views/Partenaires/add.partenaire.php';
            break;
        case 'delete.partenaire' :
            require ROOT . '/Views/Partenaires/delete.partenaire.php';
            break;

        // PRODUITS
        case 'produits' :
            require ROOT . '/Views/Produits/produits.php';
            break;
        case 'add.produit' :
            require ROOT . '/Views/Produits/add.produit.php';
            break;
        case 'edit.produit' :
            require ROOT . '/Views/Produits/edit.produit.php';
            break;
        case 'view.produit' :
            require ROOT . '/Views/Produits/view.produit.php';
            break;
        case 'delete.produit' :
            require ROOT . '/Views/Produits/delete.produit.php';
            break;

        case 'home' :
            require ROOT . '/Views/home.php';
            break;
        case 'add.rapport' :
            require ROOT . '/Views/Help/add.rapport.php';
            break;

        // SITE DE CHALAIN
        case 'home.chalain' :
            require ROOT .'/Views/SiteChalain/home.chalain.php';
            break;

        // ARTICLE
        case 'edit.article.chalain' :
            require ROOT . '/Views/SiteChalain/edit.article.chalain.php';
            break;
        case 'add.article.chalain' :
            require ROOT . '/Views/SiteChalain/add.article.chalain.php';
            break;
        case 'delete.article.chalain' :
            require ROOT . '/Views/SiteChalain/delete.article.chalain.php';
            break;
        case 'articles.chalain' :
            require ROOT . '/Views/SiteChalain/articles.chalain.php';
            break;

            // TEMPERATURE
        case 'edit.temperature' :
            require ROOT . '/Views/SiteChalain/edit.temperature.php';
            break;

            // SPONSORS
        case 'add.sponsor' :
            require ROOT . "/Views/SiteChalain/add.sponsor.php";
            break;
        case 'sponsors' :
            require ROOT . "/Views/SiteChalain/sponsors.php";
            break;
        case 'delete.sponsor' :
            require ROOT . "/Views/SiteChalain/delete.sponsor.php";
            break;

            // PROGRAMME
        case 'edit.programme.chalain' :
            require ROOT . "/Views/SiteChalain/edit.programme.chalain.php";
            break;

            // COURSES
        case 'edit.course.chalain' :
            require ROOT . "/Views/SiteChalain/edit.course.chalain.php";
            break;

        // FICHIERS
        case 'pdf.chalain' :
            require ROOT . "/Views/SiteChalain/pdf.chalain.php";
            break;
        case 'add.pdf.chalain' :
            require ROOT . "/Views/SiteChalain/add.pdf.chalain.php";
            break;
        case 'delete.pdf.chalain' :
            require ROOT . "/Views/SiteChalain/delete.pdf.chalain.php";
            break;

        // INSCRIPTIONS
        case 'edit.inscription.chalain' :
            require ROOT . "/Views/SiteChalain/edit.inscription.chalain.php";
            break;

        // WARNING
        case 'warning' :
            require ROOT . "/Views/SiteChalain/warning.php";
            break;
        case 'add.warning' :
            require ROOT . "/Views/SiteChalain/add.warning.php";
            break;
        case 'edit.warning' :
            require ROOT . "/Views/SiteChalain/edit.warning.php";
            break;
        case 'delete.warning' :
            require ROOT . "/Views/SiteChalain/delete.warning.php";
            break;

        // REGLEMENTATION
        case 'edit.reglement.chalain' :
            require ROOT . "/Views/SiteChalain/edit.reglement.chalain.php";
            break;

        // RESULTATS
        case 'add.resultat.chalain' :
            require ROOT . "/Views/SiteChalain/add.resultat.chalain.php";
            break;
        case 'resultats' :
            require ROOT . "/Views/SiteChalain/resultats.php";
            break;
        case 'delete.resultat.chalain' :
            require ROOT . "/Views/SiteChalain/delete.resultat.chalain.php";
            break;

        // SITE DE LA CORRIDA
        case 'home.corrida' :
            require ROOT .'/Views/Corrida/home.corrida.php';
            break;

        // ARTICLE
        case 'edit.article.corrida' :
            require ROOT . '/Views/Corrida/edit.article.corrida.php';
            break;
        case 'add.article.corrida' :
            require ROOT . '/Views/Corrida/add.article.corrida.php';
            break;
        case 'delete.article.corrida' :
            require ROOT . '/Views/Corrida/delete.article.corrida.php';
            break;
        case 'articles.corrida' :
            require ROOT . '/Views/Corrida/articles.corrida.php';
            break;

        // SPONSORS
        case 'add.sponsor.corrida' :
            require ROOT . "/Views/Corrida/add.sponsor.corrida.php";
            break;
        case 'corrida.sponsors' :
            require ROOT . "/Views/Corrida/corrida.resultats.php";
            break;
        case 'delete.sponsor.corrida' :
            require ROOT . "/Views/Corrida/delete.sponsor.corrida.php";
            break;

        // PROGRAMME
        case 'edit.programme.corrida' :
            require ROOT . "/Views/Corrida/edit.programme.corrida.php";
            break;

        // COURSES
        case 'edit.course.corrida' :
            require ROOT . "/Views/Corrida/edit.course.corrida.php";
            break;

        // FICHIERS
        case 'pdf.corrida' :
            require ROOT . "/Views/Corrida/pdf.corrida.php";
            break;
        case 'add.pdf.corrida' :
            require ROOT . "/Views/Corrida/add.pdf.corrida.php";
            break;
        case 'delete.pdf.corrida' :
            require ROOT . "/Views/Corrida/delete.pdf.corrida.php";
            break;

        // INSCRIPTIONS
        case 'edit.inscription.corrida' :
            require ROOT . "/Views/Corrida/edit.inscription.corrida.php";
            break;

        // REGLEMENTATION
        case 'edit.reglement.corrida' :
            require ROOT . "/Views/Corrida/edit.reglement.corrida.php";
            break;

        // RESULTATS
        case 'add.resultat.corrida' :
            require ROOT . "/Views/Corrida/add.resultat.corrida.php";
            break;
        case 'corrida.resultats' :
            require ROOT . "/Views/Corrida/corrida.resultats.php";
            break;
        case 'delete.resultat.corrida' :
            require ROOT . "/Views/Corrida/delete.resultat.corrida.php";
            break;

        // ZONE MEMBRE
        case 'home.membre' :
            require ROOT . '/Views/Membres/home.membre.php';
            break;
        case 'entrainements' :
            require ROOT . '/Views/Membres/entrainements.php' ;
            break;
        case 'add.entrainement' :
            require ROOT . '/Views/Membres/add.entrainement.php' ;
            break;
        case 'edit.entrainement' :
            require ROOT . '/Views/Membres/edit.entrainement.php' ;
            break;
        case 'delete.programme' :
            require ROOT . '/Views/Membres/delete.entrainement.php' ;
            break;
        case 'documents.membre' :
            require ROOT . '/Views/Membres/documents.membre.php' ;
            break;
        case 'add.document.membre' :
            require ROOT . '/Views/Membres/add.document.membre.php' ;
            break;
        case 'edit.document.membre' :
            require ROOT . '/Views/Membres/edit.document.membre.php' ;
            break;
        case 'delete.document.membre' :
            require ROOT . '/Views/Membres/delete.document.membre.php' ;
            break;
        case 'parcours' :
            require ROOT . '/Views/Membres/parcours.php' ;
            break;
        case 'add.parcours' :
            require ROOT . '/Views/Membres/parcours.php' ;
            break;
        case 'edit.parcours' :
            require ROOT . '/Views/Membres/parcours.php' ;
            break;
        case 'delete.parcours' :
            require ROOT . '/Views/Membres/parcours.php' ;
            break;

        // CONNEXION / DECONNEXION
        case 'logout':
            require ROOT . '/Views/Admin/logout.php';
            break;
        case 'login':
            require ROOT . '/Views/Admin/login.php';
            break;
        case 'edit.admin':
            require ROOT . '/Views/Admin/edit.admin.php';
            break;

    endswitch;
else :
    require ROOT . '/Views/Admin/login.php';
endif;

$content = ob_get_clean();
$parts = explode('.', $page);
$id = $parts[0];
if($id === 'delete') :
    require ROOT . '/Template/delete.php';
else :
    require ROOT . '/Template/default.php';
endif;