<?php
$title = 'Partenaires';
$description = "Parteniares du Triath'Lons";
include('_inc/header.php');
$partenaires = \App\Partenaire\Partenaire::all('triathlons');
?>	
<main class="site-content" role="main">
	<section id="service">
		<div class="container">
            <div class="mt"></div>
			<div class="row">
				<div class="sec-title text-center">
					<h2>Nos Partenaires</h2>
					<p>Ils sont là pour nous</p>
				</div>
                <?php
                foreach ($partenaires AS $partenaire) : ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
                        <div class="service-item">
                            <a href="<?= $partenaire->site; ?>">
                                <img target="_blank" src="image/<?= $partenaire->image; ?>" class="img-rounded img-responsive" style="height: 200px">
                                <h3><?= $partenaire->nom;?></h3>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php include('_inc/footer.php'); ?>