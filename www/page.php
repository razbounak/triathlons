<?php
	require_once'_inc/cnx.php';
	$id = $_GET['id'];
	$two = $bdd->prepare("SELECT * FROM page WHERE id = :id");
	$two->execute(array(':id' => $id));
	foreach ($two as $twos) :
		$title = $twos->titre .' | Triath\'Lons';
	    $titre = $twos->titre;
		$description = $twos->description;
		$contenu = $twos->contenu;
	endforeach;
	require_once'_inc/header.php';
?>
<main class="site-content" role="main">
	<section class="about">
		<div class="container">
			<div class="row">
                <div class="mt"></div>
				<div class="col-md-offset-1 col-md-10">
					<h2><?= $titre;?></h2>
					<p><?= $contenu;?></p>
				</div>
			</div>
		</div>
	</section>	
</main>
<?php include('_inc/footer.php'); ?>