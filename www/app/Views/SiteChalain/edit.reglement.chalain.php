<?php

use App\Core\Table;
use App\HTML\Form;
use App\Session\Session;
use App\Chalain\Chalain;

$id = $_GET['id'];

$regle = Chalain::FindReglement($id);

$form = new Form($regle);

$fichiers = Chalain::AffichePDF();

if (isset($_POST['modifier'])) :

    $titre = $_POST['titre'];
    $pdf = $_POST['fichier'];
    Chalain::EditReglement($id, [
        'titre' => $titre,
        'fichier' => $pdf
    ]);
    Session::setFlash("Le réglement a bien été modifié.", 'success');
    Table::Redirect('home.chalain');
endif;
?>

<div class="header">
    <h1>Modification : <?= $regle->titre;?> | CHALAIN</h1>
</div>

<div class="bloc-edit">
    <form action="#" method="POST">

        <?= $form->input('titre', 'Titre du réglement :');?>

        <div class="form-group">
            <label class="label" for="fichier">Lien du Fichier</label><!--
            --><select class="input" name="fichier">
                <option value="0">aucun</option>
                <?php foreach ($fichiers as $fichier) : ?>
                    <option value="<?= $fichier->fichier;?>"><?= $fichier->fichier;?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?= $form->submit('modifier', 'Modifier', 'home.chalain') ;?>
    </form>
</div>