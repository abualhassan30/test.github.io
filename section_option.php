<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();
######################################################
require_once("inc/section_option.php");
$switch=$_GET['switch'];



$switch=$_GET['switch'];


switch ($switch) {




    case "save_sections";
        save_sections();
        break;






    default;
        form_sections();
        break;
}

######################################################
CloseWorkSpace();



require_once("Style/footer.php");



?>
