<?PHP

class Resevation{



    function DrowTable($section_id,$from_time , $to_time){
        //$from_time= $this->ReturnDayToFirst($from_time);

        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");



        echo "<form action=\"reservation.php?switch=drowtable\" method=\"post\">\n";

        echo "<div id='loading' style=\"display:none\">";
        echo "  <div class=\"progress\">\n";
        echo "    <div class=\"progress-bar progress-bar-striped progress-bar-animated\" style=\"width:40%\"></div>\n";
        echo "  </div>";
        echo " </div>";




        $sql= "select * from sections where section_id=$section_id ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result) ;


            echo "<h1>".$row["section_name"]."</h1>";

        }

        echo " <div class=\"row\">\n";//12

        echo "  <div class=\"col-sm-12\">";
        echo "<h1>".$from_time ."</h1> ";




        //        echo "<div class='pull-left'>";
        //        echo "<input type=\"date\" id=\"birthday\" value='$from_time' name=\"selectdate\" onchange='refresh_table_new_date(this.value);'> ";
        //        echo "</div>" ;
        //        
        //           echo "<div class='pull-left'>";
        $this->MYLOAD_SECTIONS($section_id,$from_time);
        //        echo "</div>" ;     

        echo "  </div>\n";





        echo "</div> ";


        echo "<hr>";

        echo "      <div class=\"card\" >";


        echo "      <div  class=\"table-responsive\" >\n";
        echo "<table  class=\"table\">\n";
        echo "    <tr>\n";                        //echo "        <td>خلف</td>\n";
        echo "        <th>القاعات</th>\n";



        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from times ";

        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                $start_time = date("H:i", strtotime($row["start_time"]));    
                $end_time = date("H:i", strtotime($row["end_time"]));


                echo "        <th>".  $start_time ." - " . $end_time  ."</th>\n";    
            }
        }        
        mysqli_close($conn);



        echo "    </tr>\n";


        $this->load_classes($section_id,$from_time);


        echo "</table>";

           echo "    </div>\n";
        echo "    </div>\n";
        echo "</form>";  
    }

    function MYLOAD_SECTIONS($section_id,$from_time){

        $section_id= $_SESSION["section_id"] ;


        echo "<div class=\"input-group mb-3\">\n";
        echo "  <input type=\"date\" class=\"form-control\" value='$from_time' name=\"selectdate\" id='SerachDateId' >\n";   

        $sql= "select * from sections where allow_other=1 or section_id='$section_id' order by binary(section_name) ";
        echo InputSelect($sql,"section_id","section_name",$section_id,"selectsection_id");
        echo "  <div class=\"input-group-append\">\n";
        echo "    <button class=\"btn btn-success\" type=\"button\" onclick='refresh_table_new_date(\"SerachDateId\",\"id_selectsection_id\");'>بحث</button>\n";
        echo "  </div>\n";
        echo "</div>";
    }


    ### This Code for loading data from table classes

    function load_classes($section_id,$from_time){


        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $sql= "select * from classes where section_id ='$section_id'";

        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $class_id =  $row[class_id];


                echo "  <tr>\n";
                //echo "         <td></td>\n";
                echo "         <td>" . $row[class_name] . "</td>\n";

                //                for($i=0;$i<6;$i++){
                //                    $ColDate = date("Y-m-d",strtotime($from_time . " + $i day"));
                //                    
                //                    echo "         <td>". $this->GetReservationClass($class_id,$ColDate)."</td>\n";
                //
                //                }


                $sql= "select * from times ";

                $result2 = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result2) > 0) {

                    while($row2 = mysqli_fetch_assoc($result2)) {

                        $time_id = $row2["time_id"];



                        echo "         <td>". $this->GetReservationClass($class_id,$from_time,$time_id)."</td>\n";   
                    }
                }        



                echo "  </tr>\n";
                $i++;
            }







        }

        mysqli_close($conn);
        //   $this->form_reservation($section_id);

    }

    //function ReturnDayToFirst($date){
//        $fromSerila =  date("N",strtotime($date));
//
//        if($fromSerila !=7){
//            $date= date("Y-m-d l",strtotime($date . "- $fromSerila day"));
//        }
//
//        return $date;
//    }

    function GetReservationClass($class_id,$date,$time_id){
        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }
        $login_user_id=$_SESSION["user_id"];
        
        $sql= "select * from reservation where class_id ='$class_id' and  reservation_date ='$date' and time_id='$time_id' ";

        //echo $sql;
        $result = mysqli_query($conn, $sql);

        // $content.= "<table  class=\"table\">\n";
        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $res_id = $row["res_id"];
                $class_id = $row["class_id"];
                $user_id = $row["user_id"];

                if ($user_id !== $login_user_id ) {     
                  
                  
                  $btn_style = "btn-warning"  ; 
                }else{
                  $btn_style = "btn-danger"  ;   
                }
                $button_curse =  "<div>";
                $button_curse .= "<button type=\"button\" class=\"btn $btn_style btn-block\" onclick='OpenModalCancelReservation($res_id);'><small>". $row["course_name"]."-".$row["course_no"]."-".$row["doctor_name"]."</small></button>";
                $button_curse .=  "<div>";

                $content.= "         <div  > $button_curse</div>\n";
            }
        }else{
            //$content.= "  <tr>\n";

            $button_add =  "<button type=\"button\" class=\"btn btn-success btn-block\" onclick='OpenModalNewReservation($class_id,\"$date\",$time_id);'>احجز</button>";


            $content.= "         <div  > $button_add</div>\n";
            //$content.= "  </tr>\n";           
        }
        // $content.= "</table>";
        mysqli_close($conn);

        return $content;
    }


    ### This code for form table  reservation

    function form_reservation($section_id){


        $URLAction = "?switch=save_reservation";
        $from_time ="08:00";
        $to_time ="09:00";
        echo "      <form method=\"POST\" action=\"$URLAction\">\n";


        echo "    <table  class=\"table\" width=\"100%\" >\n";


        //        //---------START---user_id----------------
        //        echo "        <tr>\n";
        //        echo "            <td >" . _user_id .  "</td>\n";
        //        echo "        </tr>\n";
        //        echo "        <tr>\n";
        //        echo "            <td >\n";
        //        echo "                 <input  type=\"text\" name=\"user_id\" value =\"$user_id\" >\n";
        //        echo "            </td>\n";
        //        echo "        </tr>\n";
        //        //---------End---user_id----------------

        //---------START---class_id----------------
        echo "        <tr>\n";
        echo "            <td >القاعة</td>\n";
        echo "        </tr>\n";
        echo "        <tr>\n";
        echo "            <td >\n";
        //echo "                 <input  type=\"text\" name=\"class_id\" value =\"$class_id\" >\n";
        $sql= "select * from  `classes` where section_id = '$section_id'  ";
        echo InputSelect($sql,"section_id","section_name","","section_id");
        echo "            </td>\n";
        echo "        </tr>\n";   
        //---------End---class_id----------------

        //---------START---from_date----------------
        //        echo "        <tr>\n";
        //        echo "            <td >" . reservation_date .  "</td>\n";
        //        echo "        </tr>\n";
        //        echo "        <tr>\n";
        //        echo "            <td >\n";
        //        echo "                 <input  type=\"date\" name=\"reservation_date\" value =\"$reservation_date\" >\n";
        //        echo "            </td>\n";
        //        echo "        </tr>\n";
        //        //---------End---from_date----------------
        //
        //        //---------START---from_time----------------
        //        echo "        <tr>\n";
        //        echo "            <td >" . _from_time .  "</td>\n";
        //        echo "        </tr>\n";
        //        echo "        <tr>\n";
        //        echo "            <td >\n";
        //        echo "                 <input  type=\"time\" name=\"from_time\" value =\"$from_time\" min=\"08:00\" max=\"14:00\" required>\n";
        //        echo "            </td>\n";
        //        echo "        </tr>\n";
        //---------End---from_time----------------

        //---------START---to_time----------------
        //        echo "        <tr>\n";
        //        echo "            <td >" . _to_time .  "</td>\n";
        //        echo "        </tr>\n";
        //        echo "        <tr>\n";
        //        echo "            <td >\n";
        //        echo "                 <input  type=\"time\" name=\"to_time\" value =\"$to_time\" min=\"09:00\" max=\"14:00\" required>\n";
        //        echo "            </td>\n";
        //        echo "        </tr>\n";
        //---------End---to_time----------------



        echo "    </table>\n";


        echo "           <hr>\n";
        echo "                  <input  type=\"submit\" name=\"_save\" value =\"Save\" >\n";

        echo "      </form>\n";


    }



    function save_reservation(){




        $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
        mysqli_set_charset($conn,"utf8");
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }

        $RecordID=intval($_REQUEST["RecordID"]);

        $user_id= $_POST["user_id"];

        $class_id= $_POST["class_id"];

        $reservation_date= $_POST["reservation_date"];

        $from_time= date("H:i:00",strtotime( $_POST["from_time"]));

        $to_time= date("H:i:00",strtotime($_POST["to_time"]));




        if ($RecordID == 0) {

            $sql = "SELECT * FROM `reservation` WHERE class_id='$class_id' and reservation_date='$reservation_date'
            and  (('$from_time' between from_time and to_time) or ('$to_time' between from_time and to_time) )";
            //        $sql = "SELECT * FROM `reservation` WHERE class_id='$class_id' and reservation_date='$reservation_date'
            //        and  ('$from_time' between from_time and to_time) ";
            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) == 0) {
                $sql= "INSERT INTO reservation  (user_id,class_id,reservation_date,from_time,to_time) Values ('".$user_id."','".$class_id."','".$reservation_date."','".$from_time."','".$to_time."')";
                $result = mysqli_query($conn, $sql);
            }else{
                //echo "<h1>$sql</h1>";
                echo "<div class=\"alert alert-danger\">\n";
                echo "  <strong> خطأ !</strong> لا يمكن حجز هذه القاعة لتعارض الوقت مع حجز آخر</div>";
                DrowTable(1,_config_start_part,_config_end_part);
                return;
            }



        }


        if ($RecordID > 0) {
            $sql= "UPDATE reservation SET   user_id='".$user_id."',class_id='".$class_id."',reservation_date='".$reservation_date."',from_time='".$from_time."',to_time='".$to_time."'  WHERE res_id='$RecordID'   ";
            $result = mysqli_query($conn, $sql);
        }


        header("Location: index.php");
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


}

?>