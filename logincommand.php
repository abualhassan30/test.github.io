<?php


function LoginSign($login_id,$login_password){

    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");
    if(! $conn ) {

        die('Could not connect: ' . mysqli_error());

    }

    $sql = "select * from users where login_id = '$login_id' and login_password = '$login_password'";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["user_name"] = $row["user_name"];
        $_SESSION["section_id"] = $row["section_id"];
        $_SESSION["user_email"] = $row["user_email"];
        $_SESSION["group_id"] = $row["group_id"] ;
        $_SESSION["selectsection_id"] = $row["section_id"];
          
        return true;
    } else{
        return false;
    }


}
?>
