<?php
session_start();
date_default_timezone_set('Europe/Paris');
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
// routing
$page = 'home';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

// zone de la langue
if(!isset($_COOKIE['lang'])) :
    // si le cookie n'existe pas -> definition de la langue par défaut en FR puis creation du Cookie de la langue.
    $lang = "fr_FR";
    setcookie('lang', $lang, time() + 2592000);
    $_COOKIE['lang'] = $lang;
elseif(isset($_GET['lang'])) :
    // Si une valeur est envoyée alors on change la langue du cookie en définissant celui transmis.
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 2592000);
    $_COOKIE['lang'] = $lang;
endif;
// Controle du cookie -> si existe et que la valeur est de fr_FR ou en_EN on initialise la valeur $lang,
// sinon on défini par défaut en fr_FR
if(isset($_COOKIE['lang']) AND $_COOKIE['lang'] === 'fr_FR' OR $_COOKIE['lang'] === 'en_EN' OR $_COOKIE['lang'] === 'nl_NL' OR $_COOKIE['lang'] === 'de_DE'):
    $lang = $_COOKIE['lang'];
else :
    $lang = 'fr_FR';
endif;

putenv('LC_ALL=' . $lang);
setlocale(LC_ALL, $lang);

// Rendu du template
$loader = new Twig_Loader_Filesystem(__DIR__ . '/template');
$twig = new Twig_Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'autoload' => true,
]);
$twig->addExtension(new Extension());
$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addExtension(new Twig_Extensions_Extension_Intl());
$twig->addExtension(new Twig_Extensions_Extension_I18n());
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('cookie', $_COOKIE);

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

// chargement du fichiers selon la langue sélectionnée.
if($lang === 'fr_FR') :
    include_once 'lang/fr_FR/FR.php';
    $trad = $traduction['FR'];
elseif($lang === 'en_EN') :
    include_once 'lang/en_EN/EN.php';
    $trad = $traduction['EN'];
elseif($lang === 'nl_NL') :
    include_once 'lang/nl_NL/NL.php';
    $trad = $traduction['NL'];
endif;

switch ($page) {
    case 'contact' :
        echo $twig->render('contact/contact.twig', [
            'traduction' => $trad,
            'cookie'     => $_COOKIE,
            ($_SESSION) ? [
                'inputs' => $_SESSION['inputs'],
                'errors' => $_SESSION['errors'],
                'success' => $_SESSION['success'],
            ] : [],
        ]);
        break;
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
            'resultats'     => $resultats,
            'traduction'    => $trad,
            'cookie'        => $_COOKIE,
        ]);
        break;
    case 'new':
        echo $twig->render('article/article.twig', [
            'article'       => $article,
            'traduction'    => $trad,
            'cookie'        => $_COOKIE['lang'],
        ]);
        break;
    case 'actualites':
        echo $twig->render('actualites/actualites.twig', [
            'articles'       => $actualites,
            'traduction'    => $trad,
            'cookie'        => $_COOKIE,
        ]);
        break;
    case 'resultats':
        echo $twig->render('resultats/resultats.twig', [
            'archives'     => $archives,
            'traduction'    => $trad,
            'cookie'        => $_COOKIE,
        ]);
        break;
    case 'course':
        echo $twig->render('course/course.twig', [
            'course'        => $course,
            'traduction'    => $trad,
            'cookie'        => $_COOKIE,
        ]);
        break;
    case 'mentions':
        echo $twig->render('other/mentions.twig', [
            'traduction'    => $trad,
            'cookie'        => $_COOKIE,
        ]);
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
    break;
}
unset($_SESSION['inputs']);
unset($_SESSION['errors']);
unset($_SESSION['success']);