<?php
	$title = 'Photo';
	$description = 'Album photo du Triath\'Lons';
	include('_inc/header.php');
?>	
<main class="site-content" role="main">
    <section class="parallax about">
        <div class="overlay">
            <div class="container">
                <div class="mt"></div>
                <div class="row">
                    <?php
                        $one = $bdd->query("SELECT * FROM album ORDER BY data DESC");
                        while ($ones = $one->fetch()) : ?>
                                <div class="col-md-6">
                                    <p><a href="album.php?id=<?= $ones->id;?>" class="btn btn-blue btn-effect block"><?= $ones->nom_album;?></a></p>
                                </div>
                        <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
	include('_inc/footer.php');
?>		