<?PHP

### This Code for loading data from table classes

function load_classes(){


    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $section_id = $_REQUEST["section_id"];
    
    
    if($section_id==""){
        
        echo "<p>يجب تحديد القسم</p>";
        return;
        
    }    


    $sql= "select * from classes where section_id='$section_id'";

    $result = mysqli_query($conn, $sql);
    echo "      <div class=\"card\" >";
    echo "      <table  class=\"table\" >\n";

    echo "          <tr>\n";
    echo "            <th>#</th>\n";
    //echo "            <th>المبنى</th>\n";
    echo "            <th>رقم القاعة</th>\n";
    echo "            <th>الدور</th>\n";
    echo "            <th>شبكة</th>\n";
    echo "            <th>سعة المقاعد</th>\n";
    echo "            <th></th>\n";
    echo "            <th></th>\n";
    echo "          </tr>\n";

    if (mysqli_num_rows($result) > 0) {
        $serial =1;
        while($row = mysqli_fetch_assoc($result)) {
            $class_id =  $row[class_id];
            $urlEdit = ("?switch=edit_classes&RecordID=".$row[class_id]."&section_id=$section_id");
            $urlDelete = ("?switch=delete_classes&RecordID=".$row[class_id]."&section_id=$section_id");
           
            echo "  <tr>\n";
           // echo "         <td><a href=\"$urlEdit\">" . $row[class_id] . "</a></td>\n";
            echo "         <td>" . $serial . "</td>\n";
            
            echo "         <td>" . $row[class_name] . "</td>\n";
            echo "         <td>" . $row[floor_no] . "</td>\n";

           
            
            if($row["is_network"]==1){
                $isNet = "يوجد شبكة";
            }else{
                $isNet = "لايوجد شبكة";
            }
            
            echo "         <td>" . $isNet . "</td>\n";
            echo "         <td>" . $row[count_avilable] . "</td>\n";
            echo "         <td><a class=\"btn btn-warning  btn-sm\" href=\"$urlEdit\">تعديل</a></td>\n";
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
   // echo "<a class=\"btn btn-outline-primary\" href=\"classes.php?switch=new_classes\">اضافة جديد</a>";
           echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModalClass\">\n";
    echo "  اضف قاعة\n";
    echo "</button>\n";
    ModalFormClass();
}



### This code for form table  classes

function form_classes($RecordID=0){


    $RecordID = intval($RecordID);
     $section_id = $_REQUEST["section_id"];
    if($RecordID>0){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        
        $sql= "select * from classes where class_id='$RecordID'" ;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $building_id=$row["building_id"];
           // $section_id =$row["section_id"];
            $class_name=$row["class_name"];
            $floor_no=$row["floor_no"];
            $is_network=$row["is_network"];
            $count_avilable=$row["count_avilable"];






        }
    }
    
    if($section_id==""){
        
        echo "<p>يجب تحديد القسم</p>";
        return;
        
    }    
    
    $URLAction = "?switch=save_classes&section_id=$section_id";
    echo "      <div class=\"card\" >";
    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---building_id----------------
//    echo "        <tr>\n";
//    echo "            <td >رقم المبنى</td>\n";
//    echo "        </tr>\n";
//    echo "        <tr>\n";
//    echo "            <td >\n";
//
//    echo InputSelect("select building_id,building_name from building ","building_id","building_name",$building_id,"building_id");
//    echo "            </td>\n";
//    echo "        </tr>\n";
    //---------End---building_id----------------

    //---------START---class_name----------------
    echo "        <tr>\n";
    echo "            <td >رقم القاعة</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  class=\"form-control\"  type=\"text\" name=\"class_name\" value =\"$class_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---class_name----------------


    //---------START---section_id----------------
//    echo "        <tr>\n";
//    echo "            <td >القسم</td>\n";
//    echo "        </tr>\n";
//    echo "        <tr>\n";
//    echo "            <td >\n";
//    //echo "                 <input class=\"form-control\"    type=\"text\" name=\"section_id\" value =\"$section_id\" >\n";
//
//    echo InputSelect("select section_id,section_name  from sections where section_id='$section_id' ","section_id","section_name",$section_id,"section_id");
//
//    echo "            </td>\n";
//    echo "        </tr>\n";
    //---------End---section_id----------------

    //---------START---floor_no----------------
    echo "        <tr>\n";
    echo "            <td >الدور</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  class=\"form-control\"  type=\"text\" name=\"floor_no\" value =\"$floor_no\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---floor_no----------------

    //---------START---is_network----------------
//    echo "        <tr>\n";
//    echo "            <td >شبكة</td>\n";
//    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td style='padding:10px'>\n";
    if($is_network==1){
        $Checked = "checked";
    }else{
        $Checked = "";
    }
//    echo "<lable for=\"id_net\">شبكة</lable>";
//    echo "                 <input id='id_net' class=\"form-control\"  type=\"checkbox\" name=\"is_network\" value =\"1\" $Checked>\n";

echo "  <label class=\"form-check-label\">\n";
echo "    <input type=\"checkbox\" class=\"form-check-input\" name=\"is_network\"  value=\"1\" $Checked>&nbsp;&nbsp;&nbsp;     شبكة     \n";
echo "  </label>";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---is_network----------------

    //---------START---count_avilable----------------
    echo "        <tr>\n";
    echo "            <td >سعة المقاعد</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input  class=\"form-control\"  type=\"text\" name=\"count_avilable\" value =\"$count_avilable\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---count_avilable----------------



    echo "    </table>\n";
    echo "      </div>\n";

    echo "              <input  type=\"hidden\" name=\"RecordID\" value =\"$RecordID\" >\n";
    echo "           <hr>\n";
//    echo "                  <input class=\"btn btn-success\"  type=\"submit\" name=\"_save\" value =\"Save\" >\n";
//    echo "         <a class=\"btn btn-outline-light text-dark\" href=\"classes.php?section_id=$section_id\">تراجع</a>\n";
    echo "          <button type=\"submit\" class=\"btn btn-success\">حفظ</button>" ;
    echo "        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">تراجع</button>\n";
    
    //echo "                 <input   type=\"hidden\" name=\"section_id\" value =\"$section_id\" >\n";
    echo "      </form>\n";


}



function save_classes(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);

    $building_id= $_POST["building_id"];

    $section_id = $_REQUEST["section_id"];
    
    
    if($section_id==""){
        
        echo "<p>يجب تحديد القسم</p>";
        return;
        
    }


    $class_name= $_POST["class_name"];

    $floor_no= $_POST["floor_no"];

    $is_network= $_POST["is_network"];

    $count_avilable= $_POST["count_avilable"];




    if ($RecordID == 0) {
        $sql= "INSERT INTO classes  (building_id,section_id,class_name,floor_no,is_network,count_avilable) Values
        ('".$building_id."','".$section_id."','".$class_name."','".$floor_no."','".$is_network."','".$count_avilable."')";
        $result = mysqli_query($conn, $sql);


    }


    if ($RecordID > 0) {
        $sql= "UPDATE classes SET   class_name='".$class_name."',floor_no='".$floor_no."',is_network='".$is_network."',count_avilable='".$count_avilable."'  WHERE class_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: classes.php?section_id=$section_id");
}

function delete_classes(){


     $section_id=intval($_REQUEST["section_id"]);

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);




    if ($RecordID > 0) {
        $sql= "DELETE FROM classes WHERE class_id=$RecordID";
        $result = mysqli_query($conn, $sql);


    }





    header("Location: classes.php?section_id=$section_id");
}


 function ModalFormClass(){






    echo "<div class=\"modal\" id=\"myModalClass\">\n";
    echo "  <div class=\"modal-dialog modal-lg\">\n";
    echo "    <div class=\"modal-content\">\n";


    echo "      <div class=\"modal-header\">\n";
    echo "        <h4 class=\"modal-title\">اضافة قاعة</h4>\n";
    echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "      </div>\n";


    echo "      <div class=\"modal-body\">\n";

    
    form_classes();
    
    
    echo "      </div>\n";

 

    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>";

}


?>