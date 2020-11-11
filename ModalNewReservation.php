<?PHP
ob_start();
session_start();

require_once("../inc/Config.php");

$switch=$_GET['switch'];

switch ($switch) {

    case "save_new";
        save_new_reservation();
        break;



    default;
        ModalAddNewResevation();
        break;
}





function ModalAddNewResevation(){


    $class_id = $_GET["class_id"];
    $date = $_GET["date"];
    $time_id = $_GET["time_id"];








    echo "  <div class=\"modal\" id=\"myModalNewResvration\">\n";
    echo "    <div class=\"modal-dialog modal-lg\">\n";
    echo "      <div class=\"modal-content\">\n";
    echo "      \n";
    echo "        <!-- Modal Header -->\n";
    echo "        <div class=\"modal-header\">\n";
    echo "          <h4 class=\"modal-title\">اضف حجز جديد</h4>\n";
    echo "          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "        </div>\n";
    echo "        \n";
    echo "        <!-- Modal body -->\n";
    echo "        <div class=\"modal-body\">\n";
    ##################################################


    echo "<div id='ContentNewResvration'>" ;
    form_reservation($class_id,$date,$time_id);
    echo "  </div>\n";

    echo "<div id='ContentDone' style='display:none'>" ;
    echo "<div class=\"alert alert-success\">\n";
    echo "  <strong>تم الحجز!</strong> يمكنك اغلاق هذه النافذة.\n";
    echo "</div>";
    echo "  </div>\n";

    ##################################################
    echo "        </div>\n";
    echo "        \n";
    echo "        <!-- Modal footer -->\n";
    echo "        <div class=\"modal-footer\">\n";
    echo "          <button id='btn-start-Reservation' type=\"button\" class=\"btn btn-success\"  onclick='OpenModalNewReservation_save();'>موافق</button>\n";
    echo "          <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">اغلاق</button>\n";
    echo "        </div>\n";
    echo "        \n";
    echo "      </div>\n";
    echo "    </div>\n";
    echo "  </div>\n";




}

function form_reservation($class_id,$date,$time_id){

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $sql= "select * from times where time_id='$time_id'  ";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {     
        $row = mysqli_fetch_assoc($result);
        $time_name = date("H:i",strtotime( $row["start_time"]))  ." - "  .date("H:i",strtotime( $row["end_time"])); 
    }

    echo "      <form method=\"POST\" action=\"#\" id='FormaModalNewResevation'>\n";
    echo "    <table  class=\"table\" width=\"100%\" >\n";


    echo "        <tr>\n";
    echo "            <td >اسم المادة</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "<input class=\"form-control input-sm \" id=\"id_course_name\" type=\"text\" name=\"course_name\" value =\"$course_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";


    echo "        <tr>\n";
    echo "            <td >رقم المادة </td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "<input class=\"form-control input-sm \" id=\"id_course_no\" type=\"text\" name=\"course_no\" value =\"$course_no\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";

    echo "        <tr>\n";
    echo "            <td >الدكتور </td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    echo "<input class=\"form-control input-sm \" id=\"id_doctor_name\" type=\"text\" name=\"doctor_name\" value =\"$doctor_name\" >\n";
    echo "            </td>\n";
    echo "        </tr>\n";



    echo "        <tr>\n";
    echo "            <td >وقت الحجز : الساعة <strong>$time_name</strong></td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";




    echo "        <input type=\"radio\" id=\"radio-1\"  name='type_r' value='byall' CHECKED>\n";
    echo "      <label class=\"form-check-label\" for=\"radio-1\"> طول الفصل</label>\n";

    echo "<br>";



    echo "&nbsp;&nbsp;&nbsp;&nbsp;      -- <input type=\"checkbox\"  value=\"7\" id=\"check-1\" name='day_s[]'>\n";
    echo "      <label  for=\"check-1\"> كل أحد</label>\n";
    echo "<br>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;    -- <input type=\"checkbox\"  value=\"1\" id=\"check-2\" name='day_s[]'>\n";
    echo "      <label   for=\"check-2\"> كل اثنين</label>\n";
    echo "<br>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;    -- <input type=\"checkbox\"  value=\"2\" id=\"check-3\" name='day_s[]'>\n";
    echo "      <label   for=\"check-3\"> كل ثلاثاء</label>\n";
    echo "<br>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;    -- <input type=\"checkbox\"  value=\"3\" id=\"check-4\" name='day_s[]'>\n";
    echo "      <label   for=\"check-4\"> كل اربعاء</label>\n";

    echo "<br>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;    -- <input type=\"checkbox\"  value=\"4\" id=\"check-5\" name='day_s[]'>\n";
    echo "      <label  for=\"check-5\" > كل خميس</label>\n";

    echo "<br>";


    echo "        <input type=\"radio\" id=\"radio-2\" name='type_r' value='bydate'>\n";
    echo "      <label class=\"form-check-label\" for=\"radio-2\"> يوم واحد فقط بتاريخ : ". date("Y-m-d",strtotime($date)) ."</label>\n";


    echo "            </td>\n";
    echo "        </tr>\n";    

    echo "    </table>\n";
    echo "                 <input   type=\"hidden\" name=\"class_id\" value =\"$class_id\" >\n";
    echo "                 <input   type=\"hidden\" name=\"date\" value =\"$date\" >\n";
    echo "                 <input   type=\"hidden\" name=\"time_id\" value =\"$time_id\" >\n";
    echo "      </form>\n";



}

function save_new_reservation(){



    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }



    $user_id=$_SESSION["user_id"] ;

    $class_id= $_POST["class_id"];

    $reservation_date= $_POST["date"];

    $time_id= $_POST["time_id"];

    $course_name= $_POST["course_name"];

    $course_no= $_POST["course_no"];

    $doctor_name= $_POST["doctor_name"];

    $type= $_POST["type_r"];



    if($type=="byall"){


        $day_s =$_POST["day_s"] ;
        
        if(is_array($day_s)){



            $sql= "select * from chapter_date  ";


            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) { 
                
                $row = mysqli_fetch_assoc($result);
                
                $start_date = $row["start_date"];
                $end_date = $row["end_date"];


                $datediff = strtotime($end_date) - strtotime($start_date);
                $days = round($datediff / (60 * 60 * 24));  //90
                
                $is_reservation = is_reservation($class_id,$reservation_date,$time_id,true);
                
                
                if($is_reservation){



                    for($d=0; $d <= $days ; $d++){

                        $reservation_date = date("Y-m-d" ,strtotime("$start_date + $d days"));
                        $day_no = date("N",strtotime($reservation_date));

                        if(in_array($day_no , $day_s )){



                            $sql= "INSERT INTO reservation  
                            (user_id,class_id,reservation_date,time_id,course_name,course_no,doctor_name) 
                            Values ('".$user_id."','".$class_id."','".$reservation_date."','".$time_id."','".$course_name."','".$course_no."',
                            '".$doctor_name."')";



                            $result = mysqli_query($conn, $sql); 
                        }

                    }
                }else{
                    //////////////  
                }

            }

            mysqli_close($conn);
        }else{

        }
    }elseif ($type=="bydate"){


        $is_reservation = is_reservation($class_id,$reservation_date,$time_id,false);
        
        
        if($is_reservation()){
            $sql= "INSERT INTO reservation  
            (user_id,class_id,reservation_date,time_id,course_name,course_no,doctor_name) 
            Values ('".$user_id."','".$class_id."','".$reservation_date."','".$time_id."','".$course_name."','".$course_no."','".$doctor_name."')";
            $result = mysqli_query($conn, $sql);   
        }else{
            ////////////
        }





    }












}

function is_reservation($class_id,$reservation_date,$time_id,$is_Full=true){

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }


    if($is_Full){
        $sql= "select * from reservation where class_id='$class_id'  and  time_id='$time_id'  ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {     
            return false;
        }else{
            return true;
        }    


    }else{

        $sql= "select * from reservation where class_id='$class_id' and reservation_date='$reservation_date' and  time_id='$time_id'  ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {     
            return false;
        }else{
            return true;
        }       
    }








}

function delete_reservation(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID=intval($_REQUEST["RecordID"]);




    if ($RecordID == 0) {
        $sql= "DELETE FROM reservation WHERE res_id=$RecordID";
        $result = mysqli_query($conn, $sql);


    }





    header("Location: reservation.php");   
}
?>