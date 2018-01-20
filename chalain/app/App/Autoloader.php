<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 26/06/2016
 * Time: 11:05
 */
namespace App;

class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class) {
        if(strpos($class, __NAMESPACE__ . '\\') === 0) :
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        endif;
    }

}