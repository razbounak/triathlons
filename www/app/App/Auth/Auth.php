<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 13/07/2016
 * Time: 10:18
 */

namespace App\Auth;

use App\App;
use App\Cookie\Cookie;

class Auth {

    public function Login($name, $pass) {
        $user = App::getDatabase()->Prepare("SELECT * FROM admin WHERE username = :username", ['username' => $name], 'App\Auth\Auth');
        if($user) {
            if(password_verify($pass, $user->password)) :
                $remember_token = Cookie::token(250);
                App::getDatabase()->Prepare("UPDATE admin SET cookie = :cookie WHERE username = :username", [ 'cookie' => $remember_token, 'username' => $user->username ]);
                Cookie::Set('AdminTriathlons', $user->id . '==' . $remember_token . sha1($user->id . 'AdminTriathlons'), Cookie::ThirtyDays);
                Cookie::Set('NOM', substr($user->nom, 0, 1). '. ' , Cookie::ThirtyDays);
                Cookie::Set('PRENOM', ucfirst($user->prenom), Cookie::ThirtyDays);
                Cookie::Set('FONCTION', ucfirst($user->fonction), Cookie::ThirtyDays);
                Cookie::Set('IDUSER', ucfirst($user->id), Cookie::ThirtyDays);
            else :
                return false;
            endif;
        }
    }

    public function IsLogged() {
        if(isset($_COOKIE['AdminTriathlons'])) :
            $cookie = $_COOKIE['AdminTriathlons'];
            $parts = explode('==', $cookie);
            $id = $parts[0];
            $user = App::getDatabase()->Prepare("SELECT * FROM admin WHERE id = :id", ['id' => $id], 'App\Auth\Auth');

            if ($user) :
                $expected = $id . '==' . $user->cookie . sha1($id . 'AdminTriathlons');
                if ($expected === $cookie) :
                    return true;
                else :
                    Cookie::Delete('AdminTriathlons');
                endif;
            else :
                Cookie::Delete('AdminTriathlons');
            endif;
        endif;
    }

    public function Redirect($url) {
        header("Location: index.php?page=$url");
    }

    public function Logout() {
        Cookie::Delete('AdminTriathlons');
        Cookie::Delete('NOM');
        Cookie::Delete('PRENOM');
        Cookie::Delete('FONCTION');
        Cookie::Delete('IDUSER');
    }

}