<?php
	$title = 'Album';
	$description = 'Album du Triath\'Lons';
	include('_inc/header.php');
?>
<link rel="stylesheet" href="assets/css/lightbox.css">
<main class="site-content" role="main">
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="mt"></div>
                <?php
                    $two = $bdd->prepare("SELECT * FROM album WHERE id = ?");
                    $two->execute(array($_GET['id']));
                    foreach ($two AS $twos) : ?>
                        <div class="sec-title text-center wow animated fadeInDown">
                            <h2 class="sec-title text-center"><?= $twos->nom_album ;?></h2>
                        </div>
                <ul class="project-wrapper wow animated fadeInUp fancybox">
                    <?php $one = $bdd->prepare("SELECT * FROM album_photo WHERE id_album = ?");
                        $one->execute(array($_GET['id']));
                        foreach($one as $ones) : ?>
                            <li class="portfolio-item">
                                <a href="image/<?= $ones->image;?>.jpg" rel="lightbox[group]"><img src="image/<?= $ones->image;?>.jpg" alt=""/></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
</main>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/lightbox.js"></script>
<?php include('_inc/footer.php'); ?>