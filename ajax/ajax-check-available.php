 
<?php  


// DB
include '../db/db-connect.php';


// ==================================================================
//
// Get string
//
// ------------------------------------------------------------------
$dateIn     = $_GET['dateIn'];
$timeCheck  = $_GET['timeCheck'];
$room       = $_GET['room'];
$uid        = $_GET['uid'];
$no_of_part = $_GET['no_of_part'];


// ==================================================================
//
// Debuging
//  
// ------------------------------------------------------------------
 


  // ==================================================================
  //
  // search query by name %s%
  //
  // ------------------------------------------------------------------
   

  /* if return 0 */
  if ($dateIn != null && $timeCheck != 0 && $room != 0) {
   




$query_rsbooking = "SELECT status_booking.booking_room_type As roomType,
                  
                  time_detail.time_name, status_booking. * , mj_users . * 
              
              FROM status_booking
              INNER JOIN room ON status_booking.booking_room_type = room.room_id
              INNER JOIN time_detail ON status_booking.time_booking = time_detail.time_id
              INNER JOIN mj_users ON status_booking.employer_id_fk = mj_users.usr_id
              Where
                -- jp_users.users_type = 1 And
                status_booking.date_booking = '$dateIn' And
                status_booking.booking_room_type ='$room' and
                status_booking.time_booking ='$timeCheck'";



$rsbooking             = mysql_query($query_rsbooking) or die(mysql_error());
$row_rsbooking         = mysql_fetch_object($rsbooking);
$totalRows_rsbooking   = mysql_num_rows($rsbooking);



if($totalRows_rsbooking == 1)
{
            
              ?>
                
                <script type="text/javascript"> 
                <?php 
                $qsec  = "SELECT
                  time_detail.time_id As timeID,
                  time_detail.time_name As timeName
                    From
                  time_detail";
                  $resultsec      = mysql_query($qsec);
  
  
            $rowsec  = mysql_fetch_object($resultsec); ?>

                alert("Already reserve for date: <?php echo $_GET['dateIn']; ?> . Please choose another day.."); 
                
               </script> 
            <?php

                // echo "reserve";  
              }
              else
              {  
                ?>
                <br/>
                <div id="available">
                  <button type ="button" value ="click" id ="clickA"> available </button>
                  </div>
                 

                 

                 <script type="text/javascript">
                  $(document).ready(function(){      
                 $('#clickA').click(function(){
                  var click      = $('#clickA').val();
                  var user_id = '<?php echo $uid; ?>';
                  var time_book = '<?php echo $timeCheck ?>';
                  var date_book = '<?php echo $dateIn ?>';
                  var room_book ='<?php echo $room ?>';
                  var no_of_part ='<?php echo $no_of_part ?>';


                  

                 window.location = "booking_form.php?uid="+user_id+"&tbook="+time_book+"&dbook="+date_book+"&rbook="+room_book+"&no_of_part="+no_of_part ;
      
      // window.location = "booking_form.php?uid="+user_id+"&tbook="+time_book+"&dbook="+date_book;

                return false;
              
  });
   });                

</script>
<?php  
   
    
    //console.log(searchsector+' - '+searchProduct+' - '+searchnetworkarea);
 
  

   }
 }


?>

