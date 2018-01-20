<?php
header("Content-type: text/css; charset=UTF-8");
require_once('../cnx.php');

$one = $bdd->query("SELECT * FROM imagelogo WHERE id = 1 ");
while ($ones = $one->fetch()) {
	$image1 = $ones['image'];
}

$one = $bdd->query("SELECT * FROM imagelogo WHERE id = 2 ");
while ($ones = $one->fetch()) {
	$image2 = $ones['image'];
}

$one = $bdd->query("SELECT * FROM imagelogo WHERE id = 3 ");
while ($ones = $one->fetch()) {
	$image3 = $ones['image'];
}
?>

.bg-img-1 {
background-image: url(../img/slider/<?php echo $image1;?>);
}
.bg-img-2 {
background-image: url(../img/slider/<?php echo $image2;?>);
}
.bg-img-3 {
background-image: url(../img/slider/<?php echo $image3;?>);
}


    @media all and (min-device-width: 1024px)
    {
        .sidebar-nav {
            padding: 9px 0;

        }
        .dropdown-menu .sub-menu {
            left: 100%;
            position: absolute;
            top: 0;
            visibility: hidden;
            margin-top: -1px;
            color:white;
        }

        .dropdown-menu li:hover .sub-menu {
            visibility: visible;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
            margin-top: 0;
        }

        .navbar .sub-menu:before {
            border-bottom: 7px solid transparent;
            border-left: none;
            border-right: 7px solid rgba(0, 0, 0, 0.2);
            border-top: 7px solid transparent;
            left: -7px;
            top: 10px;
        }
        .navbar .sub-menu:after {
            border-top: 6px solid transparent;
            border-left: none;
            border-right: 6px solid #fff;
            border-bottom: 6px solid transparent;
            left: 10px;
            top: 11px;
            left: -6px;
        }
    }
