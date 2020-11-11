<?php
function form_sections(){



    $RecordID =  $_SESSION["section_id"];

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

            $allow_other=$row["allow_other"];

        }
    }
    
    if($allow_other==1){
       $Checked_yes = "checked";
       $Checked_no = ""; 
    }else{
        $Checked_yes = "";
       $Checked_no = "checked";        
    }
    
    
    $URLAction = "?switch=save_sections";
    echo "      <div class=\"card\" >";
    echo "      <form method=\"POST\" action=\"$URLAction\">\n";


    echo "    <table  class=\"table\" width=\"100%\" >\n";


    //---------START---section_name----------------
    echo "        <tr>\n";
    echo "            <td >السماح لاقسام اخرى الحجز من قاعات قسمي</td>\n";
    echo "        </tr>\n";
    echo "        <tr>\n";
    echo "            <td >\n";
    //echo "                 <input class=\"form-control\"  type=\"text\" name=\"section_name\" value =\"$section_name\" >\n";

    echo "        <input type=\"radio\" id=\"radio-1\"  name='allow_other' value='1' $Checked_yes>\n";
    echo "      <label class=\"form-check-label\" for=\"radio-1\">نعم</label>\n"; 
    
    echo "<br>";
    
    echo "        <input type=\"radio\" id=\"radio-1\"  name='allow_other' value='0' $Checked_no>\n";
    echo "      <label class=\"form-check-label\" for=\"radio-1\">لا</label>\n"; 


    echo "            </td>\n";
    echo "        </tr>\n";
    //---------End---section_name----------------







    echo "    </table>\n";
    echo "      </div>\n";


    echo "           <hr>\n";
    echo "        <input class=\"btn btn-success\"  type=\"submit\" name=\"_save\" value =\"حفظ\" >\n";
    echo "        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">تراجع</button>\n";

    echo "      </form>\n";


}



function save_sections(){




    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $RecordID =  $_SESSION["section_id"];

    $allow_other= $_POST["allow_other"];







    if ($RecordID > 0) {
        $sql= "UPDATE sections SET   allow_other='".$allow_other."'  WHERE section_id='$RecordID'   ";
        $result = mysqli_query($conn, $sql);
    }


    header("Location: section_option.php");
}

?>