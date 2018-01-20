<?php

use App\Core\Table;
use App\Session\Session;
use App\Chalain\Chalain;

$form = new \App\HTML\Form($_POST);

if (isset($_POST['add'])) :

    $texte = $_POST['texte'];
    $date = date('Y-m-d');

    Chalain::AddWarning([
        'texte' => $texte,
        'data'  => $date
    ]);
    Session::setFlash("L'information a bien été ajoutée.", 'success');
    Table::Redirect('warning');
endif;

?>
<div class="header">
    <h1>Ajouter un message d'information | Chalain</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <h2>Mettre en gras la date ou mot du début suivi d'un tiret (-) </h2>

        <?= $form->textarea('texte');?>

        <?= $form->submit('add', "Ajouter cette information", 'warning') ;?>

    </form>
</div>

<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>