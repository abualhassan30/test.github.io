<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}

OpenWorkSpace();
######################################################
 require_once("Tables/data_users.php");



        // Check if page is $_GET Parameters for
        // Normal load tables
        // Or form for add new row;
        // or save $_post Data


        $switch=$_GET['switch'];


        switch ($switch) {


        case "new_users";
        form_users();
        break;

        case "edit_users";
        $RecordID=$_GET["RecordID"];
        form_users($RecordID);
        break;


        case "save_users";
        save_users();
        break;



        case "delete_users";
        delete_users();
        break;


        default;
        load_users();
        break;
        }



CloseWorkSpace();



require_once("Style/footer.php");



?>
