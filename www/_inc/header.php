<?php
use App\Page\Page;

session_start();
require_once 'cnx.php';
require 'app/App/Autoloader.php';
\App\Autoloader::register();

$pages = Page::findKey('club');
$results = Page::findKey('adhesion');

?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title><?= $title; ?></title>
    <?php
        $texte = explode(" ", $description);
        $i = 0;
    ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/slit-slider.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#262c42">
    <meta name="msapplication-TileColor" content="#262c42">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#262c42">
    <meta name="apple-mobile-web-app-title" content="Triath'Lons">
    <meta name="application-name" content="Triath'Lons">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <?php
        if(!empty($twos->image))
            echo '<meta property="og:image" content="https://www.triathlons.fr/image/' . $twos->image . '" />';
        if(!empty($description))
            echo '<meta property="og:description" content="' . $description . '"/>';
    ?>
</head>
<body>
<header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">
    <div class="container">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header"><a href="index.php"><img src="theme/triathlogo.png" width="230" alt="logo triathlons"></a></div>
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li class="jaune"><a href="https://forum.triathlons.fr" target="_blank"><i class="fa fa-list-alt"></i> Forum</a></li>
                <li class="jaune"><a href="https://membre.triathlons.fr" target="_blank"><i class="fa fa-user-circle-o"></i> Accès membres</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <nav class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Accueil</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Le club <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($pages AS $page_menu) :?>
                            <li><a href="page.php?id=<?= $page_menu->id;?>"><?= $page_menu->titre;?></a></li>
                        <?php endforeach;?>
                        <li class="divider" role="separator"></li>
                        <li><a href="vma/index.html" target="_blank">Calculateur VMA</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Adhésion<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($results as $page_menu) :?>
                            <li><a href="page.php?id=<?= $page_menu->id;?>"><?= $page_menu->titre;?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Boutique <i class="caret"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="boutique.php">Boutique</a></li>
                        <li><a href="petitesannonces.php">Petites annonces</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Photo / Vidéo <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="photo.php">Photo</a></li>
                        <li><a href="video.php">Vidéo</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Partenaires <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="partenaires.php">Partenaires</a></li>
                        <li><a href="clubs.php">Clubs Franc-comtois</a></li>
                        <li><a href="http://fftri.com/" target="_blank">FFTRI</a></li>
                        <li><a href="http://triathlon-franche-comte.onlinetri.com/" target="_blank">Ligue de Franche-comté</a></li>
                    </ul>
                </li>
                <li><a href="http://chalain.triathlons.fr/">Triathlon de Chalain</a></li>
                <li><a href="http://corrida.triathlons.fr/">Corrida du parc</a></li>
            </ul>
        </nav>
    </div>
</header>