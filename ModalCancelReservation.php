<?PHP
ob_start();
session_start();
require_once("../inc/Config.php");

$switch=$_GET['switch'];

switch ($switch) {

    case "do_cancel";
        do_cancel();
        // echo "HI";

        break;



    default;
        ModalAddCancelResevation();
        break;
}





function ModalAddCancelResevation(){


    $res_id = $_GET["res_id"];

    $show_ok = true;

    echo "  <div class=\"modal\" id=\"myModalCancelResvration\">\n";
    echo "    <div class=\"modal-dialog modal-lg\">\n";
    echo "      <div class=\"modal-content\">\n";
    echo "      \n";
    echo "        <!-- Modal Header -->\n";
    echo "        <div class=\"modal-header\">\n";
    echo "          <h4 class=\"modal-title\">الغاء حجز قاعة</h4>\n";
    echo "          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>\n";
    echo "        </div>\n";
    echo "        \n";
    echo "        <!-- Modal body -->\n";
    echo "        <div class=\"modal-body\">\n";
    ##################################################


    echo "<div id='ContentCancelResvration'>" ;
    if(is_can_cancel($res_id)){


        form_Cancel_reservation($res_id);   
    }else{
        echo "<div class=\"alert alert-success\">\n";
        echo "  <strong>عفوا !</strong>هذه القاعة محجوزة لقسم اخر . لا يمكنك تحرير معلوماتها او حذفها.\n";
        echo "</div>"; 
        $show_ok = false;

    }

    echo "  </div>\n";

    echo "<div id='ContentDoneCancel' style='display:none'>" ;
    echo "<div class=\"alert alert-success\">\n";
    echo "  <strong>تم الالغاء!</strong> يمكنك اغلاق هذه النافذة.\n";
    echo "</div>";
    echo "  </div>\n";

    ##################################################
    echo "        </div>\n";
    echo "        \n";
    echo "        <!-- Modal footer -->\n";
    echo "        <div class=\"modal-footer\">\n";
    if($show_ok){
        echo "          <button id='btn-start-CancelReservation' type=\"button\" class=\"btn btn-success\"  onclick='OpenModalCancelReservation_save();'>موافق</button>\n";
    }
    echo "          <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">اغلاق</button>\n";
    echo "        </div>\n";
    echo "        \n";
    echo "      </div>\n";
    echo "    </div>\n";
    echo "  </div>\n";




}

function form_Cancel_reservation($res_id){

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

    echo "      <form method=\"POST\" action=\"#\" id='FormaModalCancelResevation'>\n";

    echo "<div class='well'>هل تريد بالتأكيد الغاء هذا الحجز</div>";

    echo "        <input type=\"radio\" id=\"radio-1\"  name='type_cancel' value='CancelOne' CHECKED>\n";
    echo "      <label class=\"form-check-label\" for=\"radio-1\">الغاء مؤقت</label>\n";
    echo "<br>";
    echo "        <input type=\"radio\" id=\"radio-2\"  name='type_cancel' value='CancelAll' >\n";
    echo "      <label class=\"form-check-label\" for=\"radio-2\">الغاء دائم</label>\n";


    echo "                 <input   type=\"hidden\" name=\"res_id\" value =\"$res_id\" >\n";

    echo "      </form>\n";



}

function is_can_cancel($res_id){
    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $section_id=$_SESSION["section_id"];

    $sql= "select * from reservation where res_id='$res_id'  ";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {     
        $row = mysqli_fetch_assoc($result);
        $class_id = $row["class_id"];


        $sql= "select * from classes where class_id='$class_id' and section_id='$section_id'   ";
        // echo $sql;
        $result2 = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result2) > 0) {     
            return true;
        }



    }   
    return false;
}

function do_cancel(){

    //echo "HI";

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }



    $user_id= $_SESSION["user_id"];

    $res_id= $_POST["res_id"];



    $type= $_POST["type_cancel"];



    if($type=="CancelAll"){







        $sql= "select * from reservation where res_id='$res_id'  ";


        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {     
            $row = mysqli_fetch_assoc($result);


            $class_id = $row["class_id"];
            $time_id = $row["time_id"];


            $sql= "delete  from reservation where class_id='$class_id'  and time_id='$time_id' " ;
            $result = mysqli_query($conn, $sql); 




        }

        mysqli_close($conn);

    }elseif ($type=="CancelOne"){

        $sql= "delete  from reservation where res_id='$res_id'  " ;
        $result = mysqli_query($conn, $sql); 



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