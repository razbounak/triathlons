<?php
    require '_inc/cnx.php';
	$two = $bdd->prepare("SELECT * FROM news WHERE news_id = :id");
	$two->execute(array('id' => $_GET['id']));
	while ($twos = $two->fetch()) :
	    date_default_timezone_set('Europe/Paris');
	    $date = date("Y-m-d");
        $title = $twos->news_title;
        $description = $twos->news_seo;
        include('_inc/header.php');
?>	
<main class="site-content" role="main">
	<section class="about">
		<div class="container">
            <div class="mt"></div>
			<div class="row">
				<div class="col-md-6">
					<h1><?= $title; ?></h1>
					<p><?= $twos->news_body; ?></p>
				</div>
				<div class="col-md-6">
                    <br>
					<?php
					if(!empty($twos->image)) { ?>
						<img src="image/<?= $twos->image; ?>" alt="<?= $title; ?>" class="img-responsive img-rounded"><br>
						<div class="fb-share-button" data-href="http://triathlons.fr/news.php?id=<?= $twos->news_id;?>" data-layout="button_count"></div>
					<?php } ?>
                    <div class="partage">
                        <a href="http://www.facebook.com/share.php?u=https://triathlons.fr/news.php?id=<?= $twos->news_id;?>" target="_blank" title="Partager sur Facebook"><img src="theme/facebook.png" alt="Partager sur Facebook"/></a>
                        <a href="http://twitter.com/share?url=https://triathlons.fr/news.php?id=<?= $twos->news_id;?>" target="_blank" title="Partager sur Twitter"><img src="theme/twitter.png" alt="Partager sur Twitter"/></a>
                        <a href="https://plus.google.com/share?url={https://triathlons.fr/news.php?id=<?= $twos->news_id;?>}" target="_blank" title="Partager sur Google+"><img src="theme/google.png" alt="Partager sur Google+"/></a>
                    </div>
				</div>
			</div>

		</div>
        <div class="mt"></div>
	</section>		
<?php
	if(!empty($twos->id_album)) :?>
	<section id="portfolio">
		<div class="container">
			<div class="row">
				<ul class="project-wrapper wow animated fadeInUp">		
					<div class="row">
						<?php  
						$three = $bdd->query("SELECT * FROM album WHERE id = :ib_album ");
						$three->execute(array('ib_album' => $twos->id_album));
						while ($threes = $three->fetch()) : ?>
							<div class="sec-title text-center wow animated fadeInDown">
                                <h2><?= $threes->nom_album;?></h2>
                            </div>
						<?php endwhile;
						$one = $bdd->query("SELECT * FROM album_photo WHERE id_album = :ib_album");
						$one->execute(array('id_album' => $twos->id_album));
						while ($ones = $one->fetch()) : ?>
							<div class="col-md-4">
								<img src="image/<?= $ones->image;?>" class="img-responsive">
							</div>
                        <?php endwhile; ?>
					</div>
				</ul>
			</div>
		</div>	
	</section>
<?php
	endif;
?>		
</main>
<?php
	endwhile;
	include('_inc/footer.php');
?>		