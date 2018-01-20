<?php
use App\Page\Page;

$title = 'Plan du site';
    $description = 'Plan du site';
    include '_inc/header.php';
?>
<main class="site-content" role="main">
    <section>
        <div class="container">
            <div class="row">
                <div class="sec-title text-center"><br>
                    <h2 class="wow animated bounceInLeft">Plan du site</h2>
                </div>
                <div class="col-md-offset-1 col-md-10">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li>
                            <a href="#">Le club <span class="caret"></span></a>
                            <ul>
                                <?php $pages = Page::findKey('club');
                                foreach ($pages AS $page_menu) :?>
                                    <li><a href="page.php?id=<?= $page_menu->id;?>"><?= $page_menu->titre;?></a></li>
                                <?php endforeach;?>
                                <li><a href="vma/index.html" target="_blank">Calculateur VMA</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Accès membre</a></li>
                        <li>
                            <a href="#">Adhésion <span class="caret"></span></a>
                            <ul>
                                <?php $pages = Page::findKey('adhesion');
                                foreach ($pages AS $page_menu) :?>
                                    <li><a href="page.php?id=<?= $page_menu->id;?>"><?= $page_menu->titre;?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <li><a href="all.php">Actualités</a></li>
                        <li>
                            <a href="#">Boutique <i class="caret"></i></a>
                            <ul>
                                <li><a href="boutique.php">Boutique</a></li>
                                <li><a href="petitesannonces.php">Petites annonces</a></li>
                            </ul>
                        </li>
                        <li><a href="forum.triathlons.fr">Forum</a></li>
                        <li class="">
                            <a href="#">Photo / Vidéo <span class="caret"></span></a>
                            <ul>
                                <li><a href="photo.php">Photo</a></li>
                                <li><a href="video.php">Vidéo</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="#">Partenaires  <i class="caret"></i></a>
                            <ul>
                                <li><a href="partenaires.php">Partenaires</a></li>
                                <li><a href="clubs.php">Clubs franc comtois</a></li>
                                <li><a href="http://fftri.com/" target="_blank">FFTRI</a></li>
                                <li><a href="http://triathlon-franche-comte.onlinetri.com/" target="_blank">Ligue de Franche-comté</a></li>
                            </ul>
                        </li>
                        <li><a href="chalain/index.php">Triathlon de Chalain</a></li>
                        <li><a href="corrida/index.php">Corrida du parc</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    include '_inc/footer.php';
?>

