<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();
######################################################
require_once("Tables/data_classes.php");

$switch=$_GET['switch'];


switch ($switch) {


    case "new_classes";
        form_classes();
        break;

    case "edit_classes";
        $RecordID=$_GET["RecordID"];
        form_classes($RecordID);
        break;


    case "save_classes";
        save_classes();
        break;



    case "delete_classes";
        delete_classes();
        break;


    default;
        load_classes();
        break;
}




######################################################
CloseWorkSpace();



require_once("Style/footer.php");



?>
