<?php
session_start();
date_default_timezone_set('Europe/Paris');
putenv('LC_ALL= fr_FR');
setlocale(LC_ALL, 'fr_FR');
use App\Article\Article;
use App\Course\Course;
use App\Information\Information;
use App\Partenaire\Partenaire;
use App\Programme\Programme;
use App\Reglement\Reglement;
use App\Parametre\Parametre;
use App\Resultat\Resultat;

require "vendor/autoload.php";
require 'app/App/Autoloader.php';
\App\Autoloader::register();
require 'vendor/Extension.php';

// ROUTING
$page = 'home';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

// Rendu du template
$loader = new Twig_Loader_Filesystem(__DIR__ . '/template');
$twig = new Twig_Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'autoload' => true,
]);
$twig->addExtension(new Extension());
$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addExtension(new Twig_Extensions_Extension_Intl());
$twig->addGlobal('session', $_SESSION);

$id = null;
if(isset($_GET['id']) ) :
    // verifier que la valeur est bien un nombre entier
    if(ctype_digit($_GET['id'])) :
        $id = $_GET['id'];
        $course = Course::find($id);
        $article = Article::find($id);
        $resultat = Resultat::find($id);
    else :
        // sinon renvoie à la page d'accueil
        header('Location : index.php');
    endif;
endif;

// CONNEXION A LA BASE DE DONNEES
$courses = Course::all();
$articles = Article::last(3);
$inscrits = Course::inscription();
$partenaires = Partenaire::all();
$programmes = Programme::all();
$reglements = Reglement::all();
$temperature = Parametre::AfficheT(1);
$compteur = Parametre::AfficheDecompte(1);
$informations = Information::last();
$resultats = Resultat::last(5);
$archives = Resultat::all();
$actualites = Article::all();

switch($page) {
    case 'home':
        echo $twig->render('home.twig', [
            'courses'       => $courses,
            'inscrits'      => $inscrits,
            'article'       => $articles,
            'partenaires'   => $partenaires,
            'programmes'    => $programmes,
            'reglements'    => $reglements,
            'temperature'   => $temperature,
            'compteur'      => $compteur,
            'informations'  => $informations,
            'resultats'     => $resultats
        ]);
        break;
    case 'contact' :
        echo $twig->render('contact/contact.twig', [
            ($_SESSION) ? [
                'inputs' => $_SESSION['inputs'],
                'errors' => $_SESSION['errors'],
                'success' => $_SESSION['success'],
            ] : [],
        ]);
        break;
    case 'new':
        echo $twig->render('article/article.twig', [
            'article'       => $article
        ]);
        break;
    case 'actualites':
        echo $twig->render('actualites/actualites.twig', [
            'articles'      => $actualites
        ]);
        break;
    case 'resultats':
        echo $twig->render('resultats/resultats.twig', [
            'archives'     => $archives
        ]);
        break;
    case 'course':
        echo $twig->render('course/course.twig', [
            'course'        => $course
        ]);
        break;
    case 'mentions':
        echo $twig->render('other/mentions.twig', []);
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
    break;
}
unset($_SESSION['inputs']);
unset($_SESSION['errors']);
unset($_SESSION['success']);