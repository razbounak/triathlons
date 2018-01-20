<?php

use App\Corrida\Corrida;
use App\HTML\Form;
use App\Session\Session;
use App\Core\Table;

$id = $_GET['id'];

$inscrit = Corrida::FindInscription($id);

$form = new Form($inscrit);

if (isset($_POST['modifier'])) :

    $name = $_POST['name'];
    $url = $_POST['url'];

    Corrida::EditInscription($id, [
        'name'  => $name,
        'url'   => $url
    ]);
    Session::setFlash("La modification a été prise en compte.", 'success');
    Table::Redirect('home.corrida');

endif;
?>

<div class="header">
    <h1>Modification : <?= $inscrit->name;?> | CORRIDA</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('name', "Nom : *");?>

        <?= $form->input('url', 'Lien :');?>

        <?= $form->submit('modifier', 'Modifier', 'home.corrida') ;?>
    </form>
</div>


<div class="return"><a href="index.php?page=home.corrida"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>