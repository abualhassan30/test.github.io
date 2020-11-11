<?php



//         $dbhost = 'localhost';
//         $dbuser = 'root';
//         $dbpass = '123456789';
//         $dbname = 'crs';
//         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
//
//         if(! $conn ) {
//            die('Could not connect: ' . mysqli_error());
//         }
//         //echo 'Connected successfully<br>';
//        $sql = "SELECT * FROM building ORDER BY building_id";
//         $result = mysqli_query($conn, $sql);
//
//         if (mysqli_num_rows($result) > 0) {
//            while($row = mysqli_fetch_assoc($result)) {
//               echo "Name: " . $row["building_name"]. "<br>";
//            }
//         } else {
//            echo "0 results";
//         }
//         mysqli_close($conn);





### This Code for loading data from table building


define("_config_db_host","localhost");
define("_config_db_user","root");
define("_config_db_pass","123456789");
define("_config_db_name","crs");








// Check if page is $_GET Parameters for
// Normal load tables
// Or form for add new row;
// or save $_post Data


$fun=$_GET['switch'];


switch ($fun) {


    case "new_building";
        form_building();
        break;

    case "edit_building";
        $RecordID=$_GET["RecordID"];
        form_building($RecordID);
        break;


    case "save_building";
        save_building();
        break;


    default;
        load_building();
        break;
}



### This Code for loading data from table building

function load_building(){


    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }
    $sql= "select * from building";

    $result = mysqli_query($conn, $sql);

    echo "      <table  class=\"table\" >\n";
    echo "          <tr>\n";
    echo "            <th>building_id</th>\n";
    echo "            <th>building_name</th>\n";
    echo "          </tr>\n";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $building_id =  $row[building_id];
            $urlEdit = ("?switch=edit_building&RecordID=".$row[building_id]."");
            echo "  <tr>\n";
            echo "         <td><a href=\"$urlEdit\">" . $row[building_id] . "</a></td>\n";
            echo "         <td>" . $row[building_name] . "</td>\n";
            echo "  </tr>\n";

        }


    }else{
        echo "0 results";



    }
    mysqli_close($conn);
}


### This code for form table  building

function form_building($RecordID=0){


    $RecordID = intval($RecordID);
    if($RecordID>0){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from building where building_id='$RecordID'" ;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $building_id=$row["building_id"];
            $building_name=$row["building_name"];






        }
    }
    $URLAction = "?switch=save_building";

    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---building_id----------------
    echo "        <tr>\n";
    echo "            <td >" . _building_id .  "</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  type=\"text\" name=\"building_id\" value =\"$building_id\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---building_id----------------

    //---------START---building_name----------------
    echo "        <tr>\n";
    echo "            <td >" . _building_name .  "</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  type=\"text\" name=\"building_name\" value =\"$building_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---building_name----------------



    echo "    </table>\n";


    echo "              <input  type=\"hidden\" name=\"RecordID\" value =\"$RecordID\" >\n";
    echo "           <hr>\n";
    echo "                  <input  type=\"submit\" name=\"_save\" value =\"Save\" >\n";
    echo "      </form>\n";


}




function save_building(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);

    $building_id= $_POST["building_id"];

    $building_name= $_POST["building_name"];




    if ($RecordID == 0) {
        $sql= "INSERT INTO building  (building_id,building_name) Values ('".$building_id."','".$building_name."')";
        $result = mysqli_query($conn, $sql);
        return;

    }


    if ($RecordID > 0) {
        $sql= "UPDATE building SET   building_id='".$building_id."',building_name='".$building_name."'  WHERE building_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: building.php");
}


?>
