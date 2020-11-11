<?PHP



### This Code for loading data from table building

function load_building(){


    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    //$mysqli->set_charset("utf8");
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }
    $sql= "select * from building";

    $result = mysqli_query($conn, $sql);
    echo "      <div class=\"card\" >";
    echo "      <table  class=\"table\" >\n";
    echo "          <tr>\n";
    echo "            <th>رقم المبنى</th>\n";
    echo "            <th>اسم المبنى</th>\n";
    echo "            <th></th>\n";
    //    echo "            <th></th>\n";
    echo "          </tr>\n";



    if (mysqli_num_rows($result) > 0) {

        $serial =1;

        while($row = mysqli_fetch_assoc($result)) {
            $building_id =  $row[building_id];


            $urlEdit = ("?switch=edit_building&RecordID=".$row[building_id]."");
            $urlSections = ("sections.php?building_id=".$row[building_id]."");
            $urlDelete = ("?switch=delete_building&RecordID=".$row[building_id]."");

            echo "  <tr>\n";
            //echo "         <td><a href=\"$urlEdit\">$serial </a></td>\n";
            echo "         <td>$serial </td>\n";
            echo "         <td><a href=\"$urlSections\">" . $row[building_name] . "</a></td>\n";
            echo "         <td><a href=\"$urlDelete\" class='text-muted'>حذف</a></td>\n";
            //echo "         <td><a href=\"$urlSections\">" . $row[building_name] . "</a></td>\n";
            echo "  </tr>\n";

            $serial++;
        }


    }else{




    }
    echo "</table>";
    echo "</div>";
    mysqli_close($conn);
    echo "<hr>";
    //echo "<a class=\"btn btn-outline-primary\" href=\"building.php?switch=new_building\">إضافة مبنى جديد</a>";
    
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModalBuilding\">\n";
    echo "  اضف مبنى جديد\n";
    echo "</button>\n";
    ModalFormBuilding();
}



### This code for form table  building

function form_building($RecordID=0){


    $RecordID = intval($RecordID);
    if($RecordID>0){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from building where building_id='$RecordID'" ;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $building_name=$row["building_name"];






        }
    }
    $URLAction = "?switch=save_building";
    echo "      <div class=\"card\" >";
    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---building_name----------------
    echo "        <tr>\n";
    echo "            <td >اسم المبنى</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  type=\"text\" name=\"building_name\" value =\"$building_name\" class=\"form-control\">\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---building_name----------------



    echo "    </table>\n";


    echo "              <input  type=\"hidden\" name=\"RecordID\" value =\"$RecordID\" >\n";
    echo "           <hr>\n";
    // echo "                  <input  type=\"submit\" name=\"_save\" value =\"Save\" class=\"btn btn-primary\" >\n";
    echo "          <button type=\"submit\" class=\"btn btn-success\">حفظ</button>" ;
    echo "        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">تراجع</button>\n";
    //echo "         <a class=\"btn btn-outline-light text-dark\" href=\"building.php?switch=delete_building&RecordID=$RecordID\">Delete</a>\n";
    echo "      </form>\n";
    echo "      </div>\n";

}




function save_building(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);

    $building_name= $_POST["building_name"];

    if($building_name==""){
        echo "<div class=\"alert alert-danger\">\n";
        echo "  <strong>خطأ!</strong> يجب عليك ادخال اسم المبنى.\n";
        echo "</div>";
        return;
    }


    if ($RecordID == 0) {
        $sql= "INSERT INTO building  (building_name) Values ('".$building_name."')";
        $result = mysqli_query($conn, $sql);


    }


    if ($RecordID > 0) {
        $sql= "UPDATE building SET   building_name='".$building_name."'  WHERE building_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: building.php");
}

function delete_building(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);




    if ($RecordID > 0) {
        $sql= "DELETE FROM building WHERE building_id=$RecordID";
        $result = mysqli_query($conn, $sql);


    }





    header("Location: building.php");
}


function ModalFormBuilding(){






    echo "<div class=\"modal\" id=\"myModalBuilding\">\n";
    echo "  <div class=\"modal-dialog modal-lg\">\n";
    echo "    <div class=\"modal-content\">\n";


    echo "      <div class=\"modal-header\">\n";
    echo "        <h4 class=\"modal-title\">اضافة مبنى</h4>\n";
    echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "      </div>\n";


    echo "      <div class=\"modal-body\">\n";

    
    form_building();
    
    
    echo "      </div>\n";

 

    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>";

}



?>