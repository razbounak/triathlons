<?php

use App\Session\Session;
use App\Core\Table;
use App\Album\Album;

if(isset($_POST['delete'])) {

    $id = $_POST['id'];

    if($_GET['image1'] != '') {
        $image1 = $_GET['image1'];
    } else {
        $image1 = '';
    }
    if($_GET['image2'] != '') {
        $image2 = $_GET['image2'];
    } else {
        $image2 = '';
    }
    if($_GET['image3'] != '') {
        $image3 = $_GET['image3'];
    } else {
        $image3 = '';
    }
    if($_GET['image4'] != '') {
        $image4 = $_GET['image4'];
    } else {
        $image4 = '';
    }
    if($_GET['image5'] != '') {
        $image5 = $_GET['image5'];
    } else {
        $image5 = '';
    }
    if($_GET['image6'] != '') {
        $image6 = $_GET['image6'];
    } else {
        $image6 = '';
    }
    if($_GET['image7'] != '') {
        $image7 = $_GET['image7'];
    } else {
        $image7 = '';
    }
    if($_GET['image8'] != '') {
        $image8 = $_GET['image8'];
    } else {
        $image8 = '';
    }
    if($_GET['image9'] != '') {
        $image9 = $_GET['image9'];
    } else {
        $image9 = '';
    }
    if($_GET['image10'] != ''){
        $image10 = $_GET['image10'];
    } else {
        $image10 = '';
    }
    if($_GET['image11'] != ''){
        $image11 = $_GET['image11'];
    } else {
        $image11 = '';
    }
    if($_GET['image12'] != ''){
        $image12 = $_GET['image12'];
    } else {
        $image12 = '';
    }
    if($_GET['image13'] != ''){
        $image13 = $_GET['image13'];
    } else {
        $image13 = '';
    }
    if($_GET['image14'] != ''){
        $image14 = $_GET['image14'];
    } else {
        $image14 = '';
    }
    if($_GET['image15'] != ''){
        $image15 = $_GET['image15'];
    } else {
        $image15 = '';
    }

    Album::Delete($image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9, $image10, $image11, $image12, $image13, $image14, $image15);
    Album::Del($id);
    Session::setFlash("L'album et ses photos sont supprimés", 'error');
    Table::Close();
}
Table::setTitle('Suppression Album');
?>

<h2>&Ecirc;tes-vous sûr de vouloir supprimer cet album ?</h2>

<form action="#" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <button type="reset" class="btn btn-danger" onclick="javascript:window.close();">NON</button><!--
    --><button type="submit" name="delete" class="btn btn-valide">OUI</button>
</form>
