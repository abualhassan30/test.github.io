<?php
ob_start();
session_start();

if($_SESSION["user_id"]==""){
    die();
}

require_once("inc/Config.php");
require_once("inc/ClassResevation.php");
require_once("inc/InputSelect.php");


$switch=$_GET['switch'];


switch ($switch) {



    case "refresh_table";
        mydrowtable();
        break;
        
    case "refresh_table_new_date";
       refresh_table_new_date();
    break ;


}




function mydrowtable(){




    $Resevation = new Resevation();

    $selectdate = $_SESSION["selectdate"];
    $section_id = $_SESSION["selectsection_id"];


    if($selectdate==""){
        $selectdate = date("Y-m-d",time());
        $_SESSION["selectdate"] =$selectdate ;
    }


    $Resevation->DrowTable($section_id,$selectdate,$selectdate); 






}

function refresh_table_new_date(){          
   $selectdate = $_REQUEST["selectdate"]; 
   $selectsection_id = $_REQUEST["selectsection_id"]; 
   
   $_SESSION["selectdate"] =$selectdate ;
   $_SESSION["selectsection_id"] =$selectsection_id ;
   mydrowtable();
   
}



?>
