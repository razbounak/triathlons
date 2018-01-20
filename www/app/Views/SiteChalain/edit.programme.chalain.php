<?php

use App\Session\Session;
use App\Core\Table;
use App\Chalain\Chalain;

$id = $_GET['id'];
$programme = Chalain::FindProgramme($id);
$form = new \App\HTML\Form($programme);

if (isset($_POST['modifier'])) :

    $programme = $_POST['texte'];
    Chalain::EditProgramme($id, [
        'texte' => $programme
    ]);
    Session::setFlash("Le programme a bien été modifiée", 'success');
    Table::Redirect('home.chalain');

endif;

?>
<div class="header">
    <h1>Edition du Programme</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <h2>Information : mettre l'heure sous format hh:mm et en gras et sous forme de liste.</h2>

        <?= $form->textarea('texte');?>

        <?= $form->submit('modifier', 'Modifier', 'home.chalain') ;?>
    </form>
</div>


<div class="return"><a href="index.php?page=home.chalain"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>