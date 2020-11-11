<?php

### This Code for loading data from table sections

function load_sections(){


    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $building_id = $_GET["building_id"];
    $section_id=$_SESSION["section_id"];
    //$sql= "select * from sections where building_id =$building_id and section_id='$section_id'";
    $sql= "select * from sections where building_id ='$building_id' ";

    $result = mysqli_query($conn, $sql);
    echo "      <div class=\"card\" >";
    echo "      <table  class=\"table\" >\n";
    echo "          <tr>\n";
    echo "            <th>التسلسل</th>\n";
    echo "            <th>اسم القسم</th>\n";
    echo "            <th></th>\n";
    echo "          </tr>\n";
    if (mysqli_num_rows($result) > 0) {
        $serial =1;
        while($row = mysqli_fetch_assoc($result)) {
            $section_id =  $row[section_id];

            //$urlEdit = ("?switch=edit_sections&RecordID=".$row[section_id]."");
            $urlEdit = ("classes.php?section_id=".$row[section_id]."");
            $urlDelete = ("?switch=delete_sections&RecordID=".$row[section_id]."&building_id=$building_id");


            echo "  <tr>\n";
            //echo "         <td><a href=\"$urlEdit\">تعديل</a></td>\n";
            echo "         <td>$serial</td>\n";
            echo "         <td><a href=\"$urlEdit\">" . $row[section_name] . "</a></td>\n";
            echo "         <td><a href=\"$urlDelete\" class='text-muted'>حذف</a></td>\n";
            echo "  </tr>\n";
            $serial++;
        }


    }else{




    }
    echo "</table>";
    echo "</div>";
    mysqli_close($conn);

    echo "<hr>";

    // echo "<a class=\"btn btn-warning\" href=\"building.php?switch=edit_building&RecordID=$building_id\">تعديل المبنى</a>  ";
    //echo "<a class=\"btn btn-primary\" href=\"sections.php?switch=new_sections\">اضافة قسم جديد للمبنى</a>  ";

    // echo "<a class=\"btn btn-danger\" href=\"sections.php?switch=delete_building&RecordID=$building_id\">إزالة المبنى</a>  ";
    // echo "         <a class=\"btn btn-danger \" href=\"building.php?switch=delete_building&RecordID=$building_id\">إزالة المبنى</a>\n";


    echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">\n";
    echo "  اضف قسم جديد\n";
    echo "</button>\n";
    ModalFormSection();



}



### This code for form table  sections

function form_sections($RecordID=0){

    $building_id = $_GET["building_id"];
    
    $RecordID = intval($RecordID);
    if($RecordID>0){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from sections where section_id='$RecordID'" ;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $section_name=$row["section_name"];
            $building_id=$row["building_id"];





        }
    }
    $URLAction = "?switch=save_sections";
    echo "      <div class=\"card\" >";
    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---section_name----------------
    echo "        <tr>\n";
    echo "            <td >اسم القسم / المسرح</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input class=\"form-control\"  type=\"text\" name=\"section_name\" value =\"$section_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---section_name----------------



    //---------START---section_id----------------
//    echo "        <tr>\n";
//    echo "            <td >المبنى</td>\n";
//    echo "        </tr>\n";
//    echo "        <tr>\n";
//    echo "            <td >\n";
//    //echo "                 <input   type=\"hidden\" name=\"building_id\" value =\"$building_id\" >\n";
//
//    //echo InputSelect("select building_id,building_name from building ","building_id","building_name",$building_id,"building_id");
//
//    echo "            </td>\n";
//    echo "        </tr>\n";
    //---------End---section_id----------------



    echo "    </table>\n";
    echo "      </div>\n";

    echo "              <input  type=\"hidden\" name=\"RecordID\" value =\"$RecordID\" >\n";
    echo "           <hr>\n";
    echo "        <input class=\"btn btn-success\"  type=\"submit\" name=\"_save\" value =\"حفظ\" >\n";
    echo "        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">تراجع</button>\n";
    // echo "         <a class=\"btn btn-outline-light text-dark\" href=\"sections.php?switch=delete_sections&RecordID=$RecordID\">Delete</a>\n";
    echo "                 <input   type=\"hidden\" name=\"building_id\" value =\"$building_id\" >\n";
    echo "      </form>\n";


}



function save_sections(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);

    $section_name= $_POST["section_name"];
    $building_id = $_POST["building_id"];



    if ($RecordID == 0) {
        $sql= "INSERT INTO sections  (section_name,building_id) Values ('".$section_name."','".$building_id."')";
        $result = mysqli_query($conn, $sql);


    }


    if ($RecordID > 0) {
        $sql= "UPDATE sections SET   section_name='".$section_name."',building_id='".$building_id."'  WHERE section_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: sections.php?building_id=$building_id");
}

function delete_sections(){



    $building_id=$_GET["building_id"];
    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);




    if ($RecordID > 0) {
        $sql= "DELETE FROM sections WHERE section_id=$RecordID";
        $result = mysqli_query($conn, $sql);


    }





    header("Location: sections.php?building_id=$building_id");
}


function ModalFormSection(){






    echo "<div class=\"modal\" id=\"myModal\">\n";
    echo "  <div class=\"modal-dialog modal-lg\">\n";
    echo "    <div class=\"modal-content\">\n";


    echo "      <div class=\"modal-header\">\n";
    echo "        <h4 class=\"modal-title\">اضافة قسم</h4>\n";
    echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "      </div>\n";


    echo "      <div class=\"modal-body\">\n";

    
    form_sections();
    
    
    echo "      </div>\n";

 

    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>";

}

?>