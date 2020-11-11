<?PHP
function InputSelect($sql,$FieldValue,$FieldView,$value,$name){
    $conn = mysqli_connect(_config_db_host, _config_db_user, _config_db_pass,_config_db_name);
    mysqli_set_charset($conn,"utf8");


    $rst = mysqli_query($conn, $sql);

    $result.= "<select class='form-control' name=".$name." id='id_{$name}'>";
    // $result.= "<option value=''  >__</option>" ;
    if (mysqli_num_rows($rst) > 0) {

        while($row = mysqli_fetch_assoc($rst)) {
            $sel = $row[$FieldValue];
            $FV=$row[$FieldValue];
            $FS = $row[$FieldView];
            if (($sel==$value) and ($value<>"")){
                $sel="selected";
            }else{
                $sel="";
            }
            $result.= "<option value='". $FV ."' " . $sel . " >". $FS ."</option>" ;
        }
    }

    $result.= "</select>";
    mysqli_close($conn);

    return $result;
}
?>