<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 18/07/2016
 * Time: 18:54
 */

use App\Auth\Auth;
use App\Session\Session;

$session = new Session();
$session->setFlash("Vous êtes déconnecté");

$login = new Auth();
$login->Logout();
$login->Redirect('login');