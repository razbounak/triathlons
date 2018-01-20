<?php

use App\Core\Table;
use App\HTML\Form;
use App\Send\SendMail;
use App\Session\Session;
use App\Email\Validate;

$form = new Form($_POST);

if (isset($_POST['send'])) :

    $errors = [];

    $validate = new Validate($_POST);
    $validate->check('name', 'required');
    $validate->check('tel', 'required');
    $validate->check('email', 'email');
    $validate->check('text', 'required');
    $errors = $validate->errors();

    if(!empty($errors)) :
        $_SESSION['errors'] = $errors;
        $_SESSION['inputs'] = $_POST;
    else :
        $to = 'contact@fcwd.fr';
        $sujet = 'Rapport de bug';
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $texte = $_POST['texte'];
        $name = $_POST['name'];
        $file = $_FILES['image'];

        SendMail::Send($to, $sujet, $name, $tel, $email, $texte, $file);
        Session::flash('Votre rapport a bien été envoyé.', 'success');
        Table::Redirect('home');
    endif;

endif;
?>
<div class="header">
    <h1>Envoyer un Rapport de bug !</h1>
</div>

<?php if(array_key_exists('errors', $_SESSION)) : ?>
    <div class="alerte">
        <p>Erreur : <?php echo implode('<br>', $_SESSION['errors']); ?></p>
    </div>
<?php endif;
session_destroy();
?>
<div class="bloc-edit">

    <h3>Vous avez des difficultés à mettre à jour ? Vous avez relevè un bug d'affichage ? ...</h3>

    <p>Complétez et envoyer le formulaire ci-dessous :</p>

    <p>Merci de détailler votre message sur votre problème, afin d'accéler sa résolution.</p>

    <form action="#" method="POST">

        <?= $form->input('email','E-Mail','Entrez votre adresse | Entrez une adresse valide'); ?>

        <?= $form->input('tel', 'Téléphone','Entrez votre numéro de téléphone'); ?>

        <?= $form->textarea('texte'); ?>
        
        <?= $form->file('image', 'Capture d\'écran', 'Touche "Impr écran" de votre clavier', 4060000); ?>

        <input type="hidden" name="name" value="Triathlons"/>

        <?= $form->submit('send', 'envoyer votre rapport', null, true);?>
    </form>

</div>
