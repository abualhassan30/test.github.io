<?PHP

class Booking{


    var $user_id;
    var $section_id;
    var $fromDate;
    var $Todate;



    function DrowTable($building_id,$from_time , $to_time){
        $from_time= $this->ReturnDayToFirst($from_time);

        echo "      <div class=\"card\" >";
        echo "<table border=\"1\" width=\"100%\" id=\"table1\">\n";
        echo "    <tr>\n";

        echo "        <td> Rooms</td>\n";

        for($i=0;$i<7;$i++){
            $ColDate = date("Y-m-d l",strtotime($from_time . " + $i day"));
            echo "        <td> $ColDate</td>\n";
        }

        echo "    </tr>\n";


       // load_classes($building_id,$from_time);


        echo "</table>";

        //form_reservation();
        echo "    </div>\n";
    }
    
    function ReturnDayToFirst($date){
        $fromSerila =  date("N",strtotime($date));

        if($fromSerila !=7){
            $date= date("Y-m-d l",strtotime($date . "- $fromSerila day"));
        }

        return $date;
    }

}



?>