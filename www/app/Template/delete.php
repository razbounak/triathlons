<?php
    use App\Core\Table;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= Table::getTitle();?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="author" content="Franck Contet - FCWD Agence Web"/>
    <link rel="stylesheet" href="Template/theme/assets/css/del.css">

</head>
<body>

    <?= $content; ?>

</body>
</html>