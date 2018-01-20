<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 28/06/2016
 * Time: 09:31
 */

namespace App\Cookie;

class Cookie {

    const Session = null;
    const OneHour = 3600;
    const SevenDays = 604800;
    const ThirtyDays = 2592000;
    const SixMonths = 15811200;
    const OneYear = 31536000;
    const Lifetime = -1; // 2030-01-01 00:00:00

    /**
     * Retourne TRUE s'il le cokkie existe.
     *
     * @param string $name
     * @return bool
     */
    public static function Exists($name) {
        return isset($_COOKIE[$name]);
    }

    /**
     * Retourne TRUE  si il n'y a pas de cookie ou que la valeur est 0
     * @param string $name
     * @return bool
     */
     public static function IsEmpty($name) {
        return empty($_COOKIE[$name]);
    }

    /**
     * Donne la valeur du cookie. Si $_COOKIE n'existe pas alors la valeur $default sera retourner
     * @param string $name
     * @param string $default
     * @return mixed
     */
    public static function Get($name, $default = '') {
        return (isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default);
    }

    /**
     * Défini le cookie.
     * @param string $name
     * @param string $value
     * @param mixed $expiry
     * @param string $path
     * @param string $domain
     * @return bool
     */
    public static function Set($name, $value, $expiry = self::OneYear) {
        $retval = false;
        if (!headers_sent()) {
            if ($expiry === -1)
                $expiry = 1893456000;
            elseif (is_numeric($expiry))
                $expiry += time();
            else
                $expiry = strtotime($expiry);

            $retval = @setcookie($name, $value, $expiry);
            if ($retval)
                $_COOKIE[$name] = $value;
        }
        return $retval;
    }

    /**
     * Delete a cookie.
     * @param string $name
     * @return true
     */
    public static function Delete($name) {
        setcookie($name, null, - 1);
    }

    /**
     * @param $length
     * @return string
     */
    public static function token($length) {
        $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+*/!:;,-&";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

}