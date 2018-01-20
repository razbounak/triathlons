<?php

use App\Core\Table;
use App\HTML\Form;
use App\Admin\Admin;
use App\Session\Session;

$id = $_GET['id'];
$admin = Admin::find($id);

$form = new Form($admin);

if (isset($_POST['Changer'])) :

    if(password_verify($_POST['password'], $admin->password)) :
        if($_POST['newspass'] == $_POST['verifpass']) :
            $password = password_hash($_POST['newspass'], PASSWORD_BCRYPT);
            Admin::Edit($id, [
                'password'  => $password
            ]);
            Session::setFlash("Votre mot de passe a bien été modifiée", 'success');
        else :
            Session::setFlash('Nouveaux mot de passe non identique. Recommencer', 'error');
        endif;
    else :
        Session::setFlash('Le mot de passe actuel est incorrect', 'error');
    endif;

endif;

if(isset($_POST['modifier'])) :

    Admin::Edit($id, [
            'username'  => $_POST['username'],
            'nom'       => $_POST['nom'],
            'prenom'    => $_POST['prenom'],
            'email'     => $_POST['email']
    ]);
    Session::setFlash("Vos informations ont bien été modifiés.", 'success');
endif;

?>

<div class="header">
    <h1>Modifier vos informations</h1>
</div>

<?= Session::flash();?>

<div class="bloc-edit">

    <form action="#" method="POST">

        <?= $form->input('username', 'Identifiant de connexion* : ', 'Vous pouvez modifier votre identifiant de connexion');?>
        <?= $form->input('prenom', 'Votre prénom :', null);?>

        <?= $form->input('nom', 'Votre Nom :', null);?>

        <div class="form-group">
            <div class="label">Votre fonction :</div><!--
            --><div class="input"><?= $admin->fonction;?></div>
        </div>

        <?= $form->input('email', 'Adresse Email :', 'Entre une adresse valide');?>
        <input type="hidden" name="id" value="<?= $_GET['id'];?>">
        <?= $form->submit('modifier', 'Modifier', 'home') ;?>

    </form>

</div>

<div class="return"><a href="index.php?page=home"><span class="icon-return"><i class="ion-arrow-left-a"></i></span><span class="text-return">Retour</span></a></div>
<div class="header">
    <h1>Modifier votre mot de passe</h1>
</div>

<div class="bloc-edit">

    <form action="#" method="POST">
    <div class="form-group">
        <label class="label" for="password">Mot de passe actuel* :</label><!--
            --><input type="password" class="input" id="password" name="password" required aria-required="true" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '';?>">
        <span class="aide">Saissisez votre mot de passe actuel</span>
    </div>

    <div class="form-group">
        <label class="label" for="newspass">Nouveau mot de passe* :</label><!--
            --><input type="password" class="input" id="newspass" name="newspass" required aria-required="true" value="<?php echo isset($_POST['newspass']) ? $_POST['newspass'] : '';?>">
        <span class="aide">Saissisez votre nouveau mot de passe</span>
    </div>

    <div class="form-group">
        <label class="label" for="verifpass">Nouveau mot de passe* :</label><!--
            --><input type="password" class="input" id="verifpass" name="verifpass" required aria-required="true" value="<?php echo isset($_POST['verifpass']) ? $_POST['verifpass'] : '';?>">
        <span class="aide">Resaissisez votre nouveau mot de passe</span>
    </div>
        <?= $form->submit('Changer', 'Changer le mot de passe', 'home') ;?>
</form>