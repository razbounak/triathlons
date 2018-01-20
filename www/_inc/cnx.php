<?php 
try {
    $bdd = new PDO('mysql:host=triathlomxclub.mysql.db;dbname=triathlomxclub', 'triathlomxclub', 'Triathlons39', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}