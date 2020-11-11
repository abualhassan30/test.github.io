<?
ob_start();
session_start();
require_once("inc/Config.php");
require_once("Style/Workspace.php");
require_once("inc/InputSelect.php");
?>

<!DOCTYPE html>
<html>
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>مشروع القاعات</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">



    <link rel="stylesheet" type="text/css" href="Style/my.css">

    <link rel="stylesheet" href="Style/font-awesome-4.7.0/css/font-awesome.min.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" ></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <script src="Style/GetSection.js"></script>





</head>

<body >

<div class="header">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 25%;"><a href="index.php"><img src="Style/images/logo.png"></a></td>
                <td style="text-align: center;" >
                    <?

                    echo date("Y-m-d l ",time()); 
                    echo "<br>";
                    //echo $_SESSION["section_id"];

                    ?>  

                </td>
            </tr>
        </tbody>
    </table>

</div>

<div class="lineUnderLogo"></div>



<?


if($_SESSION["user_id"]){


    LoadMenu($_SESSION["group_id"]);

}else{

    MenuOfMainSite();

}

function LoadMenu($group_type ){


    if($group_type == 1){
        MenuOfManger();

    }elseif($group_type==2){

        MenuOfAgent();

    }


}


function MenuOfAgent(){
    echo " <nav class=\"navbar navbar-expand-md bg-light navbar-light\">\n";
    echo "  <!-- Brand -->\n";
    echo "  <a class=\"navbar-brand\" href=\"index.php\">وكيل</a>\n";
    echo "\n";
    echo "  <!-- Toggler/collapsibe Button -->\n";
    echo "  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">\n";
    echo "    <span class=\"navbar-toggler-icon\"></span>\n";
    echo "  </button>\n";
    echo "\n";
    echo "  <!-- Navbar links -->\n";
    echo "  <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">\n";
    echo "    <ul class=\"navbar-nav\">\n";
    echo "\n";
    echo "\n";
    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"building.php\">المباني</a>\n";
    echo "      </li>\n";
    echo "\n";
    echo "\n";
    echo "<!--      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"sections.php\">الاقسام</a>\n";
    echo "      </li> -->\n";
    echo "\n";
    echo "<!--      <li class=\"nav-item\">\n";
    echo "        <a class=\"nav-link\" href=\"classes.php\">القاعات</a>\n";
    echo "      </li>  -->\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "\n";
    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"users.php\">المستخدمين</a>\n";
    echo "      </li>\n";
    echo "\n";
    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"out.php\">تسجيل خروج</a>\n";
    echo "      </li>\n";
    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";

}


function MenuOfManger(){
    echo " <nav class=\"navbar navbar-expand-md bg-light navbar-light\">\n";

    echo "  <a class=\"navbar-brand\" href=\"index.php\">رئيس قسم</a>\n";

 
    echo "  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">\n";
    echo "    <span class=\"navbar-toggler-icon\"></span>\n";
    echo "  </button>\n";

  
    echo "  <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">\n";
    echo "    <ul class=\"navbar-nav\">\n";


    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"reservation.php\">الحجوزات</a>\n";
    echo "      </li>\n";

    echo "     <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"section_option.php\">خيارات</a>\n";
    echo "      </li> \n";

    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"out.php\">تسجيل خروج</a>\n";
    echo "      </li>\n";
 
    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";

}


function MenuOfMainSite(){

    echo " <nav class=\"navbar navbar-expand-md  bg-light navbar-light\">\n";

    echo "  <a class=\"navbar-brand\" href=\"index.php\">مرحبا</a>\n";

    echo "  <!-- Toggler/collapsibe Button -->\n";
    echo "  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">\n";
    echo "    <span class=\"navbar-toggler-icon\"></span>\n";
    echo "  </button>\n";

    echo "  <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">\n";
    echo "    <ul class=\"navbar-nav\">\n";

    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"home.php\">نبذه عن الموقع</a>\n";
    echo "      </li>\n";

    echo "      <li class=\"nav-item\">\n";
    echo "      <a class=\"nav-link\" href=\"contact.php\">اتصل بنا </a>\n";
    echo "      </li> \n";

    echo "      <li class=\"nav-item\">\n";
    echo "        <a class=\"nav-link\" href=\"login.php\">تسجيل دخول</a>\n";
    echo "      </li>  \n";




    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";   
}
?>

<div class="container" >









