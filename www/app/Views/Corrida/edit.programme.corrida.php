<?php

use App\Session\Session;
use App\Core\Table;
use App\Corrida\Corrida;

$id = $_GET['id'];
$programme = Corrida::FindProgramme($id);
$form = new \App\HTML\Form($programme);

if (isset($_POST['modifier'])) :

    $programme = $_POST['text'];
    Corrida::EditProgramme($id, [
        'text' => $programme
    ]);
    Session::setFlash("Le programme a bien été modifiée", 'success');
    Table::Redirect('home.corrida');

endif;

?>
<div class="header">
    <h1>Edition du Programme</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <h2>Information : mettre l'heure sous format hh:mm et en gras.</h2>

        <?= $form->textarea('text');?>

        <?= $form->submit('modifier', 'Modifier', 'home.corrida') ;?>
    </form>
</div>


<div class="return"><a href="index.php?page=home.corrida"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>