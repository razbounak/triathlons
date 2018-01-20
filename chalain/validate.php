<?php
define('CHARSET', 'UTF8');

session_start();

$errors = [];
if(!array_key_exists('name', $_POST) || $_POST['name'] == '' ){
    $errors['name'] = "Vous n'avez pas renseigné votre nom";
}
if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Votre adresse mail n'est pas valide";
}
if(!array_key_exists('message', $_POST) || $_POST['message'] == '' ){
    $errors['message'] = "Vous n'avez pas renseigné de message";
}
if(!array_key_exists('code', $_POST) || $_POST['code'] != '10' ){
    $errors['code'] = "Le code de sécurité ne correspond pas";
}

if(!empty($errors)) :
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $_POST;
    $_SESSION['success'] = 0;
    header('Location: Contact');
else :
    $_SESSION['success'] = 1;
    $_SESSION['errors'] = '';
    $_SESSION['inputs'] = '';
    $destination = "contact@triathlons.fr";

    $objet = 'Nouveau Message';
    $mail = $_POST['email'];
    $message = $_POST['message'] . "\r\n";
    $message .= 'message envoyé par : ' . $_POST['name'] . "\r\n";
    $message .= 'adresse email : ' . $_POST['email'] . "\r\n";
    $message .= 'message émis depuis le formulaire ';

    $headers = 'FROM: <' . $mail . '>';
    mail($destination, $objet, utf8_decode($message), $headers);
    header('Location: Contact');
endif;
