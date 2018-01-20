<?php
use App\Diapo\Diapo;
use App\Date\Date;
use App\Information\Information;

$title = "Triath'Lons | Club de triathlon de Lons Le Saunier - Jura";
	$description = 'Actualités et vie du club de triatlon de Lons le Saunier | Triath\'Lons';
	require('_inc/header.php');
	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d");
// actualité
$actu = $bdd->query("SELECT *, 
                            DATE_FORMAT(news_date, '%d') AS jour, 
                            DATE_FORMAT(news_date, '%m') AS mois, 
                            DATE_FORMAT(news_date, '%Y') AS annee
                            FROM news 
                            ORDER BY news_date DESC LIMIT 0, 4");

$evenements = \App\Agenda\Agenda::last();
// Partenaires
$partenaires = $bdd->query("SELECT * FROM partenaires");

$image1 = Diapo::find(1);
$image2 = Diapo::find(2);
$image3 = Diapo::find(3);
?>
<style>
    .diapo {
        position: fixed;
        z-index:100;
        bottom: 0;
        width:100%;
    }
    .tickercontainer {
        background-color: #fc0;
        height: 60px;
        line-height:50px;
        margin: 0;
        padding: 0;
        overflow: hidden;
        width: 100%;
    }
    .tickercontainer .mask {
        position: relative;
        left: 10px;
        top: 8px;
        width: 100%;
        overflow: hidden;
    }
    ul.newsticker {
        position: relative;
        left: 100%;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    ul.newsticker li {
        float: left;
        margin: 0 15px 0 0;
        padding: 0;
        font-weight: bold;
        color: #009ee3;
    }
    ul.newsticker  {
        white-space: nowrap;
        padding: 0;
        margin: 0 50px 0 0;
        font-size: 1.5em;
        font-family: 'Pathway Gothic One';
        color: #262626;
        text-transform: uppercase;
    }
    ul.newsticker span {
        margin: 0 10px 0 0;
    }
    ul.newsticker li strong {
        color: #262626;
    }
    ul.newsticker li >  * {
        line-height:50px;
        height:50px;
    }
    .bg-img-1 {
        background-image: url('img/slider/<?php echo $image1->image;?>');
    }
    .bg-img-2 {
        background-image: url('img/slider/<?php echo $image2->image;?>');
    }
    .bg-img-3 {
        background-image: url('img/slider/<?php echo $image3->image;?>');
    }
    #footer {
        padding-bottom: 75px;
    }
</style>
<body class="site-content">
	<div id="home-slider">
        <div id="slider" class="sl-slider-wrapper">
			<div class="sl-slider">
				<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
					<div class="bg-img bg-img-1"></div>
					<div class="slide-caption">
                        <div class="caption-content">
                            <a href="#actu" class="bounce"><img src="theme/circle.png" alt=""></a>
                        </div>
                    </div>
				</div>
				<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
					<div class="bg-img bg-img-2"></div>
				</div>
				<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
					<div class="bg-img bg-img-3"></div>
				</div>
			</div>
            <nav id="nav-arrows" class="nav-arrows hidden-xs hidden-sm visible-md visible-lg">
                <a href="javascript:;" class="sl-prev">
                    <i class="fa fa-angle-left fa-3x"></i>
                </a>
                <a href="javascript:;" class="sl-next">
                    <i class="fa fa-angle-right fa-3x"></i>
                </a>
            </nav>
			<nav id="nav-dots" class="nav-dots visible-xs visible-sm hidden-md hidden-lg">
				<span class="nav-dot-current"></span>
				<span></span>
				<span></span>
			</nav>
		</div>
	</div>
    <section class="index">
		<div class="container" id="actu">
			<div class="row">
				<div class="sec-title text-center">
					<h2>Actualités</h2>
				</div>
				<ul class="project-wrapper">
					<?php foreach ($actu AS $blog) : ?>
                        <li class="portfolio-item">
                            <a href="news.php?id=<?= $blog->news_id;?>">
                                <div class="date"><i class="fa fa-calendar"></i> le <?= $blog->jour . ' ' . Date::getMois($blog->mois) . ' ' . $blog->annee;?></div>
                                <div class="image">
                                <?php
                                    if(!empty($blog->thumbnail)) :
                                        echo '<img src="thumbnail/' . $blog->thumbnail . '" alt="' . $blog->news_title . '"/>';
                                    elseif(empty($blog->image)) :
                                        echo '<img src="image/triathlons.png" width="390" alt="' . $blog->news_title . '"/>';
                                    else :
                                        echo '<img src="image/' . $blog->image . '" alt="' . $blog->news_title . '"/>';
                                    endif;
                                ?>
                                </div>
                                <div class="desc">
                                    <h3><?= $blog->news_title; ?></h3>
                                    <div class="text"><?= substr($blog->news_body, 0, 210) . '...'; ?></div>
                                    <div class="link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Lire la suite</div>
                                </div>
                            </a>
                        </li>
					<?php endforeach; ?>
				</ul>
		            <div class="text-center"><a href="all.php" class="btn btn-blue btn-effect">Voir toutes les actualités</a></div>
			</div>
		</div>
	</section>
    <?php if(!empty($evenements)) : ?>
	<section class="index">
		<div class="overlay">
			<div class="container">
				<div class="row">
					<div class="sec-title text-center">
						<h2>Prochains événements</h2>
					</div>
					<div>
                        <?php foreach ($evenements AS $event) :
                            if(!empty($event->lien)) :?>
                                <a target="_blank" href="<?= $event->lien;?>">
                                    <div class="col-md-6">
                                        <div class="bloc-event bdl">
                                            <div class="col-lg-2 text-center">
                                                <span class="big xx"><?= $event->jour;?></span><!--
                                                --><span class="month"><?= Date::getMois($event->mois);?></span><!--
                                                --><span class="year"><?= $event->annee;?></span>
                                            </div>
                                            <div class="col-lg-10">
                                                <h4><?= $event->nom ;?></h4>
                                                <div class="lieu"><?= $event->lieu;?></div>
                                                <div class="city"><?= $event->ville;?></div>
                                            </div>
                                        </div>
                                        <div class="lien"><i class="fa fa-plus-square-o" aria-hidden="true"></i> plus d'informations</div>
                                    </div>
                                </a>
                            <?php else : ?>
                                <div class="col-md-6">
                                    <div class="bloc-event bdl">
                                        <div class="col-lg-2 text-center">
                                            <span class="big"><?= $event->jour;?></span><!--
                                            --><span class="month"><?= Date::getMois($event->mois);?></span><!--
                                            --><span class="year"><?= $event->annee;?></span>
                                        </div>
                                        <div class="col-lg-10">
                                            <h4><?= $event->nom ;?></h4>
                                            <div class="lieu"><?= $event->lieu ;?></div>
                                            <div class="city"><?= $event->ville ;?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                        endforeach; ?>
                    </div>
				</div>
			</div>
		</div>
	</section>
    <?php endif;?>
	<section id="service" class="index">
		<div class="container">
			<div class="row">
				<div class="sec-title text-center">
					<h2>Nos Partenaires</h2>
					<p>Ils sont là pour nous</p>
				</div>
                <?php foreach ($partenaires AS $partenaire) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
                        <div class="service-item">
                            <a target="_blank" href="<?= $partenaire->site;?>">
                                <img src="image/<?= $partenaire->image;?>" height="200" alt="<?= $partenaire->nom;?>">
                                <h3><?= $partenaire->nom;?></h3>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
	<section class="about index">
		<div class="container">
			<div class="row">
                <div class="sec-title text-center white">
                    <h2>Entrainements</h2>
                </div>
				<div class="col-md-4">
					<div class="recent-works">
						<h3>Entraînements Jeunes</h3>
						<div id="works">
							<div class="work-item">
								<h4>Natation</h4>
								<p>Mardi 17h - 18h30 (2)</p>
								<p>Mardi 18h30 - 20h00 (1)</p>
								<p>Jeudi 16h30 - 18h00 (2)</p>
								<p>Vendredi 17h - 18h30 (2)</p>
								<p>Vendredi 18h - 20h (1)</p>
								<p>Samedi 12h - 13h30 (1)</p>
							</div>
							<div class="work-item">
								<h4>Vélo</h4>
								<p>Mercredi 14h00 - 15h00 (Pupilles et Benjamins Confirmés)</p>
								<p>Mercredi 15h30 - 17h00 (1)</p>
								<p>Samedi 9h - 11h00 (Groupe 2 Tous Niveaux)</p>
                                <p>Samedi 14h30 - 16h00 (1)</p>
							</div>
							<div class="work-item">
								<h4>Course à pied</h4>
								<p>Mercredi 15h00 - 15h30 (2)</p>
								<p>Mercredi 17h00 - 17h30 (1)</p>
								<p>Jeudi 18h15 - 19h30 (1)</p>
								<p>Samedi 16h00 - 16h30 (1)</p>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-4">
                    <div class="recent-works">
                        <h3>Groupes Jeunes</h3>
                        <div class="work-item">
                            <h4>Groupe 1 :</h4>
                            <p>Minimes - Cadets - Juniors</p>
                            <h4>Groupe 2 :</h4>
                            <p>Poussins - Pupilles - Benjamins</p>
                        </div>
                    </div>

                </div>
				<div class="col-md-4">
					<div class="recent-works">
						<h3>Entraînements Adultes</h3>
						<div id="works">
							<div class="work-item">
								<h4>Natation</h4>
								<p>Mardi 12h - 13h30 (3 lignes)</p>
								<p>Mardi 20h - 21h30 (3 lignes)</p>
								<p>Mercredi 9h00 - 10h00 (Santé Loisir)</p>
								<p>Jeudi 12h - 13h30 (3 lignes)</p>
								<p>Jeudi 20h - 21h30 (5 lignes)</p>
								<p>Samedi 12h - 13h30 (3 lignes)</p>
							</div>
							<div class="work-item">
								<h4>Vélo</h4>
								<p>Samedi 14h30 - 16h30</p>
							</div>
							<div class="work-item">
								<h4>Course à pied</h4>
								<p>Lundi 18h30 - 20h (Confirmés)</p>
								<p>Mardi 8h30 - 9h30 (Santé Loisir Bien-être)</p>
								<p>Mercredi 18h30 - 20h (Débutants et confirmés)</p>
                                <p>Jeudi 8h30 - 9h30 (Santé Loisir Bien-être)</p>
                                <p>Jeudi 18h30 - 20h00 (groupe Débutants)</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <section id="contact" class="index">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <address class="contact-details">
                        <h3>Contactez nous</h3>
                        <div class="col-lg-6"><i class="fa fa-map-marker"></i> Triath'Lons <span>15 Avenue du Stade</span> <span>Lons-le-Saunier - France</span></div>
                        <hr>
                        <div class="col-lg-6"><i class="fa fa-phone"></i> <a href="tel:+33682870041"> 06.82.87.00.41</a> <br> <i class="fa fa-envelope"></i>
                            <a href="mailto:contact@triathlons.fr">contact@triathlons.fr</a></div>
                    </address>
                </div>
                <hr>
                <div class="col-md-10 contact-form" id="contact">
                    <?php if(array_key_exists('errors', $_SESSION)) : ?>
                        <div class="alert">
                            <span class="icon-error"></span><!--
                            --><span class="text-error"><?php echo implode('<br>', $_SESSION['errors']); ?></span>
                        </div>
                    <?php endif;
                    if(array_key_exists('success', $_SESSION)) : ?>
                        <div class="alert">
                            <span class="icon-success"></span><!--
                            --><span class="text-success">Votre message a bien été envoyé. Merci</span>
                        </div>
                    <?php endif;
                    session_destroy();
                    ?>
                    <div class="contact-details">
                        <h3>Envoyez-nous un email</h3>
                    </div>
                    <form action="validate.php" method="post">
                        <div class="input-field">
                            <input type="text" name="name" class="form-control" required aria-required="true" placeholder="Votre nom..." value="<?php echo isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : '';?>">
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" class="form-control" required aria-required="true" placeholder="Votre e-mail..." value="<?php echo isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : '';?>">
                        </div>
                        <div class="input-field">
                            <textarea name="message" class="form-control" placeholder="Message..." required aria-required="true"><?php echo isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : '';?></textarea>
                        </div>
                        <div class="input-field">
                            <input type="text" name="code" class="form-control" required aria-required="true" placeholder="Ecrire le résultat de 7 + 3">
                        </div>
                        <p class="text-right"><button type="submit" id="submit" class="btn btn-blue btn-effect">Envoyer</button></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2737.5033384901967!2d5.556412215848695!3d46.6760659597835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478cd7f1618c78e1%3A0x843eade208f5b7d5!2sTriath&#39;Lons!5e0!3m2!1sfr!2sfr!4v1485203116394" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
    <footer id="footer">
        <div class="container">
            <div class="row text-center">
                <div class="footer-content">
                    <div class="footer-social">
                        <ul>
                            <li class="wow animated zoomIn"><a target="_blank" href="https://www.facebook.com/groups/triathlons39/"><i class="fa fa-thumbs-up fa-4x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12"><a href="app/index.php">Triath'Lons</a> <i class="fa fa-copyright" aria-hidden="true"></i> 1987 / <?= date('Y');?> - <a href="plan-du-site.php">Plan du site</a> - <a href="mentions-legales.php">Mentions Légales</a> - <a href="https://www.fcwd.fr">Développé par Franck Contet</a></div>
            </div>
        </div>
    </footer>
    <?php $info = Information::last('Triathlons');
    if (!empty($info)) : ?>
        <div class="diapo">
            <div class="tickercontainer">
                <ul id="ticker01">
                    <?php foreach ($info AS $ones) : ?>
                        <li><?= $ones->texte;?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.singlePageNav.min.js"></script>
    <script src="assets/js/jquery.fancybox.pack.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.slitslider.js"></script>
    <script src="assets/js/jquery.ba-cond.min.js"></script>
    <script src="assets/js/main.js"></script>
    <?php include('_inc/analytics.php'); ?>
    <script type="text/javascript" src="assets/js/tickers.js"></script>
    <script>
        $(function(){
            $("ul#ticker01").liScroll();
        });
    </script>
</body>
</html>