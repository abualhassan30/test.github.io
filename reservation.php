<?php

require_once("Style/header.php");

if($_SESSION["user_id"]==""){
    header("Location: login.php");
    die();
}


require_once("inc/ClassResevation.php");

OpenWorkSpace();


$switch=$_GET['switch'];


switch ($switch) {



    //    case "save_reservation";
    //        StartSaveDate();
    //        break;

//    case "drowtable";
//    StartDrowTable();
//        drowtable();
//        break;

//    case "select_b";
//        select_b();
//        break;

//    case "select_s";
//        select_s();
//        break;

    default;
        //StartDrowTable();
        drowtable();
        break;
}



######################################################
CloseWorkSpace();
require_once("Style/footer.php");

function drowtable(){




    $Resevation = new Resevation();

    $selectdate = $_SESSION["selectdate"];
    $section_id = $_SESSION["selectsection_id"];


    if($selectdate==""){
        $selectdate = date("Y-m-d",time());
        $_SESSION["selectdate"] =$selectdate ;
    }

       

        echo "          <button  type=\"button\" class=\"btn btn-info\"  onclick='refresh_table();'>تحديث</button>\n";


        echo "<div id='tools'></div> ";
        echo "<div id='Action'></div> ";
         
        echo "<div id='DrowTableContent'>"; 
        $Resevation->DrowTable($section_id,$selectdate,$selectdate); 
        echo "</div>";

}


function StartDrowTable(){



    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }  
    $sql= "select * from  `building`  ";

    $result = mysqli_query($conn, $sql);




    if (mysqli_num_rows($result) > 0) {

        $serial =1;

        while($row = mysqli_fetch_assoc($result)) {
            $building_id =  $row[building_id];
            $building_name =  $row[building_name];

            //                echo " <button  type=\"button\"  onclick = 'GetSections($building_id);'
            //                class=\"btn btn-primary btn-lg\">" . $row[building_name] . "</button>";

            echo "<label class=\"radio-inline\" style=\"border:1px solid #cccccc;padding:15px;margin:15px;\">
            <input type=\"radio\" value=\"$building_id\" style='margin:10px;' name='radioBuildingID'
            onchange = 'GetSections($building_id);'
            >$building_name
            </label> ";

            $serial++;
        }


        echo "<div id='id_sections'></div>";




    }

    mysqli_close($conn);

}



//function select_b(){
//
//    $building_id = $_GET["building_id"];
//
//
//    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
//    mysqli_set_charset($conn,"utf8");
//    if(! $conn ) {
//        die('Could not connect: ' . mysqli_error());
//    }  
//    $sql= "select * from  `sections` where building_id = $building_id  ";
//
//    $result = mysqli_query($conn, $sql);
//
//    if (mysqli_num_rows($result) > 0) {
//
//        $serial =1;
//
//        while($row = mysqli_fetch_assoc($result)) {
//            $section_id =  $row[section_id];
//
//            echo " <a href='index.php?switch=select_s&section_id=$section_id' type=\"button\" class=\"btn btn-primary btn-lg\">" . $row[section_name] . "</a>";
//            $serial++;
//        }
//
//
//    }else{
//
//
//
//
//    }
//
//    mysqli_close($conn);    
//
//}

function StartSaveDate(){
    $Resevation = new Resevation();
    $Resevation->save_reservation();
}





?>
