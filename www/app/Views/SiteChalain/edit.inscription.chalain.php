<?php

use App\Chalain\Chalain;
use App\HTML\Form;
use App\Session\Session;
use App\Core\Table;

$id = $_GET['id'];

$inscrit = Chalain::FindInscription($id);

$form = new Form($inscrit);

if (isset($_POST['modifier'])) :

    $name = $_POST['name'];
    $url = $_POST['url'];

    Chalain::EditInscription($id, [
        'name'  => $name,
        'url'   => $url
    ]);
    Session::setFlash("La modification a été prise en compte.", 'success');
    Table::Redirect('home.chalain');

endif;
?>

<div class="header">
    <h1>Modification : <?= $inscrit->name;?> | CHALAIN</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('name', "Nom : *");?>

        <?= $form->input('url', 'Lien :');?>

        <?= $form->submit('modifier', 'Modifier', 'home.chalain') ;?>
    </form>
</div>


<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>