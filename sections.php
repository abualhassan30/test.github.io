<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();
######################################################
 require_once("Tables/data_sections.php");
$switch=$_GET['switch'];



        $switch=$_GET['switch'];


        switch ($switch) {


        case "new_sections";
        form_sections();
        break;

        case "edit_sections";
        $RecordID=$_GET["RecordID"];
        form_sections($RecordID);
        break;


        case "save_sections";
        save_sections();
        break;



        case "delete_sections";
        delete_sections();
        break;


        default;
        load_sections();
        break;
        }

######################################################
CloseWorkSpace();



require_once("Style/footer.php");



?>
