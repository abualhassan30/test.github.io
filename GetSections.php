<?php

require_once("../inc/Config.php");
require_once("../inc/InputSelect.php");


$bulding_id = $_GET["building_id"];



$conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
mysqli_set_charset($conn,"utf8");
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}  
$sql= "select * from  `sections` where building_id = '$bulding_id'  ";



echo "<hr>";


echo "<form action=\"reservation.php?switch=drowtable\" method=\"post\">\n";



echo " <div class=\"row\">\n";//12

echo "  <div class=\"col-sm-3\">";
echo InputSelect($sql,"section_id","section_name","","section_id");
echo "  </div>\n";

 $today_date=date("Y-m-d",time());

echo "  <div class=\"col-sm-3\"><input class=\"form-control\" type=\"date\" id=\"\" name=\"selectdate\" value='$today_date'></div>\n";



echo "  <div class=\"col-sm-3\"><button class=\"btn btn-success btn-block\" type='submit' name='view_reservation'>اعرض الحجوزات</button></div>\n";

//echo "  <div class=\"col-sm-3\"><button class=\"btn btn-info btn-block\" type='submit' name='new_reservation' >حجز جديد</button></div>\n";

echo "</div> ";






echo "</form>";






?>