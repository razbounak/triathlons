<?php
	$title = 'Clubs franc-comtois';
	$description = 'Les clubs franc-comtois de Triathlon';
	include('_inc/header.php');
	$clubs = App\Club\Club::all();
?>	
<main class="site-content" role="main">
	<section id="service">
		<div class="container">
			<div class="row">
                <div class="mt"></div>
				<div class="sec-title text-center">
					<h2 class="wow animated bounceInLeft">Clubs de triathlon en Franche-comté</h2>
				</div>
                <?php
                foreach ($clubs as $club) : ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow animated zoomIn">
                        <div class="service-item">
                            <a href="<?= $club->site; ?>" target="_blank" >
                                <img src="image/<?= $club->image;?>'" class="img-rounded img-responsive" style="height: 200px">
								<h3><?= $club->nom;?></h3>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
	include('_inc/footer.php');
?>		