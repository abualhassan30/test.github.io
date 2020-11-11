<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();
######################################################
 require_once("Tables/data_building.php");
$switch=$_GET['switch'];


switch ($switch) {


    case "new_building";
        form_building();
       //echo "IT IS NEW";
        break;

    case "edit_building";
        $RecordID=$_GET["RecordID"];
        form_building($RecordID);
        break;


    case "save_building";
        save_building();
        break;



    case "delete_building";
        delete_building();
        break;


    default;
        load_building();
       //echo "DEFAULT";
        break;
}

######################################################
CloseWorkSpace();



require_once("Style/footer.php");



?>
