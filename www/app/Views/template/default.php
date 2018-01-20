<?php
$time = microtime(TRUE);

use App\Annonce\Annonce;
use App\Core\Table;

if(isset($_COOKIE['AdminTriathlons']) && $_COOKIE['AdminTriathlons'] != '' && $_COOKIE['AdminTriathlons'] != null):
    $id = $_COOKIE['IDUSER'];
    $annonce = Annonce::NBAValider();
endif;
$name = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= Table::getTitle();?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="author" content="Franck Contet - FCWD Agence Web"/>
    <link rel="stylesheet" href="Views/template/theme/assets/css/app.css"/>
</head>
<body>
<div class="wrapper flex">
<?php if(isset($_COOKIE['AdminTriathlons']) && $_COOKIE['AdminTriathlons'] != '' && $_COOKIE['AdminTriathlons'] != null): ?>
    <header class="col1">
        <div class="logo"></div>
        <nav>
            <ul>
                <li class="<?= $name == 'home' ? 'active' : ''; ?>"><a href="index.php?page=home"><span class="icone"></span><span class="navtitre">Accueil</span></a></li><!--
                --><li <?=
                $name == 'articles' || $name == 'edit.article' || $name == 'add.article' || $name == 'article' ? 'class="active"' : '';
                ?>><a href="index.php?page=articles"><span class="icone new"></span><span class="navtitre">Actualité</span></a></li><!--
                --><li <?=
                $name == 'agenda' || $name == 'add.agenda' || $name == 'edit.agenda' || $name == 'evens' ? 'class="active"' : '';
                ?>><a href="index.php?page=agenda"><span class="icone agenda"></span><span class="navtitre">Agenda</span></a></li><!--
                --><li <?=
                $name == 'annonce' || $name == 'edit.annonce' || $name == 'valide.annonce' || $name == 'view.annonce' ? 'class="active"' : '';
                ?>><a href="index.php?page=annonces"><span class="icone annonce"></span><span class="navtitre">Annonces <span class="nbMessage <?=  $annonce == 0 ? ' none' : '';?>"><?= $annonce != 0 ? $annonce : '';?></span></a></li><!--
                --><li <?=
                $name == 'albums' || $name == 'add.album' || $name == 'view.album' || $name == 'delete.album' ? 'class="active"' : '';
                ?>><a href="index.php?page=albums"><span class="icone diapo"></span><span class="navtitre">Albums </span></a></li><!--
                --><li <?=
                $name == 'produits' || $name == 'add.produit' || $name == 'view.produit' || $name == 'edit.produit' || $name == 'add.category' || $name == 'edit.category' ? 'class="active"' : '';
                ?>><a href="index.php?page=produits"><span class="icone produit"></span><span class="navtitre">Boutique</span></a></li><!--
                --><li <?=
                $name == 'clubs' || $name == 'add.club' || $name == 'delete.club' ? 'class="active"' : '';
                ?>><a href="index.php?page=clubs"><span class="icone club"></span><span class="navtitre">Clubs</span></a></li><!--
                --><li <?=
                $name == 'diaporama' || $name == 'edit.diaporama' ? 'class="active"' : '';
                ?>><a href="index.php?page=diaporama"><span class="icone album"></span><span class="navtitre">Diaporama</span></a></li><!--
                --><li <?=
                $name == 'fichiers' || $name == 'add.fichier' || $name == 'edit.fichier' || $name == 'delete.fichier' ? 'class="active"' : '';
                ?>><a href="index.php?page=fichiers"><span class="icone pdf"></span><span class="navtitre">Fichiers PDF</span></a></li><!--
                --><li <?=
                $name == 'informations' || $name == 'add.information' || $name == 'delete.information' ? 'class="active"' : '';
                ?>><a href="index.php?page=informations"><span class="icone warning"></span><span class="navtitre">Informations</span></a></li><!--
                --><li <?=
                $name == 'pages' || $name == 'add.page' || $name == 'edit.page' || $name == 'delete.page' ? 'class="active"' : '';
                ?>><a href="index.php?page=pages"><span class="icone page"></span><span class="navtitre">Pages</span></a></li><!--
                --><li <?=
                $name == 'partenaires' || $name == 'add.partenaire' || $name == 'delete.partenaire' ? 'class="active"' : '';
                ?>><a href="index.php?page=partenaires&key=triathlons"><span class="icone partenaire"></span><span class="navtitre">Partenaires</span></a></li><!--
                --><li <?=
                $name == 'home.chalain' || $name == 'edit.article.chalain'  || $name == 'edit.temperature'  || $name == 'sponsors'  || $name == 'edit.programme.chalain'  || $name == 'edit.course.chalain'  || $name == 'add.sponsor'  || $name == 'warning'  || $name == 'add.article.chalain'  || $name == 'articles.chalain'  || $name == 'edit.reglement.chalain'  || $name == 'add.pdf.chalain'  || $name == 'pdf.chalain'  || $name == 'edit.inscription.chalain'  || $name == 'add.warning' ? 'class="active"' : '';
                ?>><a href="index.php?page=home.chalain"><span class="icone regle"></span><span class="navtitre">Site Chalain</span></a></li><!--
               --><li class="deconnect"><a href="index.php?page=logout"><span class="icone logout"></span><span class="navtitre">Déconnexion</span></a></li>
            </ul>
        </nav>
    </header>
<section class="col2">

    <?php endif; ?>

        <?= $content; ?>

   <?php if(isset($_COOKIE['AdminTriathlons']) && $_COOKIE['AdminTriathlons'] != '' && $_COOKIE['AdminTriathlons'] != null) : ?>

</section>
</div>
    <footer>
        <div class="flex">
            <div class="contact">
                <p>Un bug ? Un problème ?</p>
                <p><a href="index.php?page=add.rapport">[ ENVOYEZ UN RAPPORT DE BUG ]</a></p>
                <p>[ CONTACT SUPPORT //  <a href="tel:+33687095869">Tél : 06 87 09 58 69</a> // <a href="mailto:contact@fcwd.fr">Email : contact@fcwd.fr</a> ]</p>
            </div>
            <div class="contact">
                <p>Zone Administration</p>
                <p><a href="http://www.fcwd.fr/" target="_blank">Designed & developed by FCWD <sup>&reg;</sup> <?= date('Y');?></a> </p>
            </div>
        </div>
    </footer>
<?php endif; ?>
<script src="Views/template/theme/assets/js/libjs.js" type="text/javascript" language="JavaScript"></script>
<?php
$page = $_GET['page'];
$page = explode('.', $page);
$res = $page[0];
if ($res === 'add' || $res === 'edit') : ?>
    <script src="Views/template/theme/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('desc');
        CKEDITOR.replace('description_annonce');
    </script>
<?php endif; ?>
<script src="Views/template/theme/assets/js/jQuery.3.0.js"></script>
<script src="Views/template/theme/assets/js/AfficheInfo.js"></script>
</body>
</html>