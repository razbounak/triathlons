<?php

use App\Core\Table;
use App\HTML\Form;
use App\Session\Session;
use App\Corrida\Corrida;

$id = $_GET['id'];

$regle = Corrida::FindReglement($id);

$form = new Form($regle);

if (isset($_POST['modifier'])) :

    $titre = $_POST['name'];
    $texte = $_POST['text'];
    Corrida::EditReglement($id, [
        'name' => $titre,
        'text' => $texte
    ]);
    Session::setFlash("Le réglement a bien été modifié.", 'success');
    Table::Redirect('home.corrida');
endif;
?>

<div class="header">
    <h1>Modification : <?= $regle->name;?> | CORRIDA</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('name', 'Titre du réglement :');?>

        <?= $form->textarea('text', 'Contenu du réglement :');?>

        <?= $form->submit('modifier', 'Modifier', 'home.corrida') ;?>
    </form>
</div>