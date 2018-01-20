<?php
	$title = 'Actualité';
	$description = 'Actualité du Triath\'Lons';
	require'_inc/header.php';
	require'_inc/functions.php';
    $sql = $bdd->query("SELECT COUNT(news_id) as nbCom FROM news");
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    $nbCom = $data['nbCom'];
    $perPage = 30; // afficher 30 commentaires / page
    $nbPage = ceil($nbCom/$perPage); // cacul le nombre de page

    // Vérifie la valeur dans URL
    if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<= $nbPage) {
        $cPage = $_GET['p'];
    } else {
        $cPage = 1;
    }

    $pageA = (int) (($cPage-1)*$perPage);
    $pageB = (int) $perPage;
    $one = $bdd->prepare('SELECT *,
                                DATE_FORMAT(news_date, \'%d\') AS jour, 
                                DATE_FORMAT(news_date, \'%m\') AS mois, 
                                DATE_FORMAT(news_date, \'%Y\') AS annee
                                FROM news 
                                ORDER BY news_date 
                                DESC
                                LIMIT :offset , :limit');
    $one->bindParam(':offset', $pageA ,PDO::PARAM_INT);
    $one->bindParam(':limit', $pageB, PDO::PARAM_INT);
    $one->execute();
?>	
<main class="site-content" role="main">
    <section id="testimonials" class="parallax">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="mt"></div>
                    <?php
                        while ($ones = $one->fetch()) { ?>
                        <div class="col-md-4">
                            <?php $count = strlen($ones->news_title);?>
                            <div class="news">
                                <a href="news.php?id=<?= $ones->news_id;?>" alt="<?= $ones->news_title; ?>" class="">
                                    <div class="date"><i class="fa fa-calendar"></i> le <?= $ones->jour . ' ' . getMonth($ones->mois) . ' ' . $ones->annee;?></div>
                                    <div class="image">
                                        <img src="image/<?= $ones->image; ?>" alt="<?= $ones->news_title; ?>" class="img-responsive">
                                    </div>
                                    <div class="title"><?= substr($ones->news_title, 0, 35);?>
                                        <?= ($count > 36) ? '...' : '';?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagination">
                    <?php
                    for($i = 1 ; $i <= $nbPage ; $i++) {
                        if($i == $cPage) {
                            echo "<a href=\"#\" class=\"actif\">$i</a>";
                        } else {
                            echo "<a href=\"all.php?p=$i\">$i</a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('_inc/footer.php');