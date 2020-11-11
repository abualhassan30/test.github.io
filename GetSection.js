


function GetSections(building_id){

    var url =  "GetData/GetSections.php?building_id=" + building_id; 
    $.ajax({
        url: url ,
        dataType: "text",
        type: "GET",
        success: function(data){


            $("#id_sections").html( data );


        },
        error: function( jqXhr, textStatus, errorThrown ){
         
            alert( errorThrown );
        }
    }); 
}


function OpenModalNewReservation(_class_id,_date,_time_id){
   $("#loading").show();
              
    var url =  "GetData/ModalNewReservation.php?class_id=" + _class_id + "&date="+ _date + "&time_id=" + _time_id ; 
    $.ajax({
        url: url ,
        dataType: "text",
        type: "GET",
        success: function(data){


            $("#tools").html( data );
            
            $("#loading").hide();
            $("#myModalNewResvration").modal({show:true});

        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            
        }
    }); 
}


function OpenModalCancelReservation(_res_id){
   $("#loading").show();
              
    var url =  "GetData/ModalCancelReservation.php?res_id=" + _res_id  ; 
    $.ajax({
        url: url ,
        dataType: "text",
        type: "GET",
        success: function(data){


            $("#tools").html( data );
            
            $("#loading").hide();
            $("#myModalCancelResvration").modal({show:true});

        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            
        }
    }); 
}

function OpenModalNewReservation_save(){ 
  
   $("#loading").show();
              
    var url =  "GetData/ModalNewReservation.php?switch=save_new";
    var dataString =  $("#FormaModalNewResevation").serialize();
    $.ajax({
        url: url ,
        data: dataString,
        type: "POST",
        success: function(data){

            $("#Action").html(data);
            
            $("#loading").hide();
             $("#ContentNewResvration").hide(1000); 
             $("#btn-start-Reservation").hide();
             $("#ContentDone").show(1000);
           
             refresh_table();
             
             
        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            alert( errorThrown );
        }
    }); 
}


function OpenModalCancelReservation_save(){ 
  
   $("#loading").show();
              
    var url =  "GetData/ModalCancelReservation.php?switch=do_cancel";
    var dataString =  $("#FormaModalCancelResevation").serialize();
    $.ajax({
        url: url ,
        data: dataString,
        type: "POST",
        success: function(data){

            $("#Action").html(data);
            $("#loading").hide();
            
             $("#ContentCancelResvration").hide(500); 
             $("#btn-start-CancelReservation").hide();
             $("#ContentDoneCancel").show(500);
             refresh_table();
        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            alert( errorThrown );
        }
    }); 
}

function refresh_table(){ 
  
   $("#loading").show();
              
    var url =  "get.php?switch=refresh_table";

    $.ajax({
        url: url ,
        dataType: "text",
        type: "GET",
        success: function(data){

            $("#loading").hide();
            $("#DrowTableContent").html(data);
            

        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            alert( errorThrown );
        }
    }); 
}


function refresh_table_new_date(ctldate,ctlsection){ 
  
   $("#loading").show();
    
    var date = $("#"  + ctldate ).val();
    var section_id = $("#"  + ctlsection ).val();
              
    var url =  "get.php?switch=refresh_table_new_date&selectdate=" + date + "&selectsection_id=" + section_id;
    

    $.ajax({
        url: url ,
        dataType: "text",
        type: "GET",
        success: function(data){

            $("#loading").hide();
            $("#DrowTableContent").html(data);
            

        },
        error: function( jqXhr, textStatus, errorThrown ){
            $("#loading").hide();
            alert( errorThrown );
        }
    }); 
}


