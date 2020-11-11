<?php


require_once("Style/header.php");


$switch = $_GET["switch"];




switch ($switch) {



    
    case "sendpassword";
    require_once("inc/forgot.php");
       sendpassword();
    break;

    case "login";
        require_once("inc/logincommand.php");

        $isCorrect =  LoginSign($_POST["login_id"],$_POST["login_password"]);


        if($isCorrect){
            header("Location: index.php");

            die();

        }else{


            echo "<br>";
            echo "<div class=\"alert alert-warning\">\n";
            echo "  <strong>خطأ!</strong>خطا اسم المستخدم وكلمة المرور.\n";
            echo "</div>";            

            require_once("inc/loginform.php");
        }
        break;



    default;
        require_once("inc/loginform.php");
        break;
}




require_once("Style/footer.php");


?>




