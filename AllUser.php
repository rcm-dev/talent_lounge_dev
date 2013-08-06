<?php  


/* Include header */
include 'header.php';
include 'class/short.php';

function shortUpdate($text) { 

    // Change to the number of characters you want to display 
    $chars = 90; 

    $text = $text." "; 
    $text = substr($text,0,$chars); 
    $text = substr($text,0,strrpos($text,' '));

    if ($chars > 90) {
    	$text = $text."...";
    }
    else {
    	$text = $text."";
    }


    return $text; 

}

// Function seo friendly
function seo_url($string) 
{

	$seoname = preg_replace('/\%/',' percentage',$string); 
	$seoname = preg_replace('/\@/',' at ',$seoname); 
	$seoname = preg_replace('/\&/',' and ',$seoname);
	$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
	$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
	$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
	$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens  
	//$seoname = trim(str_replace(range(0,9),'',$seoname));
	$seoname = strtolower($seoname);

	echo $seoname;
}




$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($dbname, $db);
$query_rsTenLatestJob = "SELECT ads_id, ads_title FROM jp_ads WHERE ads_enable_view = 1 ORDER BY ads_date_posted DESC";
$rsTenLatestJob = mysql_query($query_rsTenLatestJob, $db) or die(mysql_error());
$row_rsTenLatestJob = mysql_fetch_assoc($rsTenLatestJob);
$totalRows_rsTenLatestJob = mysql_num_rows($rsTenLatestJob);

$maxRows_rsAllTalent = 30;
$pageNum_rsAllTalent = 0;
if (isset($_GET['pageNum_rsAllTalent'])) {
  $pageNum_rsAllTalent = $_GET['pageNum_rsAllTalent'];
}
$startRow_rsAllTalent = $pageNum_rsAllTalent * $maxRows_rsAllTalent;

mysql_select_db($dbname, $db);
$query_rsAllTalent = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_last_login As setLastlogin,
  mj_users.usr_email As setemail,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat As WorkAt,
  
  mj_users.usr_general_info As CurGenInfo,
  mj_users.usr_rating,
  mj_users.usr_core_activity,
  mj_users.mj_sector_fk,
  mj_users.mj_services_fk,
  mj_sector.sec_name,
  mj_services.services_name As Profession,
  mj_state.state_name As Location,
  mj_country.country_name,
  jp_skills.skills_name As Skills,
  jp_edu_lists.edu_name As Education

From
  mj_users Inner Join
  mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id Inner Join
  mj_services On mj_users.mj_services_fk = mj_services.services_id Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id Inner Join
  mj_country On mj_users.mj_country_id_fk = mj_country.country_id Inner Join
  jp_skills On jp_skills.user_id_fk = mj_users.users_id Inner Join
  jp_education On jp_education.user_id_fk = mj_users.users_id Inner Join
  jp_edu_lists On jp_education.edu_qualification = jp_edu_lists.edu_id ";
$query_limit_rsAllTalent = sprintf("%s LIMIT %d, %d", $query_rsAllTalent, $startRow_rsAllTalent, $maxRows_rsAllTalent);
$rsAllTalent = mysql_query($query_limit_rsAllTalent, $db) or die(mysql_error());
$row_rsAllTalent = mysql_fetch_assoc($rsAllTalent);

if (isset($_GET['totalRows_rsAllTalent'])) {
  $totalRows_rsAllTalent = $_GET['totalRows_rsAllTalent'];
} else {
  $all_rsAllTalent = mysql_query($query_rsAllTalent);
  $totalRows_rsAllTalent = mysql_num_rows($all_rsAllTalent);
}
$totalPages_rsAllTalent = ceil($totalRows_rsAllTalent/$maxRows_rsAllTalent)-1;

$queryString_rsAllTalent = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsAllTalent") == false && 
        stristr($param, "totalRows_rsAllTalent") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsAllTalent = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsAllTalent = sprintf("&totalRows_rsAllTalent=%d%s", $totalRows_rsAllTalent, $queryString_rsAllTalent);
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

?>

<div id="filterSection">
	<div class="center" style="padding:2px 0px">
		<div style="padding-left: 8px;">
			Filter by:
		</div>
	</div>
</div>



	<div class="center">
		 <div id="wrapper">
  
  <section id="middle">

      <div id="content_full" style="padding-top:10px;margin-top:30px;">
              <h1 class="title">Browse the Talent</h1>
              <p>There are <?php echo $totalRows_rsAllTalent ?> Talent(s).</p>
              <?php if ($totalRows_rsAllTalent > 0) { // Show if recordset not empty ?>



  <ul id="job-cards">
    <?php while ($row_rsAllTalent = mysql_fetch_object($rsAllTalent)) { ?>
      <li>

        <div>
          
          <div class="profile left" style="border:0px solid orange; width: 110px;height:115px; padding:5px; margin:5px">
            
              <h2 class="titleImg"><?php echo ucwords($rowviewusrSQL->currName); ?></h2>
              <div style="background-image:url('<?php echo $row_rsAllTalent->emp_pic; ?>'); width:110px; height:105px; background-repeat:no-repeat; background-position: top center; background-repeat:no-repeat; background-position: top center;  background-color:#f1f1f1">
                    
                    <!-- <img src="<?php echo $rowviewusrSQL->usrPicture; ?>" width="64" /> -->

                    </div>

          </div>
          <div class="profile right" style="border:0px solid purple;  width: 730px;  height:200px; margin:10px; padding:5px; ">
        <div class="profile22 left" style=" float:left; border:0px solid #4c4c4c;  width: 260px; height:180px; margin:10px; padding:5px; ">
                  <table>
                  <tr>
                    <td>

	
                      <tr><td>NAME :</td><td><?php echo $row_rsAllTalent->currName ?></td> </tr>
                      <tr><td>PROFESSION :</td><td><?php echo $row_rsAllTalent->Profession ?></td></tr>
                      <tr><td>SKILLS :</td><td><?php echo $row_rsAllTalent->Skills ?></td></tr>
                      <tr><td>EDUCATION :</td><td><?php echo $row_rsAllTalent->Education ?></td></tr>
                      <tr><td>EMPLOYER :</td><td> <?php echo $row_rsAllTalent->WorkAt ?></td></tr>
                      <tr><td>LOCATION :</td><td><?php echo $row_rsAllTalent->Location ?></td></tr>
                      <tr></tr>

                    </td>
                 </tr>               

               </table>
              
              
</div>
<div class="profile23 left" style="float:right; border:0px solid #4c4c4c;  width: 400px; height:180px; margin:10px; padding:5px; ">

     <div style="float:left; border:0px solid red; padding:10px;" >
            <h3 style="font-weight: bold; color:#312F53" class="users_color">Network</h3>
            <?php

            // ==================================================================
            //
            // display friends
            //
            // ------------------------------------------------------------------
            
            $qFriend = "SELECT
              mj_users.usr_name As friendName,
              mj_users.usr_id As usrGetId,
              mj_users.user_pic As usrPicture,
              mj_users.usr_workat As WorkAt
            From
              mj_usr_network Inner Join
              mj_users On mj_users.usr_id = mj_usr_network.usr_network_friend_usr_id_fk
            Where
              mj_usr_network.usr_network_usr_id_fk = '$get_user_id' And
              mj_usr_network.usr_network_friend_usr_id_fk != '$get_user_id' And
              mj_usr_network.usr_network_approved = 0";

            $rqFriend = mysql_query($qFriend);
            $numrowqFriend = mysql_num_rows($rqFriend);

            if ($numrowqFriend == 0) {
              
              echo "This user does not have any friends yet.";

            } else {

              echo '<ul class="friendsUserView">';

              while ($rowqFriend = mysql_fetch_object($rqFriend)) { ?>

            <li>
              <a href="users.php?uid=<?php echo $rowqFriend->usrGetId; ?>">
              <div class="namePic" original-title="<?php echo $rowqFriend->friendName; ?>">
                <div class="profile-pic48">
                  <div style="width:48px; height:48px; background-position: top center; background-size: 100%; background-image:url('<?php echo $rowqFriend->usrPicture; ?>'); background-repeat: no-repeat;">
                    
                  </div>
                  <!-- <img src="<?php echo $rowqFriend->usrPicture; ?>" width="48" /> -->
                </div >
              
              </a>
              <div class="clear"></div>
            </li>

            <?php

              }

              echo '</ul>';
              
            }

            ?>
            </div>

             

             <div style="float:right" class="button green">        <?php  

              // ==================================================================
              //
              // Displayuser profile
              //
              // ------------------------------------------------------------------
              
              $qAlreadyFriend = "SELECT
                mj_usr_network.usr_network_friend_usr_id_fk,
                mj_usr_network.usr_network_usr_id_fk,
                mj_usr_network.usr_network_friend_usr_id_fk As isFriend,
                mj_usr_network.usr_network_approved As isFriendStatus
              From
                mj_usr_network
              Where
                mj_usr_network.usr_network_usr_id_fk = '$usr_id' And
                mj_usr_network.usr_network_friend_usr_id_fk = '$get_user_id'";
              
              $resultAlreadyFriend = mysql_query($qAlreadyFriend);
              $rowAlreadyFriend = mysql_fetch_object($resultAlreadyFriend);

              $numrowAlreadyFriend = mysql_num_rows($resultAlreadyFriend);
              

              if ($numrowAlreadyFriend == 1) { ?>
              
                <?php 

                $isFriend = $rowAlreadyFriend->isFriend; 

                if ($isFriend == $usr_id) { ?>

                  

                <?php } else { ?>
                  
                  <?php if ($rowAlreadyFriend->isFriendStatus == 0) { ?>

                    Followed
                    
                  <?php } else { ?>

                    Waiting for Approved

                  <?php } ?>
                  
                <?php } ?>


              <?php } else { ?>


                
                  
                  <a href="#" id="send-request-friend">
                  Follow <?php echo $rowviewusrSQL->currName; ?>
                  </a>
                  <input type="hidden" name="getviewuserid" id="getviewuserid" value="<?php echo $get_user_id; ?>">

                  <input type="hidden" name="currUsrId" id="currUsrId" value="<?php echo $usr_id; ?>">
                  
              
              <?php } ?>
          </div>


          <div style="border:1px; margin:10px;"><a href="connect_share_view.php?uid=<?php echo $row_rsAllTalent->usr_id;?>" class="tl-btn-blue">View Profle!</a>
           </div>
   




<div class="clear"></div>









        </div>
        
  <div class="clear"></div>

               </div>



  <div class="clear"></div>
        </div>
        
     
           
      </li>
      <?php } ?>

  </ul>
              <div class="paginate"><a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, 0, $queryString_rsAllTalent); ?>">First</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, max(0, $pageNum_rsAllTalent - 1), $queryString_rsAllTalent); ?>">Previous</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, min($totalPages_rsAllTalent, $pageNum_rsAllTalent + 1), $queryString_rsAllTalent); ?>">Next</a> | <a href="<?php printf("%s?pageNum_rsAllTalent=%d%s", $currentPage, $totalPages_rsAllTalent, $queryString_rsAllTalent); ?>">Last</a> | 
Records <?php echo ($startRow_rsAllTalent + 1) ?> to <?php echo min($startRow_rsAllTalent + $maxRows_rsAllTalent, $totalRows_rsAllTalent) ?> of <?php echo $totalRows_rsAllTalent ?></div>
                <?php } // Show if recordset not empty ?>
          </div><!-- #content-->
  
      <!-- <aside id="sideRight"> -->
              <?php //include('full_content_sidebar.php'); ?>
          <!-- </aside> -->
      <!-- aside -->
      <!-- #sideRight -->

    

  </section><!-- #middle-->

  </div><!-- #wrapper-->
</div>
<?php
?>




	</div>
</div>








<input type="hidden" name="page_title" value="Training" id="page_title" />

<script>
$(document).ready(function(){

	/*$('#intervalStream').load('ajax/ajax-landing-stream.php');
    
   function test () {
   		console.log('RUN');
   		$('#intervalStream').load('ajax/ajax-landing-stream.php');
   		//$('#ImgOne').fadeOut(4000).fadeIn(4000);
   }

   var refreshId = setInterval(test, 5000);*/


   /* vertical ticker */
	$('#intervalStream').totemticker({
		row_height	:	'85px',
	});
   /*-------------------------------------------------------------------*/



   /* tipsy */
	$('.idea-new-ui').find('li img').tipsy({gravity: 's'});

	$('.book-ui').find('li img').tipsy({gravity: 's'});

	$('.ideaMisc').find('div .ic_attachment_grey').tipsy({gravity: 's'});

/* request friends */
  $('#send-request-friend').click(function(){
    
    var getuserviewid = $('#getviewuserid').val();
    var currUsrId   = $('#currUsrId').val();

    $.ajax({
        
      type: "POST",
      url: "ajax/friend-requested.php",
      data: 'getuserviewid=' + getuserviewid + '&currUsrId=' + currUsrId,
      cache: false,

      success: function(html){

        var url_to_load = 'users.php?uid=';
        //$('#followFriendBtn').load(url_to_load+getuserviewid+ ' #followFriendBtn');
        $('#send-request-friend').hide();
        $('#followFriendBtn').fadeIn('slow').append(html);
        //console.log(url_to_load + 'DONE');
        
      }

    });

  });


	/* Change services */
	$('#searchsector').change(function(){

		var sectorID = $(this).val();
	

		$('#searchProduct').load('ajax/ajax-selectsector.php?sectorid='+sectorID);
		console.log(sectorID);
		

	});


	$('.flexslider').flexslider({
	    animation: "fade"
	  });


});
</script>
<?php  

/* Include header */
include 'footer.php';

?>