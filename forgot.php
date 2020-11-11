<?PHP

function form_lostPassword(){
    echo "<br>\n";
    echo "<br>\n";
    echo "<div class=\"container\">\n";
    echo "\n";
    echo "\n";
    echo "    <div class=\"card\" style=\"max-width:500px;margin: auto;\">\n";
    echo "        <div class=\"card-header\">\n";
    echo "            هل فقد ت كلمة مرورك\n";
    echo "        </div>\n";
    echo "        <div class=\"card-body\">\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "            <form action=\"login.php?switch=sendpassword\" method=\"post\"  >\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "                <div>\n";

    echo "\n";
    echo "                    <label  for=\"usr\">بريدك الإلكتروني :</label >\n";
    echo "                    <input type=\"text\" name=\"user_email\" class=\"form-control\"  id=\"user_email\">\n";
    echo "\n";

    echo "                    <hr>\n";

    echo "                    <div>\n";
    echo "                        <button type=\"submit\" class=\"btn btn-success\" >ارسل كلمة المرور</button>\n";
    echo "                    </div>\n";
    echo "\n";
    echo "                </div>\n";

    echo "            </form>\n";
    echo "\n";
    echo "        </div>\n";
    echo "    </div>\n";
    echo "</div>";

}

function sendpassword(){

    $user_email = $_POST["user_email"];

    if($user_email==""){
        echo "<br>";
        echo "<div class=\"alert alert-warning\">\n";
        echo "  <strong>خطأ!</strong>يجب كتابة البريد الإلكتروني.\n";
        echo "</div>";
    }  

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {

        die('Could not connect: ' . mysqli_error());

    }

    $sql = "select * from users where user_email = '$user_email' ";

    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        //SEND MAIL

        $to      = $row["user_email"];
        $subject = 'كلمة مرورك';
        $message = 'السلام عليكم : كلمة مرورك هي :' . $row["login_password"];
        $headers = 'From: kghamdi96@gmail.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

      $sent  =   mail($to, $subject, $message, $headers);    
      
      if($sent){
            echo "<br>";
        echo "<div class=\"alert alert-success\">\n";
        echo "  <strong>تم ارسال كلمة المرور !</strong>إذا لم تجد كلمة المرور في البريد الوارد تجدها في البريد المهمل.\n";
        echo "</div>";         
      }            

        return true;
    } 
        
           echo "<br>";
        echo "<div class=\"alert alert-warning\">\n";
        echo "  <strong>خطأ!</strong>لم يتم العثور على بريد الكتروني لك .\n";
        echo "</div>";

}

?>