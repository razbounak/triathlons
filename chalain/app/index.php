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

        // COURSES
        case 'courses' :
            require ROOT . '/Views/Courses/courses.php';
            break;
        case 'add.course' :
            require ROOT . '/Views/Courses/add.course.php';
            break;
        case 'view.course' :
            require ROOT . '/Views/Courses/view.course.php';
            break;
        case 'edit.course' :
            require ROOT . '/Views/Courses/edit.course.php';
            break;
        case 'valide.course' :
            require ROOT . '/Views/Courses/valide.course.php';
            break;
        case 'delete.course' :
            require ROOT . '/Views/Courses/delete.course.php';
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

        // PARAMETRES
        case 'parametres' :
            require ROOT . '/Views/Parametres/parametres.php';
            break;
        case 'edit.parametre' :
            require ROOT . '/Views/Parametres/edit.parametre.php';
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

        // PROGRAMMES
        case 'programmes' :
            require ROOT . '/Views/Programmes/programmes.php';
            break;
        case 'edit.programme' :
            require ROOT . '/Views/Programmes/edit.programme.php';
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

        // PROGRAMMES
        case 'programmes' :
            require ROOT . '/Views/Programmes/programmes.php';
            break;
        case 'add.programme' :
            require ROOT . '/Views/Programmes/add.programme.php';
            break;
        case 'edit.programme' :
            require ROOT . '/Views/Programmes/edit.programme.php';
            break;
        case 'view.programme' :
            require ROOT . '/Views/Programmes/view.programme.php';
            break;
        case 'delete.programme' :
            require ROOT . '/Views/Programmes/delete.programme.php';
            break;

        case 'home' :
            require ROOT . '/Views/home.php';
            break;
        case 'add.rapport' :
            require ROOT . '/Views/Help/add.rapport.php';
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
    require ROOT . '/Views/template/delete.php';
else :
    require ROOT . '/Views/template/default.php';
endif;