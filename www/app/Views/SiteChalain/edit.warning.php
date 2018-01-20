<?php

use App\Chalain\Chalain;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$infos = Chalain::FindWarning($id);

$form = new Form($infos);

Table::setTitle("Edition de l'information ");

if(isset($_POST['modifier'])) :

    $date = date('Y-m-d H:i');
    $texte = $_POST['texte'];

    Chalain::EditWarning($id, [
        'texte'    => $texte,
        'data'     => $date,
    ]);
    Session::setFlash("L'information a bien été modifiée.", 'success');
    Table::Redirect('warning');
endif;

?>

<div class="header">
    <h1>Modifier de l'information</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST" enctype="multipart/form-data">

        <?= $form->textarea("texte");?>

        <?= $form->submit('modifier', "Modifier l'information", 'warning');?>
    </form>
</div>

<div class="return"><a href="index.php?page=warning"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>