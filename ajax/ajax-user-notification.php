<?php  


echo "<strong class=\"balloon_box_color\">Notification</strong><br/><br/>";

include '../db/db-connect.php';


// ==================================================================
//
// function time
//
// ------------------------------------------------------------------
// Get second
function realtime($timestap) {
        
    $realtime = strtotime($timestap);

    return $realtime;
}

// 12 min ago..
function time_since($time) {


    $original = realtime($time);

    // array of time period chunks
    $chunks = array(
    array(60 * 60 * 24 * 365 , 'year'),
    array(60 * 60 * 24 * 30 , 'month'),
    array(60 * 60 * 24 * 7, 'week'),
    array(60 * 60 * 24 , 'day'),
    array(60 * 60 , 'hour'),
    array(60 , 'min'),
    array(1 , 'sec'),
    );
 
    $today = time(); /* Current unix time  */
    $since = $today - $original;
 
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
 
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
 
    // finding the biggest chunk (if the chunk fits, break)
    if (($count = floor($since / $seconds)) != 0) {
        break;
    }
    }
 
    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
 
    if ($i + 1 < $j) {
    // now getting the second item
    $seconds2 = $chunks[$i + 1][0];
    $name2 = $chunks[$i + 1][1];
 
    // add second item if its greater than 0
    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s ago";
    }
    }
    return $print;
}

/*--------------------------------------------------------------------------------*/

$usr_id = $_GET['id'];


// $sqlNotification = "SELECT
//   mj_users1.usr_name As requestBy,
//   mj_users.usr_name As notiTo,
//   mj_notification.noti_datetime As notiPosted,
//   mj_notification_type.noti_type_name As notiTypeName,
//   mj_notification.noti_status,
//   mj_notification.noti_id As notiID,
//   mj_users1.usr_id As requestIdFK,
//   mj_users1.user_pic As usrPic1
// From
//   mj_notification Inner Join
//   mj_users On mj_notification.noti_to_usr_id = mj_users.usr_id Inner Join
//   mj_users mj_users1 On mj_notification.noti_request_usr_id_fk =
//     mj_users1.usr_id Inner Join
//   mj_notification_type On mj_notification.noti_type_id_fk =
//     mj_notification_type.noti_type_id
// Where
//   mj_notification.noti_to_usr_id = '$usr_id'
// Group By
//   mj_users1.usr_name, mj_users.usr_name, mj_notification.noti_datetime,
//   mj_notification_type.noti_type_name, mj_notification.noti_status,
//   mj_notification.noti_to_usr_id, mj_notification.noti_id
// Order By
//   mj_notification.noti_datetime Desc";

$sqlNotification = "SELECT
  mj_users1.usr_name As requestBy,
  mj_users.usr_name As notiTo,
  mj_notification.noti_datetime As notiPosted,
  mj_notification.noti_status,
  mj_notification.noti_id As notiID,
  mj_users1.usr_id As requestIdFK,
  mj_users1.user_pic As usrPic1,
  mj_notification.noti_type_id_fk As notiTypeName,
  mj_notification.*
From
  mj_notification Inner Join
  mj_users On mj_notification.noti_to_usr_id = mj_users.usr_id Inner Join
  mj_users mj_users1 On mj_notification.noti_request_usr_id_fk =
    mj_users1.usr_id
Where
  mj_notification.noti_to_usr_id = '$usr_id'
Group By
  mj_users1.usr_name, mj_users.usr_name, mj_notification.noti_datetime,
  mj_notification.noti_to_usr_id, mj_notification.noti_id
Order By
  mj_notification.noti_datetime Desc";

$resultNoti = mysql_query($sqlNotification);
$totalNoti  = mysql_num_rows($resultNoti);

if ($totalNoti == 0) {
  
  echo "No notification yet.";
}
else {

  while ($rowNoti = mysql_fetch_object($resultNoti)) {
      
?>


<div id="<?php echo $rowNoti->notiID; ?>" class="notirow">
  
  <a href="users.php?uid=<?php echo $rowNoti->requestIdFK; ?>" title="<?php echo $rowNoti->requestBy; ?>">
    
    <div class="profile-pic48" style="background-image: url('<?php echo $rowNoti->usrPic1; ?>'); float:left; margin-right: 10px;">
    </div>

    <div style="float:left; padding-top:5px; line-height: 20px;">
      <strong><?php echo ucwords($rowNoti->requestBy); ?></strong></a>  
        <?php 

        $notiType = $rowNoti->notiTypeName; 

        switch ($notiType) {

          case '1':
            echo 'has been <strong>message</strong> on you. view ' . '<a href="myinbox.php?id='.$usr_id.'" title="view message">View Message</a>';
            break;

          case 'idea':
            echo 'has been idea';
            break;

          case 'market':
            echo 'has been market';
            break;

          case 'review':
            echo 'has been review';
            break;

          case 'comment':
            echo 'has been <strong>comment</strong> on your submission';
            break;

          // Group
          case '6':

            $query_group_name = "SELECT * FROM mj_network WHERE mn_id = " . $rowNoti->mj_group_id_fk;
            $result_group_name = mysql_query($query_group_name);
            $row_group_name = mysql_fetch_object($result_group_name);

            echo 'has invite to join a <strong>group</strong> ' . $row_group_name->mn_name . '.';

            $query_detect_joined_group = "SELECT * FROM mj_network_relation WHERE usr_id_fk = $usr_id AND mn_id_fk = $rowNoti->mj_group_id_fk AND mnr_status = 1";
            $result_query_detect_joined_group = mysql_query($query_detect_joined_group);
            $rows_query_detect_joined_group = mysql_num_rows($result_query_detect_joined_group);

            if ($rows_query_detect_joined_group == 1) {
              # code...
            } else {

            echo ' <span class="gstatus" id="'.$rowNoti->mj_group_id_fk.'">Approved? <a href="approveGroup.php?curruid='.$usr_id.'&gid='.$rowNoti->mj_group_id_fk.'&status=1" title="" class="groupApproved" id="'.$usr_id.'" data-group="'.$rowNoti->mj_group_id_fk.'">Yes</a> | <a href="deleteGroup.php?curruid='.$usr_id.'&gid='.$rowNoti->mj_group_id_fk.'&delete=yes" title="">No</a></span>';

            }
            break;

          // friend requested
          case '7':
            echo 'want to <strong>follow on you</strong>. ';

            $query_already_friend = "SELECT * FROM mj_usr_network WHERE usr_network_usr_id_fk = $rowNoti->noti_to_usr_id AND usr_network_friend_usr_id_fk = $rowNoti->noti_request_usr_id_fk AND usr_network_approved = 0";
            $result_query_already_friend = mysql_query($query_already_friend);
            $rows_query_already_friend = mysql_num_rows($result_query_already_friend);

            if ($rows_query_already_friend == 1) {
              echo "You are friend now.";
            } else {

            echo '<span class="fstatus" id="'.$rowNoti->noti_to_usr_id.'">Approve? | <a href="#" title="" class="friendApproved" id="'.$rowNoti->noti_to_usr_id.'" data-friend="'.$rowNoti->noti_request_usr_id_fk.'">Yes</a> No </span>';

            }

            break;
        }


        ?> 
      <br>
      <?php  

      /* time ago new function */
       

      ?>
      <span class="clock_color"><?php echo $rowNoti->notiPosted; ?></span>
    </div>

    <div class="right" style="margin-top:10px;">
      <div class="actionApprove">
        <div class="action" id="<?php echo $rowNoti->requestIdFK; ?>">
          
          <?php if ($rowNoti->notiTypeName == 'friend') { ?>
            <a href="friend-requested.php?notiID=<?php echo $rowNoti->notiID; ?>" id="<?php echo $rowNoti->requestIdFK; ?>" data-friend="<?php echo $usr_id; ?>" style="font-size:11px; color:#aeaeae">Details</a>
          <?php } ?>

          <?php if ($rowNoti->notiTypeName == 'group') { ?>
            <a href="group-requested.php?notiID=<?php echo $rowNoti->notiID; ?>" id="<?php echo $rowNoti->requestIdFK; ?>" data-friend="<?php echo $usr_id; ?>" style="font-size:11px; color:#aeaeae">Details</a>
          <?php } ?>

        </div><!-- /action -->
        <div class="afterAction" id="<?php echo $rowNoti->requestIdFK; ?>">
          
        </div><!-- /html -->
      </div>
    </div>

    <div class="clear">
      
    </div>

</div><!-- /<?php echo $rowNoti->notiID; ?> -->

<?php  


  }

}

?>