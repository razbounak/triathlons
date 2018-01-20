<?php
/**
 * Created by PhpStorm.
 * User: FCWD
 * Date: 21/06/2016
 * Time: 18:09
 */

namespace App\Database;

use \PDO;

class Database {

    private $bd_name;
    private $bd_host;
    private $bd_user;
    private $bd_pass;
    private $bdd = null;

    public function __construct($bd_name, $bd_host = 'triathlomxclub.mysql.db', $bd_user = 'triathlomxclub', $bd_pass = 'Triathlons39') {
        $this->bd_name = $bd_name;
        $this->bd_host = $bd_host;
        $this->bd_user = $bd_user;
        $this->bd_pass = $bd_pass;
    }

    private function getPDO(){
        if ($this->bdd === null) {
            $bdd = new PDO('mysql:host=triathlomxclub.mysql.db;dbname=triathlomxclub', 'triathlomxclub', 'Triathlons39', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd = $bdd;
        }
        return $this->bdd;
    }

    public function Query($statement, $class_name = null, $one = null) {
        $res = $this->getPDO()->query($statement);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }

        if ($class_name === null) {
            $res->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $res->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if ($one) {
            $datas = $res->fetch();
        } else {
            $datas = $res->fetchAll();
        }
        return $datas;
    }

    public function Prepare($statement, $attributes, $class_name = null, $one = true) {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }

        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }
    

}