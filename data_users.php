<?PHP

### This Code for loading data from table users

function load_users(){


    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }




//    $sql= "select * from users";


    $section_id = $_SESSION["section_id"];
    $sql = "select * from users  ";



    $result = mysqli_query($conn, $sql);
    echo "      <div class=\"card\" >";
    echo "      <table  class=\"table\" >\n";
    echo "          <tr>\n";
    //echo "            <th>رمز المستخدم</th>\n";
    echo "            <th>اسم المستخدم</th>\n";
    echo "            <th>اسم الدخول</th>\n";
    //echo "            <th>القسم</th>\n";
    //echo "            <th>نشط</th>\n";
    echo "            <th>بريد الكتروني</th>\n";
    echo "            <th></th>\n";
    echo "            <th></th>\n";
   // echo "            <th>المجموعة</th>\n";
    echo "          </tr>\n";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $user_id =  $row[user_id];
            $urlEdit = ("?switch=edit_users&RecordID=".$row[user_id]."");
            echo "  <tr>\n";
            //echo "         <td>" . $row[user_id] . "</td>\n";
            echo "         <td>" . $row[user_name] . "</td>\n";
            echo "         <td>" . $row[login_id] . "</td>\n";
           // echo "         <td>" . $row[section_id] . "</td>\n";
            //echo "         <td>" . $row[is_active] . "</td>\n";
            echo "         <td>" . $row[user_email] . "</td>\n";
            echo "         <td><a class=\"btn btn-warning  btn-sm\" href=\"$urlEdit\">تعديل</a></td>\n";
            echo "         <td><a class=\"btn btn-outline-light text-dark btn-sm\" href=\"users.php?switch=delete_users&RecordID=$user_id\">حذف</a></td>\n";
            echo "  </tr>\n";

        }


    }else{
        //  echo "0 results";



    }
    //    echo "</table>";
    //    mysqli_close($conn);
    //    echo "<a href=\"users.php?switch=new_users\">اضافة جديد</a>";


    echo "</table>";
    echo "</div>";
    mysqli_close($conn);

    echo "<hr>";
   // echo "<a class=\"btn btn-outline-primary\" href=\"users.php?switch=new_users\">اضافة جديد</a>";
   echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModalUser\">\n";
    echo "  اضف مستخدم جديد\n";
    echo "</button>\n";
    
    ModalFormUsers();

}



### This code for form table  users

function form_users($RecordID=0){

     $section_id = $_SESSION["section_id"];
    $RecordID = intval($RecordID);
    if($RecordID>0){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from users where user_id='$RecordID'" ;

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $user_name=$row["user_name"];
            $login_id=$row["login_id"];
            $login_password=$row["login_password"];
            $section_id=$row["section_id"];
            $is_active=$row["is_active"];
            $user_email=$row["user_email"];
            $group_id=$row["group_id"];






        }
    }
    $URLAction = "?switch=save_users";
    echo "      <div class=\"card\" >";
    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---user_name----------------
    echo "        <tr>\n";
    echo "            <td >اسم المستخدم الثلاثي</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input class=\"form-control\"  type=\"text\" name=\"user_name\" value =\"$user_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---user_name----------------

    //---------START---login_id----------------
    echo "        <tr>\n";
    echo "            <td >اسم الدخول</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input class=\"form-control\"    type=\"text\" name=\"login_id\" value =\"$login_id\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---login_id----------------

    //---------START---login_password----------------
    echo "        <tr>\n";
    echo "            <td >كلمة المرور</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input class=\"form-control\"    type=\"password\" name=\"login_password\" value =\"$login_password\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---login_password----------------

    //---------START---section_id----------------
    echo "        <tr>\n";
    echo "            <td >القسم</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    //echo "                 <input class=\"form-control\"    type=\"text\" name=\"section_id\" value =\"$section_id\" >\n";

    echo InputSelect("select section_id,section_name from sections","section_id","section_name",$section_id,"section_id");

    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---section_id----------------

    //---------START---is_active----------------
//    echo "        <tr>\n";
//    echo "            <td >نشط</td>\n";
//    echo "        </tr>\n";
//    echo "        <tr>\n";
//    echo "            <td >\n";
//    echo "                 <input class=\"form-control\"    type=\"text\" name=\"is_active\" value =\"$is_active\" >\n";
//    echo "            </td>\n";
//    echo "        </tr>\n";
    //---------End---is_active----------------

    //---------START---user_email----------------
    echo "        <tr>\n";
    echo "            <td >بريد الكتروني</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "                 <input class=\"form-control\"    type=\"text\" name=\"user_email\" value =\"$user_email\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---user_email----------------

    //---------START---group_id----------------
    echo "        <tr>\n";
    echo "            <td >نوع المستخدم</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    //echo "                 <input class=\"form-control\"    type=\"text\" name=\"group_id\" value =\"$group_id\" >\n";

    echo InputSelect("select group_id,group_name from groups ","group_id","group_name",$group_id,"group_id");


    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---group_id----------------





    echo "    </table>\n";
    echo "      </div>\n";

    echo "              <input  type=\"hidden\" name=\"RecordID\" value =\"$RecordID\" >\n";
    echo "           <hr>\n";
    echo "                  <input class=\"btn btn-success\"  type=\"submit\" name=\"_save\" value =\"حفظ\" >\n";
    //echo "         <a class=\"btn btn-outline-light text-dark\" href=\"users.php?switch=delete_users&RecordID=$RecordID\">Delete</a>\n";
    echo "      </form>\n";


}



function save_users(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);

    $user_name= $_POST["user_name"];

    $login_id= $_POST["login_id"];

    $login_password= $_POST["login_password"];

    $section_id= $_POST["section_id"];

    $is_active= $_POST["is_active"];

    $user_email= $_POST["user_email"];

    $group_id= $_POST["group_id"];




    if ($RecordID == 0) {
        $sql= "INSERT INTO users  (user_name,login_id,login_password,section_id,is_active,user_email,group_id) Values ('".$user_name."','".$login_id."','".$login_password."','".$section_id."','".$is_active."','".$user_email."','".$group_id."')";
        $result = mysqli_query($conn, $sql);


    }


    if ($RecordID > 0) {
        $sql= "UPDATE users SET   user_name='".$user_name."',login_id='".$login_id."',login_password='".$login_password."',section_id='".$section_id."',is_active='".$is_active."',user_email='".$user_email."',group_id='".$group_id."'  WHERE user_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: users.php");
}

function delete_users(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);




    if ($RecordID > 0) {
        $sql= "DELETE FROM users WHERE user_id=$RecordID";
        $result = mysqli_query($conn, $sql);


    }





    header("Location: users.php");
}


function ModalFormUsers(){






    echo "<div class=\"modal\" id=\"myModalUser\">\n";
    echo "  <div class=\"modal-dialog modal-lg\">\n";
    echo "    <div class=\"modal-content\">\n";


    echo "      <div class=\"modal-header\">\n";
    echo "        <h4 class=\"modal-title\">اضافة قسم</h4>\n";
    echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "      </div>\n";


    echo "      <div class=\"modal-body\">\n";

    
    form_users();
    
    
    echo "      </div>\n";

 

    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>";

}

?>