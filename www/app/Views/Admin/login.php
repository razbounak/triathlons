<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 20/06/2016
 * Time: 17:48
 */
use App\Auth\Auth;
use App\Session\Session;

$Session = new Session();
$login = new Auth();

if(isset($_POST['connexion']) && isset($_POST['login']) && isset($_POST['password'])) :
    $id = $_POST['login'];
    $password = $_POST['password'];
    $nom = $id;
    
    if($login->Login($id, $password) === true) :
        $login->Redirect("home");
        Session::setFlash("Bienvenue $nom", 'success');
    else :
        $Session->setFlash("Erreur : Identifiant ou mot de passe incorrect");
    endif;
endif;

// Redirection si Logger

if($login->IsLogged()) :
    $login->Redirect('home');
endif;

?>
<style type="text/css">body{background-color:#183b50 !important}.titre-h1{color:#FFF !important}button{margin:10px !important}</style>
<div class="login">
    <img src="../theme/logo_admin.png" alt="">
    <h2 class="titre-h1">Identification requise</h2>
    <div class="hline"></div>

    <?php $Session->flash();?>

    <div class="formulaire">

        <form action="#" method="post" role="form">

            <div class="flex">
                <label for="login">Identifiant :</label>
                <input type="text" name="login" id="login" required aria-required="true">
            </div>
            <div class="flex">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required aria-required="true">
            </div>
            <button type="submit" name="connexion" class="btn valide">Se connecter</button>

        </form>
    </div>
</div>
