<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();


//include("reservation.php");

echo "<h1>مرحبا : ". $_SESSION["user_name"] ." </h1>";

echo "<hr>";


if($_SESSION["group_id"]==1){
    header("Location:reservation.php");
    die();
}

if($_SESSION["group_id"]==2){
    header("Location:building.php");
    die();
}






CloseWorkSpace();



require_once("Style/footer.php");



?>
