<?php

use App\Page\Page;
use App\Session\Session;
use App\Core\Table;
use App\HTML\Form;

$id = $_GET['id'];
$menu = Page::find($id);
$form = new Form($menu);

Table::setTitle('Edition : '. $menu->titre);

if(isset($_POST['modifier'])) :

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $contenu = $_POST['contenu'];
    $cle = $_POST['cle'];

    Page::Edit($id, [
        'titre'         => $titre,
        'description'   => $description,
        'contenu'       => $contenu,
        'cle'           => $cle
    ]);
    Session::setFlash("La page a bien été modifiée.", 'success');
    Table::Redirect('pages');
endif;
?>

<div class="header">
    <h1>Modifier de la page : <?= $menu->titre;?></h1>
</div>

<div class="bloc-edit">

    <form action="#" method="POST">

        <?= $form->input('titre', "Titre de la page* : ");?>

        <?= $form->select('cle', 'Menu concerné* : ', null, ['adhesion' => 'Adhésion', 'club' => 'Le Club'])?>

        <?= $form->input('description', 'Description de la page :', 'Ajouter un court descriptif')?>

        <?= $form->textarea('contenu');?>

        <?= $form->submit('modifier', 'Modifier', 'pages') ;?>

    </form>

</div>

<div class="return"><a href="index.php?page=pages"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>